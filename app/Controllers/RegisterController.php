<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function register()
    {
        return view('register'); // Render the registration form
    }

    public function save()
    {
        // Validate the form data
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'address' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required|numeric',
            'role' => 'required'
        ]);

        // If validation fails, redirect back with error messages
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Create a new UserModel instance
        $userModel = new UserModel();

        // Save the user data to the database
        $userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'role' => $this->request->getPost('role'),
        ]);

        // Optionally, send a welcome email
        $email = \Config\Services::email();
        $email->setTo($this->request->getPost('email'));
        $email->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $email->setSubject('Welcome!');
        $email->setMessage('Welcome to the Warehouse Management System and successfully registered.');
        $email->send();

        // Redirect to login page with success message
        return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
    }
}
