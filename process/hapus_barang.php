<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id = $_POST["id"];

$delete = mysqli_query($conn, "delete from barang where id_barang = $id");

if($delete){
    ?>
    <script>
        alert("Hapus data barang berhasil");
        document.location = "../index.php?page=barang";
    </script>
    <?php
}else{
    echo "error";
}

?>