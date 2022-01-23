<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM santri
            WHERE
        nama LIKE '%$keyword%' OR
        asal LIKE '%$keyword%' OR
        kampus LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        ";

$santri = query($query);
?>

<table cellpadding="10" cellspacing="0">

    <tr>
        <th class="white">No.</th>
        <th class="white">Aksi</th>
        <th class="white">Gambar</th>
        <th class="white">Nama</th>
        <th class="white">Asal</th>
        <th class="white">Kampus</th>
        <th class="white">jurusan</th>
    </tr>

    <?php $i = 1; ?>    
    <?php foreach( $santri as $row) : ?>
    <tr>
        <td class="white"><?=$i ?></td>
        <td>
            <a class="green" style="text-align: center;" href="ubah.php?id=<?=$row["id"]; ?>" id="aksi">Ubah </a>
            <a class="merah" style="text-align: center;" href="hapus.php?id=<?=$row["id"]; ?>" id="aksi" onclick="return confirm('yakin?')">Hapus</a>
        </td>
        <td><img src="img/<?=$row["gambar"]; ?>" width="50px"></td>
        <td class="white" style="text-align: center;"><?=$row["nama"]; ?></td>
        <td class="white" style="text-align: center;"><?=$row["asal"]; ?></td>
        <td class="white" style="text-align: center;"><?=$row["kampus"]; ?></td>
        <td class="white" style="text-align: center;"><?=$row["jurusan"]; ?></td>
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>

</table>