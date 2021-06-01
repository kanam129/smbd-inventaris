<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["nim"])){
    header("location:login.php");
}

$nim = $_POST["nim"];
$nama_anggota = $_POST["nama_anggota"];
$jenis_kelamin_anggota = $_POST["jenis_kelamin_anggota"];
$tgl_lahir_anggota = $_POST["tgl_lahir_anggota"];
$no_tlp_anggota = $_POST["no_tlp_anggota"];
$alamat_anggota = $_POST["alamat_anggota"];

$insert = mysqli_query($conn, "insert into anggota values ('$nim', '$nama_anggota', '$jenis_kelamin_anggota', '$tgl_lahir_anggota', '$no_tlp_anggota', '$alamat_anggota')");

if($insert){
    ?>
    <script>
        alert("Tambah data anggota berhasil");
        document.location = "../index.php?page=anggota";
    </script>
    <?php
}else{
    echo "error";
}

?>