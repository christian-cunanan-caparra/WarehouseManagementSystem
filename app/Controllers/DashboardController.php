<?php

namespace App\Controllers;

use App\Models\UserModel;
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

    // ... (existing methods)

    // Account Management View
    public function accountManagement()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        if ($role === 'Admin') {
            $data['users'] = $this->userModel->findAll(); // Fetch all users
            return view('account_management', $data);
        }

        return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
    }

    // Create Account View
    public function createAccount()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        return view('create_account');
    }

    // Store Account
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

    // Edit Account View
    public function editAccount($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'You must be logged in as Admin to access this page.');
        }

        $data['user'] = $this->userModel->find($id);
        return view('edit_account', $data);
    }

    // Update Account
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

    // Delete Account
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