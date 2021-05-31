<?php

include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from barang where id_barang=$id AND jumlah_barang > 0");

while($data = mysqli_fetch_array($select)){
    $nama_barang = $data["nama_barang"];
    $merk_barang = $data["merk_barang"];
    $kondisi_barang = $data["kondisi_barang"];
}

if(isset($nama_barang)){
    ?>
    <div class="form-group">
    <label for="nama_barang">Nama Barang</label>
    <input type="text"
        class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" readonly required value="<?php echo $nama_barang; ?>">
    </div>
    <div class="form-group">
    <label for="merk_barang">Merk</label>
    <input type="text"
        class="form-control" name="merk_barang" id="merk_barang" placeholder="Merk" readonly required value="<?php echo $merk_barang; ?>">
    </div>
    <div class="form-group">
    <label for="kondisi_barang">Kondisi</label>
    <input type="text"
        class="form-control" name="kondisi_barang" id="kondisi_barang" aria-describedby="helpId" placeholder="Kondisi" readonly required value="<?php echo $kondisi_barang; ?>">
    </div>
    <?php
}else{
    echo "Data Tidak Ditemukan";
}
?>

