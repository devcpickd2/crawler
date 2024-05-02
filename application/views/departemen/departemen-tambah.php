<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master User /</span> Tambah departemen</h4>
        <div class="card">
            <h5 class="card-header">Tambah departemen</h5>
            <div class="card-body">
                <form action="<?= base_url('departemen/tambah') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="departemen" class="form-label">Departemen</label>
                                <input type="text" class="form-control" id="departemen" name="departemen" placeholder="Masukkan Nama Departemen..." required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                        <a href="<?= base_url('departemen')?>" class="btn btn-danger"><i class="bx bx-x"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
