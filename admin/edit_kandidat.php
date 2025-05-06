<?php 

    require '../koneksi.php';

    //Ambil nilai id yang ada di url
    $idKandidat = $_GET['id'];

    // lakukan query untuk mengambil data berdasarkan id
    $query = "SELECT * FROM kandidat WHERE id_kandidat = $idKandidat";

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
  <title>Form Kandidat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: white;
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
    .form-container {
      width: 90%;
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      border: 1px solid silver;
    }
    .form-container input, .form-container textarea {
      background-color: #1e1e1e;
      color: white;
      border: 1px solid silver;
    }
    .form-container input:focus, .form-container textarea:focus {
      border-color: silver;
      box-shadow: 0 0 5px silver;
    }
    .form-container button {
      background-color:  #ffeb3b;
      color: #121212;
      border: none;
    }
    .form-container button:hover {
      background-color:  #ffeb3b;
      color: #121212;
      box-shadow: 0 0 5px  #ffeb3b;
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

    <!-- Main Content -->
    <div class="col-md-10 p-4">
      <h2 class="text-warning text-center mb-5">Form Edit Kandidat</h2>

      <form action="proses_edit_kandidat.php" method="POST" class="form-container mx-auto" enctype="multipart/form-data">
      <input type="hidden" name="id_kandidat" value="<?= $show['id_kandidat']; ?>"> 
      <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" accept="image/*" id="foto" name="foto">
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $show['nama']; ?>"  required>
        </div>
        <div class="mb-3">
          <label for="visi" class="form-label">Visi</label>
          <textarea class="form-control" id="visi" name="visi" rows="5" required><?= $show['visi']; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="misi" class="form-label">Misi</label>
          <textarea class="form-control" id="misi" name="misi" rows="5" required><?= $show['misi']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning w-100 py-2">Edit Kandidat</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
