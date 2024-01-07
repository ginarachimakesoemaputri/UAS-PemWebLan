<?php

namespace App\Controllers;
use App\Models\User_model;

class Login extends BaseController {
    public function index($pesan = null) {
        $data["pesan"] = $pesan;
        return view('Login/index', $data);
    }

    public function cek() {
        // print_r($_POST);
        $username = $this->request->getPost('email');
        $pass = $this->request->getPost('password');

        $user = new User_model();
        $dataUser = $user->find($username);
        if ($dataUser == NULL) {
            $data["pesan"] = "Akun tidak ditemukan.";
            return view('Login/index', $data);
        } else {
            if (md5($pass) == $dataUser->password) {
                //Login berhasil

                //set Session
                $session = session();
                $session_data = [
                    "username" => $dataUser->username,
                    "role" => $dataUser->role
                ];
                $session->set($session_data);

                //Redirect ke Home
                return redirect()->to(base_url("public/home"));
            } else {
                $data["pesan"] = "Password salah.";
                return view('Login/index', $data);
            }
        }
    }
}