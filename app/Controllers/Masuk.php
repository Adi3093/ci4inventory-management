<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_masuk;
use App\Models\M_stock;

class masuk extends Controller
{
    public function index()
    {
        $model = new M_masuk();
        $modelstock = new M_stock;

        $bulan      = $this->request->getGet('bulan');
        $sortBy     = $this->request->getGet('sortBy');
        $sortOrder  = $this->request->getGet('sortOrder') ?? 'ASC';

        $limit      = (int) ($this->request->getGet('limit') ?? 10);
        $page       = (int) ($this->request->getGet('page') ?? 1);

        $offset     = ($page - 1) * $limit;

        if ($limit < 1) {
            $limit = 10;
        }

        if ($page < 1) {
            $page = 1;
        }

        if (!empty($bulan)) {
            $masuk = $model->filterByMonth($bulan);
        } else {
            $masuk = $model->getAllData();
        }

        $data = [
            'judul'      => 'Barang Masuk',
            'masuk'      => $model->getFilteredData($bulan, $sortBy, $sortOrder, $limit, $offset),
            'stockList'  => $modelstock->findAll(),    // untuk dropdown tambah
            'bulan'      => $bulan,
            'sortBy'     => $sortBy,
            'sortOrder'  => $sortOrder,
            'limit'      => $limit,
            'page'       => $page,
            'totalData'  => $model->countFilteredData($bulan)
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('masuk/index', $data);
        echo view('layout/v_footer');
    }
    public function tambah()
    {
        $model = new M_masuk();

        $data = [
            'idbarang'   => $this->request->getPost('idbarang'),
            'qty'        => $this->request->getPost('qty'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $model->insert($data);

        return redirect()->to(base_url('masuk'))->with('success', 'Barang masuk berhasil ditambahkan!');
    }



    public function update($idmasuk)
    {
        $model = new M_masuk();

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'qty'        => $this->request->getPost('qty')
        ];

        $model->update($idmasuk, $data);

        return redirect()->to(base_url('masuk'))->with('sukses', 'Data berhasil diperbarui!');
    }
    public function hapus($idmasuk)
    {
        $model = new M_masuk();
        $model->delete($idmasuk);

        return redirect()->to(base_url('masuk'))->with('sukses', 'Data berhasil dihapus!');
    }
    public function export()
    {
        $model = new \App\Models\M_masuk();

        $data = [
            'judul' => 'Export Barang Masuk',
            'masuk' => $model->findAll()
        ];

        echo view('export/masuk_export', $data);
    }
}
