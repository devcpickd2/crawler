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
                            <!-- <div class="mb-3" id="area"> -->
                                <!-- AREA -->
                            <!-- </div> -->
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" onchange="updateTimeOptions()" required>
                                <!-- <select class="form-select" id="shift" name="shift" onchange="" required> -->
                                    <option value="" disabled selected>Pilih Shift</option>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                            <!-- pukul -->
                            <div class="mb-3">
                                <label for="pukul" class="form-label">Pukul</label>
                                <select class="form-select" id="pukul" name="pukul" required>
                                    <option value="" disabled selected>Pilih waktu</option>
                                    <?php for ($i = 0; $i <= 23; $i++) : ?>
                                        <option value="<?= "{$i}:00" ?>"><?= "{$i}:00" ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="chill_room" class="form-label">Chill Room</label>
                                <input type="text" class="form-control" id="chill_room" name="chill_room" placeholder="Masukkan suhu chill room" required>
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
                                <label for="cold_fg" class="form-label">Cold Stor FG</label>
                                <input type="text" class="form-control" id="cold_fg" name="cold_fg" placeholder="Masukkan Suhu Cold Storage..." required>
                            </div>
                             <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan...">
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled selected>Pilih Nama Produksi</option>
                                    <option value="">ABA</option>
                                    <option value="">ABB</option>
                                    <option value="">ABC</option>
                                </select>
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
<script>
    function updateTimeOptions() {
        const shift = document.getElementById("shift").value;
        const pukulSelect = document.getElementById("pukul");
        pukulSelect.innerHTML = "";

        if (shift === "1") {
            addOption(pukulSelect, "7:00", "7:00");
            addOption(pukulSelect, "8:00", "8:00");
            addOption(pukulSelect, "9:00", "9:00");
            addOption(pukulSelect, "10:00", "10:00");
            addOption(pukulSelect, "11:00", "11:00");
            addOption(pukulSelect, "12:00", "12:00");
            addOption(pukulSelect, "13:00", "13:00");
            addOption(pukulSelect, "14:00", "14:00");
        } else if (shift === "2") {
            addOption(pukulSelect, "15:00", "15:00");
            addOption(pukulSelect, "16:00", "16:00");
            addOption(pukulSelect, "17:00", "17:00");
            addOption(pukulSelect, "18:00", "18:00");
            addOption(pukulSelect, "19:00", "19:00");
            addOption(pukulSelect, "20:00", "20:00");
            addOption(pukulSelect, "21:00", "21:00");
            addOption(pukulSelect, "22:00", "22:00");
        } else if (shift === "3") {
            addOption(pukulSelect, "23:00", "23:00");
            addOption(pukulSelect, "0:00", "0:00");
            addOption(pukulSelect, "1:00", "1:00");
            addOption(pukulSelect, "2:00", "2:00");
            addOption(pukulSelect, "3:00", "3:00");
            addOption(pukulSelect, "4:00", "4:00");
            addOption(pukulSelect, "5:00", "5:00");
            addOption(pukulSelect, "6:00", "6:00");
        }
    }

    function addOption(select, text, value) {
        const option = document.createElement("option");
        option.text = text;
        option.value = value;
        select.add(option);
    }

</script>