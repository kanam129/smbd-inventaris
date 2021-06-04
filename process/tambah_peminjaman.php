<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}
date_default_timezone_set("Asia/Jakarta");
$tgl_peminjaman = date("Y-m-d", time());
$id_barang = $_POST["id_barang"];
$nim = $_POST["nim"];
$id_petugas = $_SESSION["id_petugas"];

$insert = mysqli_multi_query($conn, "
    START TRANSACTION; 
    insert into peminjaman values (null, '$tgl_peminjaman', null, 0, $id_petugas, $id_barang, $nim);
    CALL peminjaman($id_barang);
    COMMIT;
");

if($insert){
    ?>
    <script>
        alert("Tambah data peminjaman berhasil");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Peminjaman Gagal");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}

?>