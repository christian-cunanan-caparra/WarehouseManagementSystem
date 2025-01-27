<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Define the table name and primary key
    protected $table = 'users';  // Make sure this matches your table name
    protected $primaryKey = 'id';

    // Define the allowed fields (these are the columns we can insert or update)
    protected $allowedFields = [
        'name', 'email', 'password', 'address', 'gender', 'mobile'
    ];

    // Enable timestamps (optional if you want created_at and updated_at columns)
    protected $useTimestamps = true;

    // Validation rules (optional, depending on your validation requirements)
    protected $validationRules = [
        'name'      => 'required|min_length[3]',
        'email'     => 'required|valid_email|is_unique[users.email]',
        'password'  => 'required|min_length[8]',
        'address'   => 'required',
        'gender'    => 'required',
        'mobile'    => 'required|numeric'
    ];

    // Custom error messages
    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters long'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'This email is already taken'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long'
        ],
        'mobile' => [
            'required' => 'Mobile number is required',
            'numeric' => 'Mobile number must be numeric'
        ]
    ];
}
