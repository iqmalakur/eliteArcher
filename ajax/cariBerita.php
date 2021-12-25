<?php
    require_once "../function/fungsi.php";

    $keyword = $_GET["keyword"];
    $berita = $db->getResult("SELECT * FROM berita WHERE judul LIKE '%$keyword%'");
?>
<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Konten</th>
            <th>Terakhir Diubah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($berita as $b) : ?>
            <tr>
                <td><img src="../img/berita/<?= $b['gambar']; ?>" alt="<?= $b['gambar']; ?>" style="width: 100px"></td>
                <td><?= $b['judul']; ?></td>
                <td><?= $b['konten']; ?></td>
                <td><?= $b['tanggal']; ?></td>
                <td>
                    <button type="button" data-id="<?= $b['idberita']; ?>" class="btn btn-info btnUbah ubahBerita" data-toggle="modal" data-target="#addBerita">Ubah</button>
                    <a href="../function/hapus.php?id=<?= $b['idberita']; ?>&table=berita&hal=berita" class="btn btn-danger hapus" data-hapus="Yakin ingin menghapus Berita ini?">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php
if ($berita == null) {
    messageAllert("Berita Tidak Ditemukan!", 'danger');
}
?>