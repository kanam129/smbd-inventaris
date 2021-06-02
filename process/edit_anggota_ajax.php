<?php

include("../system/connection.php");
$id = $_POST["nim"];

$select = mysqli_query($conn, "select * from anggota where nim=$nim");

while($data = mysqli_fetch_array($select)){
    $nim = $data["nim"];
    $nama_anggota = $data["nama_anggota"];
    $jenis_kelamin_anggota = $data["jenis_kelamin_anggota"];
    $tgl_lahir_anggota = $data["tgl_lahir_anggota"];
    $no_tlp_anggota = $data["no_tlp_anggota"];
    $alamat_anggota= $data["alamat_anggota"];
}

?>

Nim
<input type="text" name="nim" class="form-control mb-3 mt-2" placeholder="nim" value="<?php echo $nim ?>" readonly required>

Nama anggota
<input type="text" name="nama_anggota" class="form-control mb-3 mt-2" placeholder="nama_anggota" value="<?php echo $nama_anggota ?>" required>

Jenis Kelamin
<input type="text" name="jenis_kelamin_anggota" class="form-control mb-3 mt-2" placeholder="jenis_kelamin_anggota" value="<?php echo $jenis_kelamin_anggota ?>" required>

Tanggal Lahir
<input type="date" name="tgl_lahir_anggota" class="form-control mb-3 mt-2" placeholder="tgl_lahir_anggota"  value="<?php echo $tgl_lahir_anggota ?>" required>

No tlp
<input type="tel" name="no_tlp_anggota" class="form-control mb-3 mt-2" placeholder="no_tlp_anggota"  value="<?php echo $no_tlp_anggota ?>" required>

Alamat
<input type="text" name="alamat_anggota" class="form-control mb-3 mt-2" placeholder="alamat_anggota" min="1" value="<?php echo $alamat_anggota ?>" required>
