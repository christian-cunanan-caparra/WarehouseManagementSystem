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
        return view('employee_dashboard', ['products' => $this->productModel->findAll()]);
    }

    // If no valid role is set, redirect to login
    return redirect()->to('/login');
}

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
