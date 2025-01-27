<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('loggedIn')) {
            return redirect()->to('/index.php');
        }

        if (session()->get('role') === 'admin') {
            return view('admin_dashboard');
        } else {
            return view('employee_dashboard');
        }
    }
}
