<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$nama_petugas = $_POST["nama_petugas"];
$jenis_kelamin_petugas = $_POST["jenis_kelamin_petugas"];
$tgl_lahir_petugas = $_POST["tgl_lahir_petugas"];
$no_tlp_petugas = $_POST["no_tlp_petugas"];
$alamat_petugas = $_POST["alamat_petugas"];
$username_petugas = $_POST["username_petugas"];
$password_petugas = $_POST["password_petugas"];
$level_petugas = $_POST["level_petugas"];

$insert = mysqli_query($conn, "insert into petugas values (NULL, '$nama_petugas', '$jenis_kelamin_petugas', '$tgl_lahir_petugas', '$no_tlp_petugas', '$alamat_petugas', '$username_petugas', '$password_petugas', '$level_petugas')");

if($insert){
    ?>
    <script>
        alert("Tambah data petugas berhasil");
        document.location = "../index.php?page=petugas";
    </script>
    <?php
}else{
    echo "error";
}

?>