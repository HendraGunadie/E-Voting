<?php 

require '../koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $query = "INSERT INTO siswa (nisn, nama, kelas) VALUES ('$nisn', '$nama', '$kelas')";
    $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['info_siswa'] = 'Data Siswa Berhasil Di Tambahkan';
            header("Location: siswa.php");
            exit;
        } else {
            $_SESSION['info_siswa'] = 'Data Siswa Gagal Di Tambahkan';
            header("Location: siswa.php");
            exit;
        }

}

?>

