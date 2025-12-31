<?php

namespace App\Controllers;

use App\Models\M_keluar;
use App\Models\M_stock;

class Keluar extends BaseController
{
    public function index()
    {
        $keluarModel = new M_keluar();
        $stockModel  = new M_stock();

        // GET parameters
        $bulan      = $this->request->getGet('bulan');
        $sortBy     = $this->request->getGet('sortBy');
        $sortOrder  = $this->request->getGet('sortOrder') ?? 'ASC';
        $limit      = (int)($this->request->getGet('limit') ?? 10);
        $page       = (int)($this->request->getGet('page') ?? 1);
        $offset     = ($page - 1) * $limit;

        // Data keluar setelah filtering + sorting
        $keluar = $keluarModel->getFiltered($bulan, $sortBy, $sortOrder, $limit, $offset);

        $totalData = $keluarModel->countFiltered($bulan);

        $data = [
            'judul'     => 'Barang Keluar',
            'stockList' => $stockModel->findAll(),
            'keluar'    => $keluar,

            // pagination
            'totalData' => $totalData,
            'limit'     => $limit,
            'page'      => $page,

            // filters
            'bulan'     => $bulan,
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('keluar/index', $data);
        echo view('layout/v_footer');
    }

    public function tambah()
    {
        $model = new M_keluar();

        $model->insert([
            'idbarang' => $this->request->getPost('idbarang'),
            'qty'      => $this->request->getPost('qty'),
            'penerima' => $this->request->getPost('penerima'),
            'tanggal'  => date('Y-m-d'),
        ]);

        return redirect()->to('/keluar');
    }

    public function update($id)
    {
        $model = new M_keluar();

        $model->update($id, [
            'qty'      => $this->request->getPost('qty'),
            'penerima' => $this->request->getPost('penerima'),
        ]);

        return redirect()->to('/keluar');
    }

    public function hapus($id)
    {
        $model = new M_keluar();
        $model->delete($id);

        return redirect()->to('/keluar');
    }
    public function export()
    {
        $model = new \App\Models\M_keluar();

        $data = [
            'judul' => 'Export Barang Keluar',
            'keluar' => $model->findAll()
        ];

        echo view('export/keluar_export', $data);
    }
}
