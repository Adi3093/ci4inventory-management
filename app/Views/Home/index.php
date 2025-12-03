<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="row">

        <!-- Barang Masuk -->
        <div class="col-md-4">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <h5>Barang Masuk</h5>
                    <h3><?= $totalMasuk ?></h3>
                </div>
            </div>
        </div>

        <!-- Stock Keluar -->
        <div class="col-md-4">
            <div class="card shadow border-left-danger">
                <div class="card-body">
                    <h5>Barang Keluar</h5>
                    <h3><?= $totalKeluar ?></h3>
                </div>
            </div>
        </div>

        <!-- Stock Akhir -->
        <div class="col-md-4">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <h5>Stock Akhir</h5>
                    <h3><?= $totalStockAkhir ?></h3>
                </div>
            </div>
        </div>

    </div>

    <br>

    <!-- grafik -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Grafik Barang Masuk & Keluar Per Bulan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?= base_url('home'); ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <label>Pilih Tahun:</label>
                        <select name="tahun" class="form-control" onchange="this.form.submit()">
                            <?php foreach ($tahunList as $t): ?>
                                <option value="<?= $t ?>" <?= ($tahun == $t ? 'selected' : '') ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
            <canvas id="chartBarang" height="100"></canvas>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const bulanMasuk = <?= json_encode($bulanMasuk) ?>;
    const bulanKeluar = <?= json_encode($bulanKeluar) ?>;

    const ctx = document.getElementById('chartBarang').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                    label: 'Barang Masuk',
                    data: bulanMasuk,
                    borderWidth: 3,
                    borderColor: 'blue',
                    fill: false
                },
                {
                    label: 'Barang Keluar',
                    data: bulanKeluar,
                    borderWidth: 3,
                    borderColor: 'red',
                    fill: false
                }
            ]
        }
    });
</script>