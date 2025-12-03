<?php

namespace App\Controllers;

use App\Models\M_masuk;
use App\Models\M_keluar;
use App\Models\M_stock;

class Home extends BaseController
{
    public function index()
    {
        $masukModel  = new M_masuk();
        $keluarModel = new M_keluar();
        $stockModel  = new M_stock();

        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $totalMasuk = $masukModel->selectSum('qty')->first()['qty'];
        $totalKeluar = $keluarModel->selectSum('qty')->first()['qty'];
        $totalStockAkhir = $stockModel->selectSum('stock')->first()['stock'];
        $tahunListMasuk = $masukModel->getTahunList();
        $tahunListKeluar = $keluarModel->getTahunList();

        // gabungkan tahun agar tidak double
        $tahunList = array_unique(array_merge(
            array_column($tahunListMasuk, 'tahun'),
            array_column($tahunListKeluar, 'tahun')
        ));
        sort($tahunList);

        $tahun = date('Y');

        $data = [
            'judul' => 'Dashboard',
            'tahun'            => $tahun,
            'tahunList'        => $tahunList,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalStockAkhir' => $totalStockAkhir,
            'bulanMasuk' => $masukModel->getQtyByMonth($tahun),
            'bulanKeluar' => $keluarModel->getQtyByMonth($tahun)
        ];


        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('Home/index');
        echo view('layout/v_footer');
    }
}
