<?php

namespace App\Models;

use CodeIgniter\Model;

class M_stock extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'idbarang';
    protected $allowedFields = ['namabarang', 'deskripsi', 'stock', 'satuan'];

    public function getAllData()
    {
        return $this->findAll();
    }
}
