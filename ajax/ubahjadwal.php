<?php
    require_once "../function/fungsi.php";

    $id = $_POST["id"];
    echo json_encode($db->getSingleSpecific("jadwal", "idjadwal", $id));
?>