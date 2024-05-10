<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Pegawai</h5>
            <div class="card-body">
                <form action="<?= base_url('pegawai/update/'.$pegawai->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $pegawai->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="nama" class="form-control" id="nama" name="nama" value="<?= $pegawai->nama ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $pegawai->email ?>">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $pegawai->username ?>">
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?= $pegawai->password ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Departemen</label>
                                    <select name="departemen" class="form-control <?= form_error('departemen') ? 'invalid' : '' ?>">
                                        <?php foreach($departemen as $val): ?>
                                            <option value="<?= $val->uuid; ?>" <?= ($val->uuid == $pegawai->departemen) ? 'selected' : '' ?>>
                                                <?= $val->departemen; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback <?= !empty(form_error('departemen')) ? 'd-block' : '' ?>"><?= form_error('departemen') ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe_user" class="form-label">Tipe User</label>
                                    <select class="form-select" id="tipe_user" name="tipe_user">
                                        <option value="" disabled selected>Pilih Tipe User</option>
                                        <option value="0" <?= ($pegawai->tipe_user == 0) ? 'selected' : '' ?>>Admin</option>
                                        <option value="1" <?= ($pegawai->tipe_user == 1) ? 'selected' : '' ?>>Manager</option>
                                        <option value="2" <?= ($pegawai->tipe_user == 2) ? 'selected' : '' ?>>Supervisor</option>
                                        <option value="3" <?= ($pegawai->tipe_user == 3) ? 'selected' : '' ?>>Foreman/Forelady</option>
                                        <option value="4" <?= ($pegawai->tipe_user == 4) ? 'selected' : '' ?>>Staff</option>
                                        <option value="5" <?= ($pegawai->tipe_user == 5) ? 'selected' : '' ?>>QC Inspector</option>
                                        <option value="6" <?= ($pegawai->tipe_user == 6) ? 'selected' : '' ?>>Head Section</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('pegawai') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
