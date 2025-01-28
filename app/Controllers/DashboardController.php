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

    // Method to store a new product (for adding)
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

    // Method to show the edit form (for editing)
    public function edit($id)
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        $product = $this->productModel->find($id);
        
        // Return the edit form with pre-filled data
        return $this->response->setJSON(['status' => 'success', 'data' => $product]);
    }

    // Method to update a product (for editing)
    public function update()
    {
        // Get the form data
        $data = $this->request->getPost();

        // Update the product in the database
        if ($this->productModel->update($data['id'], $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Product updated successfully.']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update product.']);
    }

    // Method to deactivate (soft delete) a product
    public function delete($id)
    {
        // Update the status to 0 (inactive) instead of deleting the record
        $data = ['status' => 0];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product deactivated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    // Method to activate a product
    public function activate($id)
    {
        // Update the status to 1 (active)
        $data = ['status' => 1];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product activated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    // Logout method
    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
