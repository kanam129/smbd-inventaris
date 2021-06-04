<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$id_petugas = $_POST["id_petugas"];
$nama_petugas = $_POST["nama_petugas"];
$jenis_kelamin_petugas = $_POST["jenis_kelamin_petugas"];
$tgl_lahir_petugas = $_POST["tgl_lahir_petugas"];
$no_tlp_petugas = $_POST["no_tlp_petugas"];
$alamat_petugas = $_POST["alamat_petugas"];
$level_petugas = $_POST["level_petugas"];

$update = mysqli_query($conn, "update petugas set 
    nama_petugas = '$nama_petugas',
    jenis_kelamin_petugas = '$jenis_kelamin_petugas',
    tgl_lahir_petugas = '$tgl_lahir_petugas',
    no_tlp_petugas = '$no_tlp_petugas',
    alamat_petugas = '$alamat_petugas',
    level_petugas = '$level_petugas'
    where id_petugas = $id_petugas
");

if($update){
    ?>
    <script>
        alert("Edit data petugas berhasil");
        document.location = "../index.php?page=petugas";
    </script>
    <?php
}else{
    echo "error";
}

?>