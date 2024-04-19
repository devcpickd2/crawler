<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Peneraan Termometer</h5>
            <div class="card-body">
                <form action="<?= base_url('termo/update/'.$termo->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $termo->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $termo->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="1" <?= ($termo->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($termo->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($termo->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_termo" class="form-label">Kode Termometer/Area</label>
                                <input type="text" class="form-control" id="kode_termo" name="kode_termo" value="<?= $termo->kode_termo ?>">
                            </div>
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="time" class="form-control" id="pukul" name="pukul" value="<?= $termo->pukul ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hasil_tera" class="form-label">Hasil Tera</label>
                                <input type="text" class="form-control" id="hasil_tera" name="hasil_tera" value="<?= $termo->hasil_tera ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <input type="text" class="form-control" id="tindakan" name="tindakan" value="<?= $termo->tindakan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $termo->catatan ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('termo') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
