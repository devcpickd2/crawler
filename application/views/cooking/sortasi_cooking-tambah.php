<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('sortasi_cooking/tambah') ?>" method="post">
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
                                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" placeholder="Masukkan Nama Bahan" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" placeholder="Masukkan kode produksi" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_bahan_sebelum" class="form-label">Jumlah Bahan Sebelum Sortasi</label>
                                <input type="text" class="form-control" id="jumlah_bahan_sebelum" name="jumlah_bahan_sebelum" placeholder="Masukkan jumlah_bahan_sebelum..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sesuai" class="form-label">Jumlah Bahan Setelah | Sesuai</label>
                                <input type="text" class="form-control" id="sesuai" name="sesuai" placeholder="Masukkan sesuai..." required>
                            </div>
                            <div class="mb-3">
                                <label for="tidak_sesuai" class="form-label">Jumlah Bahan Setelah | TDK Sesuai</label>
                                <input type="text" class="form-control" id="tidak_sesuai" name="tidak_sesuai" placeholder="Masukkan tidak_sesuai..." required>
                            </div>
                            <div class="mb-3">
                                <label for="tindakan_koreksi" class="form-label">Tindakan Koreksi</label>
                                <input type="text" class="form-control" id="tindakan_koreksi" name="tindakan_koreksi" placeholder="Masukkan tindakan koreksi..." required>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('sortasi_cooking')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
