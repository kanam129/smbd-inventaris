<?php

include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from petugas where id_petugas='$id'");

while($data = mysqli_fetch_array($select)){
    $nama_petugas = $data["nama_petugas"];
    $jenis_kelamin_petugas = $data["jenis_kelamin_petugas"];
    $tgl_lahir_petugas = $data["tgl_lahir_petugas"];
    $no_tlp_petugas = $data["no_tlp_petugas"];
    $alamat_petugas = $data["alamat_petugas"];
    $username_petugas = $data["username_petugas"];
    $password_petugas = $data["password_petugas"];
    $level_petugas = $data["level_petugas"];
}

?>

<div class="form-group">
    <label for="nama_petugas">Nama</label>
    <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" aria-describedby="helpId" placeholder="Nama" value="<?php echo $nama_petugas; ?>">
</div>
<div class="w-100 mb-2">
    Jenis Kelamin
</div>
<div class="form-check form-check-inline mb-3">
    <label class="form-check-label mr-3">
        <input class="form-check-input" type="radio" name="jenis_kelamin_petugas" id="jenis_kelamin_petugas" value="L" <?php if($jenis_kelamin_petugas=="L"){echo "checked";} ?>> Laki-laki
    </label>
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="jenis_kelamin_petugas" id="jenis_kelamin_petugas2" value="P" <?php if($jenis_kelamin_petugas=="P"){echo "checked";} ?>> Perempuan
    </label>
</div>
<div class="form-group">
    <label for="tgl_lahir_petugas">Tgl Lahir</label>
    <input type="date"
    class="form-control" name="tgl_lahir_petugas" id="tgl_lahir_petugas" aria-describedby="helpId" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir_petugas; ?>">
</div>
<div class="form-group">
    <label for="no_tlp_petugas">No Tlp</label>
    <input type="tel"
    class="form-control" name="no_tlp_petugas" id="no_tlp_petugas" aria-describedby="helpId" placeholder="08xxxxxxxxxx" value="<?php echo $no_tlp_petugas; ?>">
</div>
<div class="form-group">
    <label for="alamat_petugas">Alamat</label>
    <textarea class="form-control" name="alamat_petugas" id="alamat_petugas" rows="2"> <?php echo $alamat_petugas; ?></textarea>
</div>
<div class="form-group">
    <label for="username_petugas">Username</label>
    <input type="text"
    class="form-control" name="username_petugas" id="username_petugas" aria-describedby="usernameHelpText" placeholder="Username" required onblur="checkUsername(this)" autocomplete="off" value="<?php echo $username_petugas; ?>">
</div>
<div class="form-group">
    <label for="password_petugas">Password</label>
    <input type="password" class="form-control" name="password_petugas" id="password_petugas" value="<?php echo $password_petugas; ?>">
</div>
<div class="form-group">
    <label for="level_petugas">Level</label>
    <select class="form-control" name="level_petugas" id="level_petugas">
    <option disabled>--Pilih--</option>
    <option <?php if($level_petugas=="Admin"){echo "selected";} ?>>Admin</option>
    <option <?php if($level_petugas=="Super Admin"){echo "selected";} ?>>Super Admin</option>
    </select>
</div>