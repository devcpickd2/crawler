<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Setting /</span> Edit</h4>
        <?php if ($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h5 class="card-header">Setting Data Anda</h5>
            <div class="card-body">
                <form action="<?= base_url('setting/submit') ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $pegawai->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= $pegawai->password ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('home') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
