<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sanitasi /</span> Pemeriksaan Sanitasi</h4>
        <div class="demo-inline-spacing">
            <div class="d-flex align-items-center justify-content-between">
                <a href="<?= base_url('pem_sanitasi/tambah') ?>" class="btn btn-primary">
                    <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah
                </a>
                <form class="form-inline" action="<?= base_url('pem_sanitasi/print_pdf');?>" method="post" target="_blank">
                    <div class="form-group d-flex align-items-center">
                        <label for="tanggal" class="mr-2">Tanggal:</label>
                        <input type="date" class="form-control mr-2" id="tanggal" name="tanggal">
                        <button type="submit" class="btn btn-info btn-sm"><i class="bx bx-printer"></i>Print PDF</button>
                    </div>
                </form>
            </div>
        </div>
        <hr class="my-5" />
        <!-- Responsive Table -->
        <div class="card">
            <?php if($this->session->flashdata('success_msg')): ?>
                <div id="successModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Success!</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <?= $this->session->flashdata('success_msg') ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <?php if($this->session->flashdata('error_msg')): ?>
                <div id="errorModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Error!</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <?= $this->session->flashdata('error_msg') ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <!-- / Alert Modals -->
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Pemeriksaan Sanitasi</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Pukul</th>
                            <th>Foot Basin</th>
                            <th>Hand Basin</th>
                            <th>Keterangan</th>
                            <th>Tindakan Koreksi</th>
                            <th>Qc</th>
                            <th>Produksi</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pem_sanitasi as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->date; ?></td>
                                <td><?= $val->shift; ?></td>
                                <td><?= $val->pukul; ?></td>
                                <td><?= $val->foot_basin; ?></td>
                                <td><?= $val->hand_basin; ?></td>
                                <td><?= $val->keterangan; ?></td>
                                <td><?= $val->tindakan_koreksi; ?></td>
                                <td><?= $val->nama_pegawai; ?></td>
                                <td><?= $val->produksi; ?></td>
                                <td><?= $val->catatan; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('pem_sanitasi/edit/' . $val->uuid); ?>" class="btn btn-warning">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>
                                    <!-- <a href="<?= base_url('pem_sanitasi/print_pdf/' . $val->uuid); ?>" class="btn btn-info" target="_blank">
                                        <i class="bx bx-printer"></i> Print
                                    </a> -->
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
<script>
    $(document).ready(function(){
        <?php if($this->session->flashdata('success_msg')): ?>
            $('#successModal').modal('show');
        <?php endif ?>

        <?php if($this->session->flashdata('error_msg')): ?>
            $('#errorModal').modal('show');
        <?php endif ?>

        $('.modal .close').on('click', function() {
            $(this).closest('.modal').modal('hide');
        });
    });
</script>
