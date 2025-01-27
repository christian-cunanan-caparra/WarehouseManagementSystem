<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('loggedIn')) {
            return redirect()->to('/index.php');
        }
    
        $role = session()->get('role');  // Safely retrieve role
    
        if (!$role) {
            // Handle the case where the role is not set, perhaps redirect or show an error
            return redirect()->to('/login'); // Redirect to login if no role
        }
    
        if ($role === 'admin') {
            return view('admin_dashboard');
        } else {
            return view('employee_dashboard');
        }
    }
    

    public function logout()
    {
        session()->destroy();  // Clear the session
        return redirect()->to('/index.php');  // Redirect to the login page
    }
    

}
