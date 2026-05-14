<?php
session_start();
include 'connection.php';

$query = "SELECT datapeminjam.id, datapeminjam.kode_peminjaman, datapeminjam.nama_peminjam, datapeminjam.id_buku, databuku.judul, datapeminjam.tanggal_pinjam, datapeminjam.deadline, datapeminjam.tanggal_kembali FROM datapeminjam JOIN databuku ON datapeminjam.id_buku = databuku.id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="stylepustaka.css">
</head>
<body class="body-peminjaman">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="koleksibuku.php">Pustaka Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="list_koleksi.php">Koleksi Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="list_peminjaman.php">Peminjaman</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a role="button" href="logout.php" class="btn btn-light btn-explore"><i class="bi bi-box-arrow-right"></i> Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="content-peminjaman">
        <div class="wrapper-title-pinjam">
            <h1>Database Peminjaman</h1>
        </div>
        <div class="wrapper-peminjaman">
            <div class="button-catat-pinjam">
                <a role="button" href="form_pinjam.php" class="btn btn-secondary btn-explore"><i class="bi bi-file-earmark-plus"></i> Catat Peminjaman</a>
            </div>
            <div class="wrapper-table">
                <table class="list-peminjaman">
                    <thead>
                        <tr class="title-table">
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($result) == 0) { ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                <?php echo "Data masih kosong"; ?>
                            </td>
                        </tr>
                        <?php }
                        ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) {?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['kode_peminjaman']; ?></td>
                            <td><?php echo $row['nama_peminjam']; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['tanggal_pinjam']; ?></td>
                            <td><?php echo $row['deadline']; ?></td>
                            <td>
                                <?php
                                if ($row['tanggal_kembali'] != NULL) {
                                    $deadline = strtotime($row['deadline']);
                                    $tanggal_kembali = strtotime($row['tanggal_kembali']);

                                    if ($tanggal_kembali <= $deadline) {
                                        echo "Dikembalikan";
                                    }
                                    else {
                                        echo "Terlambat";
                                    }
                                }
                                else {
                                    echo "Masih dipinjam";
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($row['tanggal_kembali'] == NULL) { ?>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiKembali<?php echo $row['id'], $row['id_buku']; ?>">
                                        Kembalikan
                                    </button>
                                    <div class="modal fade" id="modalKonfirmasiKembali<?php echo $row['id'], $row['id_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pengembalian</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Ingin mengembalikan?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a class="btn btn-primary" href="proses_kembali.php?id=<?php echo $row['id']; ?>&id_buku=<?php echo $row['id_buku']; ?>" role="button">Konfirmasi</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } 
                                else { ?> 
                                    <span class="badge bg-success">Selesai</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </main>
</body>
</html>