    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Nama Peminjam</th>
                            <th>No Tlp</th>
                            <th>Alamat</th>
                            <th>Barang</th>
                            <th>Banyak Barang</th>
                            <th>Yang Melayani</th>
                            <?php 
                            $hak_akses = $_SESSION["hak_akses"];
                            if($hak_akses=="Super Admin"){
                                ?>
                                <th colspan="2">Aksi</th>
                                <?php
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $select = mysqli_query($conn, "select * from peminjaman");
                        while($data = mysqli_fetch_array($select)){
                            $selectBarang = mysqli_query($conn, "select nama_barang from barang where id_barang=".$data["id_barang"]);
                            $nama_barang = mysqli_fetch_array($selectBarang);
                            ?>
                            <tr>
                                <td><?php echo $data["id_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_pengembalian"] ?></td>
                                <td><?php echo $data["nama_peminjam"] ?></td>
                                <td><?php echo $data["no_tlp_peminjam"] ?></td>
                                <td><?php echo $data["alamat_peminjam"] ?></td>
                                <td><?php echo $data["id_barang"]."-".$nama_barang[0] ?></td>
                                <td><?php echo $data["banyak_yang_dipinjam"] ?></td>
                                <td><?php echo $data["username_pengguna"] ?></td>
                                <?php if($hak_akses=="Super Admin"){
                                    ?>
                                    <td><a href="#form-edit" data-toggle="modal" onclick="edit(<?php echo $data['id_peminjaman'] ?>)"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td><a href="#form-hapus" data-toggle="modal" onclick="hapus(<?php echo $data['id_peminjaman'] ?>)" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
                                    <?php
                                } ?>
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
                        <input type="text" name="nama_peminjam" class="form-control mb-3" placeholder="Nama Peminjam" required>
                        <input type="tel" name="no_tlp_peminjam" class="form-control mb-3" placeholder="Nomer Telepon" required>
                        <input type="text" name="alamat_peminjam" class="form-control mb-3" placeholder="Alamat" required>
                        <select name="id_barang" class="form-control mb-3" id="id_barang" required onchange="banyak_pinjam(this.value)">
                            <option value="" disabled selected>Pilih Barang</option>
                            <?php 
                            $select = mysqli_query($conn, "select * from barang");
                            while($data = mysqli_fetch_array($select)){
                                ?>
                                <option value="<?php echo $data['id_barang'] ?>"><?php echo $data['id_barang'] ?> - <?php echo $data['nama_barang'] ?></option>
                                <script>
                                    <?php echo "var id_".$data['id_barang']." = ".((int)$data["stok_barang"]-(int)$data["dipinjam"]) ?>
                                </script>
                                <?php
                            }
                            ?>
                        </select>
                        <div id="banyak_yang_dipinjam">
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
        function edit(id_temp) {
            $("#body-edit").load("process/edit_peminjaman_ajax.php", {id:id_temp, hak_akses:"<?php echo $_SESSION['hak_akses'] ?>"}, function (response, status, request) {
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