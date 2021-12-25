<?php
    require_once "../function/fungsi.php";

    $keyword = $_GET["keyword"];
    $pengurus = $db->getResult("SELECT * FROM pengurus WHERE nama LIKE '%$keyword%' OR jabatan LIKE '%$keyword%' OR jk LIKE '%$keyword%' OR email LIKE '%$keyword%' OR notel LIKE '%$keyword%'");
?>
<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pengurus as $p) : ?>
            <tr>
                <td><?= $p['nama']; ?></td>
                <td><?= $p['jabatan']; ?></td>
                <td><?= $p['jk']; ?></td>
                <td><?= $p['email']; ?></td>
                <td><?= $p['notel']; ?></td>
                <td>
                    <button type="button" data-id="<?= $p['idpengurus']; ?>" class="btn btn-info btnUbah ubahPengurus" data-toggle="modal" data-target="#addPengurus">Ubah</button>
                    <a href="../function/hapus.php?id=<?= $p['idpengurus']; ?>&table=pengurus&hal=pengurus" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Pengurus ini?">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php
if ($pengurus == null) {
    messageAllert("Pengurus Tidak Ditemukan!", 'danger');
}
?>