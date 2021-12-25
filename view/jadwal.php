<?php
require_once "../function/fungsi.php";

$type = ["Latihan", "Latihan Bersama", "Latihan Nasional", "Perlombaan"];
?>
<!DOCTYPE html>
<html lang="en" id="top">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Elite Archer - Jadwal</title>
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
                    <a class="nav-item nav-link pageScroll" href="#top">Jadwal Kegiatan</a>
                    <a class="nav-item nav-link" href="pengurus.php">Kepengurusan</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Jadwal -->
    <section class="container" id="jadwal">
        <h1 class="judul text-center mb-5">Jadwal Kegiatan</h1>
        <?php foreach ($type as $t) : ?>
            <hr>
            <h1 class="ml-3 mb-4 mt-3"><?= $t; ?></h1>
            <?php
                $kelas = $db->getResult("SELECT * FROM kelas");
            ?>
            <?php foreach ($kelas as $kls) : ?>
                <?php
                $jadwal = $db->getResult("SELECT * FROM jadwal WHERE idkelas='" . $kls['idkelas'] . "' AND type='" . $t . "'");
                ?>
                <h3 class="ml-3"><?= $kls['namakelas']; ?></h3>
                <table class="table table-hover mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Pelatih/Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwal as $j) : ?>
                            <?php
                            $pelatih = $db->getSingleSpecific("pengurus", "idpengurus", $j['idpengurus'])['nama'];
                            ?>
                            <tr>
                                <?php if($j['tgl'] != "0000-00-00"): ?>
                                    <th scope="row"><?= $j['hari'] . ' ' . $j['tgl']; ?></th>
                                <?php else: ?>
                                    <th scope="row"><?= $j['hari']; ?></th>
                                <?php endif ?>
                                <td><?= $j['mulai'] . ' - ' . $j['selesai']; ?></td>
                                <td><?= $pelatih; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endforeach ?>
        <?php endforeach ?>
    </section>
    <!-- Akhir Jadwal -->

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