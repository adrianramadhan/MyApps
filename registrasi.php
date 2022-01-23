<?php
require 'functions.php';

if ( isset($_POST["register"])) {
    
    if ( registrasi($_POST) > 0 ) {
        echo "<script> 
                alert('User baru berhasil ditambahkan');
              </script>";
    } else {
        echo mysqli_error($conn);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins&display=swap" rel="stylesheet">
    <style>
        input {
            display: block;
            margin-top: 5px;
            border-radius: 8px;
            border: 2px solid #2ea44f;;
            padding: 10px;
        }

        li {
            list-style: none;
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
            margin-top: 12px;
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
            color: white;
            margin-left: 35px;
            margin-right: 35px;
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

        body {
            background-color: #41444B;
        }

        .white {
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

<h1>Halaman Registrasi</h1>

<form action="" method="post">

    <ul>
        <li>
            <label for="username" class="white">Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password" class="white">Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2" class="white">Konfirmasi Password : </label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <button type="submit" name="register" class="button-3">Register</button>
        </li>
        <br>
    </ul>

</form>

</div>
    
</body>
</html>