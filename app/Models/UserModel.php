<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Table name in the database
    protected $primaryKey = 'id'; // Primary key of the table
    protected $allowedFields = ['email', 'password', 'created_at']; // Fields that can be inserted or updated
    protected $useTimestamps = true; // Enable automatic handling of created_at and updated_at fields

    // You can customize the timestamps field names if needed
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
