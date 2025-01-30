<?php namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table      = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'action', 'quantity', 'user_id'];
    protected $useTimestamps = true; // Ensure created_at and updated_at are managed automatically
}
