<?php
require_once "../function/fungsi.php";

if (isset($_POST['daftar'])) {
    if (tambahAnggota($_POST) > 0) {
        $success = true;
    } else {
        $success = false;
    }
}

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

    <title>Elite Archer - Pendaftaran</title>
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
                    <a class="nav-item nav-link pageScroll" href="#top">Pendaftaran</a>
                    <a class="nav-item nav-link" href="jadwal.php">Jadwal Kegiatan</a>
                    <a class="nav-item nav-link" href="pengurus.php">Kepengurusan</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Pendaftran -->
    <section class="container pendaftaran">
        <h1 class="text-center judul mb-4">Pendaftaran</h1>
        <?php
        if (isset($_POST['daftar'])) {
            if ($success) {
                alert("Daftar Berhasil!", "Anda berhasil mendaftar sebagai Anggota Elite Archer!", "Data Anda tersimpan sebagai Anggota sementara dan Anda belum dapat mengikuti latihan! Untuk menjadi anggota tetap dan mengikuti latihan, Silahkan lakukan daftar ulang dan transaksi pembayaran di lokasi kami! (Jl. Raya Batujajar No. 176, Bandung Barat)", "success");
            } else {
                alert('Pendaftar Gagal!', 'Maaf Pendaftaran tidak Berhasil, kemungkinan data yang anda masukan salah atau tidak sesuai dengan yang kami minta, Silahkan cek kembali data yang Anda masukan!', 'Jika Anda tidak dapat menemukan kesalahan, silahkan <a href="../#contact">hubungi kami</a>, atau Anda dapat daftar langsung ke tempat kami (Jl. Raya Batujajar No. 176, Bandung Barat)', 'danger');
            }
        }
        ?>
        <form action="" method="post">
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
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-control" name="kelas" id="kelas">
                    <?php foreach ($kelas as $kls) : ?>
                        <option value="<?= $kls['idkelas']; ?>"><?= $kls['namakelas']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga Per Bulan</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?= $kelas[0]['hargakelas'] ?>" readonly>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="false" id="addons" name="addons">
                    <label class="form-check-label" for="addons">Sertakan Alat Panah (Busur, Anak Panah, dan lain-lain)</label>
                </div>
            </div>
            <input type="hidden" name="status" value="Pre-Member">
            <button type="submit" class="btn btn-primary mt-3" name="daftar">Daftar</button>
        </form>
    </section>
    <!-- Akhir Form Pendaftaran -->

    <!-- Footer -->
    <footer class="copyright bg-dark text-center mt-5">
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