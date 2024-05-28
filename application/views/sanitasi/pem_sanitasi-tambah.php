<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pem. Sanitasi /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('pem_sanitasi/tambah') ?>" method="post">
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
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="time" class="form-control" id="pukul" name="pukul" required>
                            </div>
                            <div class="mb-3">
                                <label for="foot_basin" class="form-label">Foot Basin</label>
                                <input type="text" class="form-control" id="foot_basin" name="foot_basin" placeholder="Masukkan Foot Basin" required>
                            </div>
                            <div class="mb-3">
                                <label for="hand_basin" class="form-label">Hand Basin</label>
                                <input type="text" class="form-control" id="hand_basin" name="hand_basin" placeholder="Masukkan hand basin..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan..." required>
                            </div>
                            <div class="mb-3">
                                <label for="tindakan_koreksi" class="form-label">Tindakan Koreksi</label>
                                <input type="text" class="form-control" id="tindakan_koreksi" name="tindakan_koreksi" placeholder="Masukkan tindakan koreksi..." required>
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled selected>Pilih Nama Produksi</option>
                                    <option value="Ardillla">Ardillla</option>
                                    <option value="Khoirunnisa">Khorunnisa</option>
                                    <option value="Suntoro">Suntoro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('pem_sanitasi')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<script>
    var inputDate = document.getElementById('date');
    var inputTime = document.getElementById('pukul');

    var now = new Date();
    var year = now.getFullYear();
    var month = String(now.getMonth() + 1).padStart(2, '0');
    var day = String(now.getDate()).padStart(2, '0');
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');

    inputDate.value = year + '-' + month + '-' + day;
    inputTime.value = hours + ':' + minutes;
</script>