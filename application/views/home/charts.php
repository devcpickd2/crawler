<div class="container container-dope-black">
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('<?= base_url() ?>assets/img/chart.jpg');">
            
        </div>
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
                        <h5 class="mb-1">
                            PT CHAROEN POKPHAND
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            Chart / Analysis Data Per-Years
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Dropdown positioned top-right for first chart -->
                    <div class="d-flex justify-content-between">
                        <div></div> <!-- To push the dropdown to the right -->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Select PT Charoen Pokphand Product
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <!-- Dropdown items for the products -->
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Ready Meal">Fiesta Ready
                                        Meal</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Ready To Go">Fiesta Ready To
                                        Go</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Chicken Nugget">Fiesta
                                        Chicken Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Crispy Bubble">Fiesta Crispy
                                        Bubble</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Chicken Sausage">Fiesta
                                        Chicken Sausage</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Tepung Roti">Fiesta Tepung
                                        Roti</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Tepung Bumbu">Fiesta Tepung
                                        Bumbu</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Bumbu Racik">Fiesta Bumbu
                                        Racik</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Ready To Eat">Fiesta Ready To
                                        Eat</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Ready To Serve">Fiesta Ready
                                        To Serve</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Champ Chicken Nugget">Champ Chicken
                                        Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Champ Sosis">Champ Sosis</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Okey Nugget Ayam">Okey Nugget
                                        Ayam</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Okey Sosis">Okey Sosis</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Asimo Nugget">Asimo Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Asimo Sosis">Asimo Sosis</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Akumo Nugget">Akumo Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Pizza">Fiesta Pizza</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Fiesta Ramen">Fiesta Ramen</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Kanzler Nugget">Kanzler Nugget</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-product="Kanzler Sosis">Kanzler Sosis</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-product="Kanzler Cordon Bleu">Kanzler Cordon
                                        Bleu</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Kanzler Singles">Kanzler Singles</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-product="Kimbo Sosis">Kimbo Sosis</a></li>
                                <li><a class="dropdown-item" href="#" data-product="So Good Crispy Chicken Nugget">So
                                        Good Crispy Chicken Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="So Nice Sosis Premium">So Nice Sosis
                                        Premium</a></li>
                                <li><a class="dropdown-item" href="#" data-product="So Nice Sosis Siap Makan">So Nice
                                        Sosis Siap Makan</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Bellfoods">Bellfoods</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Sunny Gold Nugget">Sunny Gold
                                        Nugget</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Salam Nugget Ayam">Salam Nugget
                                        Ayam</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Salam Sosis Ayam">Salam Sosis
                                        Ayam</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Sasa Tepung Bumbu">Sasa Tepung
                                        Bumbu</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Bumbu Racik Indofood">Bumbu Racik
                                        Indofood</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Sosis gaga">Sosis gaga</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Kobe Bumbu">Kobe Bumbu</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Kobe Tepung">Kobe Tepung</a></li>
                                <li><a class="dropdown-item" href="#" data-product="Laukita">Laukita</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- First Chart -->
                    <canvas id="myLineChart1"></canvas>
                    <div id="chart1Data" class="chart-data mt-3"></div> <!-- Data display for first chart -->
                    <br>
                    <!-- Dropdown positioned top-right for second chart -->
                    <div class="d-flex justify-content-between">
                        <div></div> <!-- To push the dropdown to the right -->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Select Positive Sentiment
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <!-- Dropdown items for the chart titles -->
                                <li><a class="dropdown-item" href="#" data-title="Enak">Enak</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Lezat">Lezat</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Menarik">Menarik</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Kenyal">Kenyal</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Hemat">Hemat</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Terjangkau">Terjangkau</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Praktis">Praktis</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Puas">Puas</a></li>
                                <li><a class="dropdown-item" href="#" data-title="Mantap">Mantap</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Second Chart -->
                    <canvas id="myLineChart2"></canvas>
                    <div id="chart2Data" class="chart-data mt-3"></div> <!-- Data display for second chart -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Data for the first chart
        const labels = ['2019', '2020', '2021', '2022', '2023']; // Years
        const datasetTemplate = {
            label: 'Fiesta Ready Meal', // Initial product
            data: [12, 19, 10, 15, 25], // Example data values
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 2,
            hoverBorderWidth: 3
        };

        // First chart configuration
        const config1 = {
            type: 'bar', // Bar chart
            data: {
                labels: labels,
                datasets: [JSON.parse(JSON.stringify(datasetTemplate))]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ff00ff',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#00ff00',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Mentions Each Year Fiesta Ready Meal',
                        color: '#ff6600',
                        font: {
                            size: 20,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    },
                    legend: {
                        labels: {
                            color: '#6a0dad',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        },
                        backgroundColor: '#333',
                        titleFont: {
                            size: 16,
                            color: '#ffffff'
                        },
                        bodyFont: {
                            size: 14,
                            color: '#ffffff'
                        },
                        cornerRadius: 10,
                        padding: 15
                    }
                }
            }
        };

        // Second chart configuration (Initially identical to the first chart)
        const config2 = JSON.parse(JSON.stringify(config1));

        // Initialize both charts
        const myBarChart1 = new Chart(document.getElementById('myLineChart1'), config1);
        const myBarChart2 = new Chart(document.getElementById('myLineChart2'), config2);

        // Function to update data display below each chart
        function updateChartDataDisplay(chart, elementId) {
            const labels = chart.data.labels;
            const data = chart.data.datasets[0].data;
            let htmlContent = "<h5>Collected Data From Table in Mentions Per Years</h5><ul>";

            labels.forEach((label, index) => {
                htmlContent += `<li>${label}: ${data[index]}</li>`;
            });
            htmlContent += "</ul>";

            document.getElementById(elementId).innerHTML = htmlContent;
        }

        // Initial data display update
        updateChartDataDisplay(myBarChart1, 'chart1Data');
        updateChartDataDisplay(myBarChart2, 'chart2Data');

        // Event listener for the first dropdown (Products)
        $('.dropdown-item[data-product]').click(function () {
            var selectedProduct = $(this).data('product');
            // Send AJAX request to get new data for the first chart
            $.ajax({
                url: '<?= base_url("home/get_mentions_per_year") ?>', // Adjust with actual URL
                method: 'POST',
                data: { keyword: selectedProduct },
                dataType: 'json',
                success: function (response) {
                    var years = [];
                    var mentions = [];
                    // Parse the response to extract years and mentions
                    response.forEach(function (data) {
                        years.push(data.year);
                        mentions.push(data.mentions);
                    });
                    // Update the first chart with the new data
                    myBarChart1.data.labels = years;
                    myBarChart1.data.datasets[0].data = mentions;
                    myBarChart1.data.datasets[0].label = selectedProduct;
                    myBarChart1.options.plugins.title.text = 'Total Mentions Each Year ' + selectedProduct;
                    // Make the second chart identical to the first chart
                    myBarChart2.data.labels = years;
                    myBarChart2.data.datasets[0].data = mentions;
                    myBarChart2.data.datasets[0].label = selectedProduct;
                    myBarChart2.options.plugins.title.text = myBarChart1.options.plugins.title.text;
                    // Update both charts and data displays
                    myBarChart1.update();
                    myBarChart2.update();
                    updateChartDataDisplay(myBarChart1, 'chart1Data');
                    updateChartDataDisplay(myBarChart2, 'chart2Data');
                },
                error: function (error) {
                    console.log('Error fetching data:', error);
                }
            });
        });

        // Event listener for the second dropdown (Positive Sentiments)
        $('.dropdown-item[data-title]').click(function () {
            var selectedSentiment = $(this).data('title');
            var selectedProduct = myBarChart1.data.datasets[0].label; // Keep the product the same as first chart
            // Send AJAX request to get new data filtered by sentiment
            $.ajax({
                url: '<?= base_url("home/get_mentions_by_sentiment") ?>', // Adjust with actual URL
                method: 'POST',
                data: { sentiment: selectedSentiment, product: selectedProduct },
                dataType: 'json',
                success: function (response) {
                    var years = [];
                    var mentions = [];
                    // Parse the response to extract years and mentions for positive sentiment
                    response.forEach(function (data) {
                        years.push(data.year);
                        mentions.push(data.mentions);
                    });
                    // Update the second chart with the filtered data
                    myBarChart2.data.labels = years;
                    myBarChart2.data.datasets[0].data = mentions;
                    myBarChart2.data.datasets[0].label = selectedProduct + ' (' + selectedSentiment + ')';
                    myBarChart2.options.plugins.title.text = 'Total Mentions of ' + selectedSentiment + ' for ' + selectedProduct;
                    // Update the second chart and data display
                    myBarChart2.update();
                    updateChartDataDisplay(myBarChart2, 'chart2Data');
                },
                error: function (error) {
                    console.log('Error fetching sentiment data:', error);
                }
            });
        });
    });
</script>

<style>
    /* Style for the data display below the charts */
    .chart-data {
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    .chart-data ul {
        padding-left: 20px;
    }
    .chart-data h5 {
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>
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