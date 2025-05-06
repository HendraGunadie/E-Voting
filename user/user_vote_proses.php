<?php 

    require '../koneksi.php';

    session_start();


    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $kandidat = $_POST['kandidat'];
        $nisn = $_SESSION['nisn'];

        $querySiswa = mysqli_query($conn, "SELECT id_siswa FROM siswa WHERE nisn='$nisn'");
        $dataSiswa = mysqli_fetch_assoc($querySiswa);
        $idsiswa = $dataSiswa['id_siswa'];

        $queryKandidat = mysqli_query($conn, "SELECT nama FROM kandidat WHERE id_kandidat='$kandidat'");
        $dataKandidat = mysqli_fetch_assoc($queryKandidat);
        $namaKandidat = $dataKandidat['nama'];

        mysqli_query($conn, "INSERT INTO hasil_vote (id_siswa, id_kandidat) VALUES ('$idsiswa', '$kandidat')");


       $siswaVote = mysqli_query($conn, "UPDATE siswa SET status='1' WHERE id_siswa='$idsiswa'");

       if ($siswaVote)
       {
        $_SESSION['informasi'] = "Kamu sudah memilih $namaKandidat";
       }


        header("Location: ../index.php");
    
    }

?>