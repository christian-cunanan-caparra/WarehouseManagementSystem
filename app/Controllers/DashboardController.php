<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;
use App\Models\InventoryLogModel;

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
    public function inventoryLogs()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    
        // Get all logs with product information
        $logs = (new InventoryLogModel())->join('products', 'products.id = inventory_logs.product_id')
                                         ->join('users', 'users.id = inventory_logs.user_id') // Assuming user_id is stored in the logs table
                                         ->select('inventory_logs.*, products.name as product_name, users.name as user_name')
                                         ->findAll();
    
        return view('inventory_logs', ['logs' => $logs]);
    }
    

public function store()
{
    $data = $this->request->getPost();
    $data['status'] = 1;

    // Insert the product into the products table
    if ($this->productModel->insert($data)) {
        // Log the action of adding the product to inventory
        $logData = [
            'product_id' => $this->productModel->getInsertID(),
            'action'     => 'Added stock',
            'quantity'   => $data['quantity'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        (new InventoryLogModel())->insert($logData);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Product added successfully.']);
    }

    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add product.']);
}

public function update($id)
{
    $data = $this->request->getPost();
    $quantityChange = $data['quantity'] ?? 0; // assuming you are updating quantity

    // Update the product
    if ($this->productModel->update($id, $data)) {
        // Log the stock action (added or removed)
        $logData = [
            'product_id' => $id,
            'action'     => ($quantityChange > 0) ? 'Added stock' : 'Removed stock',
            'quantity'   => $quantityChange,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        (new InventoryLogModel())->insert($logData);

        return $this->response->setJSON(['message' => 'Product updated successfully.']);
    }

    return $this->response->setJSON(['message' => 'Failed to update product.']);
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
