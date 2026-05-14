<?php
session_start();
include 'connection.php';

$id = $_GET['id'];
$id_buku = $_GET['id_buku'];
$tanggal_sekarang = date('Y-m-d');

$cekDeadline = "SELECT deadline FROM datapeminjam WHERE id = '$id'";
$resultCek = mysqli_query($koneksi, $cekDeadline);
$row = mysqli_fetch_assoc($resultCek);
$tanggal_kembali = $row['deadline'];

$updateTanggal = "UPDATE datapeminjam SET tanggal_kembali='$tanggal_sekarang' WHERE id = '$id'";
$resultTanggal = mysqli_query($koneksi, $updateTanggal);

$updateStok = "UPDATE databuku SET stok = stok + 1 WHERE id= = '$id_buku'";
$resultStok = mysqli_query($koneksi, $updateStok);

if ($resultTanggal) {
    header('Location: list_peminjaman.php');
    exit();
}

?>