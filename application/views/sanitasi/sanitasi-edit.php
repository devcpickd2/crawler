<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sanitasi /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Sanitasi Kebersihaan Ruangan</h5>
            <div class="card-body">
                <form action="<?= base_url('sanitasi/update/'.$sanitasi->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $sanitasi->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $sanitasi->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <input type="text" name="shift" id="shift" value="<?= $sanitasi->shift ?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="text" class="form-control" id="pukul" name="pukul" value="<?= $sanitasi->pukul ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="chill_room" class="form-label">Chill Room</label>
                                <input type="text" class="form-control" id="chill_room" name="chill_room" value="<?= $sanitasi->chill_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor1" class="form-label">Cold Storage 1</label>
                                <input type="text" class="form-control" id="cold_stor1" name="cold_stor1" value="<?= $sanitasi->cold_stor1 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor2" class="form-label">Cold Storage 2</label>
                                <input type="text" class="form-control" id="cold_stor2" name="cold_stor2" value="<?= $sanitasi->cold_stor2 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="anteroom" class="form-label">Anteroom</label>
                                <input type="text" class="form-control" id="anteroom" name="anteroom" value="<?= $sanitasi->anteroom ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sea_T" class="form-label">Seasoning T</label>
                                <input type="text" class="form-control" id="sea_T" name="sea_T" value="<?= $sanitasi->sea_T ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sea_RH" class="form-label">Seasoning RH</label>
                                <input type="text" class="form-control" id="sea_RH" name="sea_RH" value="<?= $sanitasi->sea_RH ?>">
                            </div>
                            <div class="mb-3">
                                <label for="prep_room" class="form-label">Prep. Room</label>
                                <input type="text" class="form-control" id="prep_room" name="prep_room" value="<?= $sanitasi->prep_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cooking_room" class="form-label">Cooking Room</label>
                                <input type="text" class="form-control" id="cooking_room" name="cooking_room" value="<?= $sanitasi->cooking_room ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="filling_room" class="form-label">filling_room</label>
                                <input type="text" class="form-control" id="filling_room" name="filling_room" value="<?= $sanitasi->filling_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="rice_room" class="form-label">Rice Room</label>
                                <input type="text" class="form-control" id="rice_room" name="rice_room" value="<?= $sanitasi->rice_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="noodle_room" class="form-label">Noodle Room</label>
                                <input type="text" class="form-control" id="noodle_room" name="noodle_room" value="<?= $sanitasi->noodle_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="topping_area" class="form-label">Topping Area</label>
                                <input type="text" class="form-control" id="topping_area" name="topping_area" value="<?= $sanitasi->topping_area ?>">
                            </div>
                            <div class="mb-3">
                                <label for="packing_karton" class="form-label">Packing Karton</label>
                                <input type="text" class="form-control" id="packing_karton" name="packing_karton" value="<?= $sanitasi->packing_karton ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dry_T" class="form-label">Dry Store T</label>
                                <input type="text" class="form-control" id="dry_T" name="dry_T" value="<?= $sanitasi->dry_T ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dry_RH" class="form-label">Dry Store RH</label>
                                <input type="text" class="form-control" id="dry_RH" name="dry_RH" value="<?= $sanitasi->dry_RH ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_fg" class="form-label">Cold Stor FG</label>
                                <input type="text" class="form-control" id="cold_fg" name="cold_fg" value="<?= $sanitasi->cold_fg ?>">
                            </div>
                             <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $sanitasi->keterangan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled <?= is_null($sanitasi->produksi) ? 'selected' : '' ?>>Pilih Nama Produksi</option>
                                    <option value="Ardillla" <?= ($sanitasi->produksi == 'Ardillla') ? 'selected' : '' ?>>Ardillla</option>
                                    <option value="Khoirunnisa" <?= ($sanitasi->produksi == 'Khoirunnisa') ? 'selected' : '' ?>>Khoirunnisa</option>
                                    <option value="Suntoro" <?= ($sanitasi->produksi == 'Suntoro') ? 'selected' : '' ?>>Suntoro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('sanitasi') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
