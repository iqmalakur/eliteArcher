<?php
    require_once "fungsi.php";
    session_start();

    $id = $_GET["id"];
    $table = $_GET["table"];
    $hal = $_GET["hal"];

    switch ($table) {
        case 'anggota':
            $col = 'id';
            break;
        case 'gallery':
            $col = 'idgallery';
            $img = $db->getSingleSpecific("gallery", "idgallery", $id);
            $hapus = $img['gambar'];
            unlink("../img/gallery/$hapus");
            break;
        case 'berita':
            $col = 'idberita';
            $img = $db->getSingleSpecific("berita", "idberita", $id);
            $hapus = $img['gambar'];
            unlink("../img/berita/$hapus");
            break;
        case 'jadwal':
            $col = 'idjadwal';
            break;
        case 'pengurus':
            $col = 'idpengurus';
            $img = $db->getSingleSpecific("pengurus", "idpengurus", $id);
            $hapus = $img['foto'];
            if ($hapus != "male.png" && $hapus != "female.png") {
                unlink("../img/pengurus/$hapus");
            }
            break;
        default:
            $col = null;
            break;
    }

    if ($db->delete($table, "$col=$id") > 0) {
        header("Location: ../admin/$hal.php");
        $_SESSION['delete'] = "success";
    }
    else {
        header("Location: ../admin/$hal.php");
        $_SESSION['delete'] = "failed";
    }
?>