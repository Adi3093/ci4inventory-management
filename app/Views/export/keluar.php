<h2><?= $judul ?></h2>

<div class="mb-3">
    <a href="<?= base_url('export/pdf/keluar') ?>" class="btn btn-danger">Export PDF</a>
    <a href="<?= base_url('export/xls/keluar') ?>" class="btn btn-success">Export Excel</a>
    <a onclick="window.print()" class="btn btn-primary">Print</a>
</div>

<table border="1" width="100%" cellspacing="0" cellpadding="8">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Qty</th>
            <th>Penerima</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $d): ?>
            <tr>
                <td><?= $d['tanggal'] ?></td>
                <td><?= $d['namabarang'] ?></td>
                <td><?= $d['qty'] ?></td>
                <td><?= $d['penerima'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>