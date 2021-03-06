<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Denda</th>
                            <th>Petugas</th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $select = mysqli_query($conn, "select * from viewpengembalian where tgl_kembali is null and tgl_peminjaman < NOW() - INTERVAL 7 DAY");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr class="bg-danger text-white">
                                <td><?php echo $data["id_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_kembali"] ?></td>
                                <td><?php echo $data["denda"] ?></td>
                                <td><?php echo $data["nama_petugas"] ?></td>
                                <td><?php echo $data["nama_barang"] ?></td>
                                <td><?php echo $data["nama_anggota"] ?></td>
                                <td><a href="#form-edit" class="text-white" data-toggle="modal" onclick="edit(<?php echo $data['id_peminjaman'] ?>, '<?php echo $data['tgl_peminjaman']; ?>')"><i class="fas fa-edit    "></i></a></td>
                            </tr>
                            <?php
                        }

                        $select = mysqli_query($conn, "select * from viewpengembalian where tgl_kembali is null and tgl_peminjaman > NOW() - INTERVAL 7 DAY");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["id_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_kembali"] ?></td>
                                <td><?php echo $data["denda"] ?></td>
                                <td><?php echo $data["nama_petugas"] ?></td>
                                <td><?php echo $data["nama_barang"] ?></td>
                                <td><?php echo $data["nama_anggota"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit(<?php echo $data['id_peminjaman']; ?>, '<?php echo $data['tgl_peminjaman']; ?>')"><i class="fas fa-edit    "></i></a></td>
                            </tr>
                            <?php
                        }

                        $select = mysqli_query($conn, "select * from viewpengembalian where tgl_kembali is not null");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr class="bg-success text-light">
                                <td><?php echo $data["id_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_peminjaman"] ?></td>
                                <td><?php echo $data["tgl_kembali"] ?></td>
                                <td><?php echo $data["denda"] ?></td>
                                <td><?php echo $data["nama_petugas"] ?></td>
                                <td><?php echo $data["nama_barang"] ?></td>
                                <td><?php echo $data["nama_anggota"] ?></td>
                                <td>Sudah Dikembalikan</td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    <!-- Modal Edit -->
    <div class="modal fade" id="form-edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengembalian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="process/edit_pengembalian.php" method="post" id="form-edit">
                    <div class="modal-body" id="body-edit">
                        <div class="form-check form-check-inline mb-3 ml-2">
                            <input type="hidden" name="id" id="id_pengembalian">
                            <input type="hidden" name="tgl_peminjaman" id="tgl_peminjaman_edit">
                        </div>
                        Apakah anda yakin barang telah dikembalikan ?
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
        function edit(id_temp, tgl_peminjaman) {
            $("#id_pengembalian").attr("value", id_temp);
            $("#tgl_peminjaman_edit").attr("value", tgl_peminjaman);
        }
    </script>