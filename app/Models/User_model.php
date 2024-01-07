<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'username';
    protected $returnType = 'object';
    protected $allowedFields = [
        'username', 'password', 'nama', 'role'
    ];

    public function createAcc($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('account');
        return $builder->insert($data);
    }
}