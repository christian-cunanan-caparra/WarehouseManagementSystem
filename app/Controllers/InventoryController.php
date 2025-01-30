<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class InventoryController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
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
    if ($this->request->isAJAX()) {
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
            $db = \Config\Database::connect();
            $db->table('inventory_logs')->insert([
                'product_id' => $id,
                'action' => 'Added',
                'quantity' => $quantity
            ]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Stock added successfully.', 'remaining_stock' => $remainingStock]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid quantity or product not found.']);
    }
}

public function removeStock($id)
{
    if ($this->request->isAJAX()) {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $product['remaining_stock'] >= $quantity && $quantity > 0) {
            $newStockOut = $product['stock_out'] + $quantity;
            $remainingStock = $product['stock_in'] - $newStockOut;

            $this->productModel->update($id, [
                'stock_out' => $newStockOut,
                'remaining_stock' => $remainingStock
            ]);

            // Log the stock removal
            $db = \Config\Database::connect();
            $db->table('inventory_logs')->insert([
                'product_id' => $id,
                'action' => 'Removed',
                'quantity' => $quantity
            ]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Stock removed successfully.', 'remaining_stock' => $remainingStock]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Insufficient stock or invalid request.']);
    }
}

}
