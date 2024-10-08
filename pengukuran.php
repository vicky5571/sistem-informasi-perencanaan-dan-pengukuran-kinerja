<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SP - Pengukuran</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar bg-light navbar-expand-lg shadow-sm fixed-top">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="#"><i class="bi bi-display"></i> E-Performance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sekapur Sirih</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Sakip Publik </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="perencanaan.php">Perencanaan</a></li>
                            <li><a class="dropdown-item" href="perjanjian.php">Perjanjian</a></li>
                            <li><a class="dropdown-item" href="pengukuran.php">Pengukuran</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Hubungi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <main class="p-5">
        <div class="container text-center p-5 m-5">
            <h1 class="m-4">SAKIP PUBLIK "PENGUKURAN"</h1>

            <!-- Filter Form -->
            <form method="GET" class="m-4 d-flex align-items-center">
                <p class="my-4">Pilih tahun: </p>
                <input type="number" name="tahun" class="form-control filter-form" placeholder="Filter by Tahun" value="<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : ''; ?>">
                <p class="my-4 mx-4">Pilih unit kerja: </p>
                <select name="unit_kerja" class="form-control filter-form">
                    <option value="">All Unit Kerja</option>
                    <?php
                    include_once("conn.php");
                    
                    $unit_query = "SELECT DISTINCT unit_kerja FROM pengukuran";
                    $unit_result = mysqli_query($mysqli, $unit_query);

                    while ($unit = mysqli_fetch_assoc($unit_result)) {
                        $selected = (isset($_GET['unit_kerja']) && $_GET['unit_kerja'] == $unit['unit_kerja']) ? 'selected' : '';
                        echo "<option value='" . $unit['unit_kerja'] . "' $selected>" . $unit['unit_kerja'] . "</option>";
                    }
                    ?>
                </select>
                
                <button type="submit" id="submitFilter" class="btn btn-primary mx-4 submitFilter">Filter</button>
            </form>


            <div class="alert alert-light <?php echo isset($_GET['tahun']) ? '' : 'd-none'; ?> form-alert" role="alert">
              <h4 class="alert-heading">Pengukuran Tahun "<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : ''; ?>"</h4>
              <p>Catatan: Data masih dalam proses input dan verifikasi. Mohon maklum apabila ada data yang tidak tersedia.</p>
            </div>


            <?php 
            // Filter query based on 'tahun' and "unit_kerja"
            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
            $unit_kerja = isset($_GET['unit_kerja']) ? $_GET['unit_kerja'] : '';

            $query = "
                    SELECT 
                        pengukuran.id, 
                        pengukuran.unit_kerja,
                        pengukuran.tahun,
                        pengukuran.capaian_kinerja
                    FROM pengukuran
                ";

            if ($tahun && $unit_kerja) {
                $query .= " WHERE pengukuran.tahun = '$tahun' AND pengukuran.unit_kerja = '$unit_kerja'";
            } elseif ($tahun) {
                $query .= " WHERE pengukuran.tahun = '$tahun'";
            } elseif ($unit_kerja) {
                $query .= " WHERE pengukuran.unit_kerja = '$unit_kerja'";
            }

            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-bordered my-4'>";
                echo "<tr>
                        <th rowspan='2'>No</th>
                        <th rowspan='2'>Uraian</th>
                        <th rowspan='2'>Capaian Kinerja</th>
                        <th rowspan='2'>Tidak ada Target (n/a)</th>
                        <th colspan='5'>Tidak Tercapai (<100%)</th>
                        <th rowspan='2'>Tercapai 100%</th>
                        <th rowspan='2'>Melebihi Target (>100%)</th>
                        <th rowspan='2'>Jumlah Indikator</th>
                      </tr>";

                echo "<tr>
                        <th>00.00 s/d 49.99</th>
                        <th>50.00 s/d 64.99</th>
                        <th>65.00 s/d 74.99</th>
                        <th>75.00 s/d 89.99</th>
                        <th>90.00 s/d 99.99</th>
                    </tr>";

                $no = 1;

                while ($data = mysqli_fetch_array($result)) {
                    // Split the capaian_kinerja values by commas
                    $capaian_kinerja_values = explode(',', $data['capaian_kinerja']);

                    // Determine the number of rows to span
                    $rowspan = count($capaian_kinerja_values);

                    foreach ($capaian_kinerja_values as $index => $value) {
                        echo "<tr>";
                        
                        if ($index == 0) {
                            // For the first row, display the No and Uraian columns with rowspan
                            echo "<td rowspan='$rowspan'>" . $no . "</td>";
                            echo "<td rowspan='$rowspan'>" . $data['unit_kerja'] . "</td>";
                        }

                        // Display the Capaian Kinerja value in each row
                        echo "<td>" . $value . "</td>";
                        echo "<td class='text-center'>
                                <a href='renstra.php?id=" . $data['id'] . "' class='btn btn-secondary'>
                                  7
                                </a>
                              </td>";

                        // Add placeholder cells for "Tidak Tercapai" columns
                        echo "<td></td>"; // 00.00 s/d 49.99
                        echo "<td></td>"; // 50.00 s/d 64.99
                        echo "<td></td>"; // 65.00 s/d 74.99
                        echo "<td></td>"; // 75.00 s/d 89.99
                        echo "<td></td>"; // 90.00 s/d 99.99
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>
                                <a href='renstra.php?id=" . $data['id'] . "' class='btn btn-info'>
                                7
                                </a>
                              </td>";

                        echo "</tr>";
                    }

                    $no++;
                }

                echo "</table>";
            } else {
                echo "<p>No records found.</p>";
            }
            ?>
        </div>
    </main>

    <script>
      const filterForm = document.querySelector("form");
      const formAlert = document.querySelector(".form-alert");
      const selectedYearElement = document.getElementById("selected-year");

      // Set the selected year in the alert on page load
      document.addEventListener("DOMContentLoaded", function() {
          const selectedYear = filterForm.querySelector('input[name="tahun"]').value;
          selectedYearElement.textContent = selectedYear ? selectedYear : "N/A";
      });

      filterForm.addEventListener("submit", function(event) {
          // The PHP will handle showing the alert after the page reload
      });
    </script>

</body>
</html>
