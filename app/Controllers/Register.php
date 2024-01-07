<?php

namespace App\Controllers;

use App\Models\User_model;

class Register extends BaseController
{
    public function index($pesan = null)
    {
        $data["pesan"] = $pesan;
        return view('Register/index', $data);
    }

    public function check()
    {
        // print_r($_POST);
        $username = $this->request->getPost('email');
        $pass = $this->request->getPost('password');
        $name = $this->request->getPost('name');

        $user = new User_model();
        $dataUser = $user->find($username);
        if ($dataUser != NULL) {
            $data["pesan"] = "Username telah digunakan.";
            return view('Register/index', $data);
        } else {
            if (strlen($pass) < 8) {
                $data["pesan"] = "Password harus terdiri dari 8 atau lebih karakter.";
                return view('Register/index', $data);
            } else {
                $data = array(
                    'username' => $username,
                    'password' => md5($pass),
                    'nama' => $name,
                    'role' => 'user'
                );
    
                $result = $user->createAcc($data);
                if ($result) {
                    return redirect()->to(base_url("public/login"));
                } else {
                    $data["pesan"] = "Akun gagal dibuat. Silakan coba lagi";
                    return view('Register/index', $data);
                }
            }
        }
    }
}