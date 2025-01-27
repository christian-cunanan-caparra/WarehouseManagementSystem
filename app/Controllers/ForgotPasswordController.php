<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ForgotPasswordController extends Controller
{
    public function sendCode()
    {
        helper(['form', 'url']);
        
        // If it's a POST request
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            
            // Verify if email exists in your database
            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user) {
                // Send the reset code to the user's email
                $resetCode = rand(10000, 20000);
                // Assuming you have a method to send emails (adjust according to your email configuration)
                $this->sendResetCodeEmail($email, $resetCode);

                // Store the reset code in session or database for verification
                session()->set('reset_code', $resetCode);
                session()->set('email', $email);

                return redirect()->to('/forgot-password/verify-code')->with('success', 'Reset code has been sent to your email.');
            } else {
                return redirect()->back()->with('error', 'Email not found.');
            }
        }

        // Show the form
        return view('forgot_password/send_code');
    }

    private function sendResetCodeEmail($email, $resetCode)
    {
        // Implement email sending logic here (e.g., using PHPMailer or CodeIgniter's built-in email class)
        // Send email with the reset code
    }
}
