<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login'); // Render the login form view
    }

    public function authenticate()
    {
        // Get form inputs
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validate the inputs
        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Both fields are required.');
        }

        // Initialize the UserModel
        $userModel = new UserModel();

        // Check if the user exists in the database
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Store user data in the session
            session()->set([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true,
            ]);

            // Redirect to the dashboard or home page
            return redirect()->to('/dashboard');
        } else {
            // Invalid credentials
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        // Destroy the session and log out the user
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/login');
    }
}
