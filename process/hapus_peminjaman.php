<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id = $_POST["id"];

$delete = mysqli_query($conn, "delete from peminjaman where id_peminjaman = $id");

if($delete){
    ?>
    <script>
        alert("Hapus data peminjaman berhasil");
        document.location = "../index.php?page=peminjaman";
    </script>
    <?php
}else{
    echo "error";
}

?>