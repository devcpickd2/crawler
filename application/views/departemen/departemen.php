<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Departemen</h4>
        <div class="demo-inline-spacing">
            <a href="<?= base_url('departemen/tambah') ?>" class="btn btn-primary">
                <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah departemen
            </a>
        </div>
        <hr class="my-5" />
        <!-- Responsive Table -->
        <!-- <div class="card">
            <h5 class="card-header">Daftar departemen</h5>
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
            <?php endif ?> -->
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

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Departemen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($departemen as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->departemen; ?></td>
                                <td>
                                    <a href="<?= base_url('departemen/edit/' . $val->uuid); ?>" class="btn btn-warning">
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
