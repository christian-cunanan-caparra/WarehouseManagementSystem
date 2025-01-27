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
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);

        // Send welcome email
        $email = \Config\Services::email();
        $email->setTo($this->request->getPost('email'));
        $email->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $email->setSubject('Welcome!');
        $email->setMessage('Welcome to the warehouse management system and successfully registered.');
        $email->send();

        return redirect()->to('/index.php')->with('success', 'Registration successful! Please log in.');
    }
}
