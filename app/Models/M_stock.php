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
    public function getFilteredData($sortBy = null, $sortOrder = 'ASC', $limit = 10, $offset = 0)
    {
        $builder = $this->table($this->table);

        // Sort
        if ($sortBy == 'nama') {
            $builder->orderBy('namabarang', $sortOrder);
        }

        if ($sortBy == 'stock') {
            $builder->orderBy('stock', $sortOrder);
        }

        // Pagination
        return $builder->limit($limit, $offset)->get()->getResultArray();
    }

    public function countAllData()
    {
        return $this->countAll();
    }
    public function totalStockAkhir()
    {
        return $this->selectSum('stock')->get()->getRow()->stock ?? 0;
    }
}
