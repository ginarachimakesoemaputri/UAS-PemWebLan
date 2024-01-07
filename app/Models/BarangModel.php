<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id', 'nama', 'jumlah', 'keterangan', 'harga', 'harga_satuan', 'jumlah_satuan'
    ];

    public function addData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('barang');
        return $builder->insert($data);
    }

    public function getData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('barang');
        return $builder->get()->getResult();
    }
}