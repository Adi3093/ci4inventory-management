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
}
