<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\NotificationModel;

class EmployeeDashboardController extends BaseController
{
    public function index()
    {
        // Get logged-in user's id
        $userId = session()->get('user_id');

        // Load models
        $itemModel = new ItemModel();
        $orderModel = new OrderModel();
        $notificationModel = new NotificationModel();

        // Get data
        $items = $itemModel->getAllItems();
        $orders = $orderModel->getOrdersByUser($userId);
        $notifications = $notificationModel->getNotificationsByUser($userId);

        // Count of pending orders and notifications
        $pendingOrders = count(array_filter($orders, fn($order) => $order['status'] === 'pending'));
        $unreadNotifications = count(array_filter($notifications, fn($notification) => $notification['status'] === 'unread'));

        // Prepare data for the view
        $data = [
            'stock_count' => count($items),
            'pending_orders' => $pendingOrders,
            'notifications_count' => $unreadNotifications,
            'orders' => $orders,
            'inventory' => $items,
        ];

        return view('employee_dashboard', $data);
    }

    public function requestItem()
    {
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        $userId = session()->get('user_id');

        $orderModel = new OrderModel();
        $itemModel = new ItemModel();

        // Check if the item exists and if enough stock is available
        $item = $itemModel->find($itemId);
        if ($item && $item['stock'] >= $quantity) {
            // Create the order
            $orderData = [
                'item_id' => $itemId,
                'quantity' => $quantity,
                'status' => 'pending',
                'user_id' => $userId,
            ];
            $orderModel->createOrder($orderData);

            // Update item stock
            $itemModel->update($itemId, ['stock' => $item['stock'] - $quantity]);

            // Redirect with success message
            return redirect()->to('/employee-dashboard')->with('message', 'Order placed successfully.');
        }

        // Redirect with error if insufficient stock
        return redirect()->to('/employee-dashboard')->with('error', 'Not enough stock available.');
    }
}
