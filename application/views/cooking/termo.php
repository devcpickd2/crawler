<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Peneraan Termometer</h4>
        <div class="demo-inline-spacing">
            <a href="<?= base_url('termo/tambah') ?>" class="btn btn-primary">
                <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah
            </a>
        </div>
        <hr class="my-5" />
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Peneraan Termometer</h5>
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
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Kode Termometer/Area</th>
                            <th>Pukul</th>
                            <th>Hasil Tera</th>
                            <th>Tindakan</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($termo as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->date; ?></td>
                                <td><?= $val->shift; ?></td>
                                <td><?= $val->kode_termo; ?></td>
                                <td><?= $val->pukul; ?></td>
                                <td><?= $val->hasil_tera; ?></td>
                                <td><?= $val->tindakan; ?></td>
                                <td><?= $val->catatan; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('termo/edit/' . $val->uuid); ?>" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
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
