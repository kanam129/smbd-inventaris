<?php

$conn = mysqli_connect("localhost:8111", "admin", "admin", "projek_smbd_inventaris");

if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
}

?>