<?php

include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from barang where id_barang=$id");

while($data = mysqli_fetch_array($select)){
    $nama_barang = $data["nama_barang"];
    $merk_barang = $data["merk_barang"];
    $stok_barang = $data["stok_barang"];
}

?>
<input type="text" name="id_barang" class="form-control mb-3" placeholder="ID Barang" readonly required value="<?php echo $id ?>">
<input type="text" name="nama_barang" class="form-control mb-3" placeholder="Nama Barang" required value="<?php echo $nama_barang ?>">
<input type="text" name="merk_barang" class="form-control mb-3" placeholder="Merk Barang" required value="<?php echo $merk_barang ?>">
<input type="number" name="stok_barang" class="form-control mb-3" placeholder="Stok Barang" min="1" required value="<?php echo $stok_barang ?>">