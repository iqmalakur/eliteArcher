<?php
require_once "../function/fungsi.php";

$keyword = $_GET["keyword"];
$gallery = $db->getResult("SELECT * FROM gallery WHERE caption LIKE '%$keyword%'");
?>
<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Caption</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gallery as $g) : ?>
            <tr>
                <td><img src="../img/gallery/<?= $g['gambar']; ?>" alt="<?= $g['gambar']; ?>" width="100"></td>
                <td><?= $g['caption']; ?></td>
                <td>
                    <button type="button" data-id="<?= $g['idgallery']; ?>" class="btn btn-info btnUbah ubahGallery" data-toggle="modal" data-target="#addGallery">Ubah</button>
                    <a href="../function/hapus.php?id=<?= $g['idgallery']; ?>&table=gallery&hal=gallery" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Gallery ini?">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php
if ($gallery == null) {
    messageAllert("Gallery Tidak Ditemukan!", 'danger');
}
?>