<?php

require '../koneksi.php';  

$query = "SELECT * FROM kandidat";
$result = mysqli_query($conn, $query);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Voting</title>
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
    .card-vote {
      background-color: #1e1e1e;
      border: 1px solid silver;
      color: white;
      box-shadow: 0 4px 10px silver;
      transition: 0.3s ease-in-out;
    }
    .card-vote:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px silver;
    }
    .card-img-top {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
    }
    .vote-count {
      font-size: 2.5rem;
      font-weight: bold;
      color: silver;
      text-shadow: 0 0 10px silver;
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
          <a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i></a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 p-4">
        <h2 class="text-light text-center mb-5">Hasil Voting Ketua OSIS</h2>
        <div class="row justify-content-center">
          <?php


          while ($kandidat = mysqli_fetch_assoc($result)) {
            
              $id_kandidat = $kandidat['id_kandidat'];
              $query_vote = "SELECT COUNT(*) AS jumlah_suara FROM hasil_vote WHERE id_kandidat = '$id_kandidat'";
              $result_vote = mysqli_query($conn, $query_vote);
              $vote_data = mysqli_fetch_assoc($result_vote);
              $jumlah_suara = $vote_data['jumlah_suara'];

  
              echo "
              <div class='col-md-4 mb-4'>
                  <div class='card card-vote'>
                      <img src='../img/{$kandidat['foto']}' class='card-img-top' alt='Foto {$kandidat['nama']}'>
                      <div class='card-body text-center'>
                          <h5 class='card-title'>{$kandidat['nama']}</h5>
                          <p class='card-title mb-1'>Jumlah Suara</p>
                          <div class='vote-count'>{$jumlah_suara}</div>
                      </div>
                  </div>
              </div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
