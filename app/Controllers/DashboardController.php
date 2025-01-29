<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Dashboard View
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        if ($role === 'Admin') {
            return view('admin_dashboard');
        } elseif ($role === 'Employee') {
            $data['products'] = $this->productModel->where('status', 1)->findAll();
            return view('employee_dashboard', $data);
        }

        return redirect()->to('/login');
    }

    // Create Product View
    public function create()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('create_product');
    }

    // Store Product
    public function store()
    {
        $data = $this->request->getPost();
        $data['status'] = 1;

        if ($this->productModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Product added successfully.']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add product.']);
    }

    // Edit Product View
    public function edit($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('edit_product', ['product' => $this->productModel->find($id)]);
    }

    // Update Product
    public function update($id)
    {
        $data = $this->request->getPost();

        if ($this->productModel->update($id, $data)) {
            return $this->response->setJSON(['message' => 'Product updated successfully.']);
        }

        return $this->response->setJSON(['message' => 'Failed to update product.']);
    }

    // Deactivate Product
    public function delete($id)
    {
        $this->productModel->update($id, ['status' => 0]);
        session()->setFlashdata('success', 'Product deactivated successfully.');
        return redirect()->to('/employee_dashboard');
    }

    // Activate Product
    public function activate($id)
    {
        $this->productModel->update($id, ['status' => 1]);
        session()->setFlashdata('success', 'Product activated successfully.');
        return redirect()->to('/employee_dashboard');
    }

    // Inventory: Add Stock
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

            // Log stock addition
            $db = \Config\Database::connect();
            $db->table('inventory_logs')->insert([
                'product_id' => $id,
                'action' => 'Added',
                'quantity' => $quantity
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock added successfully.');
        }

        return redirect()->to('/inventory')->with('error', 'Invalid quantity or product not found.');
    }

    // Inventory: Remove Stock
    public function removeStock($id)
    {
        $product = $this->productModel->find($id);
        $quantity = $this->request->getPost('quantity');

        if ($product && $product['remaining_stock'] >= $quantity && $quantity > 0) {
            $newStockOut = $product['stock_out'] + $quantity;
            $remainingStock = $product['stock_in'] - $newStockOut;

            $this->productModel->update($id, [
                'stock_out' => $newStockOut,
                'remaining_stock' => $remainingStock
            ]);



            // Log stock removal
            $db = \Config\Database::connect();
            $db->table('inventory_logs')->insert([
                'product_id' => $id,
                'action' => 'Removed',
                'quantity' => $quantity
            ]);

            return redirect()->to('/inventory')->with('success', 'Stock reduced successfully.');
        }


        

        return redirect()->to('/inventory')->with('error', 'Insufficient stock or invalid request.');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
