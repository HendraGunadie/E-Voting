<?php
require '../koneksi.php';
    //Ambil nilai id yang ada di url
    $idSiswa = $_GET['id'];

    // lakukan query untuk mengambil data berdasarkan id
    $query = "SELECT * FROM siswa WHERE id_siswa = $idSiswa";

    //jalankan query dan hasil simpan ke variabel $result

    $result = mysqli_query($conn, $query);

    // Ubah ke dalam bentuk array

    $show = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Anggota</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
      body {
          background-color: #121212; 
          color: white;
      }
      .col-md-2 {
          background-color: #1e1e1e;
          min-height: 100vh;
      }
      .text-turquoise-shadow {
          text-shadow: 2px 2px 8px silver; 
          font-weight: bold;
          font-size: 2rem;
      }
      .border-turquoise {
          border-right: 2px solid silver; 
          box-shadow: 6px 0 15px silver; 
      }
      .border-form {
          border-radius: 10px;
          border: 1px solid silver; 
      }

      .btn-outline-info {
          border-color: silver;
          color: silver; 
      }
      .btn-outline-info:hover {
          background-color: silver; 
          color: #121212; 
      }

      .form-control {
          background-color: #1e1e1e;
          color: white;
          border: 1px solid silver;
      }
      .form-control:focus {
          border-color: silver;
          box-shadow: 0 0 5px silver;
      }

      .col-md-10 {
          padding: 0 100px; 
      }
      .sidebar {
          height: 100vh;
          background-color: #1e1e1e;
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
          border-color: silver;
          color: silver;
      }
      .btn-outline-yellow:hover {
          background-color: silver;
          color: #121212;
      }
  </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column py-5">
            <h4 class="text-warning text-center mb-4">Menu</h4>
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
                <h2 class="text-warning">Form Anggota</h2>
            </div>


            <!-- Form for Adding Siswa -->
            <h2 class="text-turquoise-shadow mt-5">Form Siswa</h2>
            <form action="proses_edit_siswa.php" method="POST" class="container mt-4 border-form p-4">
            <input type="hidden" name="id_siswa" value="<?= $show['id_siswa']; ?>"> 
            <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" value="<?= $show['nisn']; ?>" name="nisn" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" value="<?= $show['nama']; ?>" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                    <option value=" X RPL" <?= ($show['kelas'] == ' X RPL') ? 'selected' : '' ?>>Kelas X RPL</option>
                    <option value=" X A FAR" <?= ($show['kelas'] == ' X A FAR') ? 'selected' : '' ?>>Kelas X A FAR</option>
                    <option value=" X B FAR" <?= ($show['kelas'] == ' X B FAR') ? 'selected' : '' ?>>Kelas X B FAR</option>
                    <option value=" X C FAR" <?= ($show['kelas'] == ' X C FAR') ? 'selected' : '' ?>>Kelas X C FAR</option>
                    <option value=" X TKKR" <?= ($show['kelas'] == ' X TKKR') ? 'selected' : '' ?>>Kelas X TKKR</option>
                    <option value=" X DKV" <?= ($show['kelas'] == ' X DKV') ? 'selected' : '' ?>>Kelas X DKV</option>
                    <option value=" XI RPL" <?= ($show['kelas'] == 'XI RPL') ? 'selected' : '' ?>>Kelas XI RPL</option>
                    <option value=" XI A FAR" <?= ($show['kelas'] == ' XI A FAR') ? 'selected' : '' ?>>Kelas XI A FAR</option>
                    <option value=" XI B FAR" <?= ($show['kelas'] == ' XI B FAR') ? 'selected' : '' ?>>Kelas XI B FAR</option>
                    <option value=" XI TKKR" <?= ($show['kelas'] == ' XI TKKR') ? 'selected' : '' ?>>Kelas XI TKKR</option>
                    <option value=" XI DKV" <?= ($show['kelas'] == ' XI DKV') ? 'selected' : '' ?>>Kelas XI DKV</option>
                    <option value=" XII RPL" <?= ($show['kelas'] == ' XII RPL') ? 'selected' : '' ?>>Kelas XII RPL</option>
                    <option value=" XII A FAR" <?= ($show['kelas'] == ' XII A FAR') ? 'selected' : '' ?>>Kelas XII A FAR</option>
                    <option value=" XII B FAR" <?= ($show['kelas'] == ' XII B FAR') ? 'selected' : '' ?>>Kelas XII B FAR</option>
                    <option value=" XII C FAR" <?= ($show['kelas'] == ' XII C FAR') ? 'selected' : '' ?>>Kelas XII C FAR</option>
                    <option value=" XII TKKR" <?= ($show['kelas'] == ' XII TKKR') ? 'selected' : '' ?>>Kelas XII TKKR</option>
                    <option value=" XII DKV" <?= ($show['kelas'] == ' XII DKV') ? 'selected' : '' ?>>Kelas XII DKV</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning">Edit Siswa</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
