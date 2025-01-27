<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['email', 'password']; // Fields that can be inserted/updated
    protected $useTimestamps = true; // Enable automatic timestamps
}
