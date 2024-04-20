<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Peneraan Timbangan</h5>
            <div class="card-body">
                <form action="<?= base_url('timbangan/update/'.$timbangan->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $timbangan->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $timbangan->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="1" <?= ($timbangan->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($timbangan->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($timbangan->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_timbangan" class="form-label">Kode Timbangan/Area</label>
                                <input type="text" class="form-control" id="kode_timbangan" name="kode_timbangan" value="<?= $timbangan->kode_timbangan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="time" class="form-control" id="pukul" name="pukul" value="<?= $timbangan->pukul ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hasil_tera" class="form-label">Hasil Tera</label>
                                <input type="text" class="form-control" id="hasil_tera" name="hasil_tera" value="<?= $timbangan->hasil_tera ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <input type="text" class="form-control" id="tindakan" name="tindakan" value="<?= $timbangan->tindakan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $timbangan->catatan ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('timbangan') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
