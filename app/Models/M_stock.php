<?php

namespace App\Models;

use CodeIgniter\Model;

class M_stock extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getAllData()
    {
        return $this->db->table('stock')->get()->getResultArray();
    }
}
