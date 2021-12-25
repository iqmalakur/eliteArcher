<?php
require_once "../function/fungsi.php";

$keyword = $_GET["keyword"];
$members = $db->getResult("SELECT * FROM anggota WHERE idn LIKE '%$keyword%' OR noidn LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR jk LIKE '%$keyword%' OR email LIKE '%$keyword%' OR notel LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR status LIKE '%$keyword%' OR kelas LIKE '%$keyword%'");
?>

<table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th>Identitas</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $member) : ?>
            <tr>
                <td><?= $member['idn'] . ' - ' . $member['noidn']; ?></td>
                <td><?= $member['nama']; ?></td>
                <td><?= $member['email']; ?></td>
                <td><?= $member['notel']; ?></td>
                <td><?= $member['jk']; ?></td>
                <td><?= $member['alamat']; ?></td>
                <td><?= $member['kelas']; ?></td>
                <td><?= $member['status']; ?></td>
                <td>
                    <button type="button" data-id="<?= $member['id'] ?>" class="btn btn-info btnUbah" data-toggle="modal" data-target="#addDataMember">Ubah</button>
                    <a href="../function/hapus.php?id=<?= $member['id']; ?>&table=anggota&hal=anggota" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php
    if ($members == null) {
        messageAllert("Anggota Tidak Ditemukan!", 'danger');
    }
?>