<div class="container mt-lg-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Tgl Masuk</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $select = mysqli_query($conn, "select * from barang");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["id_barang"] ?></td>
                                <td><?php echo $data["nama_barang"] ?></td>
                                <td><?php echo $data["merk_barang"] ?></td>
                                <td><?php echo $data["jumlah_barang"] ?></td>
                                <td><?php echo $data["kondisi_barang"] ?></td>
                                <td><?php echo $data["tgl_barang_masuk"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit(<?php echo $data['id_barang'] ?>)"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="#form-hapus" data-toggle="modal" onclick="hapus(<?php echo $data['id_barang'] ?>)" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
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

    <a href="process/print_barang.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    
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
                <form action="process/tambah_barang.php" method="post">
                    <div class="modal-body">
                        Nama
                        <input type="text" name="nama_barang" class="form-control mb-3 mt-2" placeholder="Nama Barang" required>

                        Merk
                        <input type="text" name="merk_barang" class="form-control mb-3 mt-2" placeholder="Merk Barang" required>

                        Jumlah
                        <input type="number" name="jumlah_barang" class="form-control mb-3 mt-2" placeholder="Jumlah Barang" min="1" required>

                        <div class="form-group">
                          <label for="kondisi">Kondisi</label>
                          <select class="form-control" name="kondisi_barang" id="kondisi" required>
                            <option selected disabled>--Pilih--</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                          </select>
                        </div>

                        Tgl Masuk
                        <input type="date" name="tgl_barang_masuk" class="form-control mb-3 mt-2" placeholder="Tgl Masuk" min="1" value="<?php echo date('Y-m-d'); ?>" required>
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
                <form action="process/edit_barang.php" method="post" id="form-edit">
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
                <form action="process/hapus_barang.php" method="post" id="form-hapus">
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
            $("#body-edit").load("process/edit_barang_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }

        function hapus(id) {  
            $("#id").attr("value", id);
        }
    </script>