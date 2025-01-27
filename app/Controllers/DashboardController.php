<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Check if the user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login'); // Redirect to login if not logged in
        }
    
        $role = session()->get('role');  // Retrieve the role from session
    
        if (!$role) {
            // Handle the case where the role is not set
            return redirect()->to('/login'); // Redirect to login if no role
        }
    
        if ($role === 'Admin') {
            return view('admin_dashboard'); // Show admin dashboard view
        } else {
            return view('employee_dashboard'); // Show employee dashboard view
        }
    }
    

    public function logout()
    {
        session()->destroy();  // Clear the session
        return redirect()->to('/login');  // Redirect to the login page
    }
}
