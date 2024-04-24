<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Form Cooking /</span> Pemeriksaan Pemasakan Dengan Streamer</h4>
        <div class="demo-inline-spacing">
            <div class="d-flex align-items-center justify-content-between">
                <a href="<?= base_url('pem_masak_steamer/tambah') ?>" class="btn btn-primary">
                    <span class="tf-icons bx bxs-plus-circle"></span>&nbsp; Tambah
                </a>
                <form class="form-inline" action="<?= base_url('pem_masak_steamer/print_pdf');?>" method="post" target="_blank">
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
            <h5 class="card-header">Data Pemeriksaan Pemasakan Dengan Streamer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Nama Produk</th>
                            <th>Kode Prod.</th>
                            <th>T.Raw Material</th>
                            <th>Jml Tray</th>
                            <th>T.Ruang</th>
                            <th>T. Produk</th>
                            <th>T. Produk 1 menit</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pem_masak_steamer as $val) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->date; ?></td>
                                <td><?= $val->shift; ?></td>
                                <td><?= $val->nama_produk; ?></td>
                                <td><?= $val->kode_produksi; ?></td>
                                <td><?= $val->t_raw; ?></td>
                                <td><?= $val->jumlah_tray; ?></td>
                                <td><?= $val->t_ruang; ?></td>
                                <td><?= $val->t_produk; ?></td>
                                <td><?= $val->t_produk1menit; ?></td>
                                <td><?= $val->waktu; ?></td>
                                <td><?= $val->keterangan; ?></td>
                                <td><?= $val->jam_mulai; ?></td>
                                <td><?= $val->jam_selesai; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('pem_masak_steamer/edit/' . $val->uuid); ?>" class="btn btn-warning">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>
                                    <!-- <a href="<?= base_url('pem_masak_steamer/print_pdf/' . $val->uuid); ?>" class="btn btn-info" target="_blank">
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
