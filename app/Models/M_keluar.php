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
    public function getChartData()
    {
        return $this->select("MONTH(tanggal) as bulan, COUNT(*) as jumlah")
            ->groupBy("MONTH(tanggal)")
            ->orderBy("bulan", "ASC")
            ->findAll();
    }
    public function totalQtyKeluar()
    {
        return $this->selectSum('qty')->get()->getRow()->qty ?? 0;
    }
    public function getTahunList()
    {
        return $this->select("YEAR(tanggal) as tahun")
            ->groupBy("YEAR(tanggal)")
            ->orderBy("tahun", "DESC")
            ->findAll();
    }
    public function getQtyByMonth()
    {
        $result = $this->select("MONTH(tanggal) AS bulan, SUM(qty) AS jumlah")
            ->groupBy("MONTH(tanggal)")
            ->orderBy("MONTH(tanggal)", "ASC")
            ->findAll();

        // ----- Bikin array 12 bulan (1–12), default 0 -----
        $finalData = array_fill(1, 12, 0);

        foreach ($result as $row) {
            $finalData[(int)$row['bulan']] = (int)$row['jumlah'];
        }

        // Kembalikan sebagai array 0-index untuk Chart JS
        return array_values($finalData);
    }
}
