<?php
session_start();
include 'connection.php';

$kode_buku = $_POST['kodeBuku'];
$stok = $_POST['stok'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$kategori = $_POST['kategori'];

$cekKode = "SELECT * FROM databuku WHERE kode_buku = '$kode_buku'";
$resultCek = mysqli_query($koneksi, $cekKode);

if (mysqli_num_rows($resultCek) > 0) {
    $_SESSION['insertGagal'] = "Insert gagal! Kode buku sudah digunakan.";
    header('Location: list_koleksi.php');
    exit();
}
else {
    $queryInsert = "INSERT INTO databuku(id, kode_buku, judul, pengarang, kategori, stok) VALUES (' ','$kode_buku','$judul','$pengarang','$kategori','$stok')";
    $resultInsert = mysqli_query($koneksi, $queryInsert);
    if ($resultInsert) {
        header('Location: list_koleksi.php');
        exit();
    }
    else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}
?>