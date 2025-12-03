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
    public function getChartData()
    {
        return $this->select("MONTH(tanggal) as bulan, COUNT(*) as jumlah")
            ->groupBy("MONTH(tanggal)")
            ->orderBy("bulan", "ASC")
            ->findAll();
    }
    public function totalQtyMasuk()
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
