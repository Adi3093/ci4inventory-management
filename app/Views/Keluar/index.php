<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="card">

        <!-- CARD HEADER -->
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                Tambah Barang
            </button>
            <a href="export.php" class="btn btn-info">Export Data</a>
        </div>

        <!-- CARD BODY -->
        <div class="card-body">
            <form method="GET" action="<?= base_url('keluar'); ?>" class="mb-3">
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
                        <a href="<?= base_url('keluar'); ?>" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <form class="form-inline mb-3" method="GET">

                <label class="mr-2">Entries:</label>
                <select name="limit" class="form-control mr-3" onchange="this.form.submit()">
                    <?php foreach ([5, 10, 15, 20, 25] as $l): ?>
                        <option value="<?= $l ?>" <?= ($limit == $l ? 'selected' : '') ?>><?= $l ?></option>
                    <?php endforeach; ?>
                </select>

                <label class="mr-2">Sort By:</label>
                <select name="sortBy" class="form-control mr-3" onchange="this.form.submit()">
                    <option value="">-- None --</option>
                    <option value="nama" <?= ($sortBy == 'nama' ? 'selected' : '') ?>>Nama</option>
                    <option value="qty" <?= ($sortBy == 'qty' ? 'selected' : '') ?>>Jumlah</option>
                    <option value="tanggal" <?= ($sortBy == 'tanggal' ? 'selected' : '') ?>>Tanggal</option>
                </select>

                <select name="sortOrder" class="form-control" onchange="this.form.submit()">
                    <option value="ASC" <?= ($sortOrder == 'ASC' ? 'selected' : '') ?>>A-Z</option>
                    <option value="DESC" <?= ($sortOrder == 'DESC' ? 'selected' : '') ?>>Z-A</option>
                </select>

            </form>

            <!-- TABEL BARANG KELUAR -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Penerima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($keluar as $k): ?>
                        <tr>
                            <td><?= $k['tanggal']; ?></td>
                            <td><?= $k['namabarang']; ?></td>
                            <td><?= $k['qty']; ?></td>
                            <td><?= $k['penerima']; ?></td>

                            <td>
                                <!-- EDIT BUTTON -->
                                <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEdit-<?= $k['idkeluar']; ?>">
                                    Edit
                                </button>

                                <!-- DELETE BUTTON -->
                                <a href="<?= base_url('keluar/hapus/' . $k['idkeluar']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">
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
                        <li class="page-item <?= ($i == $page ? 'active' : '') ?>">
                            <a class="page-link"
                                href="?page=<?= $i ?>&limit=<?= $limit ?>&sortBy=<?= $sortBy ?>&sortOrder=<?= $sortOrder ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

            <!-- MODAL TAMBAH -->
            <div class="modal fade" id="modalTambah" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form action="<?= base_url('keluar/tambah'); ?>" method="post">

                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Tambah Barang Keluar</h5>
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>

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
                                    <label>Penerima</label>
                                    <input type="text" name="penerima" class="form-control" required>
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

            <!-- MODALS EDIT PER DATA -->
            <?php foreach ($keluar as $k): ?>
                <div class="modal fade" id="modalEdit-<?= $k['idkeluar']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="<?= base_url('keluar/update/' . $k['idkeluar']); ?>" method="post">

                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title">Edit Barang Keluar</h5>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="qty" class="form-control" value="<?= $k['qty']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Penerima</label>
                                        <input type="text" name="penerima" class="form-control" value="<?= $k['penerima']; ?>" required>
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

        </div> <!-- card-body -->
    </div> <!-- card -->
</div>

</div> <!-- container-fluid -->