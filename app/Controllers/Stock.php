<?php

namespace App\Controllers;

use App\Models\M_stock;

class Stock extends BaseController
{
    public function index()
    {
        $model = new M_stock();

        $data = [
            'judul' => 'Stock Barang',
            'stock' => $model->findAll()
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('stock/index', $data);
        echo view('layout/v_footer');
    }

    public function tambah()
    {
        $model = new M_stock();
        $model->insert($this->request->getPost());

        return redirect()->to('/stock');
    }

    public function update($id)
    {
        $model = new M_stock();
        $model->update($id, $this->request->getPost());

        return redirect()->to('/stock');
    }

    public function hapus($id)
    {
        $model = new M_stock();
        $model->delete($id);

        return redirect()->to('/stock');
    }
}
