<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Show login page
    public function login()
    {
        return view('auth/login');
    }

    // Handle user login
    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid login credentials.');
        }

        session()->set('user_name', $user['name']);
        session()->set('user_email', $user['email']);

        // Redirect to dashboard based on user type (admin or employee)
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/employee/dashboard');
        }
    }

    // Forgot password - step 1: send reset code to email
    public function sendResetCode()
    {
        $email = $this->request->getPost('reset_email');

        // Check if the email exists in the database
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email address not found.');
        }

        // Generate a random 5-digit reset code
        $resetCode = random_int(10000, 99999);
        $expiryTime = time() + 60; // Code valid for 60 seconds

        // Save the reset code and expiry time in the database
        $this->userModel->update($user['id'], [
            'reset_code' => $resetCode,
            'reset_code_expiry' => $expiryTime,
        ]);

        // Send the code to the user's email
        $emailService = \Config\Services::email();
        $emailService->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $emailService->setTo($email);
        $emailService->setSubject('Password Reset Code');
        $emailService->setMessage("Your password reset code is: $resetCode.\n\nThis code is valid for 60 seconds.");
        
        if ($emailService->send()) {
            return redirect()->to('/forgot-password/verify')->with('success', 'Reset code sent to your email.');
        } else {
            return redirect()->back()->with('error', 'Failed to send reset code. Please try again.');
        }
    }

    // Show the form to verify the reset code
    public function showVerifyForm()
    {
        return view('auth/verify_code');
    }

    // Verify reset code
    public function verifyResetCode()
    {
        $email = $this->request->getPost('email');
        $resetCode = $this->request->getPost('reset_code');

        // Fetch the user by email
        $user = $this->userModel->where('email', $email)->first();

        if (!$user || $user['reset_code'] != $resetCode) {
            return redirect()->back()->with('error', 'Invalid reset code.');
        }

        if (time() > $user['reset_code_expiry']) {
            return redirect()->back()->with('error', 'Reset code has expired.');
        }

        // Code is valid - redirect to reset password form
        return view('auth/reset_password', ['email' => $email]);
    }

    // Reset password after the code is verified
    public function resetPassword()
    {
        $email = $this->request->getPost('email');
        $newPassword = $this->request->getPost('new_password');

        // Hash the new password and update the user record
        $this->userModel->update(['email' => $email], [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'reset_code' => null, // Clear reset code
            'reset_code_expiry' => null, // Clear expiry
        ]);

        return redirect()->to('/login')->with('success', 'Password has been reset. You can now log in.');
    }

    // Logout user
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
