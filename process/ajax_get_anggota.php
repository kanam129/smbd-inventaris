<?php

session_start();
include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from anggota where nim='$id'");

while($data = mysqli_fetch_array($select)){
    $nama_anggota = $data["nama_anggota"];
    $tgl_lahir_anggota = $data["tgl_lahir_anggota"];
    $alamat_anggota = $data["alamat_anggota"];
}

if(isset($nama_anggota)){
    ?>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text"
        class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Nama" readonly required value="<?php echo $nama_anggota; ?>">
    </div>
    <div class="form-group">
        <label for="tgl_lahir_anggota">Tgl Lahir</label>
        <input type="date"
        class="form-control" name="tgl_lahir_anggota" id="tgl_lahir_anggota" placeholder="Tgl Lahir" readonly required value="<?php echo $tgl_lahir_anggota; ?>">
    </div>
    <div class="form-group">
        <label for="alamat_anggota">Alamat</label>
        <input type="text"
        class="form-control" name="alamat_anggota" id="alamat_anggota" aria-describedby="helpId" placeholder="Alamat" readonly required value="<?php echo $alamat_anggota; ?>">
    </div>
    <?php
}else{
    echo "Data Tidak Ditemukan";
}
?>

