<?php

namespace App\Controllers;

use App\Models\ProductModel;

class EmployeeDashboard extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('employee_dashboard', $data);
    }

    public function create()
    {
        return view('create_product');
    }

    public function store()
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'quantity'    => $this->request->getPost('quantity'),
            'price'       => $this->request->getPost('price'),
        ];

        $this->productModel->insert($data);
        return redirect()->to('/employee_dashboard');
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        return view('edit_product', $data);
    }

    public function update($id)
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'quantity'    => $this->request->getPost('quantity'),
            'price'       => $this->request->getPost('price'),
        ];

        $this->productModel->update($id, $data);
        return redirect()->to('/employee_dashboard');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/employee_dashboard');
    }
}