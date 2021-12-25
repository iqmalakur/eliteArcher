<?php
require_once "../function/fungsi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['daftar'])) {
    if (tambahAnggota($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

if (isset($_POST['ubah'])) {
    if (ubahAnggota($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

if (isset($_SESSION['delete'])) {
    if ($_SESSION['delete'] != null) {
        if ($_SESSION['delete'] == "success") {
            $delete = true;
        } else {
            $delete = false;
        }
    }
}

$members = $db->getResult("SELECT * FROM anggota");
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
                    <a class="nav-item nav-link pageScroll" href="#top">Anggota</a>
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

    <!-- Table Anggota -->
    <section class="anggota container">
        <h1 class="text-center mb-5 judul">Data Anggota</h1>
        <?php
        if (isset($_POST['daftar'])) {
            if ($success) {
                simpleAlert("Daftar Berhasil!", "Pendaftaran Anggota telah berhasil!", "success");
            } else {
                simpleAlert("Daftar Gagal!", "Periksa kembali data yang anda masukan!", 'danger');
            }
        }
        if (isset($_POST['ubah'])) {
            if ($success) {
                simpleAlert("Ubah Berhasil!", "Data Anggota Berhasil Diubah!", "success");
            } else {
                simpleAlert("Ubah Gagal!", "Periksa kembali data yang anda masukan!", 'danger');
            }
        }
        if (isset($_SESSION['delete'])) {
            if ($_SESSION['delete'] != null) {
                if ($delete) {
                    simpleAlert("Hapus Berhasil!", "Data Anggota Berhasil Dihapus!", "success");
                } else {
                    simpleAlert("Hapus Gagal!", "Data Anggota gagal Dihapus!", 'danger');
                }
                $_SESSION['delete'] = null;
            }
        }
        ?>
        <div class="search">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="Cari Data Anggota berdasarkan Jenis Identitas, No.Identitas, Nama, Email, No.Telp, Jenis Kelamin, Alamat, dan Status..." id="cariAnggota" autofocus>
            </div>
        </div>
        <div class="tabledata">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Identitas</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member) : ?>
                        <tr>
                            <td><?= $member['idn'] . ' - ' . $member['noidn']; ?></td>
                            <td><?= $member['nama']; ?></td>
                            <td><?= $member['email']; ?></td>
                            <td><?= $member['notel']; ?></td>
                            <td><?= $member['jk']; ?></td>
                            <td><?= $member['alamat']; ?></td>
                            <td><?= $member['kelas']; ?></td>
                            <td><?= $member['status']; ?></td>
                            <td>
                                <button type="button" data-id="<?= $member['id'] ?>" class="btn btn-info btnUbah ubahAnggota" data-toggle="modal" data-target="#addDataMember">Ubah</button>
                                <a href="../function/hapus.php?id=<?= $member['id']; ?>&table=anggota&hal=anggota" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Anggota ini?">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Akhir Table Anggota -->

    <!-- Modal Bootstrap -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary tambah tambahdata" data-toggle="modal" data-target="#addDataMember">
        Tambah Data Anggota
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addDataMember" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Tambah Data Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="dataform">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idn">Tipe Identitas</label>
                                    <select class="form-control" name="idn" id="idn">
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                        <option value="Kartu Pelajar">Kartu Pelajar</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noidn">Nomor Identitas</label>
                                    <input type="number" class="form-control" id="noidn" name="noidn" required="true" maxlength="30">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required="true" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="notel">No Telepon</label>
                                    <input type="tel" class="form-control" id="notel" name="notel" required="true" maxlength="15">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lk">Jenis Kelamin</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="lk" name="jk" class="custom-control-input" value="Laki Laki" checked>
                                    <label class="custom-control-label" for="lk">Laki Laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="perempuan" name="jk" class="custom-control-input" value="Perempuan">
                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" required="true" maxlength="100"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" name="kelas" id="kelas">
                                    <?php foreach ($kelas as $kls) : ?>
                                        <option value="<?= $kls['idkelas']; ?>"><?= $kls['namakelas']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status Member</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Member">Member</option>
                                    <option value="Pre-Member">Pre-Member (Belum Bayar)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Per Bulan</label>
                            <input type="number" class="form-control" name="harga" id="harga" value="<?= $kelas[0]['hargakelas'] ?>" readonly>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="false" id="addons" name="addons">
                                <label class="form-check-label" for="addons">Sertakan Alat Panah (Busur, Anak Panah, dan lain-lain)</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="daftar">Tambah Data</button>
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