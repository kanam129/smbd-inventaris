<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$nim = $_POST["nim"];

$delete = mysqli_query($conn, "delete from anggota where nim = $nim");

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