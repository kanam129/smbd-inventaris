<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}
date_default_timezone_set("Asia/Jakarta");
$tgl_peminjaman = date("Y-m-d", time());
$waktu_peminjaman = date("Y-m-d H:i:s", time());
$nama_peminjam = $_POST["nama_peminjam"];
$no_tlp_peminjam = $_POST["no_tlp_peminjam"];
$alamat_peminjam = $_POST["alamat_peminjam"];
$id_barang = $_POST["id_barang"];
$banyak_yang_dipinjam = $_POST["banyak_yang_dipinjam"];
$username_pengguna = $_SESSION["user"];

$insert = mysqli_query($conn, "insert into peminjaman values (null, '$tgl_peminjaman', '$waktu_peminjaman', null, '$nama_peminjam', '$no_tlp_peminjam', '$alamat_peminjam', $id_barang, $banyak_yang_dipinjam, '$username_pengguna')");

if($insert){
    ?>
    <script>
        alert("Tambah data peminjaman berhasil");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}else{
    echo "error";
}

?>