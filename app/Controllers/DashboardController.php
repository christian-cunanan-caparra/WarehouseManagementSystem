<?php

namespace App\Controllers;


use App\Models\InventoryLogModel;
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
            // Load the InventoryLogs model
            $InventoryLogModel = new \App\Models\InventoryLogModel();

    
            // Fetch all inventory logs
            $data['inventory_logs'] = $InventoryLogModel->findAll();
    
            // Pass the data to the view
            return view('inventory_logs', $data);
        }
    
        return redirect()->to('/login');
    }
     // ProductS View
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
            // Fetch products where status = 0 (inactive products)
            $data['products'] = $this->productModel->where('status', 0)->findAll();
            return view('admin_dashboard', $data);
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
        $data['status'] = 0;

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
        return redirect()->to('/admin/dashboard');  // Redirect to the admin dashboard
    }


    public function reject($id)
    {
        // Delete product by ID
        if ($this->productModel->delete($id)) {
            session()->setFlashdata('success', 'Product rejected and deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to delete product.');
        }

        return redirect()->to('/admin/dashboard');
    }
    

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
