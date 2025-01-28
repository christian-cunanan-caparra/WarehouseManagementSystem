<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_name', 'quantity', 'status', 'updated_at'];
}
