<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Check if the user is logged in
        if (!session()->get('loggedIn')) {
            return redirect()->to('/index.php');  // Redirect to the login page if not logged in
        }
    
        // Get the user's name from the session
        $userName = session()->get('user_name');  // Assuming the name is stored under 'user_name'
    
        // Check the role and load the appropriate dashboard view
        if (session()->get('role') === 'admin') {
            return view('admin_dashboard', ['user_name' => $userName]);  // Pass the user's name to the admin dashboard view
        } else {
            return view('employee_dashboard', ['user_name' => $userName]);  // Pass the user's name to the employee dashboard view
        }
    }
    

    public function logout()
    {
        session()->destroy();  // Clear the session
        return redirect()->to('/index.php');  // Redirect to the login page
    }
    

}
