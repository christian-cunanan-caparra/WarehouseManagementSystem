<?php

namespace App\Controllers;

use App\Models\InventoryModel;
use App\Models\OrderModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // Ensure user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Retrieve user role from the session
        $role = session()->get('role');

        // Load necessary models for the employee dashboard
        $inventoryModel = new InventoryModel();
        $orderModel = new OrderModel();

        // Retrieve employee-related data
        if ($role === 'Admin') {
            return view('admin_dashboard');
        } elseif ($role === 'Employee') {
            // Fetch data specific to Employee (tasks, inventory, etc.)
            $stock_count = $inventoryModel->countAll();
            $pending_orders = $orderModel->where('status', 'Pending')->countAllResults();
            $notifications_count = 5; // This could be dynamically fetched from a notifications model

            $orders = $orderModel->findAll();
            $inventory = $inventoryModel->findAll();

            // Pass data to the employee dashboard view
            return view('employee_dashboard', [
                'stock_count' => $stock_count,
                'pending_orders' => $pending_orders,
                'notifications_count' => $notifications_count,
                'orders' => $orders,
                'inventory' => $inventory
            ]);
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
