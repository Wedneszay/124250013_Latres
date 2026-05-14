<?php
session_start();
include 'connection.php';

$id = $_GET['id'];
$query = "DELETE FROM databuku WHERE id='$id'";

/* echo $query; 
die(); */
$result = mysqli_query($koneksi, $query);

if ($result) {
    header('Location: koleksibuku.php');
    exit();
}
else {
    echo "Gagal menghapus buku:" . mysqli_error($koneksi);
}
?>