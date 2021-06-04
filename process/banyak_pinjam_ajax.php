<?php

session_start();
include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "SELECT SUM(banyak_yang_dipinjam) FROM peminjaman where id_barang=$id and tgl_pengembalian is null");
$dipinjam = mysqli_fetch_array($select);

$select = mysqli_query($conn, "select * from barang where id_barang=$id");

while($data = mysqli_fetch_array($select)){
    $stok_barang = $data["stok_barang"];
}

?>

<input type="number" name="banyak_yang_dipinjam" class="form-control mb-3" min="1" max="<?php echo $stok_barang-$dipinjam[0] ?>" placeholder="Banyak Barang" required>