<?php
session_start();
include 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = mysqli_query($koneksi, $query);

if (empty($username) || empty($password)) {
    $_SESSION['loginError'] = 'Username dan Password tidak boleh kosong!';
    header('Location: index.php');
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    if ($user['role'] == 'admin') {
        header('Location: dashboardAdmin.php');
    }
    else {
        header('Location: koleksibuku.php');
    }
    exit();
}
else {
    $_SESSION['loginError'] = "[ERROR] Email atau Password salah!";
    header('Location: index.php');
    exit();
}
?>