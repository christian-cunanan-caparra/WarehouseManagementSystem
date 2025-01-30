<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'action', 'quantity'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
