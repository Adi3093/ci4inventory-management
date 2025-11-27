<?php

namespace App\Models;

use CodeIgniter\Model;

class M_keluar extends Model
{
    protected $table = 'keluar';
    protected $primaryKey = 'idkeluar';
    protected $allowedFields = ['idbarang', 'tanggal', 'qty', 'penerima'];

    public function getByMonth($bulan)
    {
        return $this->db->table('keluar')
            ->select('keluar.*, stock.namabarang')
            ->join('stock', 'stock.idbarang = keluar.idbarang')
            ->where('MONTH(tanggal)', $bulan)
            ->orderBy('tanggal', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getAllData()
    {
        return $this->db->table('keluar')
            ->select('keluar.*, stock.namabarang')
            ->join('stock', 'stock.idbarang = keluar.idbarang')
            ->orderBy('tanggal', 'DESC')
            ->get()
            ->getResultArray();
    }
}
