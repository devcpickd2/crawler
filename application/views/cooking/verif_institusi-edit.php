<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Verifikasi Premix</h5>
            <div class="card-body">
                <form action="<?= base_url('verif_institusi/update/'.$verif_institusi->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $verif_institusi->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $verif_institusi->date ?>">
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift">
                                    <option value="1" <?= ($verif_institusi->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($verif_institusi->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($verif_institusi->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_produk" class="form-label">Jenis Produk</label>
                                <input type="text" class="form-control" id="jenis_produk" name="jenis_produk" value="<?= $verif_institusi->jenis_produk ?>">
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" value="<?= $verif_institusi->kode_produksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="waktu_proses" class="form-label">Waktu Proses</label>
                                <input type="time" class="form-control" id="waktu_proses" name="waktu_proses" value="<?= $verif_institusi->waktu_proses ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $verif_institusi->lokasi ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sebelum" class="form-label">Suhu Produk |Sebelum</label>
                                <input type="text" class="form-control" id="sebelum" name="sebelum" value="<?= $verif_institusi->sebelum ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sesudah" class="form-label">Suhu Produk |Sesudah</label>
                                <input type="text" class="form-control" id="sesudah" name="sesudah" value="<?= $verif_institusi->sesudah ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sensori" class="form-label">Sensori</label>
                                <input type="text" class="form-control" id="sensori" name="sensori" value="<?= $verif_institusi->sensori ?>">
                            </div>
                            <div class="mb-3">
                                <label for="qc" class="form-label">QC</label>
                                <input type="text" class="form-control" id="qc" name="qc" value="<?= $verif_institusi->qc ?>">
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <input type="text" class="form-control" id="produksi" name="produksi" value="<?= $verif_institusi->produksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $verif_institusi->catatan ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('verif_institusi') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
