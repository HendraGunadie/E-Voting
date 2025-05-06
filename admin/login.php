<?php 

require '../koneksi.php';

session_start();

$error = $_SESSION['login_error_admin'] ?? '';


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <style>
    body {
      background-color: #121212; 
     
      color: #ffffff; 
      margin: 0;
      padding: 0;
      overflow: hidden;
      height: 100%;
      width: 100%;
    }

    .form-box {
      background-color:rgba(31, 31, 31, 0.55);
      border: 1px solid silver;
      border-radius: 12px;
      padding: 2rem;
    
      width: 100%;
      max-width: 400px;
    }

    .divider {
      width: 2px;
      height: 100vh;
      background-color: silver;
      box-shadow: 30px 0 30px silver;
    }

    .glow-text {
      font-size: 2.5rem;
      color: silver;
      
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

    label {
      color: silver;
    }

    input.form-control {
      background-color: #121212;
      color: #ffffff;
      border: 1px solid silver;
    }

    input.form-control:focus {
      background-color: #121212;
      color: #ffffff;
      border: 1px solid silver;
      box-shadow: 0 0 5px silver;
    }
  </style>
</head>
<body>

<video autoplay muted loop id="bg-video">
    <source src="../img/videoBg3.mp4" type="video/mp4">
   
  </video>

<div class="container">
  <div class="row">
    <div class="col-5">
      <div class="container d-flex justify-content-center align-items-center form-set" style="height: 100vh;">
        <form action="admin_login_proses.php" method="POST" class="form-box">
          
          <h4 class="text-center mb-4" style="color: silver;">Login Admin</h4>

          <?php if ($error): ?>
                <small class="text-danger"><?= $error ?></small>
           <?php endif; ?>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-light w-100">Login</button>
          </div>

        </form>
      </div>
    </div>

    <div class="col-2 d-flex justify-content-center align-items-center">
     
    </div>

    <div class="col-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
      <h1 class="glow-text text-center">E-Voting Pemilihan Ketua Osis</h1>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
