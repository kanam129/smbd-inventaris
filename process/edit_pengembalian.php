<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$id = $_POST["id"];
$tgl_pengembalian = date("Y-m-d", time());

$update = mysqli_query($conn, "update peminjaman set tgl_pengembalian='$tgl_pengembalian' where id_peminjaman=$id");

if($update){
    ?>
    <script>
        alert("Pengembalian berhasil");
        document.location = "../index.php?page=pengembalian";
    </script>
    <?php
}else{
    echo "error";
}

?>