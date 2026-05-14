<?php
session_start();
include 'connection.php';
$id = $_GET['id'];

if ($_SESSION['loggedIn'] != true) {
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM databuku WHERE id='$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="stylepustaka.css">
</head>
<body class="body-form-edit">
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
                            <a role="button" href="logout.php" class="btn btn-warning btn-explore">Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="content-form-edit">
        <div class="wrapper-form-edit">
            <form class="form-edit" action="proses_edit.php" method="post">
                <div class="title-form-edit">
                    <h4>Form Edit Buku</h4>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ID Buku</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="id" readonly value="<?php echo $row['id']; ?>">
                </div>
                <div class="wrapper-kode-stok">
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Kode Buku</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" name="kodeBuku" value="<?php echo $row['kode_buku']; ?>">
                    </div>
                    <div class="mb-3 ms-auto">
                        <label for="exampleFormControlInput3" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" id="exampleFormControlInput3" name="stok" value="<?php echo $row['stok']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="exampleFormControlInput4" name="judul" value="<?php echo $row['judul']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="exampleFormControlInput5" name="pengarang" value="<?php echo $row['pengarang']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Kategori</label>
                    <select class="form-select" id="exampleFormControlInput6" name="kategori" aria-label="Default select example" required>
                        <option selected hidden><?php echo $row['kategori']; ?></option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Ilmiah">Ilmiah</option>
                        <option value="Novel">Novel</option>
                        <option value="Komedi">Komedi</option>
                    </select>
                </div>
                <div class="form-button d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>    
            </form>
        </div>
    </main>
</body>
</html>