<?php

namespace App\Controllers;

use App\Models\M_admin;

class Admin extends BaseController
{
    public function index()
    {
        $model = new M_admin();

        $data = [
            'judul' => 'Kelola Admin',
            'admin' => $model->getAll()
        ];

        echo view('layout/v_header', $data);
        echo view('layout/v_sidebar');
        echo view('layout/v_topbar');
        echo view('admin/index', $data);
        echo view('layout/v_footer');
    }

    public function tambah()
    {
        $model = new M_admin();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $model->insert($data);

        return redirect()->to('/admin')->with('success', 'Admin berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new M_admin();

        $password = $this->request->getPost('password');
        $updateData = [
            'username' => $this->request->getPost('username'),
        ];

        // update password jika diisi
        if ($password != '') {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $updateData);

        return redirect()->to('/admin')->with('success', 'Admin berhasil diperbarui');
    }

    public function hapus($id)
    {
        $model = new M_admin();
        $model->delete($id);

        return redirect()->to('/admin')->with('success', 'Admin berhasil dihapus');
    }
}
