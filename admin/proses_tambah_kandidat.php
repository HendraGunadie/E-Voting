<?php 

require '../koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $folder = "../img/" . basename($foto);

    if (move_uploaded_file($tmp_name, $folder)) {
        // Simpan data ke database
        $query = "INSERT INTO kandidat (foto, nama, visi, misi) VALUES ('$foto', '$nama', '$visi', '$misi')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['info_kandidat'] = 'Data Kandidat Berhasil Di Tambahkan';
            header("Location: kandidat.php");
            exit;
        } 
        else {
            $_SESSION['info_kandidat'] = 'Data Kandidat Gagal Di Tambahkan';
            header("Location: kandidat.php");
            exit;
        }
    } else {
        $_SESSION['info_kandidat'] = 'Gagal mengupload Foto';
        header("Location: kandidat.php");
        exit;
    }
}

?>

