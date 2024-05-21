<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url()?>assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>E - FORM RTM</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url('favicon.ico')?>" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/apex-charts/apex-charts.css" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="<?=base_url()?>assets/vendor/js/helpers.js"></script>
    <script src="<?=base_url()?>assets/js/config.js"></script>
    <style>
        .active {
            color: purple;
        }
    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?= base_url('home');?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="<?=base_url('assets/img/cpi-logo.png')?>" alt="CPI Logo" style="max-width: 50px;">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">E-RTM</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
                <a href="<?= base_url('home');?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <!-- Master User -->
            <?php if ($this->session->userdata('type') == '0') : ?>
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Master User</span></li>
              <!-- Forms -->
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-detail"></i>
                      <div data-i18n="Form Elements">Master Data</div>
                  </a>
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="<?= base_url('pegawai') ?>" class="menu-link">
                              <div data-i18n="Basic Inputs">Pegawai</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="<?= base_url('departemen') ?>" class="menu-link">
                              <div data-i18n="Basic Inputs">Departemen</div>
                          </a>
                      </li>
                  </ul>
              </li>
            <?php endif ?> 
            <!-- Suhu Ruangan & Sanitasi -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Suhu & Sanitasi</span></li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-file"></i>
                    <div data-i18n="Form Elements">Suhu dan Sanitasi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="<?= base_url('suhu_ruangan') ?>" class="menu-link">
                            <div data-i18n="Basic Inputs">Suhu Ruangan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('sanitasi') ?>" class="menu-link">
                            <div data-i18n="Basic Inputs">Sanitasi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('pem_sanitasi') ?>" class="menu-link">
                            <div data-i18n="Basic Inputs">Pemeriksaan Sanitasi</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms</span></li>
            <!-- Forms -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-food-menu"></i>
                    <div data-i18n="Form Elements">Form Cooking</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="<?= base_url('termo');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Peneraan Termo</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('pem_tumbling');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Pemeriksaan Proses Tumbling</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('pem_masak_steamer');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Pemeriksaan Pemasakan Dengan Steamer</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('pem_kettle');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Pemeriksaan Pemasakan Produk Di Steam / Cooking Kettle</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('timbangan');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Peneraan Timbangan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('pem_thawing');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Pemeriksaan Proses Thawing</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('param_saus');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Parameter Produk Saus Yoshinoya</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('sortasi_cooking');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Sortasi Bahan Baku Yang Tidak Sesuai</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('verif_institusi');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Verifikasi Produk Institusi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= base_url('verif_premix');?>" class="menu-link" id ="child">
                            <div data-i18n="Basic Inputs">Verifikasi Premix</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-package"></i>
                <div data-i18n="Form Layouts">Form Packing</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?= base_url('benda_asing');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Kontaminasi Benda Asing</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('suhu_qf');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Suhu Produk Setelah IQF</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('verif_pengemasan');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Verifikasi Pengemasan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('metal_detector');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Metal Detector</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('xray');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan XRAY</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('suhu_proses');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pengecekan Suhu Produk Setiap Tahapan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('monitor_reject');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Monitoring False Rejection</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('monitor_repack');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Monitoring Proses Repack</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('verif_topping');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Verifikasi Gramasi Topping</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('verif_mesin');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Verifikasi Mesin</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Form Layouts">Form Warehouse</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?= base_url('loading');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Loading Produk Untuk Lokal</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('retur');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Produk Retur</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('datang_premix');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Kedatangan Premix</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('drystore');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Pengiriman DryStore</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('kendaraan_incoming');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Kendaraan Incoming</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('raw_material');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Kedatangan Raw Material</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('kemasan_pemasok');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Kemasan Dari Pemasok</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('rice_cooker');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Pemasakan Dengan Rice Cooker</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('pem_noodle');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Pemasakan Noodle</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('verif_sanitasi');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Verifikasi Sanitasi</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('rnd');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Sample Bulanan RND</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('pem_sanitasi');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Sanitasi</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('retain_sample');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Retained Sample Report</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('laboratory');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Laboratory Sample Submission Report</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('suhu_ruang');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemeriksaan Suhu Ruangan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('suhu_coldstorage');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Pemantauan Suhu Produk Di Cold Storage</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx bxs-file-doc"></i>
                <div data-i18n="Form Layouts">Report Data</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?= base_url('report');?>" class="menu-link">
                    <div data-i18n="Vertical Form">Report Data E-RTM</div>
                  </a>
                </li>
              </ul>
            </li>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?=base_url()?>assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?=base_url()?>assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">Halo, <?php echo $nama_pegawai; ?></span>
                            <small class="text-muted"><?php echo $tipe_user; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?=base_url('logout')?>">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script>
      AOS.init();
    </script>

    <script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?=base_url()?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url()?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url()?>assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
