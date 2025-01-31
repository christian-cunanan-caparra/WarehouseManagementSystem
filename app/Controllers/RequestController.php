<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel; // Add UserModel for account management
use CodeIgniter\Controller;

class RequestController extends BaseController
{
    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel(); // Initialize UserModel
    }

    public function index(): string
    {
        return view('login');
    }

    // Request New Product function
    public function requestprod()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        // Check user role and fetch data accordingly
        if ($role === 'Admin') {
            // Fetch products where status = 0 (inactive products)
            $data['products'] = $this->productModel->where('status', 0)->findAll();

            // Return the admin dashboard view with inactive products
            return view('request_product', $data);
        } elseif ($role === 'Employee') {
            // Fetch products where status = 1 (active products)
            $data['products'] = $this->productModel->where('status', 1)->findAll();

            // Return the employee dashboard view with active products
            return view('employee_dashboard', $data);
        }

        // Redirect to login page if not logged in
        return redirect()->to('/login');
    }
}
