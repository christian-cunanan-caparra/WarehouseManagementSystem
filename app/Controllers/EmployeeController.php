<?php namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\InventoryModel;

class EmployeeController extends BaseController
{
    public function dashboard()
    {
        $orderModel = new OrderModel();
        $inventoryModel = new InventoryModel();

        $data = [
            'stock_count' => $inventoryModel->countAllResults(),
            'pending_orders' => $orderModel->where('status', 'Pending')->countAllResults(),
            'notifications_count' => 5, // Replace with actual notification logic
            'orders' => $orderModel->findAll(), // Fetch all orders
            'inventory' => $inventoryModel->findAll(), // Fetch inventory data
        ];

        return view('employee_dashboard', $data);
    }

    public function request_item()
    {
        $item_id = $this->request->getPost('item_id');
        // Handle item request logic here
        return redirect()->to('/employee/dashboard')->with('success', 'Item requested successfully!');
    }
}
