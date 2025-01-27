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
        // Validate input
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Create a new instance of the UserModel
        $userModel = new UserModel();
    
        // Prepare the data to be inserted
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];
    
        // Insert the data into the database
        $userModel->save($userData);
    
        // Send a welcome email
        $email = \Config\Services::email();
        $email->setTo($this->request->getPost('email'));
        $email->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $email->setSubject('Welcome!');
        $email->setMessage('Welcome to the warehouse management system and successfully registered.');
        $email->send();
    
        // Redirect to login page
        return redirect()->to('/index.php')->with('success', 'Registration successful! Please log in.');
    }
    
}
