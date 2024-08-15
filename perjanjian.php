<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SP - Perjanjian</title>

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
        <h1 class="m-4">SAKIP PUBLIK "PERJANJIAN"</h1>

        <!-- Filter Form -->
        <form method="GET" class="m-4 d-flex align-items-center">
            <p class="my-4">Pilih tahun: </p>
            <input type="number" name="tahun" class="form-control filter-form" placeholder="Filter by Tahun" value="<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Filter</button>
          
        </form>

        <?php 
        include_once("conn.php");

        // Filter query based on 'tahun'
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

        $query = "
                SELECT 
                    perjanjian.id, 
                    perjanjian.unit_kerja,
                    perjanjian.tahun
                FROM perjanjian
            ";

        if ($tahun) {
            $query .= " WHERE perjanjian.tahun = '$tahun'";
        }

        $result = mysqli_query($mysqli, $query);

        echo "<table class='table table-bordered my-4'>";
        echo "<tr>
                <th>NO</th>
                <th>UNIT KERJA</th>
                <th>PERKIN</th>
                <th>RENJA/RKA/PK</th>
              </tr>";

        $no = 1;

        while ($data = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $no . "</td>";
          echo "<td>" . $data['unit_kerja'] . "</td>";
          echo "<td class='text-center'>
                  <a href='renstra.php?id=" . $data['id'] . "' class='btn btn-success'>
                    <i class='bi bi-search'></i>
                  </a>
                </td>";
          echo "<td class='text-center'>
                  <a href='renja.php?id=" . $data['id'] . "' class='btn btn-primary'>
                    <i class='bi bi-search'></i>
                  </a>
                </td>";
          echo "</tr>";
          $no++;
        }

        echo "</table>";
        ?>
      </div>
    </main>
  </body>
</html>
