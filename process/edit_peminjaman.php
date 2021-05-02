<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

if($_POST["tgl_pengembalian"] == "0000-00-00" || $_POST["tgl_pengembalian"] == ""){
    $tgl_pengembalian = "tgl_pengembalian=NULL";
}else{
    $tgl_pengembalian = "tgl_pengembalian='".$_POST["tgl_pengembalian"]."'";
}

$id = $_POST["id_peminjaman"];
$tgl_peminjaman = $_POST["tgl_peminjaman"];
$nama_peminjam = $_POST["nama_peminjam"];
$no_tlp_peminjam = $_POST["no_tlp_peminjam"];
$alamat_peminjam = $_POST["alamat_peminjam"];
$id_barang = $_POST["id_barang"];
$banyak_yang_dipinjam = $_POST["banyak_yang_dipinjam"];
$username_pengguna = $_SESSION["user"];

$update = mysqli_query($conn, "update peminjaman set tgl_peminjaman='$tgl_peminjaman', nama_peminjam='$nama_peminjam', no_tlp_peminjam='$no_tlp_peminjam', alamat_peminjam='$alamat_peminjam', id_barang=$id_barang, banyak_yang_dipinjam=$banyak_yang_dipinjam, username_pengguna='$username_pengguna', $tgl_pengembalian where id_peminjaman=$id");

if($update){
    ?>
    <script>
        alert("Edit data peminjaman berhasil <?php echo $_POST["tgl_pengembalian"] ?>");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}else{
    echo "error";
}

?>