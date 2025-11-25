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

        $bulan = $this->request->getGet('bulan');

        if (!empty($bulan)) {
            $masuk = $model->filterByMonth($bulan);
        } else {
            $masuk = $model->getAllData();
        }

        $data = [
            'judul' => 'Barang Masuk',
            'masuk' => $masuk,
            'bulan' => $bulan,
            'stockList' => $modelstock->getAllData()
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
}
