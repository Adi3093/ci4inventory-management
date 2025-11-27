<?php

namespace App\Controllers;

use App\Models\M_keluar;
use App\Models\M_stock;
use CodeIgniter\Controller;

class Keluar extends Controller
{
    public function index()
    {
        $keluarModel = new M_keluar();
        $stockModel  = new M_stock();

        // Ambil bulan dari GET
        $bulan = $this->request->getGet('bulan');

        if ($bulan) {
            $keluar = $keluarModel->getByMonth($bulan);
        } else {
            $keluar = $keluarModel->getAllData();
        }

        $data = [
            'judul'      => 'Barang Keluar',
            'keluar'     => $keluar,
            'stockList'  => $stockModel->findAll(),
            'bulan'      => $bulan
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

        $data = [
            'idbarang' => $this->request->getPost('idbarang'),
            'qty'      => $this->request->getPost('qty'),
            'penerima' => $this->request->getPost('penerima')
        ];

        $model->insert($data);

        return redirect()->to('/keluar')->with('success', 'Data barang keluar berhasil ditambahkan!');
    }

    public function update($id)
    {
        $model = new M_keluar();

        $data = [
            'qty'      => $this->request->getPost('qty'),
            'penerima' => $this->request->getPost('penerima')
        ];

        $model->update($id, $data);

        return redirect()->to('/keluar')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $model = new M_keluar();
        $model->delete($id);

        return redirect()->to('/keluar')->with('success', 'Data berhasil dihapus!');
    }
}
