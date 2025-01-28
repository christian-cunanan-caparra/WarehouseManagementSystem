<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Database table name
    protected $primaryKey = 'id'; // Primary key column

    // Columns allowed for mass assignment
    protected $allowedFields = ['name', 'email', 'password', 'address', 'gender', 'mobile_number', 'role'];

    // Enable automatic timestamps
    protected $useTimestamps = true;

    // Validation rules for creating or updating users
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]', // {id} prevents conflicts on edit
        'password' => 'permit_empty|min_length[8]', // Password is required for new users only
        'address' => 'required|max_length[255]',
        'gender' => 'required|in_list[male,female,other]',
        'mobile_number' => 'required|numeric|max_length[15]',
        'role' => 'required|max_length[50]'
    ];

    // Custom validation messages
    protected $validationMessages = [
        'name' => ['required' => 'Name is required.'],
        'email' => ['required' => 'Email is required.', 'is_unique' => 'This email is already in use.'],
        'password' => ['min_length' => 'Password must be at least 8 characters.'],
        'address' => ['required' => 'Address is required.'],
        'gender' => ['required' => 'Gender is required.', 'in_list' => 'Invalid gender value.'],
        'mobile_number' => ['required' => 'Mobile number is required.', 'numeric' => 'Invalid mobile number.'],
        'role' => ['required' => 'Role is required.']
    ];

    /**
     * Retrieves all users from the database.
     *
     * @return array
     */
    public function getAllUsers()
    {
        return $this->findAll();
    }

    /**
     * Finds a user by ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getUserById($id)
    {
        return $this->find($id);
    }

    /**
     * Inserts a new user into the database.
     *
     * @param array $data
     * @return bool|int
     */
    public function createUser(array $data)
    {
        // Encrypt password if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->insert($data);
    }

    /**
     * Updates an existing user.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser($id, array $data)
    {
        // Encrypt password if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->update($id, $data);
    }

    /**
     * Deletes a user by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser($id)
    {
        return $this->delete($id);
    }



    public function create()
{
    return view('users/create');
}

public function edit($id)
{
    $userModel = new UserModel();
    $data['user'] = $userModel->find($id);  // Fetch the user by ID
    return view('users/edit', $data);  // Pass the user data to the view
}

public function store()
{
    $userModel = new UserModel();

    if (!$this->validate($userModel->getValidationRules())) {
        return view('users/create', [
            'validation' => $this->validator
        ]);
    }

    // Save user
    $userModel->save([
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'address' => $this->request->getPost('address'),
        'gender' => $this->request->getPost('gender'),
        'mobile_number' => $this->request->getPost('mobile_number'),
        'role' => $this->request->getPost('role'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ]);

    return redirect()->to('/users')->with('success', 'User created successfully!');
}

public function update($id)
{
    $userModel = new UserModel();

    // Validate the user input
    if (!$this->validate($userModel->getValidationRules())) {
        return view('users/edit', [
            'validation' => $this->validator,
            'user' => $userModel->find($id)
        ]);
    }

    // Update the user
    $userData = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'address' => $this->request->getPost('address'),
        'gender' => $this->request->getPost('gender'),
        'mobile_number' => $this->request->getPost('mobile_number'),
        'role' => $this->request->getPost('role')
    ];

    // If the password is provided, hash it
    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $userModel->update($id, $userData);

    return redirect()->to('/users')->with('success', 'User updated successfully!');
}




}



