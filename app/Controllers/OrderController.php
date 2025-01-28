<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function index()
    {
        // Ensure user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Retrieve all orders from the database
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll();

        // Load the order tracking view with order data
        return view('order_tracking', ['orders' => $orders]);
    }

    public function updateStatus($orderId)
    {
        // Ensure user is logged in and is Admin
        if (!session()->get('is_logged_in') || session()->get('role') !== 'Admin') {
            return redirect()->to('/login');
        }

        // Get the new status from the form input
        $status = $this->request->getPost('status');

        if (empty($status)) {
            session()->setFlashdata('error', 'Please select a valid status.');
            return redirect()->to('/order/tracking');
        }

        // Update order status in the database
        $orderModel = new OrderModel();
        $orderModel->update($orderId, ['status' => $status]);

        // Redirect back with success message
        session()->setFlashdata('success', 'Order status updated successfully.');
        return redirect()->to('/order/tracking');
    }
}
