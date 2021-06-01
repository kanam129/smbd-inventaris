<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$nim = $_POST["id"];

$delete = mysqli_query($conn, "delete from anggota where nim = '$nim'");

if($delete){
    ?>
    <script>
        alert("Hapus data anggota berhasil");
        document.location = "../index.php?page=anggota";
    </script>
    <?php
}else{
    echo "error";
}

?>