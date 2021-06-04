<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$nim = $_POST["nim"];
$nama_anggota = $_POST["nama_anggota"];
$jenis_kelamin_anggota = $_POST["jenis_kelamin_anggota"];
$tgl_lahir_anggota = $_POST["tgl_lahir_anggota"];
$no_tlp_anggota = $_POST["no_tlp_anggota"];
$alamat_anggota = $_POST["alamat_anggota"];

$update = mysqli_query($conn, "update anggota set nama_anggota='$nama_anggota', jenis_kelamin_anggota='$jenis_kelamin_anggota', tgl_lahir_anggota='$tgl_lahir_anggota', no_tlp_anggota='$no_tlp_anggota', alamat_anggota=$alamat_anggota where nim='$nim'");

if($update){
    ?>
    <script>
        alert("Edit data anggota berhasil");
        document.location = "../index.php?page=anggota";
    </script>
    <?php
}else{
    echo "error";
}

?>