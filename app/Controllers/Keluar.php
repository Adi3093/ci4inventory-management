<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Keluar extends Controller
{
    public function index()
    {
        $data = [
            'judul' => 'Barang Keluar'
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('keluar/index');
        echo view('layout/v_footer');
    }
}
