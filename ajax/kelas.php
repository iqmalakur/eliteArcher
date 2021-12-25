<?php
    require_once "../function/fungsi.php";
    $id = $_GET["id"];
    $addons = $_GET['addons'];

    $harga = $db->getSingle("SELECT hargakelas FROM kelas WHERE idkelas='$id'")['hargakelas'];

    if ($addons == "true") {
        $harga += 150000;
    }

    echo $harga;
?>