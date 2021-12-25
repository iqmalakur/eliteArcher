<?php
require_once "../function/fungsi.php";
session_start();

$error = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin") {
        $_SESSION['login'] = true;
        header("Location: index.php");
    } else {
        $error = true;
    }
}

if (isset($_SESSION['login'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" id="top">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Elite Archer Admin</title>
</head>

<body class="admin">
    <!-- Form Login -->
    <section class="login">
        <div class="loginform">
            <a href="../">
                <h1>Admin Area</h1>
            </a>
            <hr>
            <h2>Login</h2>
            <?php
            if ($error) {
                simpleAlert("Login Gagal!", "Username atau Password Salah!", "danger");
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" required="true" placeholder="Username..." autocomplete="off" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" required="true" placeholder="Password..." autocomplete="off">
                </div>
                <button type="submit" name="login" class="btn btn-success">Login</button>
            </form>
        </div>
    </section>
    <!-- Akhir Form Login -->

    <!-- Footer -->
    <footer class="copyright bg-dark text-center fixed-bottom">
        <span>&#169; Copyright Elite Archer 2020 | Iqmal Akbar Kurnia</span>
    </footer>
    <!-- Akhir Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>