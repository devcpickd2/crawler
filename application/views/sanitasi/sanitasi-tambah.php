<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sanitasi /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('sanitasi/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input type="time" class="form-control" id="waktu" name="waktu" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Area</label>
                        <select class="form-select" id="area" name="area" required>
                            <option value="" disabled selected>Pilih Area Produksi</option>
                            <option value="CHILLROOM RM">CHILLROOM RM</option>
                            <option value="COLD STORAGE 1 RM">COLD STORAGE 1 RM</option>
                            <option value="COLD STORAGE 2 RM">COLD STORAGE 2 RM</option>
                            <option value="SEASONING">SEASONING</option>
                            <option value="PREPARTION ROOM">PREPARTION ROOM</option>
                            <option value="COOKING">COOKING</option>
                            <option value="FILLING ROOM">FILLING ROOM</option>
                            <option value="RICE COOKING & NOODLE BOILING ROOM">RICE COOKING & NOODLE BOILING ROOM</option>
                            <option value="NOODLE MAKING ROOM">NOODLE MAKING ROOM</option>
                            <option value="TOPPING AREA">TOPPING AREA</option>
                            <option value="PACKING">PACKING</option>
                            <option value="IQF">IQF</option>
                            <option value="COLD STORAGE FG">COLD STORAGE FG</option>
                            <option value="DRY STORE">DRY STORE</option>
                        </select>
                    </div>
                    <div class="mb-3" id="lokasi">
                        <!-- lokasi -->
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('sanitasi') ?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    const areas = {
        "CHILLROOM RM": ["Lantai", "Dinding", "Kurtain", "Pintu"],
        "COLD STORAGE 1 RM": ["Langit-langit", "AC", "Rak", "Lampu"],
        // Tambahkan lokasi untuk setiap area lainnya di sini
    };

    const areaSelect = document.getElementById("area");
    const lokasiDiv = document.getElementById("lokasi");

    areaSelect.addEventListener("change", function () {
        const selectedArea = areaSelect.value;
        const lokasiFields = areas[selectedArea];

        lokasiDiv.innerHTML = "";

        lokasiFields.forEach(field => {
            lokasiDiv.innerHTML += `
                <div class="row mb-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>${field}</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="kondisi[]" placeholder="Kondisi ${field}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="masalah[]" placeholder="Masalah ${field}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="tindakan_koreksi[]" placeholder="Tindakan Koreksi ${field}">
                        </div>
                    </div>
                </div>
            `;
        });
    });
</script> -->
<script>
    const areas = {
        "CHILLROOM RM": ["Lantai", "Dinding", "Kurtain", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "LampudanCover"],
        "COLD STORAGE 1 RM": ["Lantai", "Dinding", "Kurtain", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "LampudanCover"],
        "COLD STORAGE 2 RM":["Lantai", "Dinding", "Kurtain", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "LampudanCover"],
        "SEASONING":["Lantai", "Dinding", "Kurtain", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "LampudanCover", "PemisahaanAlergendannon Allergen", "TerdapatTagging"],
        "PREPARTION ROOM":["Lantai", "Dinding", "Pintu","Langit-langit", "SaluranAirBuangan", "LampudanCover", "VegetableWashingMachine", "Slicer", "PeelingMachine", "VacuumTumbler"],
        "COOKING":["Lantai", "Dinding", "Pintu","Langit-langit", "SaluranAirBuangan", "LampudanCover", "AlcoCookingMixer", "TitingKettle","Exhaust", "SirFryer(PROVISUR)", "Steamer", "BowlCutter"],
        "FILLING ROOM":["Lantai", "Dinding", "Pintu","Langit-langit", "AC", "SaluranAirBuangan", "LampudanCover", "FillingMachine", "VacummCoolingMachine","Sealer1", "Sealer2", "FillerManual1", "FillerManual2"],
        "RICE COOKING & NOODLE BOILING ROOM":["Lantai", "Dinding", "Pintu","Langit-langit", "SaluranAirBuangan", "LampudanCover", "RiceWasher", "RiceFillingMachine","RiceCooker", "LineConveyor", "Boiling, Washing, CoolingShockMachine"],
        "NOODLE MAKING ROOM":["Lantai", "Dinding", "Pintu","Langit-langit", "SaluranAirBuangan", "LampudanCover", "Vacuum Mixer", "Aging Machine","Roller Machine", "Cutting & Sitting"],
        "TOPPING AREA":["Lantai", "Dinding", "Pintu","Langit-langit", "AC", "SaluranAirBuangan", "LampudanCover"],
        "PACKING":["Lantai", "Dinding", "Pintu","Langit-langit", "AC", "SaluranAirBuangan", "LampudanCover", "PackingMachine", "TraySealer","MetalDetector&Rejector", "Xraydetector&Rejector", "LineConveyor", "InkjetPrinterPlastik"],
        "IQF":["DindingLuar ", "DindingDalam", "RuangdalamIqf","ConveyorIQF"],
        "COLD STORAGE FG":["Lantai", "Dinding", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "LampudanCover"],
        "DRY STORE":["Lantai", "Dinding", "Kurtan", "Pintu","Langit-langit", "AC", "RakPenampungProduk", "TerdapatTagging", "LampudanCover"],
    };

    const areaSelect = document.getElementById("area");
    const lokasiDiv = document.getElementById("lokasi");

    areaSelect.addEventListener("change", function () {
        const selectedArea = areaSelect.value;
        const lokasiFields = areas[selectedArea];

        lokasiDiv.innerHTML = "";

        lokasiFields.forEach(field => {
            const kondisiName = `kondisi[${field}]`;
            const masalahName = `masalah[${field}]`;
            const tindakanKoreksiName = `tindakan_koreksi[${field}]`;

            lokasiDiv.innerHTML += `
            <div class="row mb-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="${field}" class="form-label">${field}</label>
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type ="text" class="form-control" id="${field}" name="${kondisiName}"placeholder="Masukkan kondisi ${field}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type ="text" class="form-control" id="${field}" name="${masalahName}"placeholder="Masukkan masalah ${field}">
                    </div>    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type ="text" class="form-control" id="${field}" name="${tindakanKoreksiName}"placeholder="Masukkan tindakan koreksi ${field}">
                    </div>    
                </div>
            </div>    
            `;
        });
    });

    var inputDate = document.getElementById('date');
    var inputTime = document.getElementById('waktu');

    var now = new Date();
    var year = now.getFullYear();
    var month = String(now.getMonth() + 1).padStart(2, '0');
    var day = String(now.getDate()).padStart(2, '0');
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');

    inputDate.value = year + '-' + month + '-' + day;
    inputTime.value = hours + ':' + minutes;
</script>


<style>
    #lokasi .row {
        margin-bottom: 10px;
    }
</style>
