<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id_barang = $_POST["id_barang"];
$nama_barang = $_POST["nama_barang"];
$merk_barang = $_POST["merk_barang"];
$jumlah_barang = $_POST["jumlah_barang"];
$kondisi_barang = $_POST["kondisi_barang"];
$tgl_barang_masuk = $_POST["tgl_barang_masuk"];

$update = mysqli_query($conn, "update barang set nama_barang='$nama_barang', merk_barang='$merk_barang', jumlah_barang=$jumlah_barang, kondisi_barang='$kondisi_barang', tgl_barang_masuk='$tgl_barang_masuk' where id_barang=$id_barang");

if($update){
    ?>
    <script>
        alert("Edit data barang berhasil");
        document.location = "../index.php?page=barang";
    </script>
    <?php
}else{
    echo "error";
}

?>