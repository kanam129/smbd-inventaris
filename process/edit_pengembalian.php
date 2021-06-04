<?php

session_start();
include("../system/connection.php");

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

$id = $_POST["id"];
$tgl_peminjaman = $_POST["tgl_peminjaman"];
$tgl_kembali = date("Y/m/d", time());

$update = mysqli_multi_query($conn, "
    START TRANSACTION;
    update peminjaman set tgl_kembali='$tgl_kembali', denda = cekDenda($id, '$tgl_kembali') where id_peminjaman=$id;
    set @idBarang = (select barang_id_barang from peminjaman where id_peminjaman = $id);
    call pengembalian(@idBarang);
    COMMIT;
");

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
    ?>
    <script>
        alert("Pengembalian Gagal");
        document.location = "../index.php?page=pengembalian";
    </script>
    <?php
}

?>