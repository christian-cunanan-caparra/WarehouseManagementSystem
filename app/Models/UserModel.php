<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Define the table name
    protected $table = 'users';
    
    // Define the primary key for the table
    protected $primaryKey = 'id';
    
    // Define the allowed fields for insertion and update
    protected $allowedFields = ['name', 'email', 'password', 'address', 'gender', 'mobile', 'role'];

    // Define the validation rules
    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[255]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]|max_length[255]',
        'address'  => 'required|min_length[3]|max_length[255]',
        'gender'   => 'required|in_list[male,female,other]',
        'mobile'   => 'required|numeric|min_length[10]|max_length[15]',
        'role'     => 'required|in_list[admin,employee]',
    ];

    // Define the validation messages (optional)
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
        'role' => [
            'in_list' => 'Role must be either admin or employee.',
        ],
    ];

    // Define the before insert/validation processes
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Method to hash the password before inserting or updating
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    // Method to verify user credentials during login
    public function verifyUser($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return the user data if the password matches
        }

        return null; // Return null if no user is found or password doesn't match
    }
}
