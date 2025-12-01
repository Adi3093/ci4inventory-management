<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                Tambah Admin
            </button>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password (Encrypted)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($admin as $a): ?>
                        <tr>
                            <td><?= esc($a['username']); ?></td>
                            <td><?= esc($a['password']); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEdit-<?= $a['iduser']; ?>">
                                    Edit
                                </button>

                                <a href="<?= base_url('admin/hapus/' . $a['iduser']); ?>"
                                    onclick="return confirm('Hapus admin ini?')"
                                    class="btn btn-danger btn-sm">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ========================== -->
<!-- Modal Tambah Admin -->
<!-- ========================== -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= base_url('admin/tambah'); ?>" method="post">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Admin</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Tambah</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- ========================== -->
<!-- Modal Edit Admin (Loop) -->
<!-- ========================== -->
<?php foreach ($admin as $a): ?>
    <div class="modal fade" id="modalEdit-<?= $a['iduser']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?= base_url('admin/update/' . $a['iduser']); ?>" method="post">

                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Edit Admin</h5>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control"
                                value="<?= esc($a['username']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Password (isi jika ingin ganti)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Simpan</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>