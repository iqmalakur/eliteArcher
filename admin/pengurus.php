<?php
require_once "../function/fungsi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    if (tambahPengurus($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

if (isset($_POST['ubah'])) {
    if (ubahPengurus($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

$pengurus = $db->getResult("SELECT * FROM pengurus");
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
                    <a class="nav-item nav-link" href="jadwal.php">Jadwal</a>
                    <a class="nav-item nav-link pageScroll" href="#top">Pengurus</a>
                    <a href="../function/logout.php" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Table Pengurus -->
    <section class="pengurus container">
        <h1 class="text-center judul mb-5">Pengurus</h1>
        <?php
        if (isset($_POST['tambah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Pengurus Telah Ditambahkan!", "success");
            } else {
                simpleAlert("Gagal!", "Pengurus Gagal Ditambahkan!", "danger");
            }
        }

        if (isset($_POST['ubah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Pengurus Telah Diubah!", "success");
            } else {
                simpleAlert("Gagal!", "Tidak Ada Data yang Diubah!", "danger");
            }
        }

        if (isset($_SESSION['delete'])) {
            if ($_SESSION['delete'] == "success") {
                simpleAlert("Berhasil Dihapus!", "Pengurus Berhasil Dihapus", "success");
            } else {
                simpleAlert("Gagal Dihapus!", "Pengurus Gagal Dihapus", "danger");
            }
            $_SESSION['delete'] = null;
        }
        ?>
        <div class="search">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="Cari Data Pengurus berdasarkan Nama, Jabatan, Jenis Kelamin, Email, dan No.Telp..." id="cariPengurus" autofocus>
            </div>
        </div>
        <div class="tabledata">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengurus as $p) : ?>
                        <tr>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['jabatan']; ?></td>
                            <td><?= $p['jk']; ?></td>
                            <td><?= $p['email']; ?></td>
                            <td><?= $p['notel']; ?></td>
                            <td>
                                <button type="button" data-id="<?= $p['idpengurus']; ?>" class="btn btn-info btnUbah ubahPengurus" data-toggle="modal" data-target="#addPengurus">Ubah</button>
                                <a href="../function/hapus.php?id=<?= $p['idpengurus']; ?>&table=pengurus&hal=pengurus" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Pengurus ini?">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Akhir Table Pengurus -->

    <!-- Modal Bootstrap -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary tambah tambahPengurus" data-toggle="modal" data-target="#addPengurus">
        Tambah Data Pengurus
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addPengurus" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Tambah Data Pengurus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="formdata">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required="true" maxlength="30">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required="true" maxlength="50">
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
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="form-control" name="jabatan" id="jabatan">
                                <?php if ($db->getCount("pengurus", "WHERE jabatan='Founder & Leader'") == 1) : ?>
                                    <option value="Founder & Leader" disabled>Founder & Leader</option>
                                    <option value="Founder" disabled>Founder</option>
                                    <option value="Leader" disabled>Leader</option>
                                <?php elseif ($db->getCount("pengurus", "WHERE jabatan='Founder'") == 1) : ?>
                                    <option value="Founder & Leader" disabled>Founder & Leader</option>
                                    <option value="Founder" disabled>Founder</option>
                                    <option value="Leader">Leader</option>
                                <?php elseif ($db->getCount("pengurus", "WHERE jabatan='Leader'") == 1) : ?>
                                    <option value="Founder & Leader" disabled>Founder & Leader</option>
                                    <option value="Founder">Founder</option>
                                    <option value="Leader" disabled>Leader</option>
                                <?php else : ?>
                                    <option value="Founder & Leader">Founder & Leader</option>
                                    <option value="Founder">Founder</option>
                                    <option value="Leader">Leader</option>
                                <?php endif ?>
                                <?php if ($db->getCount("pengurus", "WHERE jabatan='Co-Leader'") == 2) : ?>
                                    <option value="Co-Leader" disabled>Co-Leader</option>
                                <?php else : ?>
                                    <option value="Co-Leader">Co-Leader</option>
                                <?php endif ?>
                                <option value="Pelatih" selected>Pelatih</option>
                                <?php if ($db->getCount("pengurus", "WHERE jabatan='Administrator'") == 2) : ?>
                                    <option value="Administrator" disabled>Administrator</option>
                                <?php else : ?>
                                    <option value="Administrator">Administrator</option>
                                <?php endif ?>
                                <?php if ($db->getCount("pengurus", "WHERE jabatan='Information Center'") == 2) : ?>
                                    <option value="Information Center" disabled>Information Center</option>
                                <?php else : ?>
                                    <option value="Information Center">Information Center</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputfile">Foto</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="fileInput">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input filePengurus" id="inputfile" aria-describedby="fileInput" name="foto">
                                    <label class="custom-file-label" for="inputfile">Choose file</label>
                                </div>
                            </div>
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