<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function save()
    {
        $userModel = new UserModel();

        // Check if the email exists in the database
        $email = $this->request->getPost('email');
        $existingUser = $userModel->where('email', $email)->first();

        if (!$existingUser) {
            session()->setFlashdata('error', 'Your email is not found. Please provide your valid Email.');
            return redirect()->back()->withInput();
        }

        // Validate user input
        $validation = $this->validate([
            'name' => 'required|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'address' => 'required|max_length[255]',
            'gender' => 'required|max_length[10]',
            'mobile_number' => 'required|numeric|max_length[15]',
        ]);

        if (!$validation) {
            session()->setFlashdata('error', 'There were validation errors. Please check your inputs.');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user data
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
            session()->setFlashdata('success', 'Registration successful! Please wait, redirecting...');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'There was an error with your registration.');
            return redirect()->to('/register');
        }
    }
}
