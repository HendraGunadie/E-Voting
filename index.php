<?php 

require 'koneksi.php';

session_start();

$error = $_SESSION['login_error'] ?? '';
$info = $_SESSION['informasi'] ?? '';
unset($_SESSION['informasi']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color:rgb(0, 0, 0); /* Warna gelap */
      background-image: url('img/backgroundLogin6.png'); 
      color: #ffffff; /* Teks putih */
      margin: 0;
      padding: 0;
      overflow: hidden;
      height: 100%;
      width: 100%;
    }

    .form-box {
      background-color:rgba(31, 31, 31, 0.83); /* Form lebih terang sedikit */
      border: 2px solid silver; /* Border kuning */
      border-radius: 12px;
      padding: 2rem;
    
      width: 100%;
      max-width: 400px;
    }

    .form-set {
      margin-top: -5rem;
    }

    label {
      color: silver; /* Label form kuning */
    }

    #bg-video {
  position: fixed;
  top: 0;
  left: 0;
  min-width: 100%;
  min-height: 100%;
  object-fit: cover;
  z-index: -1; /* Supaya video ada di belakang */
}

    input.form-control {
      background-color: #121212;
      color: #ffffff;
      border: 1px solid silver; /* Border input kuning */
    }

    input.form-control:focus {
      background-color: #121212;
      color: #ffffff;
      border: 1px solid silver;
      box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
    }
  </style>
</head>
<body>
<video autoplay muted loop id="bg-video">
    <source src="img/videoBg1.mp4" type="video/mp4">
   
  </video>
<h1 class="text-center mt-5" style="color:silver; ">E-Voting Ketua Osis</h1>
<?php if ($info): ?>
                <h1 class="text-center mt-5" style="color: silver; text-shadow: 0 0 10px rgba(255, 193, 7, 0.5);"><?= $info ?></h1>
    <?php endif; ?>
<div class="container d-flex justify-content-center align-items-center form-set" style="height: 100vh;">
  <form action="user/user_login_proses.php" method="POST" class="form-box">
    
    <h4 class="text-center mb-4" style="color: silver;">Login Siswa</h4>

    <?php if ($error): ?>
                <small class="text-danger"><?= $error ?></small>
    <?php endif; ?>
    
    <div class="mb-3">
      <label for="nisn" class="form-label">NISN</label>
      <input type="text" name="nisn" id="nisn" class="form-control">
    </div>
    
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-outline-light w-100">Login</button>
    </div>

  </form>
</div>

</body>
</html>
