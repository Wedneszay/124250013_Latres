<?php
session_start();
include 'connection.php';

$id = $_POST['id'];
$kode_buku = $_POST['kodeBuku'];
$stok = $_POST['stok'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$kategori = $_POST['kategori'];

$query = "UPDATE databuku SET id = '$id', kode_buku = '$kode_buku', stok = '$stok', judul = '$judul', pengarang = '$pengarang', kategori = '$kategori' WHERE id = '$id'";
/* echo $query; 
die(); */

$result = mysqli_query($koneksi, $query);

if ($result) {
    header('Location: koleksibuku.php');
    exit();
}
else {
    echo "Gagal mengubah data: " . mysqli_error($koneksi);
}
?>