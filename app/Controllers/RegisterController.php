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

        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'address' => 'required|min_length[5]',
            'gender' => 'required',
            'mobile' => 'required|numeric|min_length[10]|max_length[15]',
            'role' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $userModel->getValidationMessages());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile' => $this->request->getPost('mobile'),
            'role' => 'employee', // Default role
        ];

        if ($userModel->save($data)) {
            session()->setFlashdata('success', 'Registration successful. You can now log in.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->to('/register');
        }
    }
}
