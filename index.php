<?php
    require_once "function/fungsi.php";
    session_start();

    if (isset($_POST['kirim'])) {
        if (kirimpesan($_POST) > 0) {
            $success = true;
        } else {
            $success = false;
        }
    }

    if (isset($_GET["gallery"])) {
        $pagegallery = $_GET["gallery"];
    } else {
        $pagegallery = 1;
    }

    if (isset($_GET["berita"])) {
        $pageberita = $_GET["berita"];
    } else {
        $pageberita = 1;
    }

    $limitgallery = ($pagegallery - 1) * 6;
    $limitberita = ($pageberita - 1) * 3;

    $berita = $db->getResult("SELECT * FROM berita LIMIT $limitberita,3");
    $gallery = $db->getResult("SELECT * FROM gallery LIMIT $limitgallery,6");
    $countgallery = ceil($db->getCount("gallery") / 6);
    $gallerykosong = 6 - count($gallery);
    $countberita = ceil($db->getCount("berita") / 3);

    for ($i = 0; $i < $gallerykosong; $i++) {
        $gallery[] = [
            'caption' => "Elite Archer",
            'gambar' => "img.png"
        ];
    }

    if (!isset($_SESSION['pengunjung'])) {
        $_SESSION['pengunjung'] = true;
        updatePengunjung();
    }
?>
<!DOCTYPE html>
<html lang="en" id="top">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Elite Archer</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand pageScroll" href="#top"><img src="img/logo/target2.png" alt="logo" class="logo">Elite Archer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="view/pendaftaran.php">Pendaftaran</a>
                    <a class="nav-item nav-link" href="view/jadwal.php">Jadwal Kegiatan</a>
                    <a class="nav-item nav-link" href="view/pengurus.php">Kepengurusan</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Right on <span>Target</span><br> and <span>Confident</span> with us</h1>
            <a href="view/pendaftaran.php" class="btn btn-primary tombol">Daftar Sekarang<img src="img/logo/target1.png" alt="logo" class="logo"></a>
        </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Container -->
    <div class="container">
        <!-- Info Panel -->
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col colinfo">
                        <img src="img/logo/bow.png" alt="bow" class="float-left">
                        <h4>Perlombaan</h4>
                        <p>Kami selalu berpatisipasi dalam berbagai Perlombaan Archery</p>
                    </div>
                    <div class="col colinfo">
                        <img src="img/logo/pelatih.png" alt="pelatih" class="float-left">
                        <h4>Pelatih Profesional</h4>
                        <p>Pelatih memiliki pengalaman yang baik dalam bidang Archery</p>
                    </div>
                    <div class="col colinfo">
                        <img src="img/logo/fasilitas.png" alt="fasilitas" class="float-left">
                        <h4>Fasilitas</h4>
                        <p>Kami memiliki lapangan panah sendiri dan fasilitas lainnya</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Info Panel -->

        <!-- Informasi -->
        <section class="container info" id="info">
            <h1 class="judul text-center mb-5">Apa itu Archery?</h1>
            <div class="row content">
                <div class="col-sm-6 pkiri">Menurut <a href="https://id.wikipedia.org/wiki/Panahan">Wikipedia</a> Panahan (Inggris:Archery) adalah suatu kegiatan menggunakan busur panah untuk menembakkan anak panah. Bukti-bukti menunjukkan bahwa sejarah panahan telah dimulai sejak 5.000 tahun yang lalu yang awalnya digunakan untuk berburu dan kemudian berkembang sebagai senjata dalam pertempuran dan kemudian sebagai olahraga ketepatan. Seseorang yang gemar atau merupakan ahli dalam memanah disebut juga sebagai Pemanah atau dalam bahasa Inggris disebut Archer.</div>
                <div class="col-sm-6 pkanan">Selain itu, Sebagai salah satu cabang olahraga modern, bagi umat Islam, panahan menempati salah satu posisi olahraga yang istimewa. Seperti yang dikutip dari <a href="https://republika.co.id/berita/nwgu9i313/alasan-panahan-tempati-posisi-istimewa-dalam-islam">republika.co.id</a>, Panahan merupakan salah satu olahraga yang dianjurkan oleh Rasulullah SAW.<br>Rasulullah bersabda, "Ajarilah anak-anak kalian berkuda, berenang, dan memanah," (HR Bukhari/Muslim).<br>Melihat hadis tersebut, jelas sekali bahwa olahraga memanah memiliki kaitan erat dengan peradaban Islam.</div>
            </div>
        </section>
        <!-- Akhir Informasi -->

        <!-- Gallery -->
        <section class="container gallery" id="gallery">
            <h1 class="judul text-center mb-5">Gallery Kegiatan</h1>
            <div class="row justify-content-center">
                <?php foreach ($gallery as $i => $g) : ?>
                    <?php if ($i >= 0 && $i <= 2) : ?>
                        <figure class="col-auto figure">
                            <img src="img/gallery/<?= $g['gambar']; ?>" class="figure-img img-fluid rounded" alt="gallery">
                            <figcaption class="figure-caption"><?= $g['caption']; ?></figcaption>
                        </figure>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
            <div class="row justify-content-center">
                <?php foreach ($gallery as $i => $g) : ?>
                    <?php if ($i > 2 && $i < 6) : ?>
                        <figure class="col-auto figure">
                            <img src="img/gallery/<?= $g['gambar']; ?>" class="figure-img img-fluid rounded" alt="gallery">
                            <figcaption class="figure-caption"><?= $g['caption']; ?></figcaption>
                        </figure>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
            <div class="pagination">
                <a href="?gallery=<?= $pagegallery == 1 ? $countgallery : $pagegallery - 1; ?>"><img src="img/logo/kiri.png" alt="kiri"></a>
                <?php for ($i = 1; $i <= $countgallery; $i++) : ?>
                    <?php if ($i == $pagegallery) : ?>
                        <a href="?gallery=<?= $i; ?>" class="text-danger"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="?gallery=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif ?>
                <?php endfor ?>
                <a href="?gallery=<?= $pagegallery == $countgallery ? 1 : $pagegallery + 1; ?>"><img src="img/logo/kanan.png" alt="kanan"></a>
            </div>
            <div class="galleryfocus"><img src="" alt="gallery"></div>
        </section>
        <!-- Akhir Gallery -->

        <!-- Berita -->
        <section class="berita" id="berita">
            <h1 class="judul text-center mb-5">Berita</h1>
            <?php foreach ($berita as $i => $b) : ?>
                <div class="row mt-5">
                    <?php if ($i == 1) : ?>
                        <div class="col-md bItem bkiri">
                            <h2><?= $b['judul']; ?></h2>
                            <p><?= $b['konten']; ?></p>
                        </div>
                        <div class="col-md bItem bkanan">
                            <img src="img/berita/<?= $b['gambar']; ?>" alt="berita" class="img-fluid">
                        </div>
                    <?php else : ?>
                        <div class="col-md bItem bkiri">
                            <img src="img/berita/<?= $b['gambar']; ?>" alt="berita" class="img-fluid">
                        </div>
                        <div class="col-md bItem bkanan">
                            <h2><?= $b['judul']; ?></h2>
                            <p><?= $b['konten']; ?></p>
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
            <div class="pagination mt-5">
                <a href="?berita=<?= $pageberita == 1 ? $countberita : $pageberita - 1; ?>"><img src="img/logo/kiri.png" alt="kiri"></a>
                <?php for ($i = 1; $i <= $countberita; $i++) : ?>
                    <?php if ($i == $pageberita) : ?>
                        <a href="?berita=<?= $i; ?>" class="text-danger"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="?berita=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif ?>
                <?php endfor ?>
                <a href="?berita=<?= $pageberita == $countberita ? 1 : $pageberita + 1; ?>"><img src="img/logo/kanan.png" alt="kanan"></a>
            </div>
        </section>
        <!-- Akhir Berita -->

        <!-- Contact Us -->
        <section class="contact" id="contact">
            <div class="container">
                <div class="row pt-4 mb-5">
                    <div class="col">
                        <h1 class="judul text-center">Contact Us</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <?php
                        if (isset($_POST['kirim'])) {
                            if ($success) {
                                simpleAlert("Pesan Terkirim!", "Kami akan berusaha untuk merespon secepatnya melalui email atau nomor telepon yang Anda kirimkan", "success");
                            } else {
                                simpleAlert("Pesan Gagal Dikirim!", 'Anda bisa hubungi kami <a href="https://wa.me/628886053436?text=Assalamualaikum%20Warohmatullahi%20Wabarokatuh" class="alert-link">disini</a>', "danger");
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Contact Us</h5>
                                <p class="card-text">Jika ada pertanyaan seputar Web atau seputar Elite Archer, hubungi kami dengan mengisi data diri anda di samping kanan</p>
                            </div>
                        </div>
                        <ul class="list-group mb-4">
                            <li class="list-group-item">
                                <h3>Location</h3>
                            </li>
                            <li class="list-group-item">Elite Archer</li>
                            <li class="list-group-item">Jl. Raya Batujajar No. 176, Bandung Barat</li>
                            <li class="list-group-item">Jawa Barat, Indonesia</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" required="true">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required="true">
                            </div>
                            <div class="form-group">
                                <label for="notel">Nomor Telepon</label>
                                <input type="tel" class="form-control" name="notel" required="true">
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea class="form-control" name="pesan" rows="3" required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="kirim">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir Contact Us -->
    </div>
    <!-- Akhir Container -->

    <!-- Footer -->
    <footer class="copyright bg-dark text-center">
        <span>&#169; Copyright Elite Archer 2020 | Iqmal Akbar Kurnia</span>
    </footer>
    <!-- Akhir Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/home.js"></script>
    <?php if (isset($_POST['kirim'])) : ?>
        <script>
            $('html').animate({
                scrollTop: $('#contact').offset().top - 50
            }, 1000, 'easeInOutExpo')
        </script>
    <?php endif ?>
</body>

</html>