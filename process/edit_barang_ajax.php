<?php

session_start();
include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from barang where id_barang=$id");

while($data = mysqli_fetch_array($select)){
    $id_barang = $data["id_barang"];
    $nama_barang = $data["nama_barang"];
    $merk_barang = $data["merk_barang"];
    $jumlah_barang = $data["jumlah_barang"];
    $kondisi_barang = $data["kondisi_barang"];
    $tgl_barang_masuk = $data["tgl_barang_masuk"];
}

?>

ID
<input type="text" name="id_barang" class="form-control mb-3 mt-2" placeholder="ID" value="<?php echo $id_barang ?>" readonly required>

Nama
<input type="text" name="nama_barang" class="form-control mb-3 mt-2" placeholder="Nama Barang" value="<?php echo $nama_barang ?>" required>

Merk
<input type="text" name="merk_barang" class="form-control mb-3 mt-2" placeholder="Merk Barang" value="<?php echo $merk_barang ?>" required>

Jumlah
<input type="number" name="jumlah_barang" class="form-control mb-3 mt-2" placeholder="Jumlah Barang" min="1" value="<?php echo $jumlah_barang ?>" required>

<div class="form-group">
    <label for="kondisi">Kondisi</label>
    <select class="form-control" name="kondisi_barang" id="kondisi" required>
    <option disabled>--Pilih--</option>
    <option value="Baik" <?php if($kondisi_barang=="Baik"){echo "Selected";} ?>>Baik</option>
    <option value="Rusak" <?php if($kondisi_barang=="Rusak"){echo "Selected";} ?>>Rusak</option>
    </select>
</div>

Tgl Masuk
<input type="date" name="tgl_barang_masuk" class="form-control mb-3 mt-2" placeholder="Tgl Masuk" min="1" value="<?php echo $tgl_barang_masuk ?>" required>