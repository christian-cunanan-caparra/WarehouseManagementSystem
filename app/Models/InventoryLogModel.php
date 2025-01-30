<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryLogs extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'action', 'quantity'];

    // Optional: Define validation rules if necessary

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
