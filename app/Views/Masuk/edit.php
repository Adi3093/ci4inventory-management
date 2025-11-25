<form action="<?= base_url('masuk/update/' . $masuk['idmasuk']); ?>" method="post">

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="idbarang" class="form-control"
            value="<?= $masuk['idbarang']; ?>">
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="datetime-local" name="tanggal" class="form-control"
            value="<?= date('Y-m-d\TH:i', strtotime($masuk['tanggal'])); ?>">
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="qty" class="form-control"
            value="<?= $masuk['qty']; ?>">
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control"
            value="<?= $masuk['keterangan']; ?>">
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('masuk'); ?>" class="btn btn-secondary">Kembali</a>

</form>