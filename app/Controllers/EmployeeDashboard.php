<?php

namespace App\Controllers;

use App\Models\ProductModel;

class EmployeeDashboard extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        // Initialize the ProductModel
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Fetch all products from the database
        $data['products'] = $this->productModel->findAll();

        // Pass the products data to the view
        return view('employee_dashboard', $data);
    }

    public function create()
    {
        // Render the view to add a new product
        return view('create_product');
    }

    public function store()
    {
        // Validate form input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'description' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|decimal',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/employee_dashboard/create')->withInput()->with('errors', $validation->getErrors());
        }

        // Get data from the form
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'quantity'    => $this->request->getPost('quantity'),
            'price'       => $this->request->getPost('price'),
        ];

        // Insert the product data into the database
        $this->productModel->insert($data);

        // Redirect back to the employee dashboard
        return redirect()->to('/employee_dashboard')->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        // Fetch the product by ID
        $product = $this->productModel->find($id);

        // If product not found, show error
        if (!$product) {
            return redirect()->to('/employee_dashboard')->with('error', 'Product not found.');
        }

        // Load the edit view and pass the product data
        return view('edit_product', ['product' => $product]);
    }

    public function update($id)
    {
        // Validate form input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'description' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|decimal',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to("/employee_dashboard/edit/{$id}")->withInput()->with('errors', $validation->getErrors());
        }

        // Get the updated data from the form
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'quantity'    => $this->request->getPost('quantity'),
            'price'       => $this->request->getPost('price'),
        ];

        // Update the product in the database
        $this->productModel->update($id, $data);

        // Redirect back to the employee dashboard
        return redirect()->to('/employee_dashboard')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        // Delete the product from the database
        $this->productModel->delete($id);

        // Redirect back to the employee dashboard
        return redirect()->to('/employee_dashboard')->with('success', 'Product deleted successfully');
    }
}
