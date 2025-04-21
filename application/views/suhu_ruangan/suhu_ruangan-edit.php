<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Suhu Ruangan /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Suhu Ruang</h5>
            <div class="card-body">
                <form action="<?= base_url('suhu_ruangan/update/'.$suhu_ruangan->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $suhu_ruangan->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $suhu_ruangan->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <input type="text" name="shift" id="shift" value="<?= $suhu_ruangan->shift ?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <input type="text" class="form-control" id="pukul" name="pukul" value="<?= $suhu_ruangan->pukul ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="chill_room" class="form-label">Chill Room</label>
                                <input type="text" class="form-control" id="chill_room" name="chill_room" value="<?= $suhu_ruangan->chill_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor1" class="form-label">Cold Storage 1</label>
                                <input type="text" class="form-control" id="cold_stor1" name="cold_stor1" value="<?= $suhu_ruangan->cold_stor1 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor2" class="form-label">Cold Storage 2</label>
                                <input type="text" class="form-control" id="cold_stor2" name="cold_stor2" value="<?= $suhu_ruangan->cold_stor2 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="anteroom" class="form-label">Anteroom</label>
                                <input type="text" class="form-control" id="anteroom" name="anteroom" value="<?= $suhu_ruangan->anteroom ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sea_T" class="form-label">Seasoning T</label>
                                <input type="text" class="form-control" id="sea_T" name="sea_T" value="<?= $suhu_ruangan->sea_T ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sea_RH" class="form-label">Seasoning RH</label>
                                <input type="text" class="form-control" id="sea_RH" name="sea_RH" value="<?= $suhu_ruangan->sea_RH ?>">
                            </div>
                            <div class="mb-3">
                                <label for="prep_room" class="form-label">Prep. Room</label>
                                <input type="text" class="form-control" id="prep_room" name="prep_room" value="<?= $suhu_ruangan->prep_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cooking_room" class="form-label">Cooking Room</label>
                                <input type="text" class="form-control" id="cooking_room" name="cooking_room" value="<?= $suhu_ruangan->cooking_room ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="filling_room" class="form-label">filling_room</label>
                                <input type="text" class="form-control" id="filling_room" name="filling_room" value="<?= $suhu_ruangan->filling_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="rice_room" class="form-label">Rice Room</label>
                                <input type="text" class="form-control" id="rice_room" name="rice_room" value="<?= $suhu_ruangan->rice_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="noodle_room" class="form-label">Noodle Room</label>
                                <input type="text" class="form-control" id="noodle_room" name="noodle_room" value="<?= $suhu_ruangan->noodle_room ?>">
                            </div>
                            <div class="mb-3">
                                <label for="topping_area" class="form-label">Topping Area</label>
                                <input type="text" class="form-control" id="topping_area" name="topping_area" value="<?= $suhu_ruangan->topping_area ?>">
                            </div>
                            <div class="mb-3">
                                <label for="packing_karton" class="form-label">Packing Karton</label>
                                <input type="text" class="form-control" id="packing_karton" name="packing_karton" value="<?= $suhu_ruangan->packing_karton ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dry_T" class="form-label">Dry Store T</label>
                                <input type="text" class="form-control" id="dry_T" name="dry_T" value="<?= $suhu_ruangan->dry_T ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dry_RH" class="form-label">Dry Store RH</label>
                                <input type="text" class="form-control" id="dry_RH" name="dry_RH" value="<?= $suhu_ruangan->dry_RH ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cold_fg" class="form-label">Cold Stor FG</label>
                                <input type="text" class="form-control" id="cold_fg" name="cold_fg" value="<?= $suhu_ruangan->cold_fg ?>">
                            </div>
                            <div class="mb-3">
                                <label for="anteroom_fg" class="form-label">Anteroom FG</label>
                                <input type="text" class="form-control" id="anteroom_fg" name="anteroom_fg" value="<?= $suhu_ruangan->anteroom_fg ?>">
                            </div>
                             <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $suhu_ruangan->keterangan ?>">
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled <?= is_null($suhu_ruangan->produksi) ? 'selected' : '' ?>>Pilih Nama Produksi</option>
                                    <option value="Ardillla" <?= ($suhu_ruangan->produksi == 'Ardillla') ? 'selected' : '' ?>>Ardillla</option>
                                    <option value="Khoirunnisa" <?= ($suhu_ruangan->produksi == 'Khoirunnisa') ? 'selected' : '' ?>>Khoirunnisa</option>
                                    <option value="Suntoro" <?= ($suhu_ruangan->produksi == 'Suntoro') ? 'selected' : '' ?>>Suntoro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('suhu_ruangan') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
