<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        // return view('profil');
        echo "Welcome Back again " . $session->get('name');
        
    }
}
