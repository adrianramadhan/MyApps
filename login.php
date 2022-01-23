<?php
session_start();
require 'functions.php';

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ( $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if ( isset($_SESSION["login"])) {
    
    header("Location: index.php");
    exit;
}

if ( isset($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if ( mysqli_num_rows($result) === 1 ) {
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if ( isset($_POST['remember'])) {
                // buat cookie               
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }

            header("Location: welcome.php");
            exit;
        }
        else {
            echo "<script> 
                    alert('Username Atau Password Salah');
                  </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins&display=swap" rel="stylesheet">
    <style>
        input {
            display: block;
            margin-top: 5px;
            border-radius: 8px;
            border: 2px solid #2ea44f;
            padding: 10px;
        }

        li {
            list-style: none;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #41444B;
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
            margin-left: 35px;
            margin-right: 70px;
            color: white;
        }

        .remember {
            float: left;
        }

        label {
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

        .register {
            font-size: 12px;
        }

        a {
            color: #2ea44f;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="bg-image"></div>
<div class="container">

<h1>Halaman Login</h1>

<form action="" method="post">

    <ul>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember" class="remember">
            <label for="remember">Remember Me</label class="remember">
        </li>
            <li>
                <label for="register" class="register">Belum punya akun? <a href="registrasi.php">Bikin akun</a></label>
            </li>
        <li>
            <button type="submit" name="login" class="button-3">Login</button>
            <br><br>
        </li>
    </ul>

</form>

</div>

    
</body>
</html>