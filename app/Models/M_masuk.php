<?php

namespace App\Models;

use CodeIgniter\Model;

class M_masuk extends Model
{
    protected $table      = 'masuk';
    protected $primaryKey = 'idmasuk';
    protected $allowedFields = ['idbarang', 'qty', 'keterangan', 'tanggal'];

    public function getAllData()
    {
        return $this->db->table('masuk')
            ->join('stock', 'stock.idbarang = masuk.idbarang')
            ->orderBy('masuk.tanggal', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function filterByMonth($bulan)
    {
        return $this->db->table('masuk')
            ->join('stock', 'stock.idbarang = masuk.idbarang')
            ->where('MONTH(masuk.tanggal)', $bulan)
            ->orderBy('masuk.tanggal', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function getFilteredData($bulan = null, $sortBy = null, $sortOrder = 'ASC', $limit = 10, $offset = 0)
    {
        $builder = $this->table($this->table)
            ->select('masuk.*, stock.namabarang')
            ->join('stock', 'stock.idbarang = masuk.idbarang');

        // Filter bulan
        if ($bulan) {
            $builder->where('MONTH(masuk.tanggal)', $bulan);
        }

        // Sorting
        if ($sortBy == 'nama') {
            $builder->orderBy('stock.namabarang', $sortOrder);
        } elseif ($sortBy == 'qty') {
            $builder->orderBy('masuk.qty', $sortOrder);
        } elseif ($sortBy == 'tanggal') {
            $builder->orderBy('masuk.tanggal', $sortOrder);
        }

        return $builder->limit($limit, $offset)->get()->getResultArray();
    }

    public function countFilteredData($bulan = null)
    {
        $builder = $this->table($this->table);

        if ($bulan) {
            $builder->where('MONTH(tanggal)', $bulan);
        }

        return $builder->countAllResults();
    }
}
