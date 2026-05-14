<?php
session_start();

if ($_SESSION['loggedIn'] != true) {
    header('Location: index.php');
    exit();
}
include 'connection.php';

$query = "SELECT * FROM databuku";
$result = mysqli_query($koneksi, $query)
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
<body class="body-collection">
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
                            <a class="nav-link active" aria-current="page" href="list_koleksi.php">Koleksi Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_peminjaman.php">Peminjaman</a>
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
    <main class="content-collection">
        <div class="wrapper-title-collection">
            <h1 class="title-collection">Koleksi Buku</h1>
        </div>
        <div class="wrapper-collection">
            <div class="button-add-collection">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Koleksi
                </button>
                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Koleksi Buku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses_insert.php" method="post">
                                <div class="modal-body">
                                    <div class="wrapper-kode-stok">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Kode Buku</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="kodeBuku" value="BK000" required>
                                        </div>
                                        <div class="mb-3 ms-auto">
                                            <label for="exampleFormControlInput2" class="form-label">Jumlah Stok</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput2" name="stok" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Judul Buku</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput3" name="judul" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput4" class="form-label">Pengarang</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="pengarang" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput5" class="form-label">Kategori</label>
                                        <select class="form-select" id="exampleFormControlInput5" name="kategori" aria-label="Default select example" required>
                                            <option selected disabled hidden>Pilih Kategori</option>
                                            <option value="Fiksi">Fiksi</option>
                                            <option value="Teknologi">Teknologi</option>
                                            <option value="Ilmiah">Ilmiah</option>
                                            <option value="Novel">Novel</option>
                                            <option value="Komedi">Komedi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-table">
                <table class="list-collection">
                    <thead>
                        <tr class="title-table">
                            <th>ID</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['kode_buku']; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['pengarang']; ?></td>
                            <td><?php echo $row['kategori']; ?></td>
                            <td><?php echo $row['stok']; ?></td>
                            <td><?php
                            if ($row['stok'] == 0) {
                                echo "Habis";
                            }
                            else if ($row['stok'] <= 5) {
                                echo "Menipis";
                            }
                            else {
                                echo "Tersedia";
                            }
                            ?></td>
                            <td>
                                <a role="button" href="form_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-explore">Edit</a>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiHapus<?php echo $row['id']; ?>">
                                    Hapus
                                </button>
                                <div class="modal fade" id="modalKonfirmasiHapus<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Buku</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda benar-benar ingin menghapus?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a class="btn btn-primary" href="proses_hapus.php?id=<?php echo $row['id']; ?>" role="button">Konfirmasi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['insertGagal'])) { ?>
                <div class="alert alert-danger text-center" role="alert" style="font-size: 0.8rem;">
                    <?php echo $_SESSION['insertGagal'];
                    unset($_SESSION['insertGagal']); ?>
                </div>
            <?php
            } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>