<?php

include("../system/connection.php");
$id = $_POST["id"];

$select = mysqli_query($conn, "select * from peminjaman where id_peminjaman=$id");

while($data = mysqli_fetch_array($select)){
    $tgl_peminjaman = $data["tgl_peminjaman"];
    $tgl_kembali = $data["tgl_kembali"];
    $denda = $data["denda"];
    $petugas_id_petugas = $data["petugas_id_petugas"];
    $barang_id_barang = $data["barang_id_barang"];
    $anggota_nim = $data["anggota_nim"];
}

$select = mysqli_query($conn, "select * from anggota where nim='$anggota_nim'");

while($data = mysqli_fetch_array($select)){
    $nama_anggota = $data["nama_anggota"];
    $tgl_lahir_anggota = $data["tgl_lahir_anggota"];
    $alamat_anggota = $data["alamat_anggota"];
}

$select = mysqli_query($conn, "select * from barang where id_barang=$barang_id_barang AND jumlah_barang > 0");

while($data = mysqli_fetch_array($select)){
    $nama_barang = $data["nama_barang"];
    $merk_barang = $data["merk_barang"];
    $kondisi_barang = $data["kondisi_barang"];
}

?>

<div class="container">
    <div class="row">
        <input type="hidden" name="id_peminjaman" value="<?php echo $id ?>">
        <div class="col-md-6">
            <div class="form-group">
              <label for="tgl_pinjam">Tgl Pinjam</label>
              <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" aria-describedby="helpId" placeholder="Tgl Pinjam" value="<?php echo $tgl_peminjaman ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="tgl_kembali">Tgl Kembali</label>
              <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" aria-describedby="helpId" placeholder="Tgl Kembali" value="<?php echo $tgl_kembali ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-2">
                <label for="nim_edit" class="w-100">NIM</label>
                <input type="text" class="form-control" name="nim" id="nim_edit" placeholder="NIM" aria-label="NIM" required value="<?php echo $anggota_nim ?>">
                <span class="input-group-btn ml-2">
                    <button class="btn btn-primary text-light" type="button" aria-label="Cari" onclick="get_anggota('#get_nim_edit', '#nim_edit')"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
            </div>
            <div id="get_nim_edit">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Nama" readonly required value="<?php echo $nama_anggota; ?>">
                </div>
                <div class="form-group">
                    <label for="tgl_lahir_anggota">Tgl Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir_anggota" id="tgl_lahir_anggota" placeholder="Tgl Lahir" readonly required value="<?php echo $tgl_lahir_anggota; ?>">
                </div>
                <div class="form-group">
                    <label for="alamat_anggota">Alamat</label>
                    <input type="text" class="form-control" name="alamat_anggota" id="alamat_anggota" aria-describedby="helpId" placeholder="Alamat" readonly required value="<?php echo $alamat_anggota; ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-2">
                <label for="id_barang_edit" class="w-100">ID Barang</label>
                <input type="text" class="form-control" name="id_barang" id="id_barang_edit" placeholder="ID Barang" required value="<?php echo $barang_id_barang ?>">
                <span class="input-group-btn ml-2">
                    <button class="btn btn-primary text-light" type="button" aria-label="Cari" onclick="get_barang('#get_barang_edit', '#id_barang_edit')"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
            </div>
            <div id="get_barang_edit">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" readonly required value="<?php echo $nama_barang; ?>">
                </div>
                <div class="form-group">
                    <label for="merk_barang">Merk</label>
                    <input type="text" class="form-control" name="merk_barang" id="merk_barang" placeholder="Merk" readonly required value="<?php echo $merk_barang; ?>">
                </div>
                <div class="form-group">
                    <label for="kondisi_barang">Kondisi</label>
                    <input type="text" class="form-control" name="kondisi_barang" id="kondisi_barang" aria-describedby="helpId" placeholder="Kondisi" readonly required value="<?php echo $kondisi_barang; ?>">
                </div>
            </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">
                <label for="denda">Denda</label>
                <input type="number" class="form-control" name="denda" id="denda" aria-describedby="denda" placeholder="Denda" value="<?php echo $denda ?>">
            </div>
        </div>
    </div>
</div>
