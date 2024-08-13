<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php
      include_once('conn.php');

      // Bar Chart Data
      $query_bar = "SELECT nama_satker, persentase FROM realisasi_satker";
      $result_bar = mysqli_query($mysqli, $query_bar);
      $nama_satker = [];
      $persentase = [];
      while ($row = mysqli_fetch_assoc($result_bar)) {
          $nama_satker[] = $row['nama_satker'];
          $persentase[] = $row['persentase'];
      }
      $nama_satker = json_encode($nama_satker);
      $persentase = json_encode($persentase);

      // Line Chart Data
      $query_line = "SELECT date, persentase FROM realisasi_satker_line";
      $result_line = mysqli_query($mysqli, $query_line);
      $dates = [];
      $percentages = [];
      while ($row = mysqli_fetch_assoc($result_line)) {
          $dates[] = $row['date'];
          $percentages[] = $row['persentase'];
      }
      $dates = json_encode($dates);
      $percentages = json_encode($percentages);
    ?>

    
    <!-- Navbar Start -->
    <nav class="navbar navbar-dashboard bg-light navbar-expand-lg shadow-sm fixed-top">
      <div class="container-fluid pe-5 ps-0">
        <div class="logo-navbar text-center">
          <i class="bi bi-suit-heart-fill"></i>
        </div>
        <div class="menu-toggle">
          <input type="checkbox" />
          <span></span>
          <span></span>
          <span></span>
        </div>
        <a class="navbar-brand ms-5" href="#">SIPUJA</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="profile ms-auto d-flex align-items-center">
            <div class="profile-info me-3 text-end">
              <a href="#" class="nav__name">Victor Palimbong</a>
              <span class="nav__profession">Direktur BIREN</span>
            </div>
            <div class="profile-img">
              <i class="bi bi-person"></i>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Sidenav Start -->
    <div class="wrapper">
      <aside id="sidebar">
        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="bi bi-house-fill"></i>
              <span>Profile</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="lni lni-agenda"></i>
              <span>Task</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
              <i class="lni lni-protection"></i>
              <span>Auth</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Login</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Register</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
              <i class="lni lni-layout"></i>
              <span>Multi Level</span>
            </a>
            <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two"> Two Links </a>
                <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Link 1</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Link 2</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="lni lni-popup"></i>
              <span>Notification</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">
              <i class="lni lni-cog"></i>
              <span>Setting</span>
            </a>
          </li>
        </ul>
        <div class="sidebar-footer">
          <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
          </a>
        </div>
      </aside>
      <div class="main p-3">
        <div class="breadcrumb-container d-flex justify-content-between">
          <h3>DASHBOARD</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Statistik Kinerja</li>
            </ol>
          </nav>
        </div>

        <div class="container">
          <div class="row">
            <div class="col text-center">
              <h2 class="fw-semibold">Data Pengukuran s.d. Juni 2023</h2>
            </div>
          </div>
          <div class="row card-row">
            <div class="col text-center">
              <div class="card-title">
                Jumlah Anggaran
              </div>
              <div class="card-data">
                10.000.000.000
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Realisasi Anggaran (Kumulatif) s.d. Juni 2023
              </div>
              <div class="card-data">
                5.225.000.000
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Tingkat Realisasi Anggaran (Kumulatif) s.d. Juni 2023
              </div>
              <div class="card-data">
                52.25%
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Total Target Kegiatan (RAPK)
              </div>
              <div class="card-data">
                1.100
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Jumlah Target Kegiatan (kumulatif) s.d. Juni 2023
              </div>
              <div class="card-data">
                600
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Jumlah Realisasi Kegiatan (Kumulatif) s.d. Juni 2023
              </div>
              <div class="card-data">
                550
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Tingkat Realisasi Total Target Kegiatan
              </div>
              <div class="card-data">
                54.55%
              </div>
            </div>
            <div class="col text-center">
              <div class="card-title">
                Tingkat Realisasi Target Kegiatan s.d. Juni 2023
              </div>
              <div class="card-data">
                91.67%
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-8">
              <canvas id="percentageChart"></canvas>
            </div>
            <div class="col-md-4">
              <canvas id="lineChart"></canvas>
            </div>
          </div>         
        </div>
      </div>
    </div>
    <!-- Sidenav End -->



    <script>
      const hamBurger = document.querySelector(".menu-toggle");

      hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
    var ctxBar = document.getElementById('percentageChart').getContext('2d');
    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: <?php echo $nama_satker; ?>,
        datasets: [{
          label: false,
          data: <?php echo $persentase; ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Tingkat Realisasi Anggaran (Kumulatif) per Satker s.d. Bulan Juni 2023',
            padding: { top: 10, bottom: 30 },
            font: { size: 20, weight: 'bold' }
          },
          legend: { display: false },
          datalabels: {
                display: true,
                align: 'top',
                anchor: 'end',
                color: 'black',
                formatter: function(value, context) {
                    return value + '%';
                },
                font: {
                    weight: 'bold'
                }
            }
        },
        scales: {
          x: {
            ticks: {
              callback: function(value) {
                var label = this.getLabelForValue(value);
                var words = label.split(" ");
                var wrappedLabel = [];
                var line = "";
                words.forEach(function(word) {
                  if (line.length + word.length > 10) {
                    wrappedLabel.push(line);
                    line = word;
                  } else {
                    if (line.length > 0) {
                      line += " ";
                    }
                    line += word;
                  }
                });
                wrappedLabel.push(line);
                return wrappedLabel;
              },
              maxRotation: 0,
              minRotation: 0
            }
          },
          y: {
            beginAtZero: true,
            min: 0,
            max: 100,
            ticks: { callback: function(value) { return value + '%'; } }
          }
        }
      },
      plugins: [ChartDataLabels]
    });

    var ctxLine = document.getElementById('lineChart').getContext('2d');
    ctxLine.canvas.height = 200;
    new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: <?php echo $dates; ?>, // Treating dates as categorical data
        datasets: [{
          label: 'Tingkat Realisasi Anggaran Kumulatif',
          data: <?php echo $percentages; ?>,
          backgroundColor: 'rgba(54, 162, 235, 0)',
          borderColor: '#ed7d31',
          borderWidth: 3,
          pointRadius: 0, // Remove Dot each data
          fill: true,
          // pointStyle: 'line' // Remove this line, as it's not a valid option here
        }]
      },
      options: {
        scales: {
          x: {
            type: 'category', // Using category scale for x-axis
            offset: true,
            title: {
              display: false,
              text: 'Date'
            }
          },
          y: {
            beginAtZero: true,
            min: 0,
            max: 100,
            ticks: { callback: function(value) { return value + '%'; } },
            title: {
              display: false,
              text: 'Percentage'
            }
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'Tingkat Realisasi Anggaran (Kumulatif) s.d. Bulan Juni 2023',
            padding: { top: 10, bottom: 30 },
            font: { size: 20, weight: 'bold' }
          },
          legend: { 
            display: true,
            position: 'bottom',
            labels: {
              usePointStyle: true, // Use point styles in legend
              pointStyle: 'line', // Legend point style is line
              generateLabels: function(chart) {
                const original = Chart.defaults.plugins.legend.labels.generateLabels;
                const labels = original.call(this, chart);

                labels.forEach(label => {
                  label.pointStyle = 'line'; // Set legend style to line
                  label.borderColor = label.fillStyle; // Set line color to match the dataset color
                  label.borderWidth = 3; // Line width
                  label.boxWidth = 0; // Hide the default box
                });

                return labels;
              }
            }
          },
          datalabels: {
            display: true,
            align: 'top',
            color: 'black',
            formatter: function(value, context) {
              return value + '%';
            },
            font: {
              weight: 'bold'
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });

  </script>
  </body>
</html>
