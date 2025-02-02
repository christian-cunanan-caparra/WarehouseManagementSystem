<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function register()
    {
        // Load the registration form view
        return view('register');
    }

    public function save()
    {
        // Validate user input
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]', // Check if email is unique
            'password' => 'required|min_length[8]',
            'address' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required|numeric|max_length[15]', // Assuming mobile number is 10 digits
        ]);

        if (!$validation) {
            // If validations fails and the email is already in use
            if ($this->validator->getError('email')) {
                session()->setFlashdata('error', 'The email address is already registered.');
            }
            
            // Redirect back with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare user data to be saved
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'role' => 'Inactive',  // Set the role to Employee by default
        ];

        // Save the user data into the database
        $userModel = new UserModel();
        if ($userModel->save($userData)) {
            // If successful, store a success messasge in the session
            session()->setFlashdata('success', 'Registration successful! Please wait, redirecting...');

            // Send a welcome email to the user
            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
            $email->setSubject('Welcome!');
            $email->setMessage('Welcome to the Warehouse Management System! You have successfully registered.');
            $email->send();
            return redirect()->to('/login');
        } else {
            // If saving the data fails, store an error message
            session()->setFlashdata('error', 'There was an error with your registration.');
        }

        // Redirect to the register page to show the success modal
        return redirect()->to('/register');
    }
}
