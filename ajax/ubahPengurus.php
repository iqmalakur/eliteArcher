<?php
require_once "../function/fungsi.php";

$id = $_GET["id"];
$pengurus = $db->getSingleSpecific("pengurus", "idpengurus", $id);
?>
<input type="hidden" name="id" id="id" value="<?= $pengurus['idpengurus']; ?>">
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required="true" maxlength="30" value="<?= $pengurus['nama'] ?>">
    </div>
    <div class="form-group col-md-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required="true" maxlength="50" value="<?= $pengurus['email'] ?>">
    </div>
    <div class="form-group col-md-4">
        <label for="notel">No Telepon</label>
        <input type="tel" class="form-control" id="notel" name="notel" required="true" maxlength="15" value="<?= $pengurus['notel'] ?>">
    </div>
</div>
<div class="form-group">
    <label for="lk">Jenis Kelamin</label>
    <?php if ($pengurus['jk'] == "Laki Laki") : ?>
        <div class="custom-control custom-radio">
            <input type="radio" id="lk" name="jk" class="custom-control-input" value="Laki Laki" checked>
            <label class="custom-control-label" for="lk">Laki Laki</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="perempuan" name="jk" class="custom-control-input" value="Perempuan">
            <label class="custom-control-label" for="perempuan">Perempuan</label>
        </div>
    <?php else : ?>
        <div class="custom-control custom-radio">
            <input type="radio" id="lk" name="jk" class="custom-control-input" value="Laki Laki">
            <label class="custom-control-label" for="lk">Laki Laki</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="perempuan" name="jk" class="custom-control-input" value="Perempuan" checked>
            <label class="custom-control-label" for="perempuan">Perempuan</label>
        </div>
    <?php endif ?>
</div>