<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Username</th>
                            <th>Hak Akses</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            var usernames = [];
                        </script>
                        <?php

                        $select = mysqli_query($conn, "select * from pengguna");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <script>
                                    usernames.push("<?php echo $data['username_pengguna'] ?>");
                                </script>
                                <td><?php echo $data["username_pengguna"] ?></td>
                                <td><?php echo $data["hak_akses_pengguna"] ?></td>
                                <td><?php echo $data["nama_pengguna"] ?></td>
                                <td><?php echo $data["no_tlp_pengguna"] ?></td>
                                <td><?php echo $data["alamat_pengguna"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit('<?php echo $data['username_pengguna'] ?>')"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="#form-hapus" data-toggle="modal" onclick="hapus('<?php echo $data['username_pengguna'] ?>')" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
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

    <a href="process/print_pengguna.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    
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
                <form action="process/tambah_pengguna.php" method="post">
                    <div class="modal-body" id="tambah">
                        <input type="text" id="username_pengguna" name="username_pengguna" class="form-control mb-3" placeholder="Username" required onblur="checkUsername(this)" autocomplete="off">
                        <input type="text" id="password_pengguna" name="password_pengguna" class="form-control mb-3" placeholder="Password" required>
                        <select id="hak_akses_pengguna" name="hak_akses_pengguna" class="form-control mb-3" required>
                            <option value="" disabled selected>Pilih</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                        <input type="text" id="nama_pengguna" name="nama_pengguna" class="form-control mb-3" placeholder="Nama" required>
                        <input type="telp" id="no_tlp_pengguna" name="no_tlp_pengguna" class="form-control mb-3" placeholder="No Telp" required>
                        <input type="text" id="alamat_pengguna" name="alamat_pengguna" class="form-control mb-3" placeholder="Alamat" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Tambah" id="tambah_data" class="btn btn-primary">
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
                <form action="process/edit_pengguna.php" method="post" id="form-edit">
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
                <form action="process/hapus_pengguna.php" method="post" id="form-hapus">
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
            $("#body-edit").load("process/edit_pengguna_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
        }

        
        function checkUsername(inputText) {  
            for(var x=0; x<usernames.length; x++){
                if(usernames[x] == inputText.value){
                    inputText.setCustomValidity("Username telah dipakai, gunakan username lain!");
                    inputText.checkValidity();
                    inputText.reportValidity();
                    break;
                }else{
                    inputText.setCustomValidity("");
                }
            }
        }

        function hapus(id) {  
            $("#id").attr("value", id);
        }
    </script>