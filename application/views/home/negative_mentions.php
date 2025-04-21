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
    <!-- Tambahkan SweetAlert CSS di head -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert JS di bagian bawah -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>


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
                style="background-image: url('<?= base_url() ?>assets/img/image1.jpg');"></div>
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
                                Market Analysis / Negative Sentiments
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Keyword Filter Input -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <input type="text" id="keywordFilter" class="form-control" placeholder="Filter by keyword..."
                            onkeyup="filterTable()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped" id="mentionsTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th style="width: 15%;">Keyword</th>
                                        <th style="width: 35%;">Negative Comment</th>
                                        <th style="width: 15%;">Author</th>
                                        <th style="width: 15%;">
                                            <a href="javascript:void(0);" onclick="sortByDate()">
                                                Date <span id="date-sort-icon" class="sort-icon">&#x2195;</span>
                                            </a>
                                        </th>
                                        <th style="width: 15%;">
                                            <a href="javascript:void(0);" onclick="sortTable()">
                                                Like <span id="like-sort-icon" class="sort-icon">&#x2195;</span>
                                            </a>
                                        </th>
                                        <th style="width: 10%;">Video Title</th>
                                        <th style="width: 10%;">Video Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($negative_mentions)): ?>
                                        <?php foreach ($negative_mentions as $index => $mention): ?>
                                            <tr>
                                                <td><?php echo (int) $index + 1; ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->keyword))); ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->text))); ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->author))); ?></td>
                                                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($mention->updated_at))); ?>
                                                </td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->like_count))); ?>
                                                </td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->title))); ?></td>
                                                <td>
                                                    <a href="https://www.youtube.com/watch?v=<?php echo htmlspecialchars($mention->video_id); ?>"
                                                        target="_blank" class="btn btn-square shadow">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No negative mentions found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Data Baru Ditemukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ada data baru dengan kata-kata negatif yang ditemukan. Berikut adalah data barunya:</p>

                    <!-- Loop untuk menampilkan data baru -->
                    <?php if (!empty($new_mentions)): ?>
                        <ul>
                            <?php foreach ($new_mentions as $mention): ?>
                                <li>
                                    <strong>Title:</strong> <?= htmlspecialchars($mention->title) ?><br>
                                    <strong>Author:</strong> <?= htmlspecialchars($mention->author) ?><br>
                                    <strong>Text:</strong> <?= htmlspecialchars($mention->text) ?><br>
                                    <strong>Likes:</strong> <?= $mention->like_count ?><br>

                                    <!-- Tambahkan link ke video YouTube -->
                                    <a href="https://www.youtube.com/watch?v=<?= htmlspecialchars($mention->video_id); ?>"
                                        target="_blank" class="btn btn-square shadow">
                                        <i class="fas fa-play"></i> Link
                                    </a>
                                    <hr>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Tidak ada data baru dengan kata-kata negatif.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script untuk menampilkan modal jika ada data baru -->
    <?php if (isset($show_notification) && $show_notification): ?>
        <script type="text/javascript">
            // Menampilkan modal ketika ada data baru
            var myModal = new bootstrap.Modal(document.getElementById('notificationModal'));
            myModal.show();
        </script>
    <?php endif; ?>


</body>

<script>
    let sortDirection = true; // true for ascending, false for descending

    function filterTable() {
        // Get the input value and convert to lowercase for case-insensitive filtering
        const filter = document.getElementById('keywordFilter').value.toLowerCase();
        const table = document.getElementById('mentionsTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows, and hide those that don't match the filter
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            const keywordCell = cells[1]; // Assuming "Keyword" is in the second column

            if (keywordCell) {
                const keywordText = keywordCell.textContent || keywordCell.innerText;
                if (keywordText.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }

    function sortTable() {
        const table = document.getElementById('mentionsTable');
        const rows = Array.from(table.rows).slice(1); // Get all rows except the header
        const likeIndex = 5; // The index of the "Like" column

        // Sort rows based on the Like count
        rows.sort((a, b) => {
            const likeA = parseInt(a.cells[likeIndex].textContent) || 0;
            const likeB = parseInt(b.cells[likeIndex].textContent) || 0;
            return sortDirection ? likeA - likeB : likeB - likeA; // Ascending or descending
        });

        // Append sorted rows to the table body
        const tbody = table.tBodies[0];
        rows.forEach(row => tbody.appendChild(row));

        // Toggle sort direction for the next click
        sortDirection = !sortDirection;

        // Update sort icon
        const sortIcon = document.getElementById('like-sort-icon');
        sortIcon.innerHTML = sortDirection ? '&#x2191;' : '&#x2193;'; // Up or down arrow
    }


    let dateSortDirection = true; // true for ascending, false for descending

    function sortByDate() {
        const table = document.getElementById('mentionsTable');
        const rows = Array.from(table.rows).slice(1); // Get all rows except the header
        const dateIndex = 4; // The index of the "Date" column (5th column, index starts from 0)

        // Sort rows based on the Date
        rows.sort((a, b) => {
            const dateA = new Date(a.cells[dateIndex].textContent);
            const dateB = new Date(b.cells[dateIndex].textContent);
            return dateSortDirection ? dateA - dateB : dateB - dateA; // Ascending or descending
        });

        // Append sorted rows to the table body
        const tbody = table.tBodies[0];
        rows.forEach(row => tbody.appendChild(row));

        // Toggle sort direction for the next click
        dateSortDirection = !dateSortDirection;

        // Update sort icon
        const sortIcon = document.getElementById('date-sort-icon');
        sortIcon.innerHTML = dateSortDirection ? '&#x2191;' : '&#x2193;'; // Up or down arrow
    }

</script>


</html>