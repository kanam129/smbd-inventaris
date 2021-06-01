<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$id = $_POST["id"];
$tgl_peminjaman = $_POST["tgl_peminjaman"];
$tgl_kembali = date("Y/m/d", time());

$update = mysqli_query($conn, "update peminjaman set tgl_kembali='$tgl_kembali', denda = cekDenda($id, '$tgl_kembali') where id_peminjaman=$id");

$datediff = date_diff(date_create($tgl_kembali), date_create($tgl_peminjaman));
$datediffInt = $datediff->format("%d");

if($update){
    ?>
    <script>
        var ddiff = <?php echo $datediffInt ?>;
        if( ddiff > 6){
            var keterlambatan = ddiff - 6;
            var denda = (ddiff-6)*2000;
            alert("Pengembalian berhasil\nPeminjam dikenakan denda Rp."+denda+" karena telat mengembalikan "+keterlambatan+" hari");
        }else{
            alert("Pengembalian berhasil");
        }
        document.location = "../index.php?page=pengembalian";
    </script>
    <?php
}else{
    echo "error";
}

?>