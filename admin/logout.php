<?php

session_start();
$_SESSION['id_admin'] = $user['id_admin'];
$_SESSION['nama'] = $user['nama'];
session_destroy();

header("Location: login.php");

?>