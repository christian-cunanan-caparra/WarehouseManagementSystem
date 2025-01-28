<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'stock'];

    public function __construct()
    {
        parent::__construct();
    }
}
