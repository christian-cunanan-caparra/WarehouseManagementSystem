<?php namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class RegisterController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function save()
    {
        // Validate user input
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]', // Ensure email is valid and unique
            'password' => 'required|min_length[8]',
            'address' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required|numeric|max_length[15]',
        ]);

        if (!$validation) {
            if ($this->validator->getError('email')) {
                session()->setFlashdata('error', 'The email address is invalid or already registered.');
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if the email exists (for additional validation)
        $userModel = new UserModel();
        $existingUser = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($existingUser) {
            session()->setFlashdata('error', 'The email address is already registered.');
            return redirect()->back()->withInput();
        }

        // Save user data
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'role' => 'Inactive',
        ];

        if ($userModel->save($userData)) {
            // Send verification email
            $emailService = Services::email();
            $emailService->setTo($this->request->getPost('email'));
            $emailService->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
            $emailService->setSubject('Welcome!');
            $emailService->setMessage('Welcome to the Warehouse Management System! You have successfully registered.');

            if (!$emailService->send()) {
                session()->setFlashdata('error', 'Email could not be sent. Please check your email address.');
                return redirect()->to('/register');
            }

            session()->setFlashdata('success', 'Registration successful! A confirmation email has been sent.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'There was an error with your registration.');
        }

        return redirect()->to('/register');
    }
}
