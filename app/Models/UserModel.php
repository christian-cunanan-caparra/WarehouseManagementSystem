<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'address', 'gender', 'mobile_number', 'role', 'reset_code', 'reset_code_expiry'];


    
    protected $useTimestamps = true; // To automatically manage created_at and updated_at timestamps

    // Validation rules
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'address' => 'required|max_length[255]',
        'gender' => 'required|max_length[10]',
        'mobile_number' => 'required|numeric|max_length[15]',
        'role' => 'required|max_length[50]'
    ];

    // Validation error messages
    protected $validationMessages = [
        'name' => ['required' => 'Name is required'],
        'email' => ['required' => 'Email is required', 'is_unique' => 'This email is already in use'],
        'password' => ['required' => 'Password is required'],
        'address' => ['required' => 'Address is required'],
        'gender' => ['required' => 'Gender is required'],
        'mobile_number' => ['required' => 'Mobile number is required'],
        'role' => ['required' => 'Role is required']
    ];
    public function checkUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

}
