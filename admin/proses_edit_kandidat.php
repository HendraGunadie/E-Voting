<?php

session_start();
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idKandidat = $_POST['id_kandidat'];
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];


    $queryOld = "SELECT foto FROM kandidat WHERE id_kandidat = $idKandidat";
    $resultOld = mysqli_query($conn, $queryOld);
    $dataOld = mysqli_fetch_assoc($resultOld);
    $fotoLama = $dataOld['foto'];


    if ($_FILES['foto']['name']) {
        $fotoBaru = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        $folder = "../img/" . basename($fotoBaru);

        move_uploaded_file($tmp_name, $folder);
    } else {
        $fotoBaru = $fotoLama;
    }

    $query = "UPDATE kandidat 
              SET foto = '$fotoBaru', nama = '$nama', visi = '$visi', misi = '$misi' 
              WHERE id_kandidat = $idKandidat";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info_kandidat'] = 'Data Kandidat Berhasil Di Edit';
        header("location: kandidat.php");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
}


?>