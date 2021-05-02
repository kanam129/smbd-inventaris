<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}


$username = $_POST["id"];

$delete = mysqli_query($conn, "delete from pengguna where username_pengguna = '$username'");

if($delete){
    ?>
    <script>
        alert("Hapus data pengguna berhasil");
        document.location = "../index.php?page=pengguna";
    </script>
    <?php
}else{
    echo "error";
}

?>