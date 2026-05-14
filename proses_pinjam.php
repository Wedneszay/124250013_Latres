<?php
session_start();
include 'connection.php';

$kode_peminjaman = $_POST['kode_peminjaman'];
$nama_peminjam = $_POST['nama_peminjam'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$deadline = $_POST['deadline'];

$cekKode = "SELECT * FROM datapeminjam WHERE kode_peminjaman = '$kode_peminjaman'";
$resultCek = mysqli_query($koneksi, $cekKode);

if (mysqli_num_rows($resultCek)) {
    $_SESSION['gagalInsertPinjam'] = "Gagal menambahkan peminjaman! Kode peminjaman sudah digunakan.";
    header('Location: form_pinjam.php');
    exit();
}
else {
    $queryInsert = "INSERT INTO datapeminjam(id, kode_peminjaman, nama_peminjam, id_buku, tanggal_pinjam, deadline) VALUES (' ','$kode_peminjaman','$nama_peminjam','$id_buku','$tanggal_pinjam','$deadline')";
    $resultInsert = mysqli_query($koneksi, $queryInsert);
    if ($resultInsert) {
        $updateStok = "UPDATE databuku SET stok = stok - 1 WHERE id = '$id_buku'";
        header('Location: list_peminjaman.php');
        exit();
    }
    else {
        echo "Gagal menambahkan data peminjam" . mysqli_error($koneksi);
    }
}


?>