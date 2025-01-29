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

    public function create()
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('create_product');
    }

    public function store()
{
    // Check if the request is an AJAX call
    if ($this->request->isAJAX()) {
        // Get the form data
        $data = $this->request->getPost();

        // Set the status to 1 (active) for the new product
        $data['status'] = 1;

        // Insert the product into the database
        if ($this->productModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Product added successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add product.']);
        }
    }
}

    
    

    public function edit($id)
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        return view('edit_product', ['product' => $this->productModel->find($id)]);
    }

    public function update()
    {
        // Restrict access if the user is not logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }
    
        // Check if the request is an AJAX call
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id'); // Get the product ID from the form data
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'quantity' => $this->request->getPost('quantity'),
                'price' => $this->request->getPost('price'),
            ];
    
            // Update the product in the database
            if ($this->productModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Product updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update product.']);
            }
        }
    }
    
    
    public function delete($id)
    {
        // Update the status to 0 (inactive) instead of deleting the record
        $data = ['status' => 0];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product deactivated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    public function activate($id)
    {
        // Update the status to 1 (active)
        $data = ['status' => 1];
        $this->productModel->update($id, $data);

        // Set a flash message to indicate success
        session()->setFlashdata('success', 'Product activated successfully.');

        return redirect()->to('/employee_dashboard');
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
