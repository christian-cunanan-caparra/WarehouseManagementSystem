<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll(); // Fetch all users
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $userModel = new UserModel();

        $userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/users');
    }
}
