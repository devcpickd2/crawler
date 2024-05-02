<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Edit</h4>
        <div class="card">
            <h5 class="card-header">Edit Data Departemen</h5>
            <div class="card-body">
                <form action="<?= base_url('departemen/edit/'.$departemen->uuid) ?>" method="post">
                    <input type="hidden" name="uuid" value="<?= $departemen->uuid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="departemen" class="form-label">Departemen</label>
                                <input type="text" class="form-control" id="departemen" name="departemen" value="<?= $departemen->departemen ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('departemen') ?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
