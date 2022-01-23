<?php
session_start();
if ( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$santri = query("SELECT * FROM santri");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $santri = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins&display=swap" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

    .button-3 {
    appearance: none;
    background-color: #2ea44f;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
    box-shadow: none;
    outline: none;
}

.button-3:hover {
  background-color: #2c974b;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #94d3a2;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #298e46;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}

table {
  border-radius: 25px;
  border: 5px solid #2ea44f;;
  padding: 10px;
}

.button-red {
    appearance: none;
    background-color: #E66360;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
}

.button-blue {
    appearance: none;
    background-color: #0275d8;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
}

@media only screen and (min-width: 680px) {
  table {
    font-size: 16px;
  }
}

@media only screen and (max-width: 680px) {
  table {
    font-size: 10px;
  }

  h1 {
    font-size: 20px;
  }

  a {
    font-size: 12px;
  }

  input {
    font-size: 12px;
  }
  
  .button-3, .button-red {
    font-size: 12px;
  }

  a#aksi {
    font-size: 8px;
  }

  .pagination {
    font-size: 8px;
  }

  img {
    width: 30px;
  }
}

  .button-red {
    float: right;
    margin-right: 12px;
    margin-top: 12px;
  }

  .link-white {
    color: white;
  }

  a{
    z-index: 2;
  }

  .pagination {
    text-align: center;
    margin-top: 4px;
  }

  .container {
    width: fit-content;
    margin-top: 8px;
  }

  body {
    background-color: #41444B;
  }
  
  h1 {
    color: white;
  }

  .white {
    color: white;
  }

  .green {
    font-weight: bold;
    color: #2ea44f;
  }

  .merah {
    font-weight: bold;
    color: #E66360;
  }

  .border {
    border-radius: 8px;
  }

  .biru {
    color: #0275d8;
  }
    </style>
</head>
<body>

  <a class="biru" href="welcome.php">Kembali</a>

  <button class="button-red" role="button" type="submit" name="logout"><a href="logout.php" class="link-white">Logout</a></button>
    <h1>Daftar Users</h1>
</div>

<button class="button-blue" role="button" type="submit" name="tambah"><a href="tambah.php" class="link-white">Tambah data santri</a></button>
<br><br>

<form action="" method="post">

    <input class="border" type="text" name="keyword" size="30" autofocus placeholder="Masukkan Keyword Pencarian..." autocomplete="off" id="keyword">
    <button class="button-3" role="button" type="submit" name="cari" id="tombol-cari">Cari!</button>

</form>

<br>

<div id="container">
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
</div>
</div>
<script src="js/script.js"></script>
</body>
</html>