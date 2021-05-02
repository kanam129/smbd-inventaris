<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$username_pengguna = $_POST["username_pengguna"];
$password_pengguna = $_POST["password_pengguna"];
$hak_akses_pengguna = $_POST["hak_akses_pengguna"];
$nama_pengguna = $_POST["nama_pengguna"];
$no_tlp_pengguna = $_POST["no_tlp_pengguna"];
$alamat_pengguna = $_POST["alamat_pengguna"];

$insert = mysqli_query($conn, "insert into pengguna values ('$username_pengguna', '$password_pengguna', '$hak_akses_pengguna', '$nama_pengguna', '$no_tlp_pengguna', '$alamat_pengguna')");

if($insert){
    ?>
    <script>
        alert("Tambah data pengguna berhasil");
        document.location = "../index.php?page=pengguna";
    </script>
    <?php
}else{
    echo "error";
}

?>