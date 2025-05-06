<?php 
session_start();
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" ){
    $id = $_POST['id_siswa'];

    $query = "DELETE FROM siswa WHERE id_siswa = $id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info_siswa'] = 'Data Siswa Berhasil Di Hapus';
        header("location: siswa.php");
    } else {
        $_SESSION['info_siswa'] = 'Data Siswa Gagal Di Hapus';
        header("location: siswa.php");
        echo mysqli_error($conn);
    }

}

?>