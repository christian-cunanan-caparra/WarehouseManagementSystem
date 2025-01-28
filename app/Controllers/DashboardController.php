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

    // Display dashboard with products based on the user's role
    public function index()
    {
        // Ensure user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Retrieve user role from the session
        $role = session()->get('role');

        // Redirect to the respective dashboard based on the role
        if ($role === 'Admin') {
            return view('admin_dashboard');
        } elseif ($role === 'Employee') {
            $data['products'] = $this->productModel->where('status', 1)->findAll();
            return view('employee_dashboard', $data);
        }

        // If no valid role is set, redirect to login
        return redirect()->to('/login');
    }

    // Show form to create a new product
    public function create()
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('create_product');
    }

    // Store a new product in the database
    public function store()
    {
        // Get the form data
        $data = $this->request->getPost();
    
        // Set the status to 1 (active) for the new product
        $data['status'] = 1;
    
        // Insert the product into the database
        if ($this->productModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Product added successfully.']);
        }
    
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add product.']);
    }

    // Show form to edit an existing product
    public function edit($id)
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('edit_product', ['product' => $this->productModel->find($id)]);
    }

    // Update the details of an existing product
    public function update($id)
    {
        // Get the form data and update the product
        $this->productModel->update($id, $this->request->getPost());
        return redirect()->to('/employee_dashboard')->with('message', 'Product updated successfully.');
    }

    // Deactivate a product (soft delete)
    public function delete($id)
    {
        // Update the status to 0 (inactive) instead of deleting the record
        $data = ['status' => 0];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product deactivated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    // Activate a product (set status to active)
    public function activate($id)
    {
        // Update the status to 1 (active)
        $data = ['status' => 1];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product activated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    // Logout functionality
    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
