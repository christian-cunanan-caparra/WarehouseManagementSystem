<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class DashboardController extends BaseController
{
    protected $inventoryModel;

    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
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
            $inventory = $this->inventoryModel->findAll();
            return view('employee_dashboard', ['inventory' => $inventory]);
        }

        // If no valid role is set, redirect to login
        return redirect()->to('/login');
    }

    public function manage_inventory($id)
    {
        $inventoryItem = $this->inventoryModel->find($id);

        if ($inventoryItem) {
            return view('manage_inventory', ['item' => $inventoryItem]);
        } else {
            return redirect()->to('/employee_dashboard')->with('error', 'Item not found.');
        }
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
