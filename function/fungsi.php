<?php
    require_once "SqlQuery.php";

    $db = new SqlQuery("localhost", "root", "", "elite_archer");

    function alert($h4, $p1, $p2, $tipe){
        echo '
        <div class="alert alert-' . $tipe . '" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">' . $h4 . '</h4>
            <p>' . $p1 . '</p>
            <hr>
            <p class="mb-0">' . $p2 . '</p>
        </div>
        ';
    }

    function messageAllert($pesan, $tipe){
        echo '
            <div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">
                <strong>' . $pesan . '</strong>
            </div>
        ';
    }

    function simpleAlert($judul, $pesan, $tipe){
        echo '
            <div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">
                <strong>' . $judul . '</strong> ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
    }

    function uploadimg($img, $halaman, $penyimpanan, $startName='img-'){
        $namaFile = $img["name"];
        $ukuranFile = $img["size"];
        $tmpName = $img["tmp_name"];

        $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
        $ekstensiFoto = explode('.', $namaFile);
        $ekstensiFoto = strtolower(end($ekstensiFoto));
        if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
            $_SESSION['errFoto'] = true;
            header("Location: $halaman");
            exit;
        }

        if ($ukuranFile > 1000000) {
            $_SESSION['errSize'] = true;
            header("Location: $halaman");
            exit;
        }

        $newNameFile = $startName . uniqid() . '.' . $ekstensiFoto;
        move_uploaded_file($tmpName, $penyimpanan . $newNameFile);
        return $newNameFile;
    }

    function tambahAnggota($data){
        global $db;

        $idn = $data['idn'];
        $noidn = htmlspecialchars($data['noidn']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $notel = htmlspecialchars($data['notel']);
        $jk = $data['jk'];
        $alamat = htmlspecialchars($data['alamat']);
        $kelas = $data['kelas'];
        $harga = $data['harga'];
        $status = $data['status'];

        if (!isset($data['addons'])) {
            $addons = "false";
        } else {
            $addons = $data['addons'];
        }

        $insert = "'', '$idn', '$noidn', '$nama', '$email', '$notel', '$jk', '$alamat', '$addons','$kelas', '$harga', '$status'";
        
        return $db->insert("anggota", $insert);
    }

    function ubahAnggota($data){
        global $db;

        $id = $data['id'];
        $idn = $data['idn'];
        $noidn = htmlspecialchars($data['noidn']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $notel = htmlspecialchars($data['notel']);
        $jk = $data['jk'];
        $alamat = htmlspecialchars($data['alamat']);
        $kelas = $data['kelas'];
        $harga = $data['harga'];
        $status = $data['status'];

        if (!isset($data['addons'])) {
            $addons = "false";
        }
        else {
            $addons = $data['addons'];
        }

        $update = "idn='$idn', noidn='$noidn', nama='$nama', email='$email', notel='$notel', jk='$jk', alamat='$alamat', addons='$addons', kelas='$kelas', harga='$harga', status='$status'";

        return $db->update("anggota", "id='$id'", $update);
    }

    function kirimpesan($data){
        global $db;

        $nama = htmlspecialchars($data['nama']);
        $email = $data['email'];
        $notel = $data['notel'];
        $pesan = htmlspecialchars($data['pesan']);
        $tanggal = date("Y-m-d", time());

        $insert = "'', '$nama', '$email', '$notel', '$pesan', '$tanggal'";

        return $db->insert("pesan", $insert);
    }

    function tambahGallery($data){
        global $db;

        $caption = htmlspecialchars($data['caption']);
        if ($caption == "") {
            $caption = "Elite Archer";
        }

        $img = uploadimg($_FILES['gallery'], '../admin/gallery.php', '../img/gallery/');
        $insert = "'', '$img', '$caption'";

        return $db->insert('gallery', $insert);
    }

    function ubahGallery($data){
        global $db;

        $id = $data['id'];
        $caption = htmlspecialchars($data['caption']);
        if ($caption == "") {
            $caption = "Elite Archer";
        }

        if ($_FILES["gallery"]["name"] != "") {
            $gambar = $db->getSingleSpecific("gallery", "idgallery", "$id")['gambar'];
            $img = uploadimg($_FILES['gallery'], '../admin/gallery.php', '../img/gallery/');
            unlink("../img/gallery/$gambar");
            return $db->update('gallery', "idgallery='$id'", "caption='$caption', gambar='$img'");
        }

        return $db->update('gallery', "idgallery='$id'", "caption='$caption'");
    }

    function tambahBerita($data){
        global $db;

        $judul = htmlspecialchars($data['judul']);
        $konten = htmlspecialchars($data['konten']);
        $tanggal = date("Y-m-d", time());
        $gambar = uploadimg($_FILES['gambar'], '../admin/berita.php', '../img/berita/', 'brt-');
        $insert = "'', '$gambar', '$judul', '$konten', '$tanggal'";

        return $db->insert("berita", $insert);
    }

    function ubahBerita($data){
        global $db;

        $id = $data['id'];
        $judul = htmlspecialchars($data['judul']);
        $konten = htmlspecialchars($data['konten']);
        $tanggal = date("Y-m-d", time());
        $update = "judul='$judul', konten='$konten', tanggal='$tanggal'";
        
        if ($_FILES["gambar"]["name"] != "") {
            $img = $db->getSingleSpecific("berita", "idberita", "$id")['gambar'];
            $gambar = uploadimg($_FILES['gambar'], '../admin/berita.php', '../img/berita/', 'brt-');
            unlink("../img/berita/$img");
            return $db->update("berita", "idberita='$id'", $update . ", gambar='$gambar'");
        }

        return $db->update("berita", "idberita='$id'", $update);
    }

    function tambahJadwal($data){
        global $db;

        $kelas = $data['kelas'];
        $pelatih = $data['pelatih'];
        $hari = $data['hari'];
        $mulai = $data['mulai'];
        $selesai = $data['selesai'];
        $type = $data['type'];

        if ($data['tgl'] == "") {
            $tgl = "0000-00-00";
        }
        else {
            $tgl = $data['tgl'];
        }

        $insert = "'', '$kelas', '$pelatih', '$hari', '$mulai', '$selesai', '$type', '$tgl'";

        return $db->insert("jadwal", $insert);
    }

    function ubahJadwal($data){
        global $db;

        $id = $data['id'];
        $kelas = $data['kelas'];
        $pelatih = $data['pelatih'];
        $hari = $data['hari'];
        $mulai = $data['mulai'];
        $selesai = $data['selesai'];
        $type = $data['type'];

        if ($data['tgl'] == "") {
            $tgl = "0000-00-00";
        } else {
            $tgl = $data['tgl'];
        }

        $update = "idkelas='$kelas', idpengurus='$pelatih', hari='$hari', mulai='$mulai', selesai='$selesai', type='$type', tgl='$tgl'";

        return $db->update("jadwal", "idjadwal='$id'", $update);
    }

    function tambahPengurus($data){
        global $db;

        $nama = $data['nama'];
        $email = $data['email'];
        $notel = $data['notel'];
        $jk = $data['jk'];
        $jabatan = $data['jabatan'];

        if ($_FILES['foto']['name'] == "") {
            if ($jk == "Laki Laki") {
                $foto = "male.png";
            }
            else {
                $foto = "female.png";
            }
        }
        else {
            $foto = uploadimg($_FILES['foto'], "../admin/pengurus.php", "../img/pengurus/", 'pengurus-');
        }

        $insert = "'', '$nama', '$jabatan', '$jk', '$email', '$notel', '$foto'";

        return $db->insert("pengurus", $insert);
    }

    function ubahPengurus($data){
        global $db;

        $id = $data['id'];
        $nama = $data['nama'];
        $email = $data['email'];
        $notel = $data['notel'];
        $jk = $data['jk'];

        if (!isset($data['jabatan'])) {
            $jabatan = $db->getSingleSpecific("pengurus", "idpengurus", $id)['jabatan'];
        }
        else {
            $jabatan = $data['jabatan'];
        }

        $update = "nama='$nama', email='$email', notel='$notel', jk='$jk', jabatan='$jabatan'";

        if ($_FILES["foto"]["name"] != "") {
            $img = $db->getSingleSpecific("pengurus", "idpengurus", "$id")['foto'];
            $gambar = uploadimg($_FILES['foto'], '../admin/pengurus.php', '../img/pengurus/', 'pengurus-');
            unlink("../img/pengurus/$img");
            return $db->update("pengurus", "idpengurus='$id'", $update . ", foto='$gambar'");
        }
        else {
            if ($jk == "Laki Laki") {
                $update .= ", foto='male.png'";
            }
            else {
                $update .= ", foto='female.png'";                
            }
        }

        return $db->update("pengurus", "idpengurus='$id'", $update);
    }
    
    function updatePengunjung(){
        global $db;
        $today = date("Y-m-d", time());

        if ($db->getResultSpecific("pengunjung", "tanggal", $today)) {
            $i = $db->getSingle("SELECT id, pengunjung FROM pengunjung WHERE tanggal='$today'");
            $id = $i['id'];
            $pengunjung = $i['pengunjung'];
            $pengunjung++;
            $db->update("pengunjung", "id='$id'", "pengunjung='$pengunjung'");
        }
        else {
            $db->insert("pengunjung", "'', '1', '$today'");
        }
    }
?>