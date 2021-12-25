<?php
require_once "../function/fungsi.php";

$kelas = $db->getResult("SELECT * FROM kelas");
?>
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