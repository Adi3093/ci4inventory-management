<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="card">

        <!-- Card Header -->
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                Tambah Barang
            </button>
            <a href="export.php" class="btn btn-info">Export Data</a>
        </div>




        <!-- Card Body -->
        <div class="card-body">
            <form method="GET" action="<?= base_url('masuk'); ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <select name="bulan" class="form-control">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="1" <?= ($bulan == 1) ? 'selected' : '' ?>>Januari</option>
                            <option value="2" <?= ($bulan == 2) ? 'selected' : '' ?>>Februari</option>
                            <option value="3" <?= ($bulan == 3) ? 'selected' : '' ?>>Maret</option>
                            <option value="4" <?= ($bulan == 4) ? 'selected' : '' ?>>April</option>
                            <option value="5" <?= ($bulan == 5) ? 'selected' : '' ?>>Mei</option>
                            <option value="6" <?= ($bulan == 6) ? 'selected' : '' ?>>Juni</option>
                            <option value="7" <?= ($bulan == 7) ? 'selected' : '' ?>>Juli</option>
                            <option value="8" <?= ($bulan == 8) ? 'selected' : '' ?>>Agustus</option>
                            <option value="9" <?= ($bulan == 9) ? 'selected' : '' ?>>September</option>
                            <option value="10" <?= ($bulan == 10) ? 'selected' : '' ?>>Oktober</option>
                            <option value="11" <?= ($bulan == 11) ? 'selected' : '' ?>>November</option>
                            <option value="12" <?= ($bulan == 12) ? 'selected' : '' ?>>Desember</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex">
                        <button class="btn btn-primary mr-2">Filter</button>
                        <a href="<?= base_url('masuk'); ?>" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <form class="form-inline mb-3" method="GET">

                <!-- Entries -->
                <label class="mr-2">Entries:</label>
                <select name="limit" class="form-control mr-3" onchange="this.form.submit()">
                    <?php foreach ([5, 10, 15, 20, 25] as $l): ?>
                        <option value="<?= $l ?>" <?= ($limit == $l ? 'selected' : '') ?>><?= $l ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Sort By -->
                <label class="mr-2">Sort By:</label>
                <select name="sortBy" class="form-control mr-3" onchange="this.form.submit()">
                    <option value="">--None--</option>
                    <option value="tanggal" <?= ($sortBy == 'tanggal') ? 'selected' : '' ?>>Tanggal</option>
                    <option value="nama" <?= ($sortBy == 'nama') ? 'selected' : '' ?>>Nama Barang</option>
                    <option value="qty" <?= ($sortBy == 'qty') ? 'selected' : '' ?>>Jumlah</option>
                </select>

                <!-- Sort Order -->
                <select name="sortOrder" class="form-control" onchange="this.form.submit()">
                    <option value="ASC" <?= ($sortOrder == 'ASC' ? 'selected' : '') ?>>A-Z</option>
                    <option value="DESC" <?= ($sortOrder == 'DESC' ? 'selected' : '') ?>>Z-A</option>
                </select>

            </form>
            <!-- table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($masuk as $row): ?>
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

            <?php
            $totalPages = ceil($totalData / $limit);
            ?>

            <!-- Pagination -->
            <?php $totalPages = ceil($totalData / $limit); ?>
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link"
                                href="?page=<?= $i ?>&limit=<?= $limit ?>&sortBy=<?= $sortBy ?>&sortOrder=<?= $sortOrder ?>&bulan=<?= $bulan ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>


            <!-- edit -->
            <?php foreach ($masuk as $row): ?>
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
                                        <input type="text" name="keterangan"
                                            class="form-control"
                                            value="<?= $row['keterangan']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah (Qty)</label>
                                        <input type="number" name="qty"
                                            class="form-control"
                                            value="<?= $row['qty']; ?>">
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
            <div class="modal fade" id="tambahModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Barang Masuk</h5>
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

        </div><!-- END card-body -->
    </div><!-- END card -->
</div>

</div>
<!-- End Page Content -->