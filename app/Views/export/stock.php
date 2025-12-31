<!DOCTYPE html>
<html>

<head>
    <title><?= $judul ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: white;
        }

        .export-btn {
            margin-right: 6px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body class="p-4">

    <div class="no-print mb-3">
        <a href="<?= base_url('export/stock/excel') ?>" class="btn btn-success export-btn">Excel</a>
        <a href="<?= base_url('export/stock/pdf') ?>" class="btn btn-danger export-btn">PDF</a>
        <button onclick="window.print()" class="btn btn-primary export-btn">Print</button>
    </div>

    <h3 class="text-center mb-4"><?= $judul ?></h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Satuan</th>
                <th>Stock</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($rows as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['namabarang'] ?></td>
                    <td><?= $r['deskripsi'] ?></td>
                    <td><?= $r['satuan'] ?></td>
                    <td><?= $r['stock'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>