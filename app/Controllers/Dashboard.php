<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }

        return view('dashboard');  // Load dashboard view
    }
}
