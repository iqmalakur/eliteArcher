<?php
require_once "../function/fungsi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    if (tambahJadwal($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

if (isset($_POST['ubah'])) {
    if (ubahJadwal($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

$jadwal = $db->getResult("SELECT * FROM jadwal");
$pengurus = $db->getResult("SELECT * FROM pengurus WHERE jabatan='Pelatih'");
$kelas = $db->getResult("SELECT * FROM kelas");
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
            <a class="navbar-brand" href="index.php"><img src="../img/logo/target2.png" alt="logo" class="logo">Elite Archer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="anggota.php">Anggota</a>
                    <a class="nav-item nav-link" href="gallery.php">Gallery</a>
                    <a class="nav-item nav-link" href="berita.php">Berita</a>
                    <a class="nav-item nav-link pageScroll" href="#top">Jadwal</a>
                    <a class="nav-item nav-link" href="pengurus.php">Pengurus</a>
                    <a href="../function/logout.php" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Table Jadwal -->
    <section class="jadwal container">
        <h1 class="text-center judul mb-5">Jadwal</h1>
        <?php
        if (isset($_POST['tambah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Jadwal Telah Ditambahkan!", "success");
            } else {
                simpleAlert("Gagal!", "Jadwal Gagal Ditambahkan!", "danger");
            }
        }

        if (isset($_POST['ubah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Jadwal Telah Diubah!", "success");
            } else {
                simpleAlert("Gagal!", "Jadwal Gagal Diubah!", "danger");
            }
        }

        if (isset($_SESSION['delete'])) {
            if ($_SESSION['delete'] == "success") {
                simpleAlert("Berhasil Dihapus!", "Jadwal Berhasil Dihapus", "success");
            } else {
                simpleAlert("Gagal Dihapus!", "Jadwal Gagal Dihapus", "danger");
            }
            $_SESSION['delete'] = null;
        }
        ?>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Pelatih/Pembimbing</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $j) : ?>
                    <?php
                    $pelatih = $db->getSingleSpecific("pengurus", "idpengurus", $j['idpengurus']);
                    $kelass = $db->getSingleSpecific("kelas", "idkelas", $j['idkelas']);
                    ?>
                    <tr>
                        <td><?= $kelass['namakelas']; ?></td>
                        <?php if ($j['tgl'] != "0000-00-00") : ?>
                            <td><?= $j['hari'] . ' ' . $j['tgl']; ?></td>
                        <?php else : ?>
                            <td><?= $j['hari']; ?></td>
                        <?php endif ?>
                        <td><?= $j['mulai'] . ' - ' . $j['selesai']; ?></td>
                        <td><?= $pelatih['nama']; ?></td>
                        <td><?= $j['type']; ?></td>
                        <td>
                            <button type="button" data-id="<?= $j['idjadwal']; ?>" class="btn btn-info btnUbah ubahJadwal" data-toggle="modal" data-target="#addJadwal">Ubah</button>
                            <a href="../function/hapus.php?id=<?= $j['idjadwal']; ?>&table=jadwal&hal=jadwal" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Jadwal ini?">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
    <!-- Akhir Table Jadwal -->

    <!-- Modal Bootstrap -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary tambah tambahJadwal" data-toggle="modal" data-target="#addJadwal">
        Tambah Data Jadwal
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" name="kelas" id="kelas">
                                <?php foreach ($kelas as $kls) : ?>
                                    <option value="<?= $kls['idkelas']; ?>"><?= $kls['namakelas']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pelatih">Pelatih</label>
                            <select class="form-control" name="pelatih" id="pelatih">
                                <?php foreach ($pengurus as $p) : ?>
                                    <option value="<?= $p['idpengurus']; ?>"><?= $p['nama']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select class="form-control" name="hari" id="hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Ahad">Ahad</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <input type="date" name="tgl" id="tgl" class="form-control" readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mulai">Mulai</label>
                                <input type="time" class="form-control" id="mulai" name="mulai" value="08:00" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="selesai">Selesai</label>
                                <input type="time" class="form-control" id="selesai" name="selesai" value="10:00" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="Latihan">Latihan</option>
                                <option value="Perlombaan">Perlombaan</option>
                                <option value="Latihan Nasional">Latihan Nasional</option>
                                <option value="Latihan Bersama">Latihan Bersama</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="tambah">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Bootstrap -->

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