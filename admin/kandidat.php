<?php

session_start();
require '../koneksi.php';

$info = $_SESSION['info_kandidat'] ?? '';
unset($_SESSION['info_kandidat']);

$query = "SELECT * FROM kandidat ";

$result = mysqli_query($conn, $query);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Kandidat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      background-image: url('../img/backgroundLogin4.png'); 
      color: white;
    }
    .sidebar {
      height: 100vh;
      background-color:rgba(30, 30, 30, 0.55);
      border-right: 2px solid silver;
      box-shadow: 6px 0 15px silver;
    }
    .sidebar .nav-link {
      color: silver;
      margin-bottom: 15px;
      font-weight: 500;
      display: flex;
      align-items: center;
      width: 100%;
      padding-left: 1rem;
    }
    .sidebar .nav-link i {
      margin-right: 10px;
    }
    .sidebar .nav-link:hover {
      background-color: silver;
      color: #121212;
    }
    .card-custom {
      background-color: #1e1e1e;
      border: 1px solid silver;
      color: white;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .btn-warning {
      color: #121212;
      font-weight: 600;
    }
    .card-img-top {
      width: 100px;
      height: 100px;
      object-fit: cover;
      object-position: center;
      border-radius: 8px;
    }
    .btn-outline-yellow {
      border-color: #ffeb3b;
      color: #ffeb3b;
    }
    .btn-outline-yellow:hover {
      background-color: #ffeb3b;
      color: #121212;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar d-flex flex-column py-5">
        <h4 class="text-light text-center mb-4">Menu</h4>
        <a href="#" class="nav-link"><i class="bi bi-speedometer2"></i>Dashboard</a>
        <a href="kandidat.php" class="nav-link"><i class="bi bi-person-lines-fill"></i>Kandidat</a>
        <a href="siswa.php" class="nav-link"><i class="bi bi-people-fill"></i>Siswa</a>
        <a href="hasil_vote.php" class="nav-link"><i class="bi bi-bar-chart-line-fill"></i>Hasil Voting</a>
      
        <div class="mt-auto">
        <a href="logout.php" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        </div>
    </div>

      <!-- Main content -->
      <div class="col-md-10 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="text-light">Data Kandidat</h2>
          <a href="tambah_kandidat.php" class="btn btn-warning">Tambah Kandidat</a>
        </div>

        <?php if ($info): ?>
            <div class="alert alert-warning text-center"><?= $info ?></div>
        <?php endif; ?>

        <div class="card card-custom p-3">
          <table class="table table-dark table-hover text-center">

            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($show = mysqli_fetch_assoc($result)) {
                  echo "
                  <tr>
                    <td>{$no}</td>
                    <td><img src=\"../img/{$show['foto']}\" class=\"card-img-top\" alt=\"Foto Kandidat\"></td>
                    <td>{$show['nama']}</td>
                    <td>{$show['visi']}</td>
                    <td>{$show['misi']}</td>
                    <td>
                      <div class='d-flex justify-content-center gap-2'>
                        <a href='edit_kandidat.php?id={$show['id_kandidat']}' class='btn btn-outline-yellow btn-sm'>Edit</a>
                        <form action='proses_hapus_kandidat.php' method='POST'>
                          <input type='hidden' name='id_kandidat' value='{$show['id_kandidat']}' />
                          <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  ";
                  $no++;
                }
              } else {
                echo "<tr><td colspan='6' class='text-center text-danger'>Data Tidak Ditemukan</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
