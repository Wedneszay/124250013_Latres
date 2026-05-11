<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="stylepustaka.css">
</head>
<body>
    <main class="wrapper-form">
        <form action="proses_login.php" method="POST">
            <div class="form-login">
                <div class="title-form">
                    <h1>Pustaka Digital</h1>
                    <p>Sistem Perpustakaan Nasional</p>
                </div>
                <?php
                if (isset($_SESSION['loginError'])) { ?>
                    <div class="alert alert-danger text-center" role="alert" style="font-size: 0.8rem;">
                        <?php echo $_SESSION['loginError'];
                        unset($_SESSION['loginError']); ?>
                    </div>
                <?php
                } ?>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="username">
                </div>
                <div class="mb-3">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" id="inputPassword5" class="form-control" name="password" aria-describedby="passwordHelpBlock">
                </div>
                <button class="btn btn-primary" type="submit">Masuk</button>
            </div>
        </form>
    </main>
</body>
</html>