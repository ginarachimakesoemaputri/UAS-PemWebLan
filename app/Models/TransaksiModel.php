<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi_keluar';
    protected $primaryKey = 'id_transaksi';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_transaksi', 'id', 'jumlah', 'keterangan', 'tanggal_transaksi', 'total'
    ];

    public function addData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('id_transaksi');
        return $builder->insert($data);
    }
}