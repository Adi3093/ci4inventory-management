                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->