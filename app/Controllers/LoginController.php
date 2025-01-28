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
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
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
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role' => $user['role'],
            'is_logged_in' => true,
        ]);

        // Redirect based on user role
        if ($user['role'] === 'Admin') {
            return redirect()->to('/admin/dashboard');
        } else if ($user['role'] === 'Employee') {
            return redirect()->to('/employee/dashboard');
        }

        // Fallback if role is unknown (shouldn't happen in a properly configured system)
        return redirect()->to('/login');
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
