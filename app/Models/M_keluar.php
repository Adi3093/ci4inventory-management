<?php

namespace App\Models;

use CodeIgniter\Model;

class M_keluar extends Model
{
    protected $table = 'keluar';
    protected $primaryKey = 'idkeluar';

    protected $allowedFields = ['idbarang', 'qty', 'penerima', 'tanggal'];

    public function getFiltered($bulan = null, $sortBy = null, $sortOrder = 'ASC', $limit = 10, $offset = 0)
    {
        $builder = $this->table($this->table)
            ->select('keluar.*, stock.namabarang')
            ->join('stock', 'stock.idbarang = keluar.idbarang');

        // Filter bulan
        if ($bulan) {
            $builder->where('MONTH(tanggal)', $bulan);
        }

        // Sorting
        if ($sortBy === 'tanggal') {
            $builder->orderBy('tanggal', $sortOrder);
        } elseif ($sortBy === 'nama') {
            $builder->orderBy('stock.namabarang', $sortOrder);
        } elseif ($sortBy === 'qty') {
            $builder->orderBy('qty', $sortOrder);
        }

        return $builder->limit($limit, $offset)->get()->getResultArray();
    }

    public function countFiltered($bulan = null)
    {
        $builder = $this->table($this->table);

        if ($bulan) {
            $builder->where('MONTH(tanggal)', $bulan);
        }

        return $builder->countAllResults();
    }
}
