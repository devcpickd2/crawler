<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url() ?>assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Login E-RTM</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css/pages/page-auth.css">
    <script src="<?= base_url() ?>assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>assets/js/config.js"></script>
</head>
<body>
    <div id="your-element-selector">
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="<?= base_url('login');?>" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="<?= base_url('assets/img/cpi-logo.png')?>" alt="CPI Logo" style="max-width: 50px;">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">E-RTM</span>
                            </a>
                        </div>
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $this->session->flashdata('error_msg') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <h4 class="mb-2 text-center">Welcome to E-RTM! 👋</h4>
                        <p class="mb-4 text-center">Silahkan Login Dengan Akun Anda</p>
                        <form id="formAuthentication" class="mb-3" action="<?= base_url('login');?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username Anda" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
    <script>
        VANTA.BIRDS({
            el: "#your-element-selector",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00
        });
    </script>
    <script src="<?= base_url() ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>assets/vendor/js/menu.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
