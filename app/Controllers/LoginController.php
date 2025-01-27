<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        // If the user is already logged in, redirect to the dashboard
        if (session()->get('loggedIn')) {
            return redirect()->to('/dashboard');
        }

        // If not logged in, show the login page
        return view('login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();

        // Get the input data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Check if the user exists with the provided email
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Store the user data in session
            session()->set([
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],  // Make sure 'role' exists in the user table
                'loggedIn' => true,
            ]);

            // Redirect based on the role
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/employee/dashboard');
            }
        } else {
            // If login fails, show an error message
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Destroy the session when logging out
        session()->destroy();
        return redirect()->to('/login');
    }
}
