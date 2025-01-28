<?php namespace App\Controllers;

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
        // Create a new product (add necessary form validation and product creation logic)
    }

    public function update()
    {
        // Update product logic
    }

    public function get_product($id)
    {
        // Fetch product details by ID
        $product = $this->productModel->find($id);

        if ($product) {
            return $this->response->setJSON($product);
        }

        return $this->response->setStatusCode(404, 'Product not found');
    }

    public function delete($id)
    {
        // Logic for deactivating product (e.g., updating product status)
        $this->productModel->update($id, ['status' => 0]);
        return redirect()->to('/employee_dashboard');
    }
}
