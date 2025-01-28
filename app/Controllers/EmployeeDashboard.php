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


    public function edit($id)
    {
        
    // Fetch the product by ID
    $product = $this->productModel->find($id);

    if (!$product) {
        // If the product doesn't exist, show an error or redirect
        return redirect()->to('/employee_dashboard')->with('error', 'Product not found.');
    }

    // Pass the product data to the edit view
    $data['product'] = $product;
    return view('edit_product', $data);
    }

   
    public function update($id)
    {
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
        return redirect()->to('/employee_dashboard');
    }

    public function delete($id)
    {
        // Delete the product from the database
        $this->productModel->delete($id);

        // Redirect back to the employee dashboard
        return redirect()->to('/employee_dashboard');
    }
}
