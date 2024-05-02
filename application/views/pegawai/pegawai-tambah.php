<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Tambah Pegawai</h4>
        <div class="card">
            <h5 class="card-header">Tambah Pegawai</h5>
            <div class="card-body">
                <form action="<?= base_url('pegawai/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama karyawan..." required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email...">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan nama password..." required>
                            </div>
                            <div class="mb-3">
                                <!-- <label for="departemen" class="form-label">Departemen</label>
                                <input type="text" class="form-control" id="departemen" name="departemen" placeholder="Masukkan nama departemen..." required> -->
                                <label class="form-label font-weight-bold">Departemen</label>
                                <select name="departemen" class="form-control <?= form_error('departemen') ? 'invalid' : '' ?>" >
                                    <option disabled selected>Pilih Departemen</option>
                                    <?php 
                                    foreach($departemen as $val){ ?>
                                        <option value="<?= $val->uuid; ?>" <?= set_select('departemen', $val->uuid) ;?>><?= $val->departemen; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback <?= !empty(form_error('departemen')) ? 'd-block' : '' ; ?> "><?= form_error('departemen') ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="tipe_user" class="form-label">Tipe User</label>
                                <select class="form-select" id="tipe_user" name="tipe_user" required>
                                    <option value="" disabled selected>Pilih Tipe User</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Manager</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Foreman/Forelady</option>
                                    <option value="4">Staff</option>
                                    <option value="5">QC Inspector</option>
                                    <option value="6">Head Section</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('pegawai')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
