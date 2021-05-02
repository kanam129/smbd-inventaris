<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$nama_barang = $_POST["nama_barang"];
$merk_barang = $_POST["merk_barang"];
$stok_barang = $_POST["stok_barang"];

$insert = mysqli_query($conn, "insert into barang values (null, '$nama_barang','$merk_barang',$stok_barang)");

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