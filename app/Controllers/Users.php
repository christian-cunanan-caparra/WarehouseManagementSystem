<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function register()
    {
        // Get data from POST request
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); // Hash the password
        $address = $this->request->getPost('address');
        $gender = $this->request->getPost('gender');
        $mobile_number = $this->request->getPost('mobile_number');
        $role = $this->request->getPost('role'); // 'Admin' or 'Employee'

        $userModel = new UserModel();
        
        // Insert new user into the database
        $userModel->save([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'gender' => $gender,
            'mobile_number' => $mobile_number,
            'role' => $role,
        ]);

        return redirect()->to('/login');  // Redirect to login page after successful registration
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');  // Get password entered by the user

        $userModel = new UserModel();
        $user = $userModel->checkUserByEmail($email);  // Check if the email exists

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, set session data
            session()->set([
                'is_logged_in' => true,
                'user_name' => $user['name'],
                'role' => $user['role'],
                'user_id' => $user['id']
            ]);

            return redirect()->to('/dashboard');  // Redirect to the dashboard
        } else {
            // Invalid credentials
            session()->setFlashdata('error', 'Invalid login credentials.');
            return redirect()->to('/login');  // Redirect back to login page
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function index()
    {
        // Ensure user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Retrieve user role from session
        $role = session()->get('role');

        // Redirect to respective dashboard based on role
        if ($role === 'Admin') {
            return redirect()->to('/admin-dashboard');  // Redirect to Admin dashboard
        } elseif ($role === 'Employee') {
            return redirect()->to('/employee-dashboard');  // Redirect to Employee dashboard
        }

        // If no valid role is found, redirect to login
        return redirect()->to('/login');
    }

    // Password reset - Request Reset Code
    public function sendResetCode()
    {
        $email = $this->request->getPost('email');

        $userModel = new UserModel();
        $user = $userModel->checkUserByEmail($email);  // Find user by email

        if ($user) {
            $resetCode = rand(10000, 20000);  // Generate a random reset code
            $resetExpiry = date('Y-m-d H:i:s', strtotime('+1 hour'));  // Expiry time (1 hour)

            // Update reset code and expiry in the database
            $userModel->update($user['id'], [
                'reset_code' => $resetCode,
                'reset_code_expiry' => $resetExpiry
            ]);

            // Send the reset code to the user's email (use your email sending functionality here)
            // mail($user['email'], 'Password Reset', 'Your reset code is: ' . $resetCode);

            return redirect()->to('/forgot-password')->with('message', 'Reset code sent to your email!');
        } else {
            return redirect()->to('/forgot-password')->with('error', 'Email not found!');
        }
    }

    // Password reset - Verify code and reset password
    public function resetPassword()
    {
        $email = $this->request->getPost('email');
        $resetCode = $this->request->getPost('reset_code');
        $newPassword = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT); // Hash the new password

        $userModel = new UserModel();
        $user = $userModel->checkUserByEmail($email);  // Find user by email

        if ($user && $user['reset_code'] == $resetCode && strtotime($user['reset_code_expiry']) > time()) {
            // Code is valid and not expired, update the password
            $userModel->update($user['id'], [
                'password' => $newPassword,
                'reset_code' => null,  // Clear the reset code after use
                'reset_code_expiry' => null  // Clear the expiry time
            ]);

            return redirect()->to('/login')->with('message', 'Password reset successful.');
        } else {
            return redirect()->to('/forgot-password')->with('error', 'Invalid or expired reset code.');
        }
    }
}
