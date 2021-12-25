<?php
require_once "../function/fungsi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    if (tambahGallery($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

if (isset($_POST['ubah'])) {
    if (ubahGallery($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

$gallery = $db->getResult("SELECT * FROM gallery");
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
                    <a class="nav-item nav-link pageScroll" href="#top">Gallery</a>
                    <a class="nav-item nav-link" href="berita.php">Berita</a>
                    <a class="nav-item nav-link" href="jadwal.php">Jadwal</a>
                    <a class="nav-item nav-link" href="pengurus.php">Pengurus</a>
                    <a href="../function/logout.php" class="btn btn-danger">Log Out</a>
                </div>

            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Table Gallery -->
    <section class="gallery container">
        <h1 class="text-center judul mb-5">Gallery</h1>
        <?php
        if (isset($_POST['tambah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Data Telah Ditambahkan!", "success");
            } else {
                simpleAlert("Gagal!", "Data Gagal Ditambahkan!", "danger");
            }
        }

        if (isset($_POST['ubah'])) {
            if ($success) {
                simpleAlert("Berhasil!", "Data Telah Diubah!", "success");
            } else {
                simpleAlert("Gagal!", "Data Gagal Diubah!", "danger");
            }
        }

        if (isset($_SESSION['errFoto'])) {
            if ($_SESSION['errFoto'] == true) {
                simpleAlert("Error!", "Tipe File Tidak Didukung!", "danger");
                $_SESSION['errFoto'] = false;
            }
        }

        if (isset($_SESSION['errSize'])) {
            if ($_SESSION['errSize'] == true) {
                simpleAlert("Error!", "Ukuran File Terlalu Besar!", "danger");
                $_SESSION['errSize'] = false;
            }
        }

        if (isset($_SESSION['delete'])) {
            if ($_SESSION['delete'] == "success") {
                simpleAlert("Berhasil Dihapus!", "Data Berhasil Dihapus", "success");
            } else {
                simpleAlert("Gagal Dihapus!", "Data Gagal Dihapus", "danger");
            }
            $_SESSION['delete'] = null;
        }
        ?>
        <div class="search">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="Cari Data Gallery berdasarkan Caption..." id="cariGallery" autofocus>
            </div>
        </div>
        <div class="tabledata">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Caption</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gallery as $g) : ?>
                        <tr>
                            <td><img src="../img/gallery/<?= $g['gambar']; ?>" alt="<?= $g['gambar']; ?>" width="100"></td>
                            <td><?= $g['caption']; ?></td>
                            <td>
                                <button type="button" data-id="<?= $g['idgallery']; ?>" class="btn btn-info btnUbah ubahGallery" data-toggle="modal" data-target="#addGallery">Ubah</button>
                                <a href="../function/hapus.php?id=<?= $g['idgallery']; ?>&table=gallery&hal=gallery" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Gallery ini?">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="imgfocus"><img src="" alt="gallery"></div>
    </section>
    <!-- Akhir Table Gallery -->

    <!-- Modal Bootstrap -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary tambah tambahGallery" data-toggle="modal" data-target="#addGallery">
        Tambah Data Gallery
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addGallery" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Tambah Data Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="inputfile">Gambar</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="fileInput">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input fileGallery" id="inputfile" aria-describedby="fileInput" name="gallery" required="true">
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