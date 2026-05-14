<?php
session_start();
include 'connection.php';

if ($_SESSION['loggedIn'] != true) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM databuku WHERE id='$id'";

/* echo $query; 
die(); */
$result = mysqli_query($koneksi, $query);

if ($result) {
    header('Location: list_koleksi.php');
    exit();
}
else {
    echo "Gagal menghapus buku:" . mysqli_error($koneksi);
}
?>