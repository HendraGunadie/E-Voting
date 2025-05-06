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
    <title>Siswa Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212; 
            color: #ffffff; 
            background-image: url('../img/backgroundLogin6.png'); 
            margin: 0;
            padding: 0;
        }

        .card-custom {
            background-color:rgba(30, 30, 30, 0.92); 
            border: 1px solid silver; 
            color: #ffffff;
            box-shadow: 0 4px 10px silver; 
            transition: transform 0.3s, box-shadow 0.3s;
            width: 24rem;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px white;
        }
        .btn-custom {
           
            transition: all 0.3s;
        }
        .btn-custom:hover {
            box-shadow: 0 6px 10px blue;
            transform: translateY(-2px);
        }
    
        .card-img-top {
            width: 100%;
            height: 23rem; 
            object-fit: cover;
            object-position: center center;
        }

        .glow-text {
            margin-bottom : 70px;
      font-size: 2.5rem;
      color: silver;
      text-shadow:  -4px 2px 5px rgba(183, 183, 183, 0.9); 
        
    }

    </style>
  </head>
  <body>


    <h1 class="glow-text text-center mt-5">Waktu Anda Untuk Memilih! <br>Ayo Tentukan Ketua OSIS Pilihan Anda!</h1>

    <div class="row justify-content-center">
    <form action="user_vote_proses.php" method="POST" class="col-12">
        <div class="row justify-content-center">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($show = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card card-custom">
                            <img src="../img/<?= htmlspecialchars($show['foto']) ?>" class="card-img-top" alt="Foto Kandidat">
                            <div class="card-body">
                                <h5 class="card-title text-warning"><?= htmlspecialchars($show['nama']) ?></h5>
                                <h6 class="card-title">VISI</h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($show['visi'])) ?></p>
                                <h6 class="card-title">MISI</h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($show['misi'])) ?></p>
                                <button type="submit" name="kandidat" value="<?= $show['id_kandidat'] ?>" class="btn btn-outline-warning btn-custom w-100">
                                    Pilih <?= htmlspecialchars($show['nama']) ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='text-danger'>Data kandidat tidak ditemukan.</div>";
            }
            ?>
        </div>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
