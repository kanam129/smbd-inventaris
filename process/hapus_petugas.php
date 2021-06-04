<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$id = $_POST["id"];
$username = $_POST["username"];

$delete = mysqli_multi_query($conn, "delete from petugas where id_petugas = $id; DROP USER '$username'");

if($delete){
    ?>
    <script>
        alert("Hapus data petugas berhasil");
        document.location = "../index.php?page=petugas";
    </script>
    <?php
}else{
    echo mysqli_error($conn);
}

?>