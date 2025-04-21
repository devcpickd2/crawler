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
                style="background-image: url('<?= base_url() ?>assets/img/image7.jpg');"></div>
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
                                Market Analysis / Positive Sentiments
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Filter Inputs -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <input type="text" id="keywordFilter" class="form-control" placeholder="Filter by keyword..."
                            onkeyup="filterTable()">
                    </div>
                    <div class="col-12 mb-3">
                        <input type="text" id="commentFilter" class="form-control" placeholder="Filter by positive comment..."
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
                                        <th style="width: 35%;">Positive Comment</th>
                                        <th style="width: 15%;">Author</th>
                                        <th style="width: 15%;">Date</th>
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
                                    <?php if (!empty($positive_mentions)): ?>
                                        <?php foreach ($positive_mentions as $index => $mention): ?>
                                            <tr>
                                                <td><?php echo (int) $index + 1; ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->keyword))); ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->text))); ?></td>
                                                <td><?php echo ucfirst(strtolower(htmlspecialchars($mention->author))); ?></td>
                                                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($mention->updated_at))); ?></td>
                                                <td style="text-align: center;"><?php echo ucfirst(strtolower(htmlspecialchars($mention->like_count))); ?></td>
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
                                            <td colspan="8" class="text-center">No positive mentions found.</td>
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
</body>

<script>
    let sortDirection = true; // true for ascending, false for descending

    function filterTable() {
        // Get the input values and convert to lowercase for case-insensitive filtering
        const keywordFilter = document.getElementById('keywordFilter').value.toLowerCase();
        const commentFilter = document.getElementById('commentFilter').value.toLowerCase();
        const table = document.getElementById('mentionsTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows, and hide those that don't match the filters
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            const keywordCell = cells[1]; // "Keyword" column
            const commentCell = cells[2]; // "Positive Comment" column

            if (keywordCell && commentCell) {
                const keywordText = keywordCell.textContent || keywordCell.innerText;
                const commentText = commentCell.textContent || commentCell.innerText;

                // Check if both filters match the respective cell text
                if (keywordText.toLowerCase().indexOf(keywordFilter) > -1 &&
                    commentText.toLowerCase().indexOf(commentFilter) > -1) {
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
</script>

</html>