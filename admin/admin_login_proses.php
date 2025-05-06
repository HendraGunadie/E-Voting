<?php 

session_start();

require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);


    if (empty($email) || empty($password))
    {
        $_SESSION['login_error_admin'] = "Email atau Password harus di isi";
        header("Location: login.php");
        exit();
    }


    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn , $query);
    $user = mysqli_fetch_assoc($result);


    if ($user)
    {
        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['nama'] = $user['nama'];
        header("Location: kandidat.php");
    }else
    {
        $_SESSION['login_error_admin'] = " email atau password salah";
        header("Location: login.php");
    }
}

?>