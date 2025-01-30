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
            // Fetch products where status = 0 (inactive products)
            $data['products'] = $this->productModel->where('status', 0)->findAll();
            return view('admin_dashboard', $data);
        } elseif ($role === 'Employee') {
            $data['products'] = $this->productModel->where('status', 1)->findAll();
            return

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

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // ==================== Account Management CRUD ====================

    // Account Management View
    public function accountManagement()
{
    if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
        return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
    }

    $data['users'] = $this->userModel->findAll(); // Fetch all users
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
        unset($data['password']); // Remove password from data if not updated
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

    if ($this->userModel->delete($id)) {
        return redirect()->to('/account-management')->with('success', 'Account deleted successfully.');
    }

    return redirect()->to('/account-management')->with('error', 'Failed to delete account.');
}
}