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

    //inventory logs
    public function index2() {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        if ($role === 'Admin') {
            return view('admin_dashboard');
        } elseif ($role === 'Employee') {
            $data['products'] = $this->productModel->where('status', 1)->findAll();
            return view('inventory_logs', $data);
        }

        return redirect()->to('/login');
    }
     // Product View
     public function index1()
     {
         if (!session()->get('is_logged_in')) {
             return redirect()->to('/login');
         }
 
         $role = session()->get('role');
 
         if ($role === 'Admin') {
             return view('admin_dashboard');
         } elseif ($role === 'Employee') {
            $data['products'] = $this->productModel->where('remaining_stock >=', 1)->findAll();

             return view('productList', $data);
         }
 
         return redirect()->to('/login');
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

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
