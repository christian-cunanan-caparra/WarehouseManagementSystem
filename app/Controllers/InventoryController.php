<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\StockRequestModel;
use CodeIgniter\Controller;

class InventoryController extends Controller
{
    protected $productModel;
    protected $stockRequestModel;

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

    // Create a request to add stock
    public function requestAddStock($id)
    {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $quantity > 0) {
            $this->stockRequestModel->save([
                'product_id' => $id,
                'quantity' => $quantity,
                'action' => 'add',
                'status' => 'pending',
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock addition request submitted for approval.');
        }

        return redirect()->to('/inventory')->with('error', 'Invalid quantity or product not found.');
    }

    // Create a request to remove stock
    public function requestRemoveStock($id)
    {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $product['remaining_stock'] >= $quantity && $quantity > 0) {
            $this->stockRequestModel->save([
                'product_id' => $id,
                'quantity' => $quantity,
                'action' => 'remove',
                'status' => 'pending',
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock removal request submitted for approval.');
        }

        return redirect()->to('/inventory')->with('error', 'Insufficient stock or invalid quantity.');
    }

    // Approve or reject the stock request
    public function approveRejectRequest($requestId, $status)
    {
        $request = $this->stockRequestModel->find($requestId);

        if ($request && in_array($status, ['approved', 'rejected'])) {
            $this->stockRequestModel->update($requestId, ['status' => $status]);

            if ($status == 'approved') {
                $product = $this->productModel->find($request['product_id']);
                if ($request['action'] == 'add') {
                    $newStock = $product['stock_in'] + $request['quantity'];
                    $remainingStock = $newStock - $product['stock_out'];
                    $this->productModel->update($request['product_id'], [
                        'stock_in' => $newStock,
                        'remaining_stock' => $remainingStock
                    ]);
                } elseif ($request['action'] == 'remove') {
                    $newStockOut = $product['stock_out'] + $request['quantity'];
                    $remainingStock = $product['stock_in'] - $newStockOut;
                    $this->productModel->update($request['product_id'], [
                        'stock_out' => $newStockOut,
                        'remaining_stock' => $remainingStock
                    ]);
                }
            }

            return redirect()->to('/inventory')->with('success', 'Request has been ' . $status . '.');
        }

        return redirect()->to('/inventory')->with('error', 'Invalid request.');
    }



    public function approveRequests()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stock_requests');
        $builder->select('stock_requests.*, products.name as product_name');
        $builder->join('products', 'products.id = stock_requests.product_id');
        $builder->where('stock_requests.status', 'pending');
        $data['requests'] = $builder->get()->getResultArray();
    
        return view('inventory/approve_requests', $data);
    }
    

}
