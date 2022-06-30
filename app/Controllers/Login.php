<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('username')) {
            return redirect()->to(base_url('/pages/dashboard'));
        }
        return view('pages/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UsersModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->ListUsersWhere("username = '$username'");
        if ($data) {
            $auth_pass = $data[0]['password'];
            if ($password == $auth_pass) {
                $sess = [
                    'no_user'   => $data[0]['no_user'],
                    'username'  => $data[0]['username'],
                    'password'  => $data[0]['password'],
                    'nama'      => $data[0]['nama'],
                    'level'     => $data[0]['level']
                ];
                $session->set($sess);
                return redirect()->to(base_url('/pages/dashboard'));
            } else {
                $msg = [
                    'alert' => 'danger',
                    'judul' => 'Login Failed',
                    'pesan' => 'Wrong Password'
                ];
                $session->setFlashdata($msg);
                return redirect()->to(base_url('/login'));
            }
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Login Failed',
                'pesan' => 'Username not found'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
