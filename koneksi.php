<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'e_voting_ketos';

$conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Tidak Connect" . mysqli_connect_error());
    }
?>