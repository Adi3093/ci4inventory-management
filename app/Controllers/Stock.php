<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_stock;

class Stock extends Controller
{
    public function index()
    {
        $model = new M_stock();

        $data = [
            'judul' => 'Stock Barang',
            'stock' => $model->getAllData()
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('stock/index');
        echo view('layout/v_footer');
    }
}
