<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_number', 'customer_name', 'status', 'order_date'];

    // Optional: Define validation rules if necessary
    protected $validationRules = [
        'order_number' => 'required|is_unique[orders.order_number]',
        'customer_name' => 'required',
        'status' => 'required|in_list[Pending, In-Progress, Shipped, Delivered]',
    ];
}
