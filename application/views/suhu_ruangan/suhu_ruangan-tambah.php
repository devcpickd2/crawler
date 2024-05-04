<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Suhu /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('suhu_ruangan/tambah') ?>" method="post">
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
                            <!-- pukul -->
                            <!-- <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                            </div> -->
                            <div class="mb-3">
                                <label for="chill_room" class="form-label">Chill Room</label>
                                <input type="text" class="form-control" id="chill_room" name="chill_room" required>
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor1" class="form-label">Cold Storage 1</label>
                                <input type="text" class="form-control" id="cold_stor1" name="cold_stor1" placeholder="Masukkan suhu cold storage 1" required>
                            </div>
                            <div class="mb-3">
                                <label for="cold_stor2" class="form-label">Cold Storage 2</label>
                                <input type="text" class="form-control" id="cold_stor2" name="cold_stor2" placeholder="Masukkan suhu cold storage 2" required>
                            </div>
                            <div class="mb-3">
                                <label for="anteroom" class="form-label">Anteroom</label>
                                <input type="text" class="form-control" id="anteroom" name="anteroom" placeholder="Masukkan suhu anteroom" required>
                            </div>
                            <div class="mb-3">
                                <label for="sea_T" class="form-label">Seasoning T</label>
                                <input type="text" class="form-control" id="sea_T" name="sea_T" placeholder="Masukkan suhu sea_T" required>
                            </div>
                            <div class="mb-3">
                                <label for="sea_RH" class="form-label">Seasoning RH</label>
                                <input type="text" class="form-control" id="sea_RH" name="sea_RH" placeholder="Masukkan suhu sea_RH" required>
                            </div>
                            <div class="mb-3">
                                <label for="prep_room" class="form-label">Prep. Room</label>
                                <input type="text" class="form-control" id="prep_room" name="prep_room" placeholder="Masukkan suhu prep_room" required>
                            </div>
                            <div class="mb-3">
                                <label for="cooking_room" class="form-label">Cooking Room</label>
                                <input type="text" class="form-control" id="cooking_room" name="cooking_room" placeholder="Masukkan suhu cooking_room" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="filling_room" class="form-label">filling_room</label>
                                <input type="text" class="form-control" id="filling_room" name="filling_room" placeholder="Masukkan hasil filling_room..." required>
                            </div>
                            <div class="mb-3">
                                <label for="rice_room" class="form-label">Rice Room</label>
                                <input type="text" class="form-control" id="rice_room" name="rice_room" placeholder="Masukkan rice room..." required>
                            </div>
                            <div class="mb-3">
                                <label for="noodle_room" class="form-label">Noodle Room</label>
                                <input type="text" class="form-control" id="noodle_room" name="noodle_room" placeholder="Masukkan Noodle room..." required>
                            </div>
                            <div class="mb-3">
                                <label for="topping_area" class="form-label">Topping Area</label>
                                <input type="text" class="form-control" id="topping_area" name="topping_area" placeholder="Masukkan Topping area..." required>
                            </div>
                            <div class="mb-3">
                                <label for="packing_karton" class="form-label">Packing Karton</label>
                                <input type="text" class="form-control" id="packing_karton" name="packing_karton" placeholder="Masukkan Packing Karton..." required>
                            </div>
                            <div class="mb-3">
                                <label for="dry_T" class="form-label">Dry Store T</label>
                                <input type="text" class="form-control" id="dry_T" name="dry_T" placeholder="Masukkan Dry Store T..." required>
                            </div>
                            <div class="mb-3">
                                <label for="dry_RH" class="form-label">Dry Store RH</label>
                                <input type="text" class="form-control" id="dry_RH" name="dry_RH" placeholder="Masukkan Dry Store RH..." required>
                            </div>
                            <div class="mb-3">
                                <label for="cold_fg" class="form-label">Cold Stor FG</label>
                                <input type="text" class="form-control" id="cold_fg" name="cold_fg" placeholder="Masukkan Cold Stor FG..." required>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('suhu_ruangan')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
