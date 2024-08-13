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
      $query = "SELECT nama_satker, persentase FROM realisasi_satker";
      $result = mysqli_query($mysqli, $query);

      $nama_satker = [];
      $persentase = [];

      while ($row = mysqli_fetch_assoc($result)) {
          $nama_satker[] = $row['nama_satker'];
          $persentase[] = $row['persentase'];
      }

      $nama_satker = json_encode($nama_satker);
      $persentase = json_encode($persentase);
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
            <div class="col-md-8">
              <canvas id="percentageChart"></canvas>
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
    <script>
var ctx = document.getElementById('percentageChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $nama_satker; ?>,
        datasets: [{
            label: '', // This will not be displayed in the legend
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
                text: 'Performance Statistics', // Change this to your desired title
                padding: {
                    top: 10,
                    bottom: 30
                },
                font: {
                    size: 16,
                    weight: 'bold'
                }
            },
            legend: {
                display: true, // Display the legend
                labels: {
                    filter: function(item, chart) {
                        // Hide the label from the legend
                        return false;
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    callback: function(value, index, values) {
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
                max: 100, // Set max to 100
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            }
        }
    }
});


    </script>
  </body>
</html>
