<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'stock', 'price'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItem($id)
    {
        return $this->find($id);
    }

    public function getAllItems()
    {
        return $this->findAll();
    }
}
