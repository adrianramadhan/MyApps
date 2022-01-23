<?php
session_start();
if ( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
// koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data santri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins&display=swap" rel="stylesheet">
    <style>
        label {
            display: block;
            margin-top: 5px;
        }

        li {
            list-style: none;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        .green-border {
            display: block;
            margin-top: 5px;
            border-radius: 8px;
            border: 2px solid #2ea44f;;
            padding: 10px;
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

        h1 {
            margin-left: 35px;
            margin-right: 35px;
            color: white;
        }

        body {
            background-color: #41444B;
        }

        .white {
            color: white;
        }

        .container {
            border: 5px solid #298e46;
            border-radius: 12px;
            width: fit-content;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>

<div class="container">

<h1>Tambah data santri</h1>

<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nama" class="white">Nama  : </label>
            <input type="text" name="nama" id="nama" required class="green-border">
        </li>
        <li>
            <label for="asal" class="white">Asal : </label>
            <input type="text" name="asal" id="asal" required class="green-border">
        </li>
        <li>
            <label for="kampus" class="white">Kampus : </label>
            <input type="text" name="kampus" id="kampus" required class="green-border">
        </li>
        <li>
            <label for="jurusasn" class="white">Jurusan : </label>
            <input type="text" name="jurusan" id="jurusan" required class="green-border">
        </li>
        <li>
            <label for="gambar" class="white">Gambar : </label>
            <input type="file" name="gambar" id="gambar"
            placeholder="Opsional" class="white">
            
        </li>
        <li>
            <br>
            <button type="submit" name="submit" class="button-3">Tambah Data!</button>
        </li>
        <br>
    </ul>
</form>
</div>
    
</body>
</html>