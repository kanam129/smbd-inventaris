<?php

include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from pengguna where username_pengguna='$id'");

while($data = mysqli_fetch_array($select)){
    $password_pengguna = $data["password_pengguna"];
    $hak_akses_pengguna = $data["hak_akses_pengguna"];
    $nama_pengguna = $data["nama_pengguna"];
    $no_tlp_pengguna = $data["no_tlp_pengguna"];
    $alamat_pengguna = $data["alamat_pengguna"];
}

?>

<input type="text" name="username_pengguna" class="form-control mb-3" placeholder="Username" required readonly value="<?php echo $id ?>">
<input type="text" name="password_pengguna" class="form-control mb-3" placeholder="Password" required value="<?php echo $password_pengguna ?>">
<select name="hak_akses_pengguna" class="form-control mb-3" required>
    <option value="" disabled>Pilih</option>
    <option value="Admin" <?php if($hak_akses_pengguna == "Admin"){echo "selected";} ?> >Admin</option>
    <option value="Super Admin" <?php if($hak_akses_pengguna == "Super Admin"){echo "selected";} ?> >Super Admin</option>
</select>
<input type="text" name="nama_pengguna" class="form-control mb-3" placeholder="Nama" required value="<?php echo $nama_pengguna ?>">
<input type="telp" name="no_tlp_pengguna" class="form-control mb-3" placeholder="No Telp" required value="<?php echo $no_tlp_pengguna ?>">
<input type="text" name="alamat_pengguna" class="form-control mb-3" placeholder="Alamat" required value="<?php echo $alamat_pengguna ?>">