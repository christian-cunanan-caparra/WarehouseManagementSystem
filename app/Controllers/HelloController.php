<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HelloController extends Controller
{
    public function index()
    {
        return view('index');  // This will load the app/views/index.php view
    }
}
