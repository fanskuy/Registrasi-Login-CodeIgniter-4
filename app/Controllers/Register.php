<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[6]|max_length[200]',
            'email'         => 'required|min_length[6]|max_length[200]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if($this->validate($rules)){
            $model  = new UserModel();
            $data   = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to(base_url('/login'));
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }
}
