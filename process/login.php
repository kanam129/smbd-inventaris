<?php

session_start();

$username = $_POST["username_petugas"];
$password = $_POST["password_petugas"];

$conn = mysqli_connect("localhost:8111", "master", "master", "projek_smbd_inventaris");

$select = mysqli_query($conn, "select * from petugas where binary username_petugas = '$username' and binary password_petugas = '$password'");
$num_row = mysqli_num_rows($select);

if($num_row < 1){
    ?>
    <script>
        alert("Username atau password salah!");
        document.location = "../login.php";
    </script>
    <?php
}else{
    while($data = mysqli_fetch_array($select)){
        $user = $data["username_petugas"];
        $password_petugas = $data["password_petugas"];
        $nama_pengguna = $data["nama_petugas"];
        $level_petugas = $data["level_petugas"];
        $id_petugas = $data["id_petugas"];
    }
    $_SESSION["user"] = $user;
    $_SESSION["password_petugas"] = $password_petugas;
    $_SESSION["level_petugas"] = $level_petugas;
    $_SESSION["nama_petugas"] = $nama_petugas;
    $_SESSION["id_petugas"] = $id_petugas;
    mysqli_close($conn);
    header("location:../index.php");
}

?>