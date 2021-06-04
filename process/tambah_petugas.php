<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$nama_petugas = $_POST["nama_petugas"];
$jenis_kelamin_petugas = $_POST["jenis_kelamin_petugas"];
$tgl_lahir_petugas = $_POST["tgl_lahir_petugas"];
$no_tlp_petugas = $_POST["no_tlp_petugas"];
$alamat_petugas = $_POST["alamat_petugas"];
$username_petugas = $_POST["username_petugas"];
$password_petugas = $_POST["password_petugas"];
$level_petugas = $_POST["level_petugas"];

if($level_petugas == "Admin"){
    $insert = mysqli_multi_query($conn, "
        insert into petugas values (NULL, '$nama_petugas', '$jenis_kelamin_petugas', '$tgl_lahir_petugas', '$no_tlp_petugas', '$alamat_petugas', '$username_petugas', '$password_petugas', '$level_petugas');
        
        CREATE USER '$username_petugas'@'%' IDENTIFIED VIA mysql_native_password USING PASSWORD('$password_petugas');
        GRANT SELECT, UPDATE, DELETE, INSERT ON `projek_smbd_inventaris`.* TO '$username_petugas'@'%';
    ");
}else{
    $insert = mysqli_multi_query($conn, "
        insert into petugas values (NULL, '$nama_petugas', '$jenis_kelamin_petugas', '$tgl_lahir_petugas', '$no_tlp_petugas', '$alamat_petugas', '$username_petugas', '$password_petugas', '$level_petugas');
        
        CREATE USER '$username_petugas'@'%' IDENTIFIED VIA mysql_native_password USING PASSWORD('$password_petugas');
        GRANT ALL PRIVILEGES ON *.* TO '$username_petugas'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
    ");
}



if($insert){
    ?>
    <script>
        alert("Tambah data petugas berhasil");
        document.location = "../index.php?page=petugas";
    </script>
    <?php
}else{
    echo mysqli_error($conn);
}

?>