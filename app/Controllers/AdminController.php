<?php

// app/Controllers/AdminController.php

namespace App\Controllers;

use App\Models\ProductModel;

class AdminController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        // Load the ProductModel
        $this->productModel = new ProductModel();
    }

    // Read: Display the product list
    public function productList()
    {
        // Fetch all products
        $data['products'] = $this->productModel->findAll();

        // Load the product list view
        return view('productAdmin', $data);
    }

    // Create: Display the add product form
    public function addProduct()
    {
        return view('addProduct');
    }

    // Create: Save the new product
    public function saveProduct()
    {
        // Validate the input
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'stock_in' => 'required|numeric',
            'stock_out' => 'required|numeric',
            'remaining_stock' => 'required|numeric',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the product
        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'quantity' => $this->request->getPost('quantity'),
            'stock_in' => $this->request->getPost('stock_in'),
            'stock_out' => $this->request->getPost('stock_out'),
            'remaining_stock' => $this->request->getPost('remaining_stock'),
            'status' => $this->request->getPost('status'),
        ]);

        // Redirect to the product list with a success message
        return redirect()->to('/product-list')->with('message', 'Product added successfully.');
    }

    // Update: Display the edit product form
    public function editProduct($id)
    {
        // Fetch the product by ID
        $data['product'] = $this->productModel->find($id);

        // Load the edit product view
        return view('editProduct', $data);
    }

    // Update: Save the updated product
    public function updateProduct($id)
    {
        // Validate the input
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'stock_in' => 'required|numeric',
            'stock_out' => 'required|numeric',
            'remaining_stock' => 'required|numeric',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update the product
        $this->productModel->save([
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'quantity' => $this->request->getPost('quantity'),
            'stock_in' => $this->request->getPost('stock_in'),
            'stock_out' => $this->request->getPost('stock_out'),
            'remaining_stock' => $this->request->getPost('remaining_stock'),
            'status' => $this->request->getPost('status'),
        ]);

        // Redirect to the product list with a success message
        return redirect()->to('/addproduct-list')->with('message', 'Product updated successfully.');
    }

    // Delete: Remove a product
    public function deleteProduct($id)
    {
        // Delete the product
        $this->productModel->delete($id);

        // Redirect to the product list with a success message ahhhhhh
        return redirect()->to('/product-list')->with('message', 'Product deleted successfully.');
    }
}