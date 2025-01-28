<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function login()
    {
        // Show the login form
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        // Validate login form inputs
        $validation = $this->validate([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Retrieve user credentials
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find user by email
        $user = $userModel->where('email', $email)->first();

        // Check if user exists and password is correct
        if (!$user || !password_verify($password, $user['password'])) {
            $session->setFlashdata('error', 'Invalid email or password.');
            return redirect()->to('/login')->withInput();
        }

        // Store user session details
        $session->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role'      => $user['role'],
            'is_logged_in' => true,
        ]);

        // Regenerate session ID for security
        $session->regenerate();

        // Redirect user to intended page or dashboard based on role
        return redirect()->to($session->get('redirect_url') ?? (($user['role'] === 'Admin') ? '/admin/dashboard' : '/employee/dashboard'));
    }

    public function logout()
    {
        $session = session();

        // Destroy session and clear data
        $session->destroy();

        // Redirect to login page with a logout success message
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
