<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],
                'loggedIn' => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/index.php');
    }
}
