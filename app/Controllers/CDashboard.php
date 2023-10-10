<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\EmployeModel;
use App\Models\UserModel;

class CDashboard extends BaseController
{
    protected $ItemModel;
    protected $employeModel;
    protected $UserModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
        $session = session();
        $this->ItemModel = new ItemModel();
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'totItem' => $this->ItemModel->totalItem(),
            'totItemPin' => $this->ItemModel->totalPinjamItem(),
            'totUser' =>  $this->UserModel->countAllResults(),
        ];

        if (session()->has('username')) {

            return view('/dashboard/dashboard', $data);
        } else {
            return view('login');
        }
    }
    public function maset()
    {
        $data['items'] = $this->ItemModel->findAll();

        $cdata = [
            'totItem' => $this->ItemModel->totalItem(),
            'totItemPin' => $this->ItemModel->totalPinjamItem(),
        ];


        if (session()->has('username')) {
            return view(
                '/dashboard/master/maset',
                [
                    'data' => $data,
                    'cdata' => $cdata
                ]
            );
        } else {
            return redirect()->to(base_url('/'));
        }
    }


    public function muser()
    {
        if (session()->has('username')) {
            return view('/dashboard/master/muser');
        } else {
            return view('/');
        }
    }

    public function pinjam()
    {
        $employe = $this->employeModel->where('status', '1')->findAll();
        $item = $this->ItemModel->findAll();

        if ($employe) {
            $jsonData = json_encode($item);

            // print_r($employe);
            // die();

            return view('dashboard/mmenu/pinjam', [
                'employe' => $employe,
                'item' => $item,
                'jsonData' => $jsonData
            ]);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
    public function kembali()
    {
        $employe = $this->employeModel->where('status', '1')->findAll();
        $item = $this->ItemModel->findAll();

        if ($employe) {
            $jsonData = json_encode($item);

            // print_r($employe);
            // die();

            return view('dashboard/mmenu/kembali', [
                'employe' => $employe,
                'item' => $item,
                'jsonData' => $jsonData
            ]);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function addItem()
    {
        $employe = $this->employeModel->where('status', '1')->findAll();

        if (session()->has('username')) {
            return view('/dashboard/master/addItem', ['employe' => $employe]);
        } else {
            return view('/');
        }
    }
}
