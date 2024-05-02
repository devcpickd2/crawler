<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Pemeriksaan Pemasakan Dengan Steamer</h5>
            <div class="card-body">
                <form action="<?= base_url('pem_masak_steamer/update/'.$pem_masak_steamer->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $pem_masak_steamer->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $pem_masak_steamer->date ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
                                    <option value="1" <?= ($pem_masak_steamer->shift == 1) ? 'selected' : '' ?>>Shift 1</option>
                                    <option value="2" <?= ($pem_masak_steamer->shift == 2) ? 'selected' : '' ?>>Shift 2</option>
                                    <option value="3" <?= ($pem_masak_steamer->shift == 3) ? 'selected' : '' ?>>Shift 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $pem_masak_steamer->nama_produk ?>">
                            </div>
                            <div class="mb-3">
                                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                                <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" value="<?= $pem_masak_steamer->kode_produksi ?>">
                            </div>
                            <div class="mb-3">
                                <label for="t_raw" class="form-label">T Raw Material (C)</label>
                                <input type="text" class="form-control" id="t_raw" name="t_raw" value="<?= $pem_masak_steamer->t_raw ?>">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_tray" class="form-label">Jumlah Tray</label>
                                <input type="text" class="form-control" id="jumlah_tray" name="jumlah_tray" value="<?= $pem_masak_steamer->jumlah_tray ?>">
                            </div>
                            <h5 class="card-header">STEAMING</h5>
                            <div class="mb-3">
                                <label for="t_ruang" class="form-label">T Ruang</label>
                                <input type="text" class="form-control" id="t_ruang" name="t_ruang" value="<?= $pem_masak_steamer->t_ruang ?>">
                            </div>
                            <div class="mb-3">
                                <label for="t_produk" class="form-label">T Produk</label>
                                <input type="text" class="form-control" id="t_produk" name="t_produk" value="<?= $pem_masak_steamer->t_produk ?>">
                            </div>
                            <div class="mb-3">
                                <label for="t_produk1menit" class="form-label">T Produk 1 Menit</label>
                                <input type="text" class="form-control" id="t_produk1menit" name="t_produk1menit" value="<?= $pem_masak_steamer->t_produk1menit ?>">
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu (Menit)</label>
                                <input type="text" class="form-control" id="waktu" name="waktu" value="<?= $pem_masak_steamer->waktu ?>">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $pem_masak_steamer->keterangan ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-header">LAMA PROSES</h5>
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= $pem_masak_steamer->jam_mulai ?>">
                            </div>
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= $pem_masak_steamer->jam_selesai ?>">
                            </div>
                            <h5 class="card-header">SENSORI</h5>
                            <div class="mb-3">
                            <label for="kematangan" class="form-label">Kematangan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kematangan" name="kematangan" value="<?= $pem_masak_steamer->kematangan ?>">
                                    <label class="form-check-label" for="kematangan">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kematangan" name="kematangan" value="<?= $pem_masak_steamer->kematangan ?>">
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
                                    <input class="form-check-input" type="checkbox" id="rasa" name="rasa" value="<?= $pem_masak_steamer->rasa ?>">
                                    <label class="form-check-label" for="rasa">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rasa" name="rasa" value="<?= $pem_masak_steamer->rasa ?>">
                                    <label class="form-check-label" for="rasa">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="aroma" class="form-label">Aroma</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aroma" name="aroma" value="<?= $pem_masak_steamer->aroma ?>">
                                    <label class="form-check-label" for="aroma">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aroma" name="aroma" value="<?= $pem_masak_steamer->aroma ?>">
                                    <label class="form-check-label" for="aroma">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tekstur" class="form-label">Tekstur</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tekstur" name="tekstur" value="<?= $pem_masak_steamer->tekstur ?>">
                                    <label class="form-check-label" for="tekstur">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tekstur" name="tekstur" value="<?= $pem_masak_steamer->tekstur ?>">
                                    <label class="form-check-label" for="tekstur">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="warna" class="form-label">Warna</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="warna" name="warna" value="<?= $pem_masak_steamer->warna?>">
                                    <label class="form-check-label" for="warna">
                                        OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="warna" name="warna" value="<?= $pem_masak_steamer->warna?>">
                                    <label class="form-check-label" for="warna">
                                        TIDAK
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="produksi" class="form-label">Produksi</label>
                                <select class="form-select" id="produksi" name="produksi">
                                <!-- <option value="1" <?= ($pem_masak_steamer->shift == 1) ? 'selected' : '' ?>>Shift 1</option> -->
                                    <!-- <option value="" disabled selected>Pilih Shift</option> -->
                                    <option value="Nama B" <?= ($pem_masak_steamer->produksi == 1) ? 'selected' : '' ?>>Nama Orang Produksi</option>
                                    <!-- <option value="Nama B">Nama Orang Produksi</option> -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan..."   >
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('pem_masak_steamer') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
