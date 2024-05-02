<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Pegawai</h4>
        <div class="demo-inline-spacing">
            <a href="<?= base_url('pegawai/tambah') ?>" class="btn btn-primary">
                <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah Pegawai
            </a>
        </div>
        <hr class="my-5" />
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Daftar Pegawai</h5>
            <?php if($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-success text-center">
                <i class="fas fa-check"></i>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
            <br>
            <?php endif ?>

            <?php if($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-danger text-center">
                <i class="fas fa-check"></i>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
            <br>
            <?php endif ?>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Departemen</th>
                            <th>Tipe User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pegawai as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->nama; ?></td>
                                <td><?= $val->email; ?></td>
                                <td><?= $val->username; ?></td>
                                <td><?= $val->departemen; ?></td>
                                <td>
                                    <?php
                                    if ($val->tipe_user == 0) {
                                        echo "Admin";
                                    } elseif ($val->tipe_user == 1) {
                                        echo "Manager";
                                    } elseif ($val->tipe_user == 2) {
                                        echo "Supervisor";
                                    } elseif ($val->tipe_user == 3) {
                                        echo "Foreman/Forelady";
                                    } elseif ($val->tipe_user == 4) {
                                        echo "Staff";
                                    } elseif ($val->tipe_user == 5) {
                                        echo "QC Inspector";
                                    } elseif ($val->tipe_user == 6) {
                                        echo "Head Section";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('pegawai/edit/' . $val->uuid); ?>" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('pegawai/edituser/' . $val->uuid); ?>" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i> Uname
                                    </a>
                                    <a href="<?= base_url('pegawai/editpass/' . $val->uuid); ?>" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i> Pass
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->
</div>
