<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Tambah</h4>
        <div class="card">
            <h5 class="card-header">Tambah</h5>
            <div class="card-body">
                <form action="<?= base_url('pem_masak_steamer/tambah') ?>" method="post">
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
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" placeholder="Masukkan kode produksi" required>
                            </div>
                            <div class="mb-3">
                                <label for="t_raw" class="form-label">T Raw Material (C)</label>
                                <input type="text" class="form-control" id="t_raw" name="t_raw" placeholder="Masukkan T Raw Material..." required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_tray" class="form-label">Jumlah Tray</label>
                                <input type="text" class="form-control" id="jumlah_tray" name="jumlah_tray" placeholder="Masukkan Jumlah Tray..." required>
                            </div>
                            <h5 class="card-header">STEAMING</h5>
                            <div class="mb-3">
                                <label for="t_ruang" class="form-label">T Ruang</label>
                                <input type="text" class="form-control" id="t_ruang" name="t_ruang" placeholder="Masukkan T Ruang..." required>
                            </div>
                            <div class="mb-3">
                                <label for="t_produk" class="form-label">T Produk</label>
                                <input type="text" class="form-control" id="t_produk" name="t_produk" placeholder="Masukkan T Produk..." required>
                            </div>
                            <div class="mb-3">
                                <label for="t_produk1menit" class="form-label">T Produk 1 Menit</label>
                                <input type="text" class="form-control" id="t_produk1menit" name="t_produk1menit" placeholder="Masukkan T Ruang 1 menit..." required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu (Menit)</label>
                                <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Masukkan Waktu..." required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-header">LAMA PROSES</h5>
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Masukkan jam_mulai..." required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Masukkan jam_selesai..." required>
                            </div>
                            <h5 class="card-header">SENSORI</h5>
                            <!-- <div class="mb-3">
                                <label for="kematangan" class="form-label">Kematangan</label>
                                <input type="text" class="form-control" id="kematangan" name="kematangan" placeholder="Masukkan Kematangan..." required>
                            </div> -->
                            <div class="mb-3">
                            <label for="kematangan" class="form-label">Kematangan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kematangan" name="kematangan" value="OK">
                                    <label class="form-check-label" for="kematangan">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kematangan" name="kematangan" value="TIDAK">
                                    <label class="form-check-label" for="kematangan">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="rasa" class="form-label">Rasa</label>
                                <input type="text" class="form-control" id="rasa" name="rasa" placeholder="Masukkan rasa..."   > -->
                                <label for="rasa" class="form-label">Rasa</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rasa" name="rasa" value="OK">
                                    <label class="form-check-label" for="rasa">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rasa" name="rasa" value="TIDAK">
                                    <label class="form-check-label" for="rasa">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="aroma" class="form-label">Aroma</label>
                                <input type="text" class="form-control" id="aroma" name="aroma" placeholder="Masukkan aroma..."   > -->
                                <label for="aroma" class="form-label">Aroma</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aroma" name="aroma" value="OK">
                                    <label class="form-check-label" for="aroma">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aroma" name="aroma" value="TIDAK">
                                    <label class="form-check-label" for="aroma">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="tekstur" class="form-label">Tekstur</label>
                                <input type="text" class="form-control" id="tekstur" name="tekstur" placeholder="Masukkan tekstur..."   > -->
                                <label for="tekstur" class="form-label">Tekstur</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tekstur" name="tekstur" value="OK">
                                    <label class="form-check-label" for="tekstur">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tekstur" name="tekstur" value="TIDAK">
                                    <label class="form-check-label" for="tekstur">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="warna" class="form-label">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna" placeholder="Masukkan warna..."   > -->
                                <label for="warna" class="form-label">Warna</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="warna" name="warna" value="OK">
                                    <label class="form-check-label" for="warna">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="warna" name="warna" value="TIDAK">
                                    <label class="form-check-label" for="warna">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="qc" class="form-label">QC</label>
                                <select class="form-select" id="qc" name="qc" required>
                                    <option value="" disabled selected>Pilih Nama QC</option>
                                    <option value="Ade Stefani Khaeria">Ade Stefani Khaeria</option>
                                    <option value="Agung Martono">Agung Martono</option>
                                    <option value="Aris Kurniawan">Aris Kurniawan</option>
                                    <option value="Dhiar Retni Panji M">Dhiar Retni Panji M</option>
                                    <option value="Oges Gumilang Andisti">Oges Gumilang Andisti</option>
                                    <option value="Risaldo Ramadhan Dwiputra">Risaldo Ramadhan Dwiputra</option>
                                    <option value="Tarissah Januarti">Tarissah Januarti</option>
                                </select>
                            </div> -->
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi" required>
                                    <option value="" disabled selected>Pilih Shift</option>
                                    <option value="Nama A">Nama Orang Produksi</option>
                                    <option value="Nama B">Nama Orang Produksi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('pem_masak_steamer')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
