<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use App\Models\ItemModel;
use App\Models\PeminjamanModel;
use App\Models\detPeminjamanModel;
use CodeIgniter\I18n\Time;

class ItemController extends BaseController
{
    protected $ItemModel;
    protected $EmployeModel;
    protected $peminjamanModel;
    protected $detPeminjamanModel;

    function __construct()
    {
        $this->ItemModel = new ItemModel();
        $this->EmployeModel = new EmployeModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->detPeminjamanModel = new detPeminjamanModel();
    }
    public function index()
    {
        // $item = $this->ItemModel->findAll(); 
        // $user = $this->EmployeModel->findall();

        $EmployeModel = new EmployeModel();
        $itemsModel = new ItemModel();
        $peminjamanModel = new PeminjamanModel();
        $detailPeminjamanModel = new detPeminjamanModel();

        $query = $itemsModel->select('items.*, employe.nama as nama_peminjam')
            ->join('employe', 'items.employeId = employe.employeId', 'left')
            ->get();

        $data = $query->getResult();

        // print_r($data);
        // die();

        return $this->response->setJSON(['data' => $data,]);

        // return view('items', $data);
    }

    public function addItemAction()
    {
        $model = new ItemModel();
        $myTime = new Time('now', 'Asia/Jakarta', 'ID');

        $data = json_decode($this->request->getBody(), true); // Mendapatkan data JSON yang dikirim dari JavaScript

        if (!empty($data) && is_array($data)) {
            $response = [
                'success' => true,
                'message' => 'Data berhasil disimpan ke database.',
                'kodeitem' => [] // Inisialisasi array untuk kodeItemId
            ];
            $kdItem = [];

            foreach ($data as $item) {
                $kdItem[] = $item['kodeItemId'];
                $item['createDate'] = $myTime->toDateTimeString();
                if ($item['status'] == 'Dipinjam') {
                    $item['status'] = '1';
                } else if ($item['status'] == 'Tersedia') {
                    $item['status'] = '0';
                    $item['employeId'] = null;
                    $item['warehouse'] = null;
                    $item['lokasiItem'] = null;
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

                $desc = $item['description'];
                // $kdItem = $item['kodeItemId'];
                $wh =  $item['warehouse'];
                $lokitem = $item['lokasiItem'];
                $empId = $item['employeId'];

                $detPinjam = [
                    'detailPeminjamanId' => $detPeminjamanId,
                    'kodeItemId' =>  $kdItem,
                    'Description' => $desc,
                    'peminjamanId' => $peminjamanId,
                    'status' => 1
                ];

                // print_r($detPeminjamanId);

                $jumItem = count($data);

                $pinjam = [
                    'peminjamanId' => $peminjamanId,
                    'jumItem' => $jumItem,
                    'warehouse' => $wh,
                    'lokasiItem' => $lokitem,
                    'employeId' => $empId,
                ];

                print_r($kdItem);
                print_r($detPinjam);
                print_r($pinjam);
                die();

                // $this->peminjamanModel->insert($pinjam);
                // $this->detPeminjamanModel->insert($detPinjam);

                // Simpan data ke dalam tabel di sini (gunakan $item)
                // Contoh jika Anda menggunakan model $model
                // $model->insert($item);

                // Tambahkan kodeItemId ke dalam array terpisah
                $response = [
                    'kodeItemId' => $item['kodeItemId'],
                    'otherData' => $item,
                    'detPinjam' => $detPinjam,
                    'pinjam' => $pinjam
                ];
            }
        } else {
            $response['item'][] = [
                'success' => false,
                'message' => 'Gagal mengirim data atau data kosong atau bukan array.',
                'data' => $data
            ];
        }

        // Mengirim respons dalam format JSON
        return $this->response->setJSON($response);
    }



    public function edit()
    {
        $itemId = $this->request->getPost();
        $data = $this->ItemModel->where('kodeItemId', $itemId)->first();

        // print_r($data);
        // die();

        if ($data) {
            $jsonData = json_encode($data);
            return view('dashboard/master/edit', [
                'data' => $data,
                'id' => $itemId,
                'jsonData' => $jsonData,
            ]);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function editAction()
    {

        // print_r($this->request->getPost());
        // die();
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

        $crtByValue = $this->request->getPost('createBy');
        $crtByText = '';

        if ($crtByValue == '1') {
            # code...
            $crtByText = 'PAK ASEP';
        } else {
            $crtByText = 'PAK NATA';
        }

        // $id = $this->request->getPost('id');
        // print_r($id);
        // die();

        $data = [
            'createDate' => $myTime,
            'createBy' => $crtByText,
            'kodeItemId' => $this->request->getPost('kodeItemId') ?? null,
            'namaItem' => $this->request->getPost('namaItem') ?? null,
            'brand' => $this->request->getPost('brand') ?? null,
            'type' => $this->request->getPost('type') ?? null,
            'detail' => $this->request->getPost('detail') ?? null,
            'warehouse' => $warehouseText ?? null,
            'lokasiItem' => $this->request->getPost('lokasiItem') ?? null,
            'tglPembelian' => $this->request->getPost('tglPembelian') ?? null,
            'kerusakan' => null,
            'keterangan' => null,
            'kondisi' => $this->request->getPost('kondisi') ?? null,
            'status' => $this->request->getPost('status') ?? null,
            // 'pic' => $this->request->getPost('pic') ?? null,
        ];

        // print_r($data);
        // die();

        // $result = $this->ItemModel->where('id', $id)->update($data);
        $result = $this->ItemModel->updateItem($data['kodeItemId'], $data);
        // $sql = $this->ItemModel->getLastQuery();
        // print_r($sql);
        // die();

        if ($result) {
            return redirect()->to('/dashboard/master/maset')->with('success', 'Barang berhasil diedit.');
        } else {
            return redirect()->back()->with('error', 'Data gagal diedit');
        }
    }

    public function delete($id = null)
    {
        $itemIds = $this->request->getPost("id");
        $response = [];

        foreach ($itemIds as $itemId) {
            $result = $this->ItemModel->deleteItem($itemId);

            if ($result) {
                $response[] = ['status' => 'success', 'id' => $itemId];
            } else {
                $response[] = ['status' => 'error', 'id' => $itemId];
            }
        }
        return $this->response->setJSON($response);

        // $sql = $this->ItemModel->getLastQuery();
        // print_r($sql);
        // die();
    }

    public function getKode()
    {
        $kodeItemIds = $this->request->getPost('kodeItemId'); // Mengambil semua kodeItemId yang dipost

        $itemModel = new ItemModel();
        $result = [];

        foreach ($kodeItemIds as $kodeItemId) { // Perulangan melalui semua kodeItemId
            $item = $itemModel->where('kodeItemId', $kodeItemId)->first();

            if ($item) {
                $result[] = $item;
            }
        }

        if (!empty($result)) {
            $namaItems = [];

            foreach ($result as $item) {
                $namaItems[] = $item['namaItem'];
            }

            $response = [
                'success' => true,
                'item' => $namaItems,
                'items' => $result,
            ];
        } else {
            $response = [
                'success' => false,
                'namaItem' => 'Item not found',
            ];
        }

        return $this->response->setJSON($response);
    }

    public function getEmployeKode()
    {
        $employeId = $this->request->getPost('employeId');

        $itemModel = new ItemModel();
        $items = $itemModel->where('employeId', $employeId)->findAll();
        $employes = $this->EmployeModel->findAll();

        if (!empty($items)) {
            $response = [
                'success' => true,
                'items' => [],
                'employeId' => $employeId, // Menambahkan employeId ke dalam response
            ];

            foreach ($items as $item) {
                // Ambil nama employe yang cocok dengan employeId dari item
                $namaEmploye = '';
                foreach ($employes as $employe) {
                    if ($item['employeId'] === $employe['employeId']) {
                        $namaEmploye = $employe['nama'];
                        break; // Keluar dari loop jika sudah menemukan cocok
                    }
                }

                // Ubah status dan employeId dalam item
                $item['status'] = 'Dipinjam';
                $item['employeId'] = $namaEmploye;

                // Tambahkan item ke dalam response
                $response['items'][] = $item;
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'No items found for the selected employe.',
            ];
        }

        return $this->response->setJSON($response);
        // Mengembalikan response JSON
    }

    public function idxPinjam()
    {
        $employe = $this->EmployeModel->where('status', '1')->findAll();
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
            $employe = $this->EmployeModel->findAll();

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


            $detPinjam = [
                'detailPeminjamanId' => $detPeminjamanId,
                'kodeItemId' =>  $this->request->getPost('kodeItemId'),
                'Description' => $this->request->getPost('desc'),
                'peminjamanId' => $peminjamanId,
                'status' => '1'
            ];

            // print_r($detPeminjamanId);

            $jumItem = count($detPinjam['kodeItemId']);

            $pinjam = [
                'peminjamanId' => $peminjamanId,
                'jumItem' => $jumItem,
                'warehouse' => $warehouseText,
                'lokasiItem' => $this->request->getPost('lokasiItem'),
                'tglPinjam' => $this->request->getPost('tglPeminjaman'),
                'employeId' => $this->request->getPost('employe'),
            ];


            $upd = [
                'warehouse' => $pinjam['warehouse'],
                'lokasiItem' => $pinjam['lokasiItem'],
                'employeId' => $pinjam['employeId'],
                'status' => '1'
            ];

            print_r($detPinjam);
            print_r($pinjam);
            print_r($upd);

            $kodeItemId = $detPinjam['kodeItemId'];

            // $this->peminjamanModel->insert($pinjam);
            // $this->detPeminjamanModel->insert($detPinjam);
            // $this->ItemModel
            //     ->where('kodeItemId', $kodeItemId)
            //     ->set($upd)
            //     ->update();

            $sql = $itemModel->getLastQuery();

            // print_r($sql);
            // die();

            return redirect()->to('/dashboard/master/maset')->with('success', 'Barang berhasil dipinjam.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Silakan isi formulir dengan benar.');
        }
    }

    public function returns()
    {
        $kodeItems = $this->request->getPost('kodeItems');

        $myTime = new Time('now', 'Asia/Jakarta', 'ID');

        if (!empty($kodeItems)) {
            for ($x = 0; $x < count($kodeItems); $x++) {
                $employeIds = [];
                $kdItm = $kodeItems[$x];

                // print_r($kdItm);
                // die();

                // $this->ItemModel->select('employeId')
                //     ->where('kodeItemId', $kodeItems)
                //     ->findAll();

                // foreach ($employe as $employes) {
                //     $employeIds[] = $employes['employeId'];
                // }
                $peminjamanIdArray = $this->detPeminjamanModel
                    ->select('peminjamanId')
                    ->where('kodeItemId', $kdItm)
                    ->findAll();

                $peminjamanIdString = implode(',', array_column($peminjamanIdArray, 'peminjamanId'));

                // print_r($peminjamanIdString);
                // die();

                $pinj = $this->peminjamanModel
                    ->where('peminjamanId', $peminjamanIdString)
                    ->set('tglKembali', $myTime)->update();

                $depnij = $this->detPeminjamanModel
                    ->where('kodeItemId', $kdItm)
                    ->set('status', '0')->update();

                $upd = [
                    'warehouse' => null,
                    'lokasiItem' => null,
                    'employeId' => null,
                    'status' => '0'
                ];

                $aset = $this->ItemModel
                    ->where('kodeItemId', $kdItm)
                    ->set($upd)
                    ->update();
                $sucess = true;
            }

            $response = [
                'success' => $sucess,
                // 'messege' => $message
                // 'sql' => $pinj,
                // $depnij
            ];
        } else {
            $response = [
                'success' => false
            ];
        }
        return $this->response->setJSON($response);
    }
}
