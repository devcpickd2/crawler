<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Sortasi Bahan Baku yang Tidak Sesuai</h5>
            <div class="card-body">
                <form action="<?= base_url('sortasi_cooking/update/'.$sortasi_cooking->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $sortasi_cooking->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $sortasi_cooking->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="1" <?= ($sortasi_cooking->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($sortasi_cooking->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($sortasi_cooking->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="<?= $sortasi_cooking->nama_bahan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" value="<?= $sortasi_cooking->kode_produksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_bahan_sebelum" class="form-label">Jumlah Bahan Sebelum</label>
                                <input type="text" class="form-control" id="jumlah_bahan_sebelum" name="jumlah_bahan_sebelum" value="<?= $sortasi_cooking->jumlah_bahan_sebelum ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sesuai" class="form-label">Jumlah Bahan Setelah | Sesuai</label>
                                <input type="text" class="form-control" id="sesuai" name="sesuai" value="<?= $sortasi_cooking->sesuai ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tidak_sesuai" class="form-label">Jumlah Bahan Setelah | TDK Sesuai</label>
                                <input type="text" class="form-control" id="tidak_sesuai" name="tidak_sesuai" value="<?= $sortasi_cooking->tidak_sesuai ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tindakan_koreksi" class="form-label">Tindakan Koreksi</label>
                                <input type="text" class="form-control" id="tindakan_koreksi" name="tindakan_koreksi" value="<?= $sortasi_cooking->tindakan_koreksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $sortasi_cooking->catatan ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('sortasi_cooking') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
