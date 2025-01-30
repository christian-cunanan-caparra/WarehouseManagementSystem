<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function login()
    {
        // Show the login form
        return view('login');
    }

    public function authenticate()
    {
        // Validate login form inputs
        $validation = $this->validate([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]', // Validate password length
        ]);
    
        if (!$validation) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Retrieve user credentials
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Verify user existence
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
    
        // Check if user exists and password matches
        if (!$user || !password_verify($password, $user['password'])) {
            // Set an error message if credentials are invalid
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->to('/login')->withInput();
        }
    
        // Store user session details
        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role'      => $user['role'],
            'is_logged_in' => true,
        ]);
    
        // Redirect based on user role
        return ($user['role'] === 'Admin') 
            ? redirect()->to('/admin/dashboard') 
            : redirect()->to('/employee/dashboard');
    }
    

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }


    public function authenticate()
{
    // Validate login form inputs
    $validation = $this->validate([
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[8]', // Validate password length
    ]);

    if (!$validation) {
        // Redirect back with errors if validation fails
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Retrieve user credentials
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Verify user existence
    $userModel = new UserModel();
    $user = $userModel->where('email', $email)->first();

    // Check if user exists and password matches
    if (!$user || !password_verify($password, $user['password'])) {
        // Set an error message if credentials are invalid
        session()->setFlashdata('error', 'Invalid email or password.');
        return redirect()->to('/login')->withInput();
    }

    // Check if the user is inactive
    if ($user['role'] === 'Inactive') {
        // Redirect the user to a page indicating they are waiting for admin confirmation
        session()->setFlashdata('info', 'Your account is inactive. Please wait for the confirmation of the admin.');
        return redirect()->to('/waiting-confirmation');
    }

    // Store user session details
    session()->set([
        'user_id'   => $user['id'],
        'user_name' => $user['name'],
        'user_email' => $user['email'],
        'role'      => $user['role'],
        'is_logged_in' => true,
    ]);

    // Redirect based on user role
    return ($user['role'] === 'Admin') 
        ? redirect()->to('/admin/dashboard') 
        : redirect()->to('/employee/dashboard');
}


public function waitingConfirmation()
{
    return view('waiting_confirmation');
}


}


