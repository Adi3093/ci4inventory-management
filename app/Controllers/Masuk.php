<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_masuk;

class masuk extends Controller
{
    public function index()
    {
        $model = new M_masuk();

        $bulan = $this->request->getGet('bulan');

        if (!empty($bulan)) {
            $masuk = $model->filterByMonth($bulan);
        } else {
            $masuk = $model->getAllData();
        }

        $data = [
            'judul' => 'Barang Masuk',
            'masuk' => $masuk,
            'bulan' => $bulan
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('masuk/index', $data);
        echo view('layout/v_footer');
    }
}
