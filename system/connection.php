<?php

$conn = mysqli_connect("localhost:8111", $_SESSION["user"], $_SESSION["password_petugas"], "projek_smbd_inventaris");

if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
}

?>