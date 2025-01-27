<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';  // Your table name
    protected $primaryKey = 'id';     // Primary key column
    protected $allowedFields = ['name', 'email', 'password'];  // Fields that can be inserted/updated
}
