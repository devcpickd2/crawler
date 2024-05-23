<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pem. Sanitasi /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Pem. Sanitasi</h5>
            <div class="card-body">
                <form action="<?= base_url('pem_sanitasi/update/'.$pem_sanitasi->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $pem_sanitasi->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $pem_sanitasi->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="1" <?= ($pem_sanitasi->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($pem_sanitasi->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($pem_sanitasi->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="time" class="form-control" id="pukul" name="pukul" value="<?= $pem_sanitasi->pukul ?>">
                            </div>
                            <div class="mb-3">
                                <label for="foot_basin" class="form-label">Foot Basin</label>
                                <input type="text" class="form-control" id="foot_basin" name="foot_basin" value="<?= $pem_sanitasi->foot_basin ?>">
                            </div>
                            <div class="mb-3">
                                <label for="hand_basin" class="form-label">Hand Basin</label>
                                <input type="text" class="form-control" id="hand_basin" name="hand_basin" value="<?= $pem_sanitasi->hand_basin ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $pem_sanitasi->keterangan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tindakan_koreksi" class="form-label">tindakan_koreksi</label>
                                <input type="text" class="form-control" id="tindakan_koreksi" name="tindakan_koreksi" value="<?= $pem_sanitasi->tindakan_koreksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled <?= is_null($pem_sanitasi->produksi) ? 'selected' : '' ?>>Pilih Nama Produksi</option>
                                    <option value="Ardillla" <?= ($pem_sanitasi->produksi == 'Ardillla') ? 'selected' : '' ?>>Ardillla</option>
                                    <option value="Khoirunnisa" <?= ($pem_sanitasi->produksi == 'Khoirunnisa') ? 'selected' : '' ?>>Khoirunnisa</option>
                                    <option value="Suntoro" <?= ($pem_sanitasi->produksi == 'Suntoro') ? 'selected' : '' ?>>Suntoro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $pem_sanitasi->catatan ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('pem_sanitasi') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
