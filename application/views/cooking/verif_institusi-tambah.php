<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('verif_institusi/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="" disabled selected>Pilih Shift</option>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_produk" class="form-label">Jenis Produk</label>
                                <input type="text" class="form-control" id="jenis_produk" placeholder="Masukkan jenis produk" name="jenis_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" placeholder="Masukkan kode produksi" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_proses" class="form-label">Waktu Proses</label>
                                <input type="time" class="form-control" id="waktu_proses" name="waktu_proses" placeholder="Masukkan waktu proses" required>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sebelum" class="form-label">Suhu Produk |Sebelum</label>
                                <input type="text" class="form-control" id="sebelum" name="sebelum" placeholder="Masukkan produk sebelum..." required>
                            </div>
                            <div class="mb-3">
                                <label for="sesudah" class="form-label">Suhu Produk |Sesudah</label>
                                <input type="text" class="form-control" id="sesudah" name="sesudah" placeholder="Masukkan produk sesudah..." required>
                            </div>
                            <div class="mb-3">
                                <label for="sensori" class="form-label">Sensori</label>
                                <input type="text" class="form-control" id="sensori" name="sensori" placeholder="Masukkan produk sensori..." required>
                            </div>
                            <div class="mb-3">
                                <label for="qc" class="form-label">QC</label>
                                <input type="text" class="form-control" id="qc" name="qc" placeholder="Masukkan qc..." required>
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <input type="text" class="form-control" id="produksi" name="produksi" placeholder="Masukkan produksi..." required>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('verif_institusi')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
