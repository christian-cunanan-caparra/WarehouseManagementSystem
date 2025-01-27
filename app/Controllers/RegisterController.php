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
        // Validate the form input
        $validation = $this->validate([
            'name'      => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[8]',
            'address'   => 'required',
            'gender'    => 'required',
            'mobile'    => 'required|numeric'
        ]);

        // If validation fails, return back to the form with errors
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare the data to be inserted into the database
        $userModel = new UserModel();
        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'address'   => $this->request->getPost('address'),
            'gender'    => $this->request->getPost('gender'),
            'mobile'    => $this->request->getPost('mobile')
        ];

        // Insert the data into the database
        if ($userModel->save($data)) {
            // Set a success message and redirect to login page
            return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
        } else {
            // Handle the error if insert fails
            return redirect()->back()->withInput()->with('errors', ['Failed to register user.']);
        }
    }
}
