<div class="content-wrapper">
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white text-white underline">
                        <h4>Profil Saya</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($pegawai)): ?>
                            <?php
                            // Array mapping tipe user
                            $tipe_user_mapping = [
                                0 => 'Admin',
                                1 => 'Manager',
                                2 => 'Supervisor',
                                3 => 'Foreman/Forelady',
                                4 => 'Staff',
                                5 => 'QC Inspector',
                                6 => 'Head Section',
                            ];
                            ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext"><?php echo $pegawai->nama; ?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Username:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext"><?php echo $pegawai->username; ?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jabatan:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext"><?php echo $tipe_user_mapping[$pegawai->tipe_user]; ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger" role="alert">
                                Data tidak ditemukan.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-right">
                        <a href="<?= base_url('setting') ?>" class="btn btn-warning">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>