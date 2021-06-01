<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id = $_POST["id"];

$delete = mysqli_query($conn, "delete from petugas where id_petugas = $id");

if($delete){
    ?>
    <script>
        alert("Hapus data petugas berhasil");
        document.location = "../index.php?page=petugas";
    </script>
    <?php
}else{
    echo "error";
}

?>