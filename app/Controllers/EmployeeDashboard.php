<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class EmployeeDashboard extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    /**
     * Display all products.
     */
    public function index()
    {
        $data['products'] = $this->productModel->where('status', 1)->findAll();
    return view('employee_dashboard', $data);
    }

    /**
     * Show the product creation form.
     */
    public function create()
    {
        return view('create_product');
    }

    /**
     * Store new product in the database.
     */
    public function store()
    {
            // Get the form data
    $data = $this->request->getPost();

    // Set the status to 1 (active) for the new product
    $data['status'] = 1;

    // Insert the product into the database
    $this->productModel->insert($data);

    // Redirect with a success message
    return redirect()->to('/employee_dashboard')->with('message', 'Product added successfully.');
    }

    /**
     * Show the edit form for a specific product.
     */
    public function edit($id)
    {
        return view('edit_product', ['product' => $this->productModel->find($id)]);
    }

    /**
     * Update product details.
     */
    public function update($id)
    {
        $this->productModel->update($id, $this->request->getPost());
        return redirect()->to('/employee_dashboard')->with('message', 'Product updated successfully.');
    }

    /**
     * Delete a product.
     */
    public function delete($id)
    {
            // Update the status to 0 (inactive) instead of deleting the record
    $data = [
        'status' => 0,
    ];

    $this->productModel->update($id, $data);

    // Set a flash message to indicate success
    session()->setFlashdata('success', 'Product deactivated successfully.');

    return redirect()->to('/employee_dashboard');
    }

    public function activate($id)
{
    // Update the status to 1 (active)
    $data = [
        'status' => 1,
    ];

    $this->productModel->update($id, $data);

    // Set a flash message to indicate sucsscess
    session()->setFlashdata('success', 'Product activated successfully.');

    return redirect()->to('/employee_dashboard');
}
}
