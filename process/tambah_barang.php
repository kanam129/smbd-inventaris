<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$nama_barang = $_POST["nama_barang"];
$merk_barang = $_POST["merk_barang"];
$jumlah_barang = $_POST["jumlah_barang"];
$kondisi_barang = $_POST["kondisi_barang"];
$tgl_barang_masuk = $_POST["tgl_barang_masuk"];

$insert = mysqli_query($conn, "insert into barang values (null, '$nama_barang','$merk_barang',$jumlah_barang, '$kondisi_barang', '$tgl_barang_masuk')");

if($insert){
    ?>
    <script>
        alert("Tambah data barang berhasil");
        document.location = "../index.php?page=barang";
    </script>
    <?php
}else{
    echo "error";
}

?>