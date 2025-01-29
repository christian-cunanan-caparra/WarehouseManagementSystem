<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class InventoryController extends Controller
{
    protected $productModel;
    protected $db;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->db = \Config\Database::connect();
    }

    // Display all products with stock details
    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('inventory/index', $data);
    }

    // Add stock to a product
    public function addStock($id)
    {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $quantity > 0) {
            $newStock = $product['stock_in'] + $quantity;
            $remainingStock = $newStock - $product['stock_out'];

            $this->productModel->update($id, [
                'stock_in' => $newStock,
                'remaining_stock' => $remainingStock
            ]);

            // Log the stock addition
            $this->db->table('inventory_logs')->insert([
                'product_id' => $id,
                'action' => 'Added',
                'quantity' => $quantity
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock added successfully.');
        }

        return redirect()->to('/inventory')->with('error', 'Invalid quantity or product not found.');
    }

    // Request to remove stock (Needs Admin Approval)
    public function requestStockRemoval($id)
    {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $quantity > 0 && $product['remaining_stock'] >= $quantity) {
            $this->db->table('stock_removal_requests')->insert([
                'product_id' => $id,
                'quantity' => $quantity,
                'status' => 'pending',
                'requested_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock removal request submitted.');
        }

        return redirect()->to('/inventory')->with('error', 'Invalid request.');
    }

    // Display stock removal requests for approval
    public function stockRemovalRequests()
    {
        $data['requests'] = $this->db->table('stock_removal_requests')
            ->where('status', 'pending')
            ->join('products', 'products.id = stock_removal_requests.product_id')
            ->select('stock_removal_requests.*, products.name')
            ->get()->getResultArray();

        return view('inventory/stock_removal_requests', $data);
    }

    // Approve stock removal request
    public function approveRemoval($requestId)
    {
        $request = $this->db->table('stock_removal_requests')->where('id', $requestId)->get()->getRowArray();

        if ($request && $request['status'] === 'pending') {
            $product = $this->productModel->find($request['product_id']);
            $newStockOut = $product['stock_out'] + $request['quantity'];
            $remainingStock = $product['stock_in'] - $newStockOut;

            if ($remainingStock >= 0) {
                $this->productModel->update($request['product_id'], [
                    'stock_out' => $newStockOut,
                    'remaining_stock' => $remainingStock
                ]);

                $this->db->table('stock_removal_requests')->where('id', $requestId)->update(['status' => 'approved']);

                // Log the stock removal
                $this->db->table('inventory_logs')->insert([
                    'product_id' => $request['product_id'],
                    'action' => 'Removed',
                    'quantity' => $request['quantity']
                ]);

                return redirect()->to('/inventory/stock_removal_requests')->with('success', 'Stock removal approved.');
            }
        }

        return redirect()->to('/inventory/stock_removal_requests')->with('error', 'Invalid request.');
    }

    // Reject stock removal request
    public function rejectRemoval($requestId)
    {
        $this->db->table('stock_removal_requests')->where('id', $requestId)->update(['status' => 'rejected']);

        return redirect()->to('/inventory/stock_removal_requests')->with('success', 'Stock removal request rejected.');
    }
}
