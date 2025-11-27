                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

                    <div class="card">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                Tambah Barang
                            </button>
                            <a href="export.php" class="btn btn-info">Export Data</a>
                        </div>
                        <div class="card-body">
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