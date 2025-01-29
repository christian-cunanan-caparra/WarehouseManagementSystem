<?php namespace App\Models;

use CodeIgniter\Model;

class StockRequestModel extends Model
{
    protected $table = 'stock_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'quantity', 'action', 'status'];
    protected $useTimestamps = true;
}
