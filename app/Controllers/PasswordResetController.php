<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class PasswordResetController extends BaseController
{
    public function requestReset()
    {
        return view('request_reset');
    }

    public function sendResetCode()
    {
        $email = $this->request->getPost('email');

        // Check if the email exists in the database
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Email not found.');
            return redirect()->back();
        }

        // Generate a 6-digit random code
        $resetCode = random_int(100000, 999999);

        // Save the code in the user's session for verification
        session()->set('reset_code', $resetCode);
        session()->set('reset_email', $email);

        // Configure and send the email
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $emailService->setSubject('Password Reset Code');
        $emailService->setMessage("Your password reset code is: $resetCode");

        if ($emailService->send()) {
            session()->setFlashdata('success', 'Reset code sent to your email.');
            return redirect()->to('/verify-reset-code');
        } else {
            session()->setFlashdata('error', 'Failed to send reset code.');
            return redirect()->back();
        }
    }

    public function verifyResetCode()
    {
        return view('verify_reset_code');
    }

    public function processVerification()
    {
        $enteredCode = $this->request->getPost('reset_code');

        // Check if the entered code matches the session code
        if ($enteredCode == session()->get('reset_code')) {
            return redirect()->to('/reset-password');
        } else {
            session()->setFlashdata('error', 'Invalid reset code.');
            return redirect()->back();
        }
    }

    public function resetPassword()
    {
        return view('reset_password');
    }

    public function processResetPassword()
    {
        $password = $this->request->getPost('password');
        $email = session()->get('reset_email');

        if (!$email) {
            session()->setFlashdata('error', 'No email session found.');
            return redirect()->to('/request-reset');
        }

        $userModel = new UserModel();

        // Update the user's password
        $userModel->where('email', $email)->set([
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ])->update();

        // Clear the reset session
        session()->remove(['reset_code', 'reset_email']);

        session()->setFlashdata('success', 'Password successfully reset. Please login.');
        return redirect()->to('/login');
    }
}
