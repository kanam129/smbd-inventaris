<div class="container mt-lg-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>No Tlp</th>
                            <th>Alamat</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $select = mysqli_query($conn, "select * from anggota");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["nim"] ?></td>
                                <td><?php echo $data["nama_anggota"] ?></td>
                                <td><?php echo $data["jenis_kelamin_anggota"] ?></td>
                                <td><?php echo $data["tgl_lahir_anggota"] ?></td>
                                <td><?php echo $data["no_tlp_anggota"] ?></td>
                                <td><?php echo $data["alamat_anggota"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit('<?php echo $data['nim'] ?>')"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="#form-hapus" data-toggle="modal" onclick="hapus('<?php echo $data['nim']; ?>')" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
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

    <a href="process/print_anggota.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    
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
                <form action="process/tambah_anggota.php" method="post">
                    <div class="modal-body">
                    Nim
                    <input type="text" name="nim" class="form-control mb-3 mt-2" placeholder="Nim" required>

                    Nama anggota
                    <input type="text" name="nama_anggota" class="form-control mb-3 mt-2" placeholder="Nama Anggota" required>

                    <div class="w-100 mb-2">
                        Jenis Kelamin
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <label class="form-check-label mr-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin_anggota" id="jenis_kelamin_anggota" value="L"> Laki-laki
                        </label>
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="jenis_kelamin_anggota" id="jenis_kelamin_anggota2" value="P"> Perempuan
                        </label>
                    </div>

                    <div class="w-100 mb-2">
                        Tanggal Lahir
                    </div>
                    <input type="date" name="tgl_lahir_anggota" class="form-control mb-3 mt-2" placeholder="Tanggal Lahir" min="1" required>

                    No tlp
                    <input type="tel" name="no_tlp_anggota" class="form-control mb-3 mt-2" placeholder="no tlp" min="1"  required>

                    <div class="form-group">
                        <label for="alamat_anggota">Alamat</label>
                        <textarea class="form-control" name="alamat_anggota" id="alamat_anggota" rows="2"></textarea>
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
                <form action="process/edit_anggota.php" method="post" id="form-edit">
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
                <form action="process/hapus_anggota.php" method="post" id="form-hapus">
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
            $("#body-edit").load("process/edit_anggota_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }

        function hapus(id) {  
            $("#id").attr("value", id);
        }
    </script>