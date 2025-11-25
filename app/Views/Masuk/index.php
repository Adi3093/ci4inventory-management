                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        Tambah Barang
                    </button>

                    <a href="export.php" class="btn btn-info">Export Data</a>
                </div>
                <div class="card-body">
                    <!-- filter -->
                    <form method="GET" action="<?= base_url('masuk'); ?>" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="bulan" class="form-control">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1" <?= ($bulan == '1') ? 'selected' : '' ?>>Januari</option>
                                    <option value="2" <?= ($bulan == '2') ? 'selected' : '' ?>>Februari</option>
                                    <option value="3" <?= ($bulan == '3') ? 'selected' : '' ?>>Maret</option>
                                    <option value="4" <?= ($bulan == '4') ? 'selected' : '' ?>>April</option>
                                    <option value="5" <?= ($bulan == '5') ? 'selected' : '' ?>>Mei</option>
                                    <option value="6" <?= ($bulan == '6') ? 'selected' : '' ?>>Juni</option>
                                    <option value="7" <?= ($bulan == '7') ? 'selected' : '' ?>>Juli</option>
                                    <option value="8" <?= ($bulan == '8') ? 'selected' : '' ?>>Agustus</option>
                                    <option value="9" <?= ($bulan == '9') ? 'selected' : '' ?>>September</option>
                                    <option value="10" <?= ($bulan == '10') ? 'selected' : '' ?>>Oktober</option>
                                    <option value="11" <?= ($bulan == '11') ? 'selected' : '' ?>>November</option>
                                    <option value="12" <?= ($bulan == '12') ? 'selected' : '' ?>>Desember</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex" style="margin-left: -20px;">
                                <button class="btn btn-primary" style="margin-right: 4px;">Filter</button>
                                <a href="<?= base_url('masuk'); ?>" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                    <!-- table barang masuk -->
                    <table class="table tabled-striped">
                        <thead>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keteragan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($masuk as $row) : ?>
                                <tr>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['namabarang']; ?></td>
                                    <td><?= $row['qty']; ?></td>
                                    <td><?= $row['keterangan']; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            data-toggle="modal"
                                            data-target="#editModal<?= $row['idmasuk']; ?>">
                                            Edit
                                        </button>

                                        <a href="<?= base_url('masuk/hapus/' . $row['idmasuk']); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php foreach ($masuk as $row) : ?>
                        <div class="modal fade" id="editModal<?= $row['idmasuk']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="<?= base_url('masuk/update/' . $row['idmasuk']); ?>" method="post">

                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title">Edit Barang Masuk</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control" value="<?= $row['keterangan']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Jumlah (Qty)</label>
                                                <input type="number" name="qty" class="form-control" value="<?= $row['qty']; ?>">
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
                    <!-- Modal Tambah Barang -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahModalLabel">Tambah Barang Masuk</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <form action="<?= base_url('masuk/tambah'); ?>" method="post">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="idbarang" class="form-control" required>
                                                <option value="">-- Pilih Barang --</option>
                                                <?php foreach ($stockList as $item): ?>
                                                    <option value="<?= $item['idbarang']; ?>">
                                                        <?= $item['namabarang']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="qty" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" required>
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


                </div>
                </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->