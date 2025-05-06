<?php

session_start();
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSiswa = $_POST['id_siswa'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];


    $query = "UPDATE siswa 
              SET nisn = '$nisn', nama = '$nama', kelas = '$kelas' 
              WHERE id_siswa = $idSiswa";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info_siswa'] = 'Data siswa Berhasil Di Edit';
        header("location: siswa.php");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
}


?>