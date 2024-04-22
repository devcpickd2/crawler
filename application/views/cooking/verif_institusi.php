<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Verifikasi Produk Institusi</h4>
        <div class="demo-inline-spacing">
            <div class="d-flex align-items-center justify-content-between">
                <a href="<?= base_url('verif_institusi/tambah') ?>" class="btn btn-primary">
                    <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah
                </a>
                <form class="form-inline" action="<?= base_url('verif_institusi/print_pdf');?>" method="post" target="_blank">
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
            <h5 class="card-header">Data Verifikasi Produk Institusi</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Jenis Produk</th>
                            <th>Kode Produksi</th>
                            <th>Waktu Proses</th>
                            <th>Lokasi</th>
                            <th>Suhu Produk |Sebelum</th>
                            <th>Suhu Produk |Setelah</th>
                            <th>Sensori</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($verif_institusi as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->date; ?></td>
                                <td><?= $val->shift; ?></td>
                                <td><?= $val->jenis_produksi; ?></td>
                                <td><?= $val->kode_produksi; ?></td>
                                <td><?= $val->waktu_proses; ?></td>
                                <td><?= $val->lokasi; ?></td>
                                <td><?= $val->sebelum; ?></td>
                                <td><?= $val->sesudah; ?></td>
                                <td><?= $val->sensori; ?></td>
                                <td><?= $val->catatan; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('verif_institusi/edit/' . $val->uuid); ?>" class="btn btn-warning">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>
                                    <!-- <a href="<?= base_url('verif_institusi/print_pdf/' . $val->uuid); ?>" class="btn btn-info" target="_blank">
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
