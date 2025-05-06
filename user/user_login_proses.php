<?php
session_start();

require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
$nisn = htmlspecialchars($_POST['nisn']);


    if (empty($nisn))
    {
        $_SESSION['login_error'] = "NISN JANGAN KOSONG!";
        header("Location: ../index.php");
        exit();
    }

    $query = "SELECT * FROM siswa WHERE nisn='$nisn'";
    $result = mysqli_query($conn , $query);
    $user = mysqli_fetch_assoc($result);

    if ($user)
    {
        if($user['status'] == '0') {
        $_SESSION['nisn'] = $user['nisn'];
        header("Location: user_vote.php");
        }
        else
        {
            $_SESSION['login_error'] = "Kamu Sudah Melakukan Voting!";
            header("Location: ../index.php");
        }
    } 
    else
    {
        $_SESSION['login_error'] = "NISN SALAH!";
        header("Location: ../index.php");
    }

}

    

?>