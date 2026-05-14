<?php
session_start();
include 'connection.php';

if ($_SESSION['loggedIn'] != true) {
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM databuku WHERE stok > 0";
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
    </head>
    <main class="content">
        <div class="wrapper-form-pinjam">
            <form action="proses_pinjam.php" method="post">
                <div class="title-form-pinjam">
                    <h4>Form Peminjaman Buku</h4>
                </div>
                <?php
                if (isset($_SESSION['gagalInsertPinjam'])) { ?>
                    <div class="alert alert-danger text-center" role="alert" style="font-size: 0.8rem;">
                        <?php echo $_SESSION['gagalInsertPinjam'];
                        unset($_SESSION['gagalInsertPinjam']); ?>
                    </div>
                <?php
                } ?>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode Peminjaman</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="kode_peminjaman" value="PJ000" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" name="nama_peminjam" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Pilih Buku</label>
                        <select class="form-select" id="exampleFormControlInput3" name="id_buku" aria-label="Default select example" required>
                        <option selected disabled hidden>Pilih Buku Tersedia</option>
                        <?php while($row = mysqli_fetch_assoc($result)) {?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['judul'] ?> - <?php echo "Stok ", $row['stok'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="wrapper-date">
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput4" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="exampleFormControlInput4" name="tanggal_pinjam" required>
                    </div>
                    <div class="mb-3 ms-auto col-md-6">
                        <label for="exampleFormControlInput5" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="exampleFormControlInput5" name="deadline" required>
                    </div>
                </div>
                <div class="form-button d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>