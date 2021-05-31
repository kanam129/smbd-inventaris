    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Petugas</th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $select = mysqli_query($conn, "select * from viewpeminjaman");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["id_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_peminjaman"] ?></td>
                                <td><?php echo $data["nama_petugas"] ?></td>
                                <td><?php echo $data["nama_barang"] ?></td>
                                <td><?php echo $data["nama_anggota"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit(<?php echo $data['id_peminjaman'] ?>)"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="#form-hapus" data-toggle="modal" onclick="hapus(<?php echo $data['id_peminjaman'] ?>)" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="#form-tambah" class="btn btn-primary rounded-circle tombol-tambah" data-toggle="modal"><i class="fas fa-plus"></i></a>

    <a href="process/print_peminjaman.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>
    
    <!-- Modal Tambah -->
    <div class="modal fade" id="form-tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <form action="process/tambah_peminjaman.php" method="post">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <label for="nim" class="w-100">NIM</label>
                                        <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" aria-label="NIM" required>
                                        <span class="input-group-btn ml-2">
                                            <button class="btn btn-primary text-light" type="button" aria-label="Cari" onclick="get_anggota('#get_nim', '#nim')"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                    <div id="get_nim">
                                        <div class="form-group">
                                            <label for="nama_anggota">Nama</label>
                                            <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Nama" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir_anggota">Tgl Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir_anggota" id="tgl_lahir_anggota" placeholder="Tgl Lahir" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_anggota">Alamat</label>
                                            <input type="text" class="form-control" name="alamat_anggota" id="alamat_anggota" aria-describedby="helpId" placeholder="Alamat" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <label for="id_barang" class="w-100">ID Barang</label>
                                        <input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="ID Barang" required>
                                        <span class="input-group-btn ml-2">
                                            <button class="btn btn-primary text-light" type="button" aria-label="Cari" onclick="get_barang('#get_barang', '#id_barang')"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                    <div id="get_barang">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="merk_barang">Merk</label>
                                            <input type="text" class="form-control" name="merk_barang" id="merk_barang" placeholder="Merk" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kondisi_barang">Kondisi</label>
                                            <input type="text" class="form-control" name="kondisi_barang" id="kondisi_barang" aria-describedby="helpId" placeholder="Kondisi" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Tambah" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="form-edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="process/edit_peminjaman.php" method="post" id="form-edit">
                    <div class="modal-body" id="body-edit">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Edit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="form-hapus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="process/hapus_peminjaman.php" method="post" id="form-hapus">
                    <div class="modal-body" id="body-edit">
                        <div class="form-check form-check-inline mb-3 ml-2">
                            <input type="hidden" name="id" id="id">
                        </div>
                        Apakah anda yakin ingin menghapus data ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <input type="submit" value="Ya" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function get_anggota(target, get_id) {  
            var id_temp = $(get_id).val();
            $(target).load("process/ajax_get_anggota.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }
        
        function get_barang(target, get_id) {  
            var id_temp = $(get_id).val();
            $(target).load("process/ajax_get_barang.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }

        function edit(id_temp) {
            $("#body-edit").load("process/edit_peminjaman_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }
        
        function hapus(id) {  
            $("#id").attr("value", id);
        }

        function banyak_pinjam(id_temp) {  
            $("#banyak_yang_dipinjam").load("process/banyak_pinjam_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }
        
        function banyak_dipinjam(id_temp) {  
            $("#banyak-dipinjam").load("process/banyak_pinjam_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }
    </script>