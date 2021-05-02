<?php

include("../system/connection.php");
$id = $_POST["id"];



$select = mysqli_query($conn, "select * from peminjaman where id_peminjaman=$id");

while($data = mysqli_fetch_array($select)){
    $tgl_peminjaman = $data["tgl_peminjaman"];
    $tgl_pengembalian = $data["tgl_pengembalian"];
    $nama_peminjam = $data["nama_peminjam"];
    $no_tlp_peminjam = $data["no_tlp_peminjam"];
    $alamat_peminjam = $data["alamat_peminjam"];
    $id_barang = $data["id_barang"];
    $banyak_yang_dipinjam = $data["banyak_yang_dipinjam"];
    $username_pengguna = $data["username_pengguna"];
}

$select = mysqli_query($conn, "SELECT SUM(banyak_yang_dipinjam) FROM peminjaman where id_barang=$id_barang and tgl_pengembalian is null");
$dipinjam = mysqli_fetch_array($select);

?>
<input type="text" name="id_peminjaman" class="form-control mb-3" placeholder="ID Peminjaman" readonly required value="<?php echo $id ?>">
<input type="date" name="tgl_peminjaman" class="form-control mb-3" placeholder="Tanggal Peminjaman" required value="<?php echo $tgl_peminjaman ?>">

<input type="date" name="tgl_pengembalian" class="form-control mb-3" placeholder="Tanggal Pengembalian" value="<?php echo $tgl_pengembalian ?>" >

<input type="text" name="nama_peminjam" class="form-control mb-3" placeholder="Nama Peminjam" required value="<?php echo $nama_peminjam ?>">
<input type="tel" name="no_tlp_peminjam" class="form-control mb-3" placeholder="Nomer Telepon" required value="<?php echo $no_tlp_peminjam ?>">
<input type="text" name="alamat_peminjam" class="form-control mb-3" placeholder="Alamat" required value="<?php echo $alamat_peminjam ?>">
<select name="id_barang" class="form-control mb-3" required onchange="banyak_dipinjam(this.value)">
    <?php 
    $select = mysqli_query($conn, "select * from barang");
    while($data = mysqli_fetch_array($select)){
        ?>
        <option value="<?php echo $data['id_barang'] ?>" <?php if($data["id_barang"]==$id_barang){ $stok_barang=$data["stok_barang"]; echo "selected"; } ?>><?php echo $data['id_barang'] ?> - <?php echo $data['nama_barang'] ?></option>
        <?php
    }
    ?>
</select>
<div id="banyak-dipinjam">
    <input type="number" name="banyak_yang_dipinjam" class="form-control mb-3" placeholder="Banyak Barang" min="1" max="<?php echo $stok_barang-$dipinjam[0]+$banyak_yang_dipinjam ?>" required value="<?php echo $banyak_yang_dipinjam ?>">
</div>