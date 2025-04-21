<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .container-dope-black {
    background-color: #1a1a1a;
    /* Softer black */
    color: black;
    /* Keep the text black */
  }
</style>
<style>
  /* Hover effect for cards */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  /* Icon animations */
  .card-header .icon {
    transition: transform 0.3s ease;
  }

  .card:hover .icon {
    transform: rotate(360deg);
  }
</style>
<div class="container container-dope-black ">
  <br><br>
  <div class="row">
    <!-- Card 1 - Total Mentions -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div
            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Mentions</p>
            <h4 class="mb-0"><?= count($youtube_data); ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder"> </span>Updated
          </p>
        </div>
      </div>
    </div>

    <!-- Card 2 - Total Likes -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div
            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Likes</p>
            <?php
            $overall_total_likes = 0;
            foreach ($youtube_data as $data) {
              $overall_total_likes += $data->like_count;
            }
            ?>
            <h4 class="mb-0"><?= $overall_total_likes; ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder"> </span>Updated
          </p>
        </div>
      </div>
    </div>

    <!-- Card 3 - Positive Mentions -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div
            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Positive Mentions</p>
            <h4 class="mb-0"><?= isset($total_positive_mentions_count) ? $total_positive_mentions_count : 'N/A'; ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-danger text-sm font-weight-bolder"></span> Updated
          </p>
        </div>
      </div>
    </div>


    <!-- Card 4 - Negative Mentions -->
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div
            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Negative Mentions</p>
            <h4 class="mb-0"> <?= isset($total_negative_mentions_count) ? $total_negative_mentions_count : 'N/A'; ?>
            </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder"> </span>Updated
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">

    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0">Total Mentions</h6>
          <p class="text-sm">Displaying all mentions per year.</p>
          <div class="form-group" hidden>
            <label for="keyword-dropdown">Keyword:</label>
            <select id="keywordDropdown" class="form-select">
              <option value="all">All</option>
              <option value="fiesta ready meal">Fiesta Ready Meal</option>
              <option value="fiesta ready to go">Fiesta Ready To Go</option>
              <option value="fiesta chicken nugget">Fiesta Chicken Nugget</option>
              <option value="fiesta crispy bubble">Fiesta Crispy Bubble</option>
              <option value="fiesta chicken sausage">Fiesta Chicken Sausage</option>
              <option value="fiesta tepung roti">Fiesta Tepung Roti</option>
              <option value="fiesta tepung bumbu">Fiesta Tepung Bumbu</option>
              <option value="fiesta bumbu racik">Fiesta Bumbu Racik</option>
              <option value="fiesta ready to eat">Fiesta Ready To Eat</option>
              <option value="fiesta ready to serve">Fiesta Ready To Serve</option>
              <option value="champ chicken nugget">Champ Chicken Nugget</option>
              <option value="champ sosis">Champ Sosis</option>
              <option value="okey nugget ayam">Okey Nugget Ayam</option>
              <option value="okey sosis">Okey Sosis</option>
              <option value="asimo nugget">Asimo Nugget</option>
              <option value="asimo sosis">Asimo Sosis</option>
              <option value="akumo nugget">Akumo Nugget</option>
              <option value="fiesta pizza">Fiesta Pizza</option>
              <option value="fiesta ramen">Fiesta Ramen</option>
              <option value="kanzler nugget">Kanzler Nugget</option>
              <option value="kanzler sosis">Kanzler Sosis</option>
              <option value="kanzler cordon bleu">Kanzler Cordon Bleu</option>
              <option value="kanzler singles">Kanzler Singles</option>
              <option value="kimbo sosis">Kimbo Sosis</option>
              <option value="so good crispy chicken nugget">So Good Crispy Chicken Nugget</option>
              <option value="so nice sosis premium">So Nice Sosis Premium</option>
              <option value="so nice sosis siap makan">So Nice Sosis Siap Makan</option>
              <option value="bellfoods">Bellfoods</option>
              <option value="sunny gold nugget">Sunny Gold Nugget</option>
              <option value="salam nugget ayam">Salam Nugget Ayam</option>
              <option value="salam sosis ayam">Salam Sosis Ayam</option>
              <option value="sasa tepung bumbu">Sasa Tepung Bumbu</option>
              <option value="bumbu racik indofood">Bumbu Racik Indofood</option>
              <option value="sosis gaga">Sosis gaga</option>
              <option value="kobe bumbu">Kobe Bumbu</option>
              <option value="kobe tepung">Kobe Tepung</option>
              <option value="laukita">Laukita</option>
              <option value="">Empty</option>
            </select>
          </div>
          <hr class="dark horizontal" />
          <div class="d-flex">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Updated dynamically.</p>
          </div>
        </div>
      </div>
    </div>


    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const keywordDropdown = document.getElementById("keywordDropdown");
        const ctx = document.getElementById("chart-bars").getContext("2d");

        let chart = null;

        function updateChart(keyword) {
          $.ajax({
            url: '<?= base_url("home/get_mentions_per_year") ?>',
            type: 'POST',
            data: { keyword: keyword }, // Send keyword value (all or specific)
            dataType: 'json',
            success: function (response) {
              console.log("API Response:", response); // Log the response

              if (Array.isArray(response)) {
                const years = response.map(item => item.year);
                const mentions = response.map(item => item.mentions);

                if (chart) {
                  chart.destroy();
                }

                chart = new Chart(ctx, {
                  type: "bar",
                  data: {
                    labels: years,
                    datasets: [{
                      label: "Mentions",
                      data: mentions,
                      backgroundColor: "rgba(255, 255, 255, .8)",
                      borderRadius: 4,
                      borderSkipped: false,
                      maxBarThickness: 6,
                    }],
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                      legend: { display: false },
                    },
                    scales: {
                      y: {
                        beginAtZero: true,
                        ticks: { color: "#fff" },
                        grid: { color: "rgba(255, 255, 255, .2)" },
                      },
                      x: {
                        ticks: { color: "#fff" },
                        grid: { color: "rgba(255, 255, 255, .2)" },
                      },
                    },
                  },
                });
              } else {
                console.error("Invalid response format:", response);
              }
            },
            error: function (xhr, status, error) {
              console.error("Error fetching data:", error);
            },
          });
        }

        keywordDropdown.addEventListener("change", function () {
          const selectedKeyword = this.value;
          updateChart(selectedKeyword); // Update chart for selected keyword
        });

        // Initialize chart for "all"
        updateChart("all");
      });

    </script>

    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0">Positive Mentions</h6>
          <p class="text-sm">
            Displaying positive mentions per year.
          </p>
          <div class="form-group" hidden>
            <label for="keywordDropdownFilter">Keyword:</label>
            <select id="keywordDropdownFilter" class="form-select">
              <option value="all">All</option>
              <option value="fiesta ready meal">Fiesta Ready Meal</option>
              <option value="fiesta ready to go">Fiesta Ready To Go</option>
              <option value="fiesta chicken nugget">Fiesta Chicken Nugget</option>
              <option value="fiesta crispy bubble">Fiesta Crispy Bubble</option>
              <option value="fiesta chicken sausage">Fiesta Chicken Sausage</option>
              <option value="fiesta tepung roti">Fiesta Tepung Roti</option>
              <option value="fiesta tepung bumbu">Fiesta Tepung Bumbu</option>
              <option value="fiesta bumbu racik">Fiesta Bumbu Racik</option>
              <option value="fiesta ready to eat">Fiesta Ready To Eat</option>
              <option value="fiesta ready to serve">Fiesta Ready To Serve</option>
              <option value="champ chicken nugget">Champ Chicken Nugget</option>
              <option value="champ sosis">Champ Sosis</option>
              <option value="okey nugget ayam">Okey Nugget Ayam</option>
              <option value="okey sosis">Okey Sosis</option>
              <option value="asimo nugget">Asimo Nugget</option>
              <option value="asimo sosis">Asimo Sosis</option>
              <option value="akumo nugget">Akumo Nugget</option>
              <option value="fiesta pizza">Fiesta Pizza</option>
              <option value="fiesta ramen">Fiesta Ramen</option>
              <option value="kanzler nugget">Kanzler Nugget</option>
              <option value="kanzler sosis">Kanzler Sosis</option>
              <option value="kanzler cordon bleu">Kanzler Cordon Bleu</option>
              <option value="kanzler singles">Kanzler Singles</option>
              <option value="kimbo sosis">Kimbo Sosis</option>
              <option value="so good crispy chicken nugget">So Good Crispy Chicken Nugget</option>
              <option value="so nice sosis premium">So Nice Sosis Premium</option>
              <option value="so nice sosis siap makan">So Nice Sosis Siap Makan</option>
              <option value="bellfoods">Bellfoods</option>
              <option value="sunny gold nugget">Sunny Gold Nugget</option>
              <option value="salam nugget ayam">Salam Nugget Ayam</option>
              <option value="salam sosis ayam">Salam Sosis Ayam</option>
              <option value="sasa tepung bumbu">Sasa Tepung Bumbu</option>
              <option value="bumbu racik indofood">Bumbu Racik Indofood</option>
              <option value="sosis gaga">Sosis gaga</option>
              <option value="kobe bumbu">Kobe Bumbu</option>
              <option value="kobe tepung">Kobe Tepung</option>
              <option value="laukita">Laukita</option>
              <option value="">Empty</option>
            </select>
          </div>
          <hr class="dark horizontal" />
          <div class="d-flex">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">updated dynamically</p>
          </div>
        </div>
      </div>
    </div>

    <script>
      const keywordDropdownFilter = document.getElementById('keywordDropdownFilter');
      const chartCanvas = document.getElementById('chart-line').getContext('2d');
      let chartInstance;

      function fetchAndUpdateChart(keyword = 'all') {
        const url = `<?= base_url('home/get_positive_mentions_per_year') ?>?keyword=${encodeURIComponent(keyword)}`;

        // Debug: Log the URL
        console.log('Fetching data from URL:', url);

        fetch(url)
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            // Debug: Log the data received
            console.log('Data received:', data);

            // Check if data is empty
            //if (!data || data.length === 0) {
            //  console.warn('No data available for the selected keyword:', keyword);
            //  alert('No data available for the selected keyword.');
            //  return;
            // }

            const years = data.map(item => item.year);
            const mentions = data.map(item => item.mentions);

            // If a chart already exists, destroy it before creating a new one
            if (chartInstance) {
              chartInstance.destroy();
            }

            chartInstance = new Chart(chartCanvas, {
              type: 'line',
              data: {
                labels: years,
                datasets: [{
                  label: `Positive Mentions (${keyword !== 'all' ? keyword : 'All'})`,
                  data: mentions,
                  borderColor: '#FFFFFF',
                  backgroundColor: 'rgba(40, 167, 69, 0.2)',
                  borderWidth: 2,
                  tension: 0.3
                }]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                  x: {
                    beginAtZero: true,
                    ticks: {
                      color: '#FFFFFF'
                    }
                  },
                  y: {
                    beginAtZero: true,
                    ticks: {
                      color: '#FFFFFF'
                    }
                  }
                },
                plugins: {
                  legend: {
                    labels: {
                      color: '#FFFFFF'
                    }
                  }
                }
              }
            });
          })
          .catch(error => {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching data. Please try again.');
          });
      }
      // Listen for dropdown changes and update the chart
      keywordDropdownFilter.addEventListener('change', event => {
        const selectedKeyword = event.target.value;
        console.log('Selected keyword:', selectedKeyword); // Debug
        fetchAndUpdateChart(selectedKeyword);
      });
      // Initial chart load
      fetchAndUpdateChart();
    </script>


    <div class="col-lg-4 mt-4 mb-3">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0">Negative Mentions</h6>
          <p class="text-sm">Displaying negative mentions per year.</p>
          <hr class="dark horizontal" />
          <div class="mb-3" hidden>
            <label for="product-filter" class="text-white">Filter by Product</label>
            <select id="product-filter" class="form-select" aria-label="Filter by product">
              <option value="all">All</option>
              <option value="fiesta ready meal">Fiesta Ready Meal</option>
              <option value="fiesta ready to go">Fiesta Ready To Go</option>
              <option value="fiesta chicken nugget">Fiesta Chicken Nugget</option>
              <option value="fiesta crispy bubble">Fiesta Crispy Bubble</option>
              <option value="fiesta chicken sausage">Fiesta Chicken Sausage</option>
              <option value="fiesta tepung roti">Fiesta Tepung Roti</option>
              <option value="fiesta tepung bumbu">Fiesta Tepung Bumbu</option>
              <option value="fiesta bumbu racik">Fiesta Bumbu Racik</option>
              <option value="fiesta ready to eat">Fiesta Ready To Eat</option>
              <option value="fiesta ready to serve">Fiesta Ready To Serve</option>
              <option value="champ chicken nugget">Champ Chicken Nugget</option>
              <option value="champ sosis">Champ Sosis</option>
              <option value="okey nugget ayam">Okey Nugget Ayam</option>
              <option value="okey sosis">Okey Sosis</option>
              <option value="asimo nugget">Asimo Nugget</option>
              <option value="asimo sosis">Asimo Sosis</option>
              <option value="akumo nugget">Akumo Nugget</option>
              <option value="fiesta pizza">Fiesta Pizza</option>
              <option value="fiesta ramen">Fiesta Ramen</option>
              <option value="kanzler nugget">Kanzler Nugget</option>
              <option value="kanzler sosis">Kanzler Sosis</option>
              <option value="kanzler cordon bleu">Kanzler Cordon Bleu</option>
              <option value="kanzler singles">Kanzler Singles</option>
              <option value="kimbo sosis">Kimbo Sosis</option>
              <option value="so good crispy chicken nugget">So Good Crispy Chicken Nugget</option>
              <option value="so nice sosis premium">So Nice Sosis Premium</option>
              <option value="so nice sosis siap makan">So Nice Sosis Siap Makan</option>
              <option value="bellfoods">Bellfoods</option>
              <option value="sunny gold nugget">Sunny Gold Nugget</option>
              <option value="salam nugget ayam">Salam Nugget Ayam</option>
              <option value="salam sosis ayam">Salam Sosis Ayam</option>
              <option value="sasa tepung bumbu">Sasa Tepung Bumbu</option>
              <option value="bumbu racik indofood">Bumbu Racik Indofood</option>
              <option value="sosis gaga">Sosis gaga</option>
              <option value="kobe bumbu">Kobe Bumbu</option>
              <option value="kobe tepung">Kobe Tepung</option>
              <option value="laukita">Laukita</option>
              <option value="">Empty</option>
            </select>
          </div>
          <div class="d-flex">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Updated dynamically</p>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Select the dropdown element for product filtering
      const productFilter = document.getElementById('product-filter');

      // Function to fetch and update the chart based on the selected product/keyword
      function fetchAndUpdateNegativeChart(product = 'all') {
        const url = `<?= base_url("home/get_negative_mentions_per_year") ?>?product_filter=${encodeURIComponent(product)}`;

        fetch(url)
          .then(response => response.json())
          .then(data => {
            console.log('Data received:', data); // Debugging log

            if (data.length === 0) {
              console.log('No data returned for this product.');
            }

            const years = data.map(item => item.year);
            const mentions = data.map(item => item.total_mentions);

            const ctx = document.getElementById('chart-line-tasks').getContext('2d');

            if (window.negativeChart) {
              window.negativeChart.destroy();
            }

            window.negativeChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: years,
                datasets: [{
                  label: `Negative Mentions (${product !== 'all' ? product : 'All'})`,
                  data: mentions,
                  fill: true,
                  backgroundColor: 'rgba(255, 255, 255, 0.2)',
                  borderColor: '#FFFFFF',
                  tension: 0.4
                }]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                  padding: 0
                },
                scales: {
                  x: {
                    ticks: { color: '#FFFFFF' }
                  },
                  y: {
                    ticks: { color: '#FFFFFF' }
                  }
                },
                plugins: {
                  legend: {
                    labels: { color: '#FFFFFF' }
                  },
                  tooltip: {
                    titleColor: '#FFFFFF',
                    bodyColor: '#FFFFFF'
                  }
                }
              }
            });
          })
          .catch(error => console.error('Error fetching negative mentions data:', error));
      }

      // Fetch data when the page loads with the default "all" value
      fetchAndUpdateNegativeChart('all');

      // Update chart when dropdown selection changes
      productFilter.addEventListener('change', (e) => {
        const selectedProduct = e.target.value;
        fetchAndUpdateNegativeChart(selectedProduct);
      });
    </script>
  </div>

  <div class="row mb-4">
  <div class="container-fluid mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <div>
            <h6>BIG DATA CORE</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-check text-info" aria-hidden="true"></i>
              <span class="font-weight-bold ms-1"></span><?= count($youtube_data); ?> rows data
            </p>
          </div>
          <div class="col-md-2">
            <select id="entries-dropdown" class="form-control">
              <option value="10">Show 10 entries</option>
              <option value="25">Show 25 entries</option>
              <option value="50">Show 50 entries</option>
              <option value="100">Show 100 entries</option>
              <option value="1000">Show 1000 entries</option>
              <option value="10000">Show 10000 entries</option>
            </select>
          </div>
        </div>

        <div class="card-body px-0 pb-2">
          <!-- Filter Section -->
          <div class="filter-container mb-3 px-3">
            <div class="row g-3">
              <div class="col-md-3">
                <select class="form-control filter-input" data-column="keyword">
                  <option value="all">All</option>
                  <option value="fiesta ready meal">Fiesta Ready Meal</option>
                  <option value="fiesta ready to go">Fiesta Ready To Go</option>
                  <option value="fiesta chicken nugget">Fiesta Chicken Nugget</option>
                  <option value="fiesta crispy bubble">Fiesta Crispy Bubble</option>
                  <option value="fiesta chicken sausage">Fiesta Chicken Sausage</option>
                  <option value="fiesta tepung roti">Fiesta Tepung Roti</option>
                  <option value="fiesta tepung bumbu">Fiesta Tepung Bumbu</option>
                  <option value="fiesta bumbu racik">Fiesta Bumbu Racik</option>
                  <option value="fiesta ready to eat">Fiesta Ready To Eat</option>
                  <option value="fiesta ready to serve">Fiesta Ready To Serve</option>
                  <option value="champ chicken nugget">Champ Chicken Nugget</option>
                  <option value="champ sosis">Champ Sosis</option>
                  <option value="okey nugget ayam">Okey Nugget Ayam</option>
                  <option value="okey sosis">Okey Sosis</option>
                  <option value="asimo nugget">Asimo Nugget</option>
                  <option value="asimo sosis">Asimo Sosis</option>
                  <option value="akumo nugget">Akumo Nugget</option>
                  <option value="fiesta pizza">Fiesta Pizza</option>
                  <option value="fiesta ramen">Fiesta Ramen</option>
                  <option value="kanzler nugget">Kanzler Nugget</option>
                  <option value="kanzler sosis">Kanzler Sosis</option>
                  <option value="kanzler cordon bleu">Kanzler Cordon Bleu</option>
                  <option value="kanzler singles">Kanzler Singles</option>
                  <option value="kimbo sosis">Kimbo Sosis</option>
                  <option value="so good crispy chicken nugget">So Good Crispy Chicken Nugget</option>
                  <option value="so nice sosis premium">So Nice Sosis Premium</option>
                  <option value="so nice sosis siap makan">So Nice Sosis Siap Makan</option>
                  <option value="bellfoods">Bellfoods</option>
                  <option value="sunny gold nugget">Sunny Gold Nugget</option>
                  <option value="salam nugget ayam">Salam Nugget Ayam</option>
                  <option value="salam sosis ayam">Salam Sosis Ayam</option>
                  <option value="sasa tepung bumbu">Sasa Tepung Bumbu</option>
                  <option value="bumbu racik indofood">Bumbu Racik Indofood</option>
                  <option value="sosis gaga">Sosis gaga</option>
                  <option value="kobe bumbu">Kobe Bumbu</option>
                  <option value="kobe tepung">Kobe Tepung</option>
                  <option value="laukita">Laukita</option>
                  <option value="">Keyword</option>
                </select>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control filter-input" data-column="author" placeholder="Author">
              </div>
              <div class="col-md-3">
                <input type="date" class="form-control filter-input" data-column="date" placeholder="Date" hidden>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control filter-input" data-column="likes" placeholder="Likes">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control filter-input" data-column="text" placeholder="Text">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control filter-input" data-column="video_id" placeholder="Video ID">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control filter-input" data-column="title" placeholder="Title">
              </div>
              <!-- Date range filter -->
              <div class="col-md-3">
                <input type="date" class="form-control filter-input" data-column="start_date" placeholder="Start Date">
              </div>
              <div class="col-md-3">
                <input type="date" class="form-control filter-input" data-column="end_date" placeholder="End Date">
              </div>

              <div class="col-md-3 d-flex gap-2">
                <button id="search-button" class="btn btn-primary w-100">Search</button>
                <button id="reset-button" class="btn btn-secondary w-100">Reset</button>
              </div>
            </div>
          </div>
          <!-- Table Section -->
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Keyword</th>
                  <th>Author</th>
                  <th>Updated At</th>
                  <th>
                    Like Count
                    <button class="sort-btn" data-column="like_count" data-direction="asc">↑</button>
                    <button class="sort-btn" data-column="like_count" data-direction="desc">↓</button>
                  </th>
                  <th>Text</th>
                  <th>Video ID</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th>Public</th>
                </tr>
              </thead>
              <tbody id="youtube-data">
                <!-- Data will be dynamically loaded here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  const defaultEntries = 10; // Default number of entries to display
  let filters = {};
  let entries = defaultEntries;
  let youtubeData = []; // Store fetched data for sorting

  // Fetch data function
  function fetchData() {
    filters['limit'] = entries; // Include limit in filters

    console.log("Filters being sent to server:", filters); // Debug log to check filter values

    $.ajax({
      url: '<?= base_url("core/fetch_youtube_data"); ?>',
      method: 'GET',
      data: filters,
      dataType: 'json',
      success: function (data) {
        youtubeData = data; // Store the fetched data
        renderTable(youtubeData); // Render the initial table
      },
      error: function (xhr, status, error) {
        console.error("An error occurred:", error);
      }
    });
  }

  // Render table function
  // Render table function
function renderTable(data) {
  let tbody = '';
  data.forEach((item, index) => {
    const youtubeLink = item.video_id
      ? `<a href="https://www.youtube.com/watch?v=${item.video_id}" target="_blank">Watch Video</a>`
      : 'No Video';

    tbody += `
      <tr>
        <td>${index + 1}</td>
        <td>${item.keyword || ''}</td>
        <td>${item.author || ''}</td>
        <td>${item.updated_at || ''}</td>
        <td>${item.like_count || ''}</td>
        <td>${item.text || ''}</td>
        <td>${item.video_id || ''}</td>
        <td>${item.title || ''}</td>
        <td>${youtubeLink}</td> <!-- YouTube Link Column -->
        <td>${item.public == 1 ? 'Yes' : 'No'}</td>
      </tr>
    `;
  });
  $('#youtube-data').html(tbody);
}


  // Handle sorting
  $(document).on('click', '.sort-btn', function () {
    const column = $(this).data('column'); // The column to sort (like_count)
    const direction = $(this).data('direction'); // The sort direction (asc or desc)

    youtubeData.sort((a, b) => {
      const valueA = parseInt(a[column]) || 0;
      const valueB = parseInt(b[column]) || 0;

      if (direction === 'asc') {
        return valueA - valueB;
      } else {
        return valueB - valueA;
      }
    });

    renderTable(youtubeData); // Re-render the table with sorted data
  });

  // Handle entries dropdown change
  $('#entries-dropdown').on('change', function () {
    entries = $(this).val();
    fetchData(); // Fetch data with the new limit
  });

  // Handle search button click
  $('#search-button').on('click', function () {
    filters = {}; // Reset filters

    // Collect filter values
    $('.filter-input').each(function () {
      const column = $(this).data('column');
      const value = $(this).val().trim();

      // Check if the filter is "All" and skip adding it to filters
      if (value && value.toLowerCase() !== 'all') {
        filters[column] = value; // Only include non-empty and non-"All" filters
      }
    });

    // Collect start_date and end_date specifically and add them to filters
    const startDate = $('input[data-column="start_date"]').val().trim();
    const endDate = $('input[data-column="end_date"]').val().trim();
    
    if (startDate) {
      filters['start_date'] = startDate;
    }
    if (endDate) {
      filters['end_date'] = endDate;
    }

    console.log("Filters after collecting input values:", filters); // Debug log to check filter values

    fetchData(); // Fetch filtered data
  });

  // Handle reset button click
  $('#reset-button').on('click', function () {
    // Clear all filter inputs
    $('.filter-input').val('');

    // Reset filters to default
    filters = {};
    entries = defaultEntries; // Reset entries to default value
    $('#entries-dropdown').val(defaultEntries); // Reset dropdown to default value

    fetchData(); // Fetch default unfiltered data
  });

  // Initial load
  fetchData();
});
</script>



    <div class="row">
      <div class="col-md-6 mt-2">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Top 10 Liked Comments</h6>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group" id="comment-list">
              <?php
              // Filter comments that contain the keywords "sosis", "nugget", or "bumbu"
              $filtered_comments = array_filter($youtube_data, function ($comment) {
                return strpos(strtolower($comment->text), 'sosis') !== false ||
                  strpos(strtolower($comment->text), 'nugget') !== false ||
                  strpos(strtolower($comment->text), 'bumbu') !== false;
              });

              // Sort filtered comments by like_count in descending order
              usort($filtered_comments, function ($a, $b) {
                return $b->like_count - $a->like_count;
              });

              // Encode the filtered comments as JSON for JavaScript use
              $top_comments = array_slice($filtered_comments, 0, 10);
              echo "<script>var commentsData = " . json_encode($top_comments) . ";</script>";
              ?>
            </ul>
            <div class="d-flex justify-content-between mt-3">
              <button class="btn btn-primary" id="prevBtn" disabled>Back</button>
              <button class="btn btn-primary" id="nextBtn">Next</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        var commentsPerPage = 5;
        var currentPage = 1;

        // Function to render comments for the current page
        function renderComments() {
          var commentList = document.getElementById("comment-list");
          commentList.innerHTML = ""; // Clear current comments

          // Calculate the start and end indices for the current page
          var start = (currentPage - 1) * commentsPerPage;
          var end = start + commentsPerPage;
          var paginatedComments = commentsData.slice(start, end);

          // Render each comment in the current page
          paginatedComments.forEach(function (comment) {
            var listItem = document.createElement("li");
            listItem.className = "list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg";
            listItem.innerHTML = `
        <div class="d-flex flex-column">
          <h6 class="mb-3 text-sm">${comment.author}</h6>
          <span class="mb-2 text-xs">Comment: <span class="text-dark font-weight-bold ms-sm-2">${comment.text}</span></span>
          <span class="mb-2 text-xs">Video Title: <span class="text-dark ms-sm-2 font-weight-bold">${comment.title}</span></span>
          <span class="mb-2 text-xs">Keyword: <span class="text-dark ms-sm-2 font-weight-bold">${comment.keyword}</span></span>
          <span class="mb-2 text-xs">Updated At: <span class="text-dark ms-sm-2 font-weight-bold">${comment.updated_at}</span></span>
          <span class="text-xs">Likes: <span class="text-dark ms-sm-2 font-weight-bold">${comment.like_count}</span></span>
        </div>
      `;
            commentList.appendChild(listItem);
          });

          // Handle button states
          document.getElementById("prevBtn").disabled = (currentPage === 1);
          document.getElementById("nextBtn").disabled = (end >= commentsData.length);
        }

        // Add event listeners for pagination buttons
        document.getElementById("nextBtn").addEventListener("click", function () {
          currentPage++;
          renderComments();
        });

        document.getElementById("prevBtn").addEventListener("click", function () {
          currentPage--;
          renderComments();
        });

        // Initial render
        renderComments();
      </script>

      <!-- ----------------------------------------------------------------------------------- -->

      <div class="col-md-6 mt-2">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Positive & Negative Mentions</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                <i class="material-icons me-2 text-lg">date_range</i>
                <small><?= date('j F Y'); ?></small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Positive Mentions</h6>
            <ul class="list-group">

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Enak</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + <?= $enak ?> comments
                </div>
              </li>


              <!-- Updated list item with "lezat" count -->
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Lezat</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + <?= $lezat ?> comments
                </div>
              </li>

              <!-- Updated list item with "menarik" count -->
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Menarik</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + <?= $menarik ?> comments
                </div>
              </li>


              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Kenyal</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + <?= $kenyal ?> comments
                </div>
              </li>


              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Hemat</h6>
                    <span class="text-xs"><?= date("d F Y, at h:i A"); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + <?= $hemat ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Terjangkau</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  <?= $terjangkau ?> comments
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Praktis</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  <?= $praktis ?> comments
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Puas</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  <?= $puas ?> comments
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('positive_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_less</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Mantap</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  <?= $mantap ?> comments
              </li>
            </ul>
            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Negative Mentions</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Enak</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_enak ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Menarik</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_menarik ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Lezat</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_lezat ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Kenyal (Keras)</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_kenyal ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Hemat</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_hemat ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Terjangkau</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_terjangkau ?> comments
                </div>
              </li>

              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Praktis</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_praktis ?> comments
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Puas</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_puas ?> comments
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <a href="<?php echo base_url('negative_mentions'); ?>">
                    <button
                      class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                      <i class="material-icons text-lg">expand_more</i>
                    </button>
                  </a>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tidak Mantap</h6>
                    <span class="text-xs"><?= date('d F Y, \a\t h:i A'); ?></span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  -<?= $tidak_mantap ?> comments
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <br>
    <!-- ------------------------  END ------------------------------------ -->

    <div class="container" style="background-color: white; padding: 20px; border-radius: 5px;">
      <div class="row">
        <!-- PT Charoen Pokphand Filter -->
        <div class="col-md-6 mb-3">
          <label for="ptKeywordFilter">Filter PT Charoen Pokphand:</label>
          <input type="text" id="ptKeywordFilter" placeholder="Enter keyword" onkeyup="filterPTTable()">
        </div>

        <!-- Competitor Filter -->
        <div class="col-md-6 mb-3">
          <label for="competitorKeywordFilter">Filter Competitor:</label>
          <input type="text" id="competitorKeywordFilter" placeholder="Enter keyword" onkeyup="filterCompetitorTable()">
        </div>
      </div>

      <div class="row">
        <!-- PT Charoen Pokphand Table -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header pb-0">
              <h6>PT Charoen Pokphand</h6>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Keyword (Total Likes)</th>
                      <th>Mentions</th>
                      <th>Positive Mentions</th>
                      <th>Negative Mentions</th>
                    </tr>
                  </thead>
                  <tbody id="ptTableBody">
                    <?php foreach ($pt_keywords as $keyword): ?>
                      <?php
                      $keyword_text = trim(strtolower($keyword->keyword));
                      $total_mentions = 0;
                      foreach ($keyword_counts as $count) {
                        if ($count->keyword == $keyword_text) {
                          $total_mentions = $count->total_mentions;
                          break;
                        }
                      }
                      $like_value = isset($total_likes[$keyword_text]) ? $total_likes[$keyword_text] : 0;
                      $positive_mentions_count = isset($positive_mentions[$keyword_text]) ? $positive_mentions[$keyword_text] : 0;
                      $negative_mentions_count = isset($negative_mentions[$keyword_text]) ? $negative_mentions[$keyword_text] : 0;
                      ?>
                      <tr>
                        <td><?= htmlspecialchars($keyword_text); ?> (<?= htmlspecialchars($like_value); ?>)</td>
                        <td class="text-center"><?= htmlspecialchars($total_mentions); ?></td>
                        <td class="text-center"><?= htmlspecialchars($positive_mentions_count); ?></td>
                        <td class="text-center"><?= htmlspecialchars($negative_mentions_count); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Competitor Table -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Competitor</h6>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Keyword (Total Likes)</th>
                      <th>Mentions</th>
                      <th>Positive Mentions</th>
                      <th>Negative Mentions</th>
                    </tr>
                  </thead>
                  <tbody id="competitorTableBody">
                    <?php if (is_array($competitor_keywords) && !empty($competitor_keywords)): ?>
                      <?php foreach ($competitor_keywords as $keyword): ?>
                        <?php
                        $keyword_text = trim(strtolower($keyword->keyword));

                        // Get total mentions for this keyword
                        $total_mentions = 0;
                        foreach ($competitor_keyword_mentions as $mention) {
                          if ($mention->keyword == $keyword_text) {
                            $total_mentions = $mention->total_mentions;
                            break;
                          }
                        }

                        // Get positive mentions for this keyword
                        $positive_mentions_count = isset($competitor_positive_mentions[$keyword_text]) ? $competitor_positive_mentions[$keyword_text] : 0;

                        // Get negative mentions for this keyword
                        $negative_mentions_count = isset($competitor_negative_mentions[$keyword_text]) ? $competitor_negative_mentions[$keyword_text] : 0;
                        ?>
                        <tr>
                          <td><?= htmlspecialchars($keyword_text); ?>
                            (<?= isset($total_likes[$keyword_text]) ? htmlspecialchars($total_likes[$keyword_text]) : 0; ?>)
                          </td>
                          <td class="text-center"><?= htmlspecialchars($total_mentions); ?></td>
                          <td class="text-center"><?= htmlspecialchars($positive_mentions_count); ?></td>
                          <td class="text-center"><?= htmlspecialchars($negative_mentions_count); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4">No data available</td>
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
    <script>
      function filterPTTable() {
        const filter = document.getElementById('ptKeywordFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#ptTableBody tr');

        rows.forEach(row => {
          const keywordCell = row.cells[0].textContent.toLowerCase();
          row.style.display = keywordCell.includes(filter) ? '' : 'none';
        });
      }

      function filterCompetitorTable() {
        const filter = document.getElementById('competitorKeywordFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#competitorTableBody tr');

        rows.forEach(row => {
          const keywordCell = row.cells[0].textContent.toLowerCase();
          row.style.display = keywordCell.includes(filter) ? '' : 'none';
        });
      }
    </script>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">TAG & TRENDING (FYP) VIDEO ANALYSIS</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <!-- Search Input for Keyword Filter -->
              <div class="p-3">
                <input type="text" id="keywordSearch" class="form-control" placeholder="Search by Keyword..."
                  onkeyup="filterTable()">
              </div>

              <div class="table-responsive p-0" style="max-height: 400px; overflow-y: auto;">
                <table class="table align-items-center mb-0 table-hover" id="videoAnalysisTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KEYWORD</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CHANNEL NAME
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">VIDEO TITLE
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                        onclick="sortTable(3)">
                        TOTAL VIEW <span id="totalViewSortIndicator" class="sort-indicator"></span>
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                        onclick="sortTable(4)">
                        VIDEO LIKE <span id="videoLikeSortIndicator" class="sort-indicator"></span>
                      </th>

                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        ENGAGEMENT RATE</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        SUBSCRIBERS</th>
                      <th class="text-center text-secondary opacity-7">TAG & TRENDING</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($keyword_analyze)): ?>
                      <?php foreach ($keyword_analyze as $item): ?>
                        <tr>
                          <td><?= htmlspecialchars($item['keyword']); ?></td>
                          <td><?= isset($item['channel_name']) ? htmlspecialchars($item['channel_name']) : 'No Channel'; ?>
                          </td>
                          <td><?= isset($item['title']) ? htmlspecialchars($item['title']) : 'No Title'; ?></td>

                          <td class="text-center">
                            <?= isset($item['total_views']) ? htmlspecialchars($item['total_views']) : 'No Views'; ?>
                          </td>
                          <td class="text-center">
                            <?= isset($item['video_id_like']) ? htmlspecialchars($item['video_id_like']) : 'No Like'; ?>
                          </td>
                          <td class="text-center">
                            <?= isset($item['engagement_rate']) ? htmlspecialchars($item['engagement_rate']) : 'No Engagement Rate'; ?>
                          </td>
                          <td class="text-center">
                            <?= isset($item['subscriber_count']) ? htmlspecialchars($item['subscriber_count']) : 'No subscriber'; ?>
                          </td>
                          <td class="text-center">
                            <a href="javascript:;" class="btn btn-primary btn-sm font-weight-bold text-xs"
                              data-bs-toggle="modal" data-bs-target="#tagModal"
                              data-keyword="<?= htmlspecialchars($item['keyword']); ?>"
                              data-tags="<?= htmlspecialchars($item['tags']); ?>"
                              data-total-views="<?= htmlspecialchars($item['total_views']); ?>"
                              data-engagement-rate="<?= htmlspecialchars($item['engagement_rate']); ?>"
                              data-video-id="<?= htmlspecialchars($item['video_id']); ?>"
                              data-video-id-like="<?= htmlspecialchars($item['video_id_like']); ?>">ANALYZE</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">No keywords found.</td>
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
    <style>
      .sort-indicator::after {
        content: "";
        display: inline-block;
        margin-left: 5px;
        border: 5px solid transparent;
      }

      .sort-indicator.asc::after {
        border-bottom: 5px solid #000;
      }

      .sort-indicator.desc::after {
        border-top: 5px solid #000;
      }


      .table tbody tr {
        transition: background-color 0.3s;
      }

      .table tbody tr:hover {
        background-color: #f1f1f1;
      }
    </style>
    <script>
      let currentSortOrder = {
        totalViews: "asc",
        videoLikes: "asc"
      };

      function sortTable(columnIndex) {
        const table = document.getElementById("videoAnalysisTable");
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);

        // Determine the new sort order for the clicked column
        if (columnIndex === 3) {
          currentSortOrder.totalViews = currentSortOrder.totalViews === "asc" ? "desc" : "asc";
        } else if (columnIndex === 4) {
          currentSortOrder.videoLikes = currentSortOrder.videoLikes === "asc" ? "desc" : "asc";
        }

        // Perform sorting
        rows.sort((a, b) => {
          const aValue = parseInt(a.cells[columnIndex].textContent.replace(/,/g, "")) || 0; // Remove commas and parse
          const bValue = parseInt(b.cells[columnIndex].textContent.replace(/,/g, "")) || 0;

          if (columnIndex === 3) {
            return currentSortOrder.totalViews === "asc" ? aValue - bValue : bValue - aValue;
          } else if (columnIndex === 4) {
            return currentSortOrder.videoLikes === "asc" ? aValue - bValue : bValue - aValue;
          }
        });

        // Remove existing rows
        tbody.innerHTML = "";

        // Re-append sorted rows
        rows.forEach(row => tbody.appendChild(row));

        // Update sort indicator
        updateSortIndicator(columnIndex);
      }

      function updateSortIndicator(columnIndex) {
        const totalViewIndicator = document.getElementById("totalViewSortIndicator");
        const videoLikeIndicator = document.getElementById("videoLikeSortIndicator");

        // Reset all indicators
        totalViewIndicator.className = "sort-indicator";
        videoLikeIndicator.className = "sort-indicator";

        // Add appropriate class to the current column
        if (columnIndex === 3) {
          totalViewIndicator.classList.add(currentSortOrder.totalViews);
        } else if (columnIndex === 4) {
          videoLikeIndicator.classList.add(currentSortOrder.videoLikes);
        }
      }

      function filterTable() {
        const searchInput = document.getElementById("keywordSearch").value.toLowerCase();
        const table = document.getElementById("videoAnalysisTable");
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);

        rows.forEach(row => {
          const keywordCell = row.cells[0].textContent.toLowerCase();
          row.style.display = keywordCell.includes(searchInput) ? "" : "none";
        });
      }
    </script>

    <!-- Modal Structure for Tag Analysis -->
    <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tagModalLabel">
              <i class="fas fa-tags"></i> Video Tags & Analysis
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- YouTube Video Section -->
            <div class="video-section mb-4">
              <h6><i class="fas fa-video"></i> Video:</h6>
              <iframe id="videoIframe" width="100%" height="315" src="" frameborder="0" allowfullscreen></iframe>
            </div>
            <!-- Video Tags Section -->
            <div class="tags-section mb-4">
              <h6><i class="fas fa-list"></i> Tags:</h6>
              <p id="modalTagsContent" class="badge bg-info text-wrap">No tags available yet.</p>
            </div>
            <!-- Trending Status Section -->
            <div class="trending-status mb-4">
              <h6><i class="fas fa-chart-line"></i> Trending Status:</h6>
              <div class="d-flex align-items-center">
                <i id="trendingIcon" class="fas fa-fire text-danger" style="font-size: 24px;"></i>
                <p id="trendingStatus" class="ms-2">Calculating...</p>
              </div>
            </div>
            <!-- Progress Bars for Each Score -->
            <div class="scores-section mb-4">
              <h6><i class="fas fa-calculator"></i> Score Breakdown:</h6>
              <!-- Engagement Rate Score -->
              <div class="mb-2">
                <label for="engagementRateScore">Engagement Rate Score</label>
                <div class="progress">
                  <div id="engagementRateProgress" class="progress-bar bg-success" role="progressbar" style="width: 0%"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0</div>
                </div>
              </div>
              <!-- Total Views Score -->
              <div class="mb-2">
                <label for="totalViewsScore">Total Views Score</label>
                <div class="progress">
                  <div id="totalViewsProgress" class="progress-bar bg-info" role="progressbar" style="width: 0%"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0</div>
                </div>
              </div>
              <!-- Likes Score -->
              <div class="mb-2">
                <label for="videoIdLikeScore">Likes Score</label>
                <div class="progress">
                  <div id="videoIdLikeProgress" class="progress-bar bg-warning" role="progressbar" style="width: 0%"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0</div>
                </div>
              </div>
            </div>
            <!-- Collapsible Calculation Details -->
            <div class="calculation-details">
              <button class="btn btn-outline-primary w-100 mb-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#calculationDetails" aria-expanded="false" aria-controls="calculationDetails">
                <i class="fas fa-info-circle"></i> Show Calculation Process
              </button>
              <div class="collapse" id="calculationDetails">
                <div class="card card-body">
                  <strong>Calculation Process:</strong><br>
                  <div id="calculationProcessContent">Loading...</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript to filter table by keyword and update modal content dynamically -->
    <script>
      // Keyword filtering logic
      // Add event listener to handle modal data population
      document.querySelectorAll('[data-bs-target="#tagModal"]').forEach(function (button) {
        button.addEventListener('click', function () {
          var keyword = this.getAttribute('data-keyword');
          var tags = this.getAttribute('data-tags');
          var totalViews = parseInt(this.getAttribute('data-total-views')) || 0;
          var engagementRate = parseFloat(this.getAttribute('data-engagement-rate')) || 0;
          var videoIdLike = parseInt(this.getAttribute('data-video-id-like')) || 0;
          var videoId = this.getAttribute('data-video-id'); // Get video ID for embedding
          // Set the iframe source to the YouTube video
          document.getElementById('videoIframe').src = `https://www.youtube.com/embed/${videoId}`;
          // Calculate trending score components
          var engagementRateScore = engagementRate * 0.5;
          var totalViewsScore = totalViews * 0.3;
          var videoIdLikeScore = videoIdLike * 0.2;
          var trendingScore = engagementRateScore + totalViewsScore + videoIdLikeScore;
          var trendingStatus = trendingScore > 1000 ? "Trending" : "Not Trending"; // Example threshold
          var trendingIconClass = trendingScore > 1000 ? "fas fa-fire text-danger" : "fas fa-times-circle text-secondary";
          // Populate the modal with the tags, trending status, and calculation details
          document.getElementById('tagModalLabel').innerText = "Tags & Analysis for " + keyword;
          document.getElementById('modalTagsContent').innerText = tags;
          document.getElementById('trendingStatus').innerText = trendingStatus;
          document.getElementById('trendingIcon').className = trendingIconClass;
          // Animate the progress bars
          document.getElementById('engagementRateProgress').style.width = (engagementRateScore * 10) + "%";
          document.getElementById('engagementRateProgress').innerText = engagementRateScore.toFixed(2);
          document.getElementById('totalViewsProgress').style.width = (totalViewsScore * 10) + "%";
          document.getElementById('totalViewsProgress').innerText = totalViewsScore.toFixed(2);
          document.getElementById('videoIdLikeProgress').style.width = (videoIdLikeScore * 10) + "%";
          document.getElementById('videoIdLikeProgress').innerText = videoIdLikeScore.toFixed(2);

          // Fill the calculation process section
          document.getElementById('calculationProcessContent').innerHTML = `
      Engagement Rate Score: ${engagementRate} * 0.5 = ${engagementRateScore.toFixed(2)}<br>
      Total Views Score: ${totalViews} * 0.3 = ${totalViewsScore.toFixed(2)}<br>
      Likes Score: ${videoIdLike} * 0.2 = ${videoIdLikeScore.toFixed(2)}<br>
      <strong>Final Trending Score:</strong> ${engagementRateScore.toFixed(2)} + ${totalViewsScore.toFixed(2)} + ${videoIdLikeScore.toFixed(2)} = ${trendingScore.toFixed(2)}<br>
      Threshold: 1000<br>
      <strong>Trending Status:</strong> ${trendingStatus}
    `;
        });
      });
    </script>

    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('<?= base_url() ?>assets/img/background1.avif');">

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
                Video / Marketing Optimization
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Tags Solution</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="javascript:;">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                          data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    Tags Solution fetches and analyzes the most optimized tags based on views and audience reach.
                  </p>
                  <hr class="horizontal gray-light my-4">
                  <p><strong>Top 10 Tags:</strong>
                    <?php echo !empty($optimized_tags) ? implode(', ', array_slice($optimized_tags, 0, 10)) : 'No tags found.'; ?>
                  </p>

                  <!-- Calculation Details Section -->
                  <div class="calculation-details mt-4">
                    <h6><strong>Calculation Method:</strong></h6>
                    <p>The top 10 optimized tags are determined based on the following formula:</p>
                    <p><strong>Score = (Total Views + Engagement Rate)</strong></p>
                    <p>This means that each tag is scored by adding its total views to its engagement rate. The tags are
                      then sorted based on their scores to identify the top 10 optimized tags.</p>
                  </div>
                </div>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-youtube btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-youtube fa-lg"></i>
                  </a>
                </li>
              </div>
            </div>

            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Top 5 Titles</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    Here are the top 5 titles based on total views:
                  </p>
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <?php if (!empty($top_titles)): ?>
                      <?php foreach ($top_titles as $row): ?>
                        <li class="list-group-item"><?= htmlspecialchars($row['title']); ?></li>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <li class="list-group-item">No titles available.</li>
                    <?php endif; ?>
                  </ul>
                </div>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-youtube btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-youtube fa-lg"></i>
                  </a>
                </li>
              </div>
            </div>

            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Market Research</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="javascript:;">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                          data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    I am too lazy doing market research, because why should I crawl a website that already in public
                    state and give you all the data ?, just ask my bestpal CPI AI here, say hi to my friend. He can
                    give you a public informations.
                  </p>
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 text-sm">
                      <strong>Ask CPI AI:</strong>
                    </li>
                    <li class="list-group-item border-0 ps-0 pb-0">
                      <a href="#gemini-chat" class="btn btn-primary">Ask</a>
                    </li>
                  </ul>
                  <hr class="horizontal gray-light my-4">
                </div>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-youtube btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-youtube fa-lg"></i>
                  </a>
                </li>
              </div>
            </div>
            <script>
              document.querySelector('a[href="#gemini-chat"]').addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector('#gemini-chat');
                target.scrollIntoView({ behavior: 'smooth' });
              });
            </script>

          </div>
        </div>
      </div>
    </div>




  </div>
</div>


<script>
  // JavaScript to synchronize multiple dropdowns
  document.querySelector('.filter-input').addEventListener('change', function () {
    var selectedValue = this.value;

    // Update the second dropdown to match the first one
    var secondDropdown = document.getElementById('keywordDropdown');
    secondDropdown.value = selectedValue;

    // Update the third dropdown (keywordDropdownFilter) to match the first one
    var thirdDropdown = document.getElementById('keywordDropdownFilter');
    thirdDropdown.value = selectedValue;

    // Update the fourth dropdown (product-filter) to match the first one
    var productFilterDropdown = document.getElementById('product-filter');
    productFilterDropdown.value = selectedValue;

    // Trigger the change event on the second dropdown to simulate a click
    var event = new Event('change');
    secondDropdown.dispatchEvent(event);

    // Trigger the change event on the third dropdown to simulate a click
    thirdDropdown.dispatchEvent(event);

    // Trigger the change event on the product-filter dropdown to simulate a click
    productFilterDropdown.dispatchEvent(event);
  });
</script>


<link rel=" apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png" />
<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png" />

<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="<?= base_url() ?>assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

<!--   Core JS Files   -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (with Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script src=".<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>

<script>
  var win = navigator.platform.indexOf("Win") > -1;
  if (win && document.querySelector("#sidenav-scrollbar")) {
    var options = {
      damping: "0.5",
    };
    Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>

<style>
  /* Hover effect for input fields */
  input[type="text"]:hover,
  input[type="date"]:hover,
  input[type="number"]:hover,
  select:hover {
    border-color: #e91e63;
    /* Change border color on hover */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Add a subtle glow/shadow */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    /* Smooth transition */
  }

  .table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.1);
    /* Change to desired color */
  }
</style>
<script>
  const BASE_URL = '<?= base_url() ?>';
</script>

<!-- Chat Widget -->
<div class="chat-widget">
  <div class="chat-header" onclick="toggleChat()">
    <h5>AI Chat Widget</h5>
    <span id="toggle-icon">▼</span>
  </div>
  <div class="chat-body">
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
            AI Chat With CPI AI
          </p>
        </div>
      </div>
    </div>
    <div class="row">    
      <!-- Chat List / Container -->
      <div class="chat-list"></div>
      <!-- Typing Area -->
      <div class="typing-area">
        <form action="#" class="typing-form">
          <div class="input-wrapper">
            <input type="text" placeholder="Enter a prompt here" class="typing-input" required />
            <button id="send-message-button" class="icon material-symbols-rounded">send</button>
          </div>
          <div class="action-buttons">
            <span id="theme-toggle-button" class="icon material-symbols-rounded">light_mode</span>
            <span id="delete-chat-button" class="icon material-symbols-rounded">delete</span>
          </div>
        </form>
        <p class="disclaimer-text">
          AI may display inaccurate info, including about people, so double-check its responses.
        </p>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="<?= base_url() ?>assets/gemini-chatbot/style.css">
<script src="<?= base_url() ?>assets/gemini-chatbot/script.js"></script>

<script>
  function toggleChat() {
    const chatBody = document.querySelector('.chat-body');
    const toggleIcon = document.getElementById('toggle-icon');

    if (chatBody.style.display === 'flex') {
      chatBody.style.display = 'none';
      toggleIcon.textContent = '▼';
    } else {
      chatBody.style.display = 'flex';
      toggleIcon.textContent = '▲';
    }
  }
</script>

<style>
  /* General chat widget styles */
  .chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    overflow: hidden;
    z-index: 1000;
    background-color: #ffffff;
  }

  /* Chat header styling */
  .chat-header {
    background-color: #E0115F;
    color: white;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
  }

  /* Header title */
  .chat-header h5 {
    margin: 0;
    font-size: 16px;
  }

  /* Chat body container */
  .chat-body {
    display: none;
    flex-direction: column;
    max-height: 400px;
    overflow-y: auto;
    border-top: 1px solid #ddd;
    background-color: #f9f9f9;
  }

  /* Suggestion list */
  .suggestion-list {
    list-style: none;
    padding: 0;
  }

  .suggestion {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  /* Typing input and button */
  .typing-form {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #f1f1f1;
    border-top: 1px solid #ddd;
  }

  .typing-input {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  .typing-form button {
    margin-left: 10px;
    padding: 10px 15px;
    background-color: #E0115F;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .typing-form button:hover {
    background-color: #0056b3;
  }
</style>
