<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class RegisterController extends Controller
{


    public function register()
    {
        // Load the registration form view
        return view('register');
    }


    public function save()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'address' => 'required',
            'gender' => 'required|in_list[Male,Female]',
            'mobile_number' => 'required|numeric',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = service('email');
        $userEmail = $this->request->getPost('email');
        $email->setTo($userEmail);
        $email->setFrom('caparrachristian47@gmail.com', 'Warehouse Management System');
        $email->setSubject('Welcome to Warehouse Management System');
        $email->setMessage('Thank you for registering.');

        try {
            if (!$email->send()) {
                return redirect()->back()->withInput()->with('error', 'Invalid Gmail or unable to send a message. Please use a valid Gmail.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Unable to send email. Please try again later.');
        }

        // Save user data in the database
        $model = new \App\Models\UserModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please check your email.');
    }
}
