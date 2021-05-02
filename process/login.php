<?php

include("../system/connection.php");
session_start();

$username = $_POST["username_pengguna"];
$password = $_POST["password_pengguna"];

$select = mysqli_query($conn, "select * from pengguna where binary username_pengguna = '$username' and binary password_pengguna = '$password'");
$num_row = mysqli_num_rows($select);

if($num_row < 1){
    ?>
    <script>
        alert("Username atau password salah!");
        document.location = "../login.php";
    </script>
    <?php
}else{
    while($data = mysqli_fetch_array($select)){
        $user = $data["username_pengguna"];
        $nama_pengguna = $data["nama_pengguna"];
        $hak_akses = $data["hak_akses_pengguna"];
    }
    $_SESSION["user"] = $user;
    $_SESSION["hak_akses"] = $hak_akses;
    $_SESSION["nama_pengguna"] = $nama_pengguna;
    header("location:../index.php");
}

?>