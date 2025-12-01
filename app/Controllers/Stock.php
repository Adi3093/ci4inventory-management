<?php

namespace App\Controllers;

use App\Models\M_stock;

class Stock extends BaseController
{
    public function index()
    {
        $model = new \App\Models\M_stock();

        $sortBy    = $this->request->getGet('sortBy') ?? '';
        $sortOrder = $this->request->getGet('sortOrder') ?? 'ASC';
        $limit     = (int) ($this->request->getGet('limit') ?? 10);
        $page      = (int) ($this->request->getGet('page') ?? 1);

        if ($limit <= 0) $limit = 10;
        if ($page <= 0)  $page = 1;

        $offset = ($page - 1) * $limit;
        $totalData = $model->countAllData();
        $stock = $model->getFilteredData($sortBy, $sortOrder, $limit, $offset);

        $data = [
            'judul'     => 'Stock Barang',
            'stock'     => $stock,
            'totalData' => $totalData,
            'limit'     => $limit,
            'page'      => $page,
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder
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
