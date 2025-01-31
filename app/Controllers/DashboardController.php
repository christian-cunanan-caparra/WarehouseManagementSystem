<?php

namespace App\Controllers;

use App\Models\InventoryLogModel;
use App\Models\ProductModel;
use App\Models\UserModel; // Add UserModel for account management
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel(); // Initialize UserModel
    }

    // Inventory Logs
    public function index2()
    {
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

    // Dashboard View with Analytics
    // Dashboard View with Analytics
public function index()
{
    if (!session()->get('is_logged_in')) {
        return redirect()->to('/login');
    }

    $role = session()->get('role');

    if ($role === 'Admin') {
        // Fetch products where status = 0 (inactive products)
        $data['products'] = $this->productModel->where('status', 0)->findAll();

        $data['totalProducts'] = count($data['products']);
        $data['totalStockIn'] = array_sum(array_column($data['products'], 'stock_in'));
        $data['totalStockOut'] = array_sum(array_column($data['products'], 'stock_out'));
        $data['totalRemainingStock'] = array_sum(array_column($data['products'], 'remaining_stock'));

        // Low Stock Alert: Set threshold (e.g., 10 units)
        $lowStockThreshold = 50;
        $data['lowStockProducts'] = array_filter($data['products'], function($product) use ($lowStockThreshold) {
            return $product['remaining_stock'] <= $lowStockThreshold;
        });

        // Most Used Products: You can define "most used" as the sum of stock in and stock out.
        usort($data['products'], function($a, $b) {
            $usageA = $a['stock_in'] + $a['stock_out'];
            $usageB = $b['stock_in'] + $b['stock_out'];
            return $usageB - $usageA; // Sort in descending order (most used first)
        });
        $data['mostUsedProducts'] = array_slice($data['products'], 0, 5); // Top 5 most used products



        return view('admin_dashboard', $data);
    } elseif ($role === 'Employee') {
        // Fetch products where status = 1 (active products)
        
        $data['products'] = $this->productModel->where('status', 1)->findAll();

        // Dashboard Analytics - Total Products, Total Stock In, Total Stock Out
        $data['totalProducts'] = count($data['products']);
        $data['totalStockIn'] = array_sum(array_column($data['products'], 'stock_in'));
        $data['totalStockOut'] = array_sum(array_column($data['products'], 'stock_out'));
        $data['totalRemainingStock'] = array_sum(array_column($data['products'], 'remaining_stock'));

        // Low Stock Alert: Set threshold (e.g., 10 units)
        $lowStockThreshold = 50;
        $data['lowStockProducts'] = array_filter($data['products'], function($product) use ($lowStockThreshold) {
            return $product['remaining_stock'] <= $lowStockThreshold;
        });

        // Most Used Products: You can define "most used" as the sum of stock in and stock out.
        usort($data['products'], function($a, $b) {
            $usageA = $a['stock_in'] + $a['stock_out'];
            $usageB = $b['stock_in'] + $b['stock_out'];
            return $usageB - $usageA; // Sort in descending order (most used first)
        });
        $data['mostUsedProducts'] = array_slice($data['products'], 0, 5); // Top 5 most used products

        // Additional analytics can be added here

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

    // Reject Product
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

    // ==================== Account Management CRUD ====================

    // Account Management View
    public function accountManagement()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        // Fetch only employees
        $data['users'] = $this->userModel->where('role', 'Employee')->findAll();

        return view('account_management', $data);
    }

    public function createAccount()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        return view('create_account');
    }

    public function storeAccount()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // Hash the password

        if ($this->userModel->insert($data)) {
            return redirect()->to('/account-management')->with('success', 'Account created successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
    }

    public function editAccount($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        $data['user'] = $this->userModel->find($id);
        return view('edit_account', $data);
    }

    public function updateAccount($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        $data = $this->request->getPost();

        // Hash the password if it's being updated
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/account-management')->with('success', 'Account updated successfully.');
        }

        return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
    }

    public function deleteAccount($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        // Set the role to 'Inactive' instead of deleting the account
        if ($this->userModel->update($id, ['role' => 'Inactive'])) {
            return redirect()->to('/account-management')->with('success', 'Account status set to Inactive.');
        }

        return redirect()->to('/account-management')->with('error', 'Failed to update account status.');
    }

    public function archiveAccounts()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        $data['users'] = $this->userModel->where('role', 'Inactive')->findAll();
        return view('archive_accounts', $data);
    }

    public function restoreAccount($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

    $this->userModel->update($id, ['role' => 'Employee']);
    return redirect()->to('/archive-accounts')->with('success', 'Account restored successfully.');
}

public function inventoryLogsPage()
{
    if (!session()->get('is_logged_in')) {
        return redirect()->to('/login');
    }

    $role = session()->get('role');

    if ($role === 'Admin') {
        // Fetch products where status = 0 (inactive products)
        $data['products'] = $this->productModel->where('status', 0)->findAll();
        return view('admin_dashboard', $data); // Redirect to admin dashboard for Admin
    } elseif ($role === 'Employee') {
        // Load the InventoryLog model
        $InventoryLogModel = new \App\Models\InventoryLogModel();

        // Fetch all inventory logs
        $data['inventory_log'] = $InventoryLogModel->findAll();

        // Pass the data to the view
        return view('inventory_log', $data);
    }

    return redirect()->to('/login');
}




}
