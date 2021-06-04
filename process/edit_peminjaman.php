<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

if($_POST["tgl_kembali"] == "0000-00-00" || $_POST["tgl_kembali"] == ""){
    $tgl_kembali = "tgl_kembali=NULL";
}else{
    $tgl_kembali = "tgl_kembali='".$_POST["tgl_kembali"]."'";
}

if($_POST["denda"] == "0" || $_POST["denda"] == ""){
    $denda = "denda=NULL";
}else{
    $denda = "denda='".$_POST["denda"]."'";
}

$id = $_POST["id_peminjaman"];
$tgl_peminjaman = $_POST["tgl_pinjam"];
$id_barang = $_POST["id_barang"];
$anggota_nim = $_POST["nim"];

$query = "update peminjaman set tgl_peminjaman='$tgl_peminjaman', barang_id_barang=$id_barang, anggota_nim='$anggota_nim', $denda, $tgl_kembali where id_peminjaman=$id";
$update = mysqli_query($conn, $query);

if($update){
    ?>
    <script>
        alert("Edit data peminjaman berhasil");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}else{
    echo "error\n$query";
}

?>