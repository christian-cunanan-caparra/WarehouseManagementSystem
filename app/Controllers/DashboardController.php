<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class DashboardController extends BaseController
{
    protected $inventoryModel;

    public function __construct()
    {
        // Initialize the Inventory Model
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

        // Fetch inventory data from the model
        $inventory = $this->inventoryModel->getInventory();

        // Check if inventory retrieval was successful
        if (!$inventory) {
            return redirect()->to('/employee_dashboard')->with('error', 'Failed to retrieve inventory.');
        }

        // Redirect to the respective dashboard based on the role
        if ($role === 'Admin') {
            return view('admin_dashboard');
        } elseif ($role === 'Employee') {
            // Pass inventory data to the view
            return view('employee_dashboard', ['inventory' => $inventory]);
        }

        // If no valid role is set, redirect to login
        return redirect()->to('/login');
    }

    // Show specific inventory item for management
    public function manage_inventory($id)
    {
        $inventoryItem = $this->inventoryModel->find($id);

        if (!$inventoryItem) {
            return redirect()->to('/employee_dashboard')->with('error', 'Inventory item not found.');
        }

        return view('inventory_manage', ['item' => $inventoryItem]);
    }

    // Update inventory item
    public function update_inventory($id)
    {
        // Get data from the form (POST request)
        $data = [
            'stock_level' => $this->request->getPost('stock_level'),
        ];

        // Try updating the inventory item
        $success = $this->inventoryModel->updateInventory($id, $data);

        if ($success) {
            return redirect()->to('/employee_dashboard')->with('success', 'Inventory updated successfully.');
        } else {
            return redirect()->to('/employee_dashboard')->with('error', 'Failed to update inventory.');
        }
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
