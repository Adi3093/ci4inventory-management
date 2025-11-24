<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'homepage'
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('Home/index');
        echo view('layout/v_footer');
    }
}
