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
        return view('/employee_dashboard', ['products' => $this->productModel->findAll()]);
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
        $this->productModel->insert($this->request->getPost());
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
        $this->productModel->delete($id);
        return redirect()->to('/employee_dashboard')->with('message', 'Product deleted successfully.');
    }
}
