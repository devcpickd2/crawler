<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link id="pagestyle" href="<?= base_url() ?>assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>

    <style>
        /* General Table Styles */
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            /* Ensures border radius is applied */
            width: 100%;
            table-layout: auto;
            /* Allow browser to adjust column widths */
            margin-top: 20px;
            /* Add space above the table */
        }

        .nav-tabs .nav-link:hover {
            color: #E30B5C !important;
            /* Text color changes to pink */
            background-color: rgba(227, 11, 92, 0.1);
            /* Add a light pink background */
            transition: background-color 0.3s, color 0.3s;
            /* Smooth transition for hover effects */
        }

        /* Header styles */
        .table th {
            vertical-align: middle;
            background-color: #E30B5C;
            /* Change header color to match button link color */
            color: white !important;
            /* Header text color */
            padding: 15px;
            /* Increased padding for better appearance */
        }

        /* Cell styles */
        .table th,
        .table td {
            white-space: normal;
            /* Allow text to wrap */
            overflow: visible;
            /* Allow overflow to show */
            padding: 10px;
            /* Add padding for better spacing */
        }

        /* Specific styles for Negative Comment column */
        .table td:nth-child(3) {
            max-width: 300px;
            /* Limit the width of the Negative Comment column */
            word-wrap: break-word;
            /* Allow words to break for better wrapping */
        }

        /* Highlight rows on hover */
        .table tbody tr:hover {
            background-color: rgba(54, 162, 235, 0.2);
        }

        /* No negative mentions found */
        .text-center {
            font-weight: bold;
            color: #777;
        }

        /* Custom gradient for the page header */
        .bg-gradient-primary {
            background: linear-gradient(90deg, rgba(54, 162, 235, 1) 0%, rgba(54, 162, 235, 0.9) 100%);
        }

        .btn-square {
            width: 50px;
            /* Width of the square button */
            height: 50px;
            /* Height of the square button */
            background-color: #E30B5C;
            /* Custom button color */
            color: white;
            /* Text color */
            border: none;
            /* No border */
            display: flex;
            /* Flexbox for centering */
            align-items: center;
            /* Center vertically */
            justify-content: center;
            /* Center horizontally */
            border-radius: 0;
            /* No border radius for square corners */
            transition: background-color 0.3s, transform 0.3s;
            /* Smooth transition for hover effects */
        }

        .btn-square:hover {
            background-color: #D70050;
            /* Darker shade on hover */
            transform: scale(1.1);
            /* Slightly increase size on hover */
        }

        .btn-square .fa-play {
            font-size: 20px;
            /* Adjust icon size */
        }
    </style>
</head>

<body>
    <div class="container container-dope-black">
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('<?= base_url() ?>assets/img/reports.jpg');"></div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="<?= base_url() ?>assets/img/cpi-logo.png" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">PT CHAROEN POKPHAND</h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                Market Analysis / Reports
                            </p>
                        </div>
                    </div>
                </div>
                <!--<div class="text-right mt-2 d-flex justify-content-start">
                    <a href="<?php echo site_url('home/download_excel'); ?>" class="btn btn-primary"
                        style="margin-right: 15px;">Download Comments Only</a>
                    <a href="<?php echo site_url('home/download_excel_2'); ?>" class="btn btn-primary"
                        style="margin-right: 15px;">Download Video Properties</a>

                </div>-->


                <div class="container mt-5">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="corporate-tab" data-bs-toggle="tab"
                                data-bs-target="#corporate" type="button" role="tab" aria-controls="corporate"
                                aria-selected="true">
                                CPI & Competitor Products
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pokphand-tab" data-bs-toggle="tab" data-bs-target="#pokphand"
                                type="button" role="tab" aria-controls="pokphand" aria-selected="false">
                                CPI Products
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cpi-negative-tab" data-bs-toggle="tab"
                                data-bs-target="#cpiNegative" type="button" role="tab" aria-controls="cpiNegative"
                                aria-selected="false">
                                CPI Negative Sentiment
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cpi-positive-tab" data-bs-toggle="tab"
                                data-bs-target="#cpiPositive" type="button" role="tab" aria-controls="cpiPositive"
                                aria-selected="false">
                                CPI Positive Sentiment
                            </button>
                        </li>
                    </ul>


                    <!-- Tab Content -->
                    <div class="tab-content mt-4" id="formTabsContent">
                        <!-- Corporate & Competitor Products Form -->
                        <div class="tab-pane fade show active" id="corporate" role="tabpanel"
                            aria-labelledby="corporate-tab">
                            <div class="row gx-4">
                                <div class="col-md-6">
                                    <div class="row gx-4 mb-3 mt-4">
                                        <div class="col-md-12">
                                            <h3 class="text-center">All Corporate & Competitor Products</h3>
                                            <hr />
                                        </div>
                                    </div>
                                    <form action="<?= base_url('reports/excel') ?>" method="GET">
                                        <div class="mb-3">
                                            <label for="startDateCorporate" class="form-label">Start Date:</label>
                                            <input type="date" id="startDateCorporate" name="start_date"
                                                class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endDateCorporate" class="form-label">End Date:</label>
                                            <input type="date" id="endDateCorporate" name="end_date"
                                                class="form-control" required />
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                Download Excel Full ver.
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="<?= base_url() ?>assets/img/gst.jpg" alt="Aesthetic Image"
                                            class="img-fluid rounded" style="max-height: 350px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PT Charoen Pokphand Products Form -->
                        <div class="tab-pane fade" id="pokphand" role="tabpanel" aria-labelledby="pokphand-tab">
                            <div class="row gx-4">
                                <div class="col-md-6">
                                    <div class="row gx-4 mb-3 mt-4">
                                        <div class="col-md-12">
                                            <h3 class="text-center">PT Charoen Pokphand Products Only</h3>
                                            <hr />
                                        </div>
                                    </div>
                                    <form action="<?= base_url('reports/excel_cpi') ?>" method="GET">
                                        <div class="mb-3">
                                            <label for="startDatePokphand" class="form-label">Start Date:</label>
                                            <input type="date" id="startDatePokphand" name="start_date"
                                                class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endDatePokphand" class="form-label">End Date:</label>
                                            <input type="date" id="endDatePokphand" name="end_date" class="form-control"
                                                required />
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                Download Excel Full ver.
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="<?= base_url() ?>assets/img/gst.jpg" alt="Aesthetic Image"
                                            class="img-fluid rounded" style="max-height: 350px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CPI Negative Sent. Form -->
                        <div class="tab-pane fade" id="cpiNegative" role="tabpanel" aria-labelledby="cpi-negative-tab">
                            <div class="row gx-4">
                                <div class="col-md-6">
                                    <div class="row gx-4 mb-3 mt-4">
                                        <div class="col-md-12">
                                            <h3 class="text-center">CPI Negative Sentiment</h3>
                                            <hr />
                                        </div>
                                    </div>
                                    <form action="<?= base_url('reports/excel_cpi_negative') ?>" method="GET">
                                        <div class="mb-3">
                                            <label for="startDateCpiNegative" class="form-label">Start Date:</label>
                                            <input type="date" id="startDateCpiNegative" name="start_date"
                                                class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endDateCpiNegative" class="form-label">End Date:</label>
                                            <input type="date" id="endDateCpiNegative" name="end_date"
                                                class="form-control" required />
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                Download Excel Full ver.
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="<?= base_url() ?>assets/img/gst.jpg" alt="Aesthetic Image"
                                            class="img-fluid rounded" style="max-height: 350px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CPI Positive Sent. Form -->
                        <div class="tab-pane fade" id="cpiPositive" role="tabpanel" aria-labelledby="cpi-positive-tab">
                            <div class="row gx-4">
                                <div class="col-md-6">
                                    <div class="row gx-4 mb-3 mt-4">
                                        <div class="col-md-12">
                                            <h3 class="text-center">CPI Positive Sentiment</h3>
                                            <hr />
                                        </div>
                                    </div>
                                    <form action="<?= base_url('reports/download_csv_cpi_positive') ?>" method="GET">
                                        <div class="mb-3">
                                            <label for="startDateCpiPositive" class="form-label">Start Date:</label>
                                            <input type="date" id="startDateCpiPositive" name="start_date"
                                                class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endDateCpiPositive" class="form-label">End Date:</label>
                                            <input type="date" id="endDateCpiPositive" name="end_date"
                                                class="form-control" required />
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                Download Excel Full ver.
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="<?= base_url() ?>assets/img/gst.jpg" alt="Aesthetic Image"
                                            class="img-fluid rounded" style="max-height: 350px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    // Initialize date range picker
    $(function () {
        $('#dateRange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
            },
            opens: 'center',
        });

        // Button click event
        $('#downloadExcelBtn').on('click', function () {
            const dateRange = $('#dateRange').val();

            // Ensure the date range is selected
            if (!dateRange) {
                alert('Please select a date range before downloading the Excel report.');
                return;
            }

            // Alert the selected date range for debugging
            alert('Selected Date Range: ' + dateRange);

            // Call the backend controller (placeholder example)
            // Use AJAX or form submission to send `dateRange` to the server
        });
    });
</script>



</html>