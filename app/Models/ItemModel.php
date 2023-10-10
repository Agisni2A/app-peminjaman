<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'kodeItemId';

    protected $allowedFields = [
        'kodeItemId',
        'namaItem', 'brand', 'type', 'detail',
        'warehouse', 'lokasiItem', 'tglPembelian', 'kerusakan',
        'peminjam', 'keterangan', 'kondisi', 'status', 'createBy',
        'createDate', 'idUser', 'employeId'
    ];

    public function totalItem()
    {
        return $this->countAllResults();
    }

    public function totalPinjamItem()
    {
        return $this->where('status', 1)->countAllResults();
    }

    public function createItem($data)
    {
        return $this->insert($data);
    }

    public function updateItem($id, $data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('items');

        // $this->where('id', $id);
        // $this->update('items', $data);

        $builder->where('kodeItemId', $id);
        return $builder->update($data);
    }

    public function deleteItem($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('items');


        // print_r($id);
        // die();
        // return $this->delete($id);
        $builder->where('kodeItemId', $id);
        $builder->delete();
        // $sql = $this->getLastQuery();
        // print_r($sql);
        // die();
        return $db->affectedRows() > 0;
    }

    public function findkodeItem($kodeItemId)
    {
        return $this->orWhereIn('kodeItemId', $kodeItemId)->findAll();
    }
}
