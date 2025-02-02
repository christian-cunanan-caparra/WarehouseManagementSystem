<?php

namespace App\Controllers;

use App\Models\ProductModel;

class AdminController extends BaseController
{
    public function productList()
    {
        // Load the ProductModel
        $productModel = new ProductModel();

        // Fetch all products from the database
        $data['products'] = $productModel->findAll();

        // Load the product list view with the product data
        return view('productAdmin', $data);
    }
}