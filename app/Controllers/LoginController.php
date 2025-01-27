<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function authenticate()
    {
        // Validation of form inputs
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation) {
            // If validation fails, show errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get user credentials
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Check if user exists in database
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // If user does not exist or password is incorrect
        if (!$user || !password_verify($password, $user['password'])) {
            // Set error flash message if login fails
            session()->setFlashdata('error', 'Invalid login credentials.');
            return redirect()->to('/login');
        }

        // Store user information in session
        session()->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role' => $user['role'],  // Store the user role
            'is_logged_in' => true,   // Indicate that the user is logged in
        ]);

        // Redirect to the dashboard based on role
        if ($user['role'] == 'Admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/employee/dashboard');
        }
    }

    public function logout()
    {
        // Destroy the session to log out
        session()->destroy();
        return redirect()->to('/login');
    }
}
