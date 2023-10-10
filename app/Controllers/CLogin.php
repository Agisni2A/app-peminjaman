<?php

namespace App\Controllers;

use App\Models\UserModel;

class CLogin extends BaseController
{
    public function index()
    {
        $session = session();

        if ($session->has('username')) {
            return redirect()->back();
        } else {
            return view('login/index');
        }
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        $password = isset($password) ? $password : '';

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userData = $userModel->getUser($username);

        $sql = $userModel->getLastQuery();

        // echo "SQL Query: $sql <br><br>";
        // print_r(($userData));
        // die();

        if ($userData) {
            $pass = $userData['password'];
            $authPass = password_verify($password, $pass);


            if ($authPass) {
                $ses_data = [
                    'idUser' => $userData['idUser'],
                    'username' => $userData['username'],
                    'isLoggedIn' => TRUE
                ];

                session()->set($ses_data);
                return redirect()->to(base_url('/dashboard'));
            } else {
                return redirect()->to(base_url('login'))->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->to(base_url('login'))->withInput()->with('error', 'Username tidak ditemukan.');
        }
    }


    // public function process()
    // {
    //     $userModel = new UserModel();
    //     $password = isset($password) ? $password : '';

    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $userData = $userModel->getUser($username);

    //     // $sql = $userModel->getLastQuery();

    //     // echo "SQL Query: $sql <br><br>";
    //     // // print_r(($userData));
    //     // die();

    //     if ($userData) {
    //         $pass = $userData['password'];
    //         $authPass = password_verify($password, $pass);


    //         if ($authPass) {
    //             $ses_data = [
    //                 'id' => $userData['idUser'],
    //                 'username' => $userData['username'],
    //                 'isLoggedIn' => TRUE
    //             ];

    //             session()->set($ses_data);
    //             return redirect()->to(base_url('/dashboard'));
    //         } else {
    //             return redirect()->to(base_url('login'))->withInput()->with('error', 'Password salah.');
    //         }
    //     } else {
    //         return redirect()->to(base_url('login'))->withInput()->with('error', 'Username tidak ditemukan.');
    //     }
    // }

    public function logout()
    {
        $session = session();
        $session->remove('username');
        $session->remove('id');
        return redirect()->to('/');
    }
}
