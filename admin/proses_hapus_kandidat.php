<?php 

require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" ){
    $id = $_POST['id_kandidat'];

    $query = "DELETE FROM kandidat WHERE id_kandidat = $id";

    if (mysqli_query($conn, $query)) {
        header("location: kandidat.php");
    } else {
        header("location: kandidat.php");
        echo mysqli_error($conn);
    }

}

?>