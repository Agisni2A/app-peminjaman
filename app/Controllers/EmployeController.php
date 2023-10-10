<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\detPeminjamanModel;
use App\Models\EmployeModel;
use App\Models\ItemModel;
use App\Models\PeminjamanModel;
use CodeIgniter\I18n\Time;

class EmployeController extends BaseController
{
    protected $employeModel;
    protected $ItemModel;
    protected $peminjamanModel;
    protected $detPeminjamanModel;

    function __construct()
    {
        $this->employeModel = new EmployeModel();
        $this->ItemModel = new ItemModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->detPeminjamanModel = new detPeminjamanModel();
    }

    public function index()
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


        // $response = ['value' => $employe];
        // return $this->response->setJSON(['employe' => $item]);
    }

    public function pinjam()
    {
        if ($this->request->getPost()) {
            $itemModel = new ItemModel();
            $employe = $this->employeModel->findAll();

            $id = session()->get('idUser');

            $myTime = new Time('now', 'Asia/Jakarta', 'ID');


            $warehouseValue = $this->request->getPost('warehouse');
            $warehouseText = '';

            if ($warehouseValue == '1') {
                $warehouseText = 'SPL 1';
            } elseif ($warehouseValue == '2') {
                $warehouseText = 'SPL 2';
            } elseif ($warehouseValue == '3') {
                $warehouseText = 'SPL 3';
            }

            $pinjamPref = 'PM'; // Prefix "PM" untuk peminjaman
            $pDetailPref = 'PMD'; // Prefix "PMD" untuk peminjaman detail

            // Inisialisasi $peminjamanId dan $detPeminjamanId
            $peminjamanId = '';
            $detPeminjamanId = '';

            for ($i = 1; $i <= 5; $i++) {
                // Menghasilkan angka acak 4 digit
                $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

                // Menggabungkan prefix dengan angka acak
                $peminjamanIdAttempt = $pinjamPref . '-' .  $randomNumber;
                $detPeminjamanIdAttempt = $pDetailPref . '-' . $randomNumber;

                // Periksa apakah ID yang dihasilkan sudah ada di database
                if (
                    $this->peminjamanModel->find($peminjamanIdAttempt) === null &&
                    $this->detPeminjamanModel->find($detPeminjamanIdAttempt) === null
                ) {
                    // Jika tidak ada yang cocok, gunakan ID ini
                    $peminjamanId = $peminjamanIdAttempt;
                    $detPeminjamanId = $detPeminjamanIdAttempt;
                    break;
                } else {
                    // Jika ada yang cocok, tambahkan angka unik (misalnya, timestamp saat ini)
                    $peminjamanId = $pinjamPref . '-' .  $randomNumber . '-' . time();
                    $detPeminjamanId = $pDetailPref . '-' . $randomNumber . '-' . time();
                }
            }


            // print_r($detPinjam);
            // die();


            // print_r($jumItem);
            // die();
            $kdItem = $this->request->getPost('kodeItemId');
            $jumItem = count($kdItem);

            $pinjam = [
                'peminjamanId' => $peminjamanId,
                'jumItem' => $jumItem,
                'warehouse' => $warehouseText,
                'lokasiItem' => $this->request->getPost('lokasiItem'),
                'tglPinjam' => $this->request->getPost('tglPeminjaman'),
                'employeId' => $this->request->getPost('employe'),
            ];
            $this->peminjamanModel->insert($pinjam);


            $upd = [
                'warehouse' => $pinjam['warehouse'],
                'lokasiItem' => $pinjam['lokasiItem'],
                'employeId' => $pinjam['employeId'],
                'status' => '1'
            ];

            for ($x = 0; $x < $jumItem; $x++) {
                $detPinjam = [
                    // 'detailPeminjamanId' => $detPeminjamanId,
                    'kodeItemId' =>  $kdItem[$x],
                    'Description' => $this->request->getPost('desc'),
                    'peminjamanId' => $peminjamanId,
                    'status' => 1
                ];

                $this->detPeminjamanModel->insert($detPinjam);

                $kodeItemId = $detPinjam['kodeItemId'];

                // print_r($jumItem);
                // print_r($kodeItemId);
                // die();
                // print_r($upd);

                $this->ItemModel
                    ->where('kodeItemId', $kodeItemId)
                    ->set($upd)
                    ->update();
            }
            $sql = $this->detPeminjamanModel->getLastQuery();

            // print_r($sql);
            // die();

            return redirect()->to('/dashboard/master/maset')->with('success', 'Barang berhasil dipinjam.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Silakan isi formulir dengan benar.');
        }
    }
}
