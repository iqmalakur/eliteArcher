<?php
    require "function/fungsi.php";

    $image = query("SELECT * FROM img");
    $berita = query("SELECT * FROM berita");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Home</title>
</head>
<body id="top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#top">
                <img src="img/logo/target2.png" width="30" height="30" class="d-inline-block align-top"
                    alt="logo">
                Archery
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item pageScroll" href="#info">Info</a>
                            <a class="dropdown-item pageScroll" href="#gallery">Gallery</a>
                            <a class="dropdown-item pageScroll" href="#berita">Berita</a>
                            <a class="dropdown-item pageScroll" href="#contact">Contact Us</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pendataan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Laporan Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jadwal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4 text-center judul">Olahraga Panahan</h1>
            <p class="lead text-center">Lebih Berani, Lebih Percaya Diri</p>
            <br>
            <p>Tepat Sasaran itu Utama</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Daftar Sekarang <img src="img/logo/target1.png" width="30" height="30" class="d-inline-block align-top" alt="logo"></a>
        </div>
    </div>

    <!-- Info -->
    <section class="container" id="info">
        <h1 class="text-center judul">Information</h1>
        <hr class="garis">
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam autem, cupiditate, blanditiis quo minima molestiae aspernatur, modi reiciendis dolorum odio accusantium incidunt aut perspiciatis quibusdam quia laudantium laboriosam exercitationem distinctio?</p>
            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim excepturi dolores corrupti quasi molestias sint iste similique quidem molestiae sed cum asperiores minus neque, ipsum hic pariatur. Aspernatur, facilis iusto!</p>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="container" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-center judul">Gallery</h1>
                    <hr class="garis">
                </div>
            </div>
            <div class="row text-center">
                <?php foreach($image as $img): ?>
                    <div class="col-sm-4">
                        <a href="#" class="thumbnail"><img src="img/gallery/<?= $img['img'] ?>" alt="<?= $img['caption'] ?>" class="thumb">
                        <br>
                        <p><?= $img['caption']; ?></p></a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- Berita -->
    <section class="container" id="berita">
        <h1 class="text-center judul">Berita</h1>
        <hr class="garis">
        <?php foreach($berita as $b): ?>
            <div class="row berita">
                <div class="col-md-3 offset-1"><img src="img/berita/<?= $b['gambar']; ?>" alt="news"></div>
                <div class="col-md-7"><?= $b['isi']; ?></div>
            </div>
        <?php endforeach ?>
    </section>

    <!-- Contact Us -->
    <section class="container" id="contact">
        <h1 class="text-center judul">Contact Us</h1>
        <hr class="garis">
        <form action="" method="post">
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label col-form-label-lg">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form form-control-lg" id="nama" name="nama" required="true">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control form form-control-lg" id="email" name="email" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea name="pesan" class="form-control form form-control-lg"
                        placeholder="Masukkan Pesan..." rows="5" required="true"></textarea>
                </div>
            </div>
            <button type="submit" name="komentar" class="btn btn-success mybtn">Kirim Komentar</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="text-center bg-dark text-light">
        &#169; Copyright 2020 | Perpustakaankuuu
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- My JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>