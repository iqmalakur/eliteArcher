<?php
require_once "../function/fungsi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = $db->getResult("SELECT * FROM pesan");
$anggota = $db->count("anggota", "GROUP BY status", "count", "status");
$pelatih = $db->getCount("pengurus", "WHERE jabatan='Pelatih'");
$gallery = $db->getCount("gallery");
$berita = $db->getCount("berita");
$avg = floor($db->getAvg("pengunjung", "pengunjung"));
$today = date("Y-m-d", time());
$totalpengunjung = $db->getResult("SELECT * FROM pengunjung");
$pengunjung = $db->getSingleSpecific("pengunjung", "tanggal", "$today");
if ($pengunjung != null) {
    $pengunjung = $pengunjung['pengunjung'];
} else {
    $pengunjung = 0;
}

$total = 0;
foreach ($totalpengunjung as $p) {
    $i = $p['pengunjung'];
    $total += $i;
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

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand pageScroll" href="#top"><img src="../img/logo/target2.png" alt="logo" class="logo">Elite Archer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="anggota.php">Anggota</a>
                    <a class="nav-item nav-link" href="gallery.php">Gallery</a>
                    <a class="nav-item nav-link" href="berita.php">Berita</a>
                    <a class="nav-item nav-link" href="jadwal.php">Jadwal</a>
                    <a class="nav-item nav-link" href="pengurus.php">Pengurus</a>
                    <a href="../function/logout.php" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Container -->
    <section class="container admin">
        <h1 class="text-center judul mb-5">Data Elite Archer</h1>
        <div class="data">
            <h2 class="mb-3">Data <a href="../.php">Pengunjung</a></h2>
            <div class="item">
                <h4>Total Pengunjung Web : <?= $total; ?></h4>
                <h4>Total Pengunjung Web Hari ini : <?= $pengunjung; ?></h4>
                <h4>Rata-Rata Pengunjung Web : <?= $avg; ?> Per Hari</h4>
            </div>
            <div class="row mt-5 item ml-1 mr-1">
                <div class="col-md">
                    <h2 class="mb-3">Data <a href="anggota.php">Anggota</a></h2>
                    <h4>Total <?= $anggota[0]['status']; ?> : <?= $anggota[0]['count']; ?></h4>
                    <h4>Total <?= $anggota[1]['status']; ?> : <?= $anggota[1]['count']; ?></h4>
                </div>
                <div class="col-md">
                    <h2>Data <a href="pengurus.php">Pelatih</a></h2>
                    <h4>Total Pelatih : <?= $pelatih; ?></h4>
                </div>
            </div>
            <div class="row mt-5 item ml-1 mr-1">
                <div class="col-md">
                    <h2 class="mb-3">Data <a href="berita.php">Berita</a></h2>
                    <h4>Total Berita : <?= $berita; ?></h4>
                </div>
                <div class="col-md">
                    <h2>Data <a href="gallery.php">Gallery</a></h2>
                    <h4>Total Gallery : <?= $gallery; ?></h4>
                </div>
            </div>
        </div>
        <h1 class="text-center judul mb-5 mt-5">Pesan Member</h1>
        <div class="data pesan pb-5">
            <?php foreach ($pesan as $p) : ?>
                <div class="item mt-5">
                    <h4><?= $p['nama']; ?></h4>
                    <h6>Balas : <a href="mailto:<?= $p['email']; ?>"><?= $p['email']; ?></a> | <?= $p['notel']; ?></h6>
                    <h5><?= $p['pesan']; ?></h5>
                    <p class="text-right"><?= $p['tanggal']; ?></p>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <!-- Akhir Container -->

    <!-- Footer -->
    <footer class="copyright bg-dark text-center">
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