<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_id', 'quantity', 'status', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOrdersByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getOrderDetails($orderId)
    {
        return $this->find($orderId);
    }

    public function createOrder($data)
    {
        return $this->insert($data);
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->update($orderId, ['status' => $status]);
    }
}
