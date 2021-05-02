<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id_barang = $_POST["id_barang"];
$nama_barang = $_POST["nama_barang"];
$merk_barang = $_POST["merk_barang"];
$stok_barang = $_POST["stok_barang"];

$update = mysqli_query($conn, "update barang set nama_barang='$nama_barang', merk_barang='$merk_barang', stok_barang=$stok_barang where id_barang=$id_barang");

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