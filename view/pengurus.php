<?php
require_once "../function/fungsi.php";

if ($leadFound = $db->getSingleSpecific("pengurus", "jabatan", "Founder & Leader")) {
    $jabatan = ["Founder & Leader", "Co-Leader", "Administrator", "Information Center", "Pelatih"];
} else {
    $jabatan = ["Founder", "Leader", "Co-Leader", "Administrator", "Information Center", "Pelatih"];
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

    <title>Elite Archer - Pengurus</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../"><img src="../img/logo/target2.png" alt="logo" class="logo">Elite Archer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="pendaftaran.php">Pendaftaran</a>
                    <a class="nav-item nav-link" href="jadwal.php">Jadwal Kegiatan</a>
                    <a class="nav-item nav-link pageScroll" href="#top">Kepengurusan</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Pengurus -->
    <section class="pengurus container">
        <h1 class="text-center judul mb-5">Pengurus Organisasi</h1>
        <div id="pengurus" class="pb-5">
            <?php foreach ($jabatan as $jbtn) : ?>
                <div class="row justify-content-center">
                    <?php
                    $pengurus = $db->getResultSpecific("pengurus", "jabatan", $jbtn);
                    ?>
                    <?php foreach ($pengurus as $p) : ?>
                        <div class="col-auto mt-5">
                            <div class="card" style="width: 18rem;">
                                <img src="../img/pengurus/<?= $p['foto']; ?>" class="card-img-top" alt="pengurus">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $p['nama']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $p['jabatan']; ?></h6>
                                    <div class="detail hide">
                                        <h6 class="card-subtitle mb-2 text-muted">Email : <?= $p['email']; ?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Nomor Telepon : <?= $p['notel']; ?></h6>
                                    </div>
                                    <button class="badge badge-pill badge-success">Detail <img src="../img/logo/tandapanah.png" alt="panah"></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <!-- Akhir Pengurus -->

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