<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="card">
        <!-- Button to Open the Modal -->
        <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                Tambah Barang
            </button>
            <a href="<?= base_url('export/stock') ?>" class="btn btn-info">Export Data</a>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline mb-3">

                <!-- Entries Per Page -->
                <label class="mr-2">Entries:</label>
                <select name="limit" class="form-control mr-3" onchange="this.form.submit()">
                    <option value="5" <?= ($limit == 5) ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= ($limit == 10) ? 'selected' : '' ?>>10</option>
                    <option value="15" <?= ($limit == 15) ? 'selected' : '' ?>>15</option>
                    <option value="20" <?= ($limit == 20) ? 'selected' : '' ?>>20</option>
                    <option value="25" <?= ($limit == 25) ? 'selected' : '' ?>>25</option>
                </select>

                <!-- Sort By -->
                <label class="mr-2">Sort By:</label>
                <select name="sortBy" class="form-control mr-3" onchange="this.form.submit()">
                    <option value="">-- None --</option>
                    <option value="nama" <?= ($sortBy == 'nama') ? 'selected' : '' ?>>Nama Barang</option>
                    <option value="stock" <?= ($sortBy == 'stock') ? 'selected' : '' ?>>Stock</option>
                </select>

                <!-- Sort Order -->
                <select name="sortOrder" class="form-control" onchange="this.form.submit()">
                    <option value="ASC" <?= ($sortOrder == 'ASC') ? 'selected' : '' ?>>A-Z</option>
                    <option value="DESC" <?= ($sortOrder == 'DESC') ? 'selected' : '' ?>>Z-A</option>
                </select>

            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($stock as $s): ?>
                        <tr>
                            <td><?= esc($s['namabarang']); ?></td>
                            <td><?= esc($s['deskripsi']); ?></td>
                            <td><?= esc($s['stock']); ?></td>
                            <td><?= esc($s['satuan']); ?></td>
                            <td>

                                <!-- TOMBOL EDIT -->
                                <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEdit-<?= $s['idbarang']; ?>">
                                    Edit
                                </button>

                                <!-- TOMBOL HAPUS -->
                                <a href="<?= base_url('stock/hapus/' . $s['idbarang']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin mau dihapus?')">
                                    Hapus
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            $totalPages = ceil($totalData / $limit);
            ?>

            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link"
                                href="?page=<?= $i ?>&limit=<?= $limit ?>&sortBy=<?= $sortBy ?>&sortOrder=<?= $sortOrder ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>


        </div>
    </div>

</div>

<?php foreach ($stock as $s): ?>
    <div class="modal fade" id="modalEdit-<?= $s['idbarang']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?= base_url('stock/update/' . $s['idbarang']); ?>" method="post">

                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="namabarang"
                                class="form-control"
                                value="<?= esc($s['namabarang']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi"
                                class="form-control"
                                value="<?= esc($s['deskripsi']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock"
                                class="form-control"
                                value="<?= esc($s['stock']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan"
                                class="form-control"
                                value="<?= esc($s['satuan']); ?>" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- tambah barang -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= base_url('stock/tambah'); ?>" method="post">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="namabarang" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->