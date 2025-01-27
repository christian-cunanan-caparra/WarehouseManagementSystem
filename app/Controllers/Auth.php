<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('login');  // Load the login view
    }

    public function loginSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // Get the user by email
        $user = $userModel->where('email', $email)->first();

        // Check if user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session after successful login
            session()->set('user', $user);

            // Redirect to the dashboard
            return redirect()->to('/dashboard');
        } else {
            // If authentication fails, show error message
            return redirect()->to('/login')->with('error', 'Invalid login credentials');
        }
    }

    public function register()
    {
        return view('register');  // Load the registration view
    }

    public function registerSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Validation: Check if passwords match
        if ($password !== $passwordConfirm) {
            return redirect()->to('/register')->with('error', 'Passwords do not match');
        }

        $userModel = new UserModel();

        // Check if email already exists in the database
        if ($userModel->where('email', $email)->first()) {
            return redirect()->to('/register')->with('error', 'Email is already registered');
        }

        // Hash the password before saving it
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Save the new user to the database
        $userModel->save([
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        // Send the welcome email
        $this->sendWelcomeEmail($email);

        // Redirect to login with a success message
        return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
    }

    private function sendWelcomeEmail($email)
    {
        $emailService = \Config\Services::email();

        $emailService->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $emailService->setTo($email);
        $emailService->setSubject('Welcome to Warehouse Management System');
        $emailService->setMessage('Welcome to the Warehouse Management System! You have successfully registered.');

        if (!$emailService->send()) {
            return redirect()->to('/register')->with('error', 'Registration successful but email could not be sent.');
        }
    }
}
