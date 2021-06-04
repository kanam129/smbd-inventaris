<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tgl Lahir</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            var usernames = [];
                        </script>
                        <?php

                        $select = mysqli_query($conn, "select * from petugas");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <script>
                                    usernames.push("<?php echo $data['username_petugas'] ?>");
                                </script>
                                <td><?php echo $data["id_petugas"] ?></td>
                                <td><?php echo $data["nama_petugas"] ?></td>
                                <td><?php echo $data["jenis_kelamin_petugas"] ?></td>
                                <td><?php echo $data["tgl_lahir_petugas"] ?></td>
                                <td><?php echo $data["no_tlp_petugas"] ?></td>
                                <td><?php echo $data["alamat_petugas"] ?></td>
                                <td><?php echo $data["username_petugas"] ?></td>
                                <td><?php echo $data["level_petugas"] ?></td>
                                <td><a href="#form-edit" data-toggle="modal" onclick="edit('<?php echo $data['id_petugas'] ?>')"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="#form-hapus" data-toggle="modal" onclick="hapus('<?php echo $data['id_petugas'] ?>', '<?php echo $data['username_petugas'] ?>')" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
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

    <a href="process/print_petugas.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    
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
                <form action="process/tambah_petugas.php" method="post">
                    <div class="modal-body" id="tambah">
                        <div class="form-group">
                          <label for="nama_petugas">Nama</label>
                          <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" aria-describedby="helpId" placeholder="Nama">
                        </div>
                        <div class="w-100 mb-2">
                            Jenis Kelamin
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <label class="form-check-label mr-3">
                                <input class="form-check-input" type="radio" name="jenis_kelamin_petugas" id="jenis_kelamin_petugas" value="L"> Laki-laki
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="jenis_kelamin_petugas" id="jenis_kelamin_petugas2" value="P"> Perempuan
                            </label>
                        </div>
                        <div class="form-group">
                          <label for="tgl_lahir_petugas">Tgl Lahir</label>
                          <input type="date"
                            class="form-control" name="tgl_lahir_petugas" id="tgl_lahir_petugas" aria-describedby="helpId" placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group">
                          <label for="no_tlp_petugas">No Tlp</label>
                          <input type="tel"
                            class="form-control" name="no_tlp_petugas" id="no_tlp_petugas" aria-describedby="helpId" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="alamat_petugas">Alamat</label>
                            <textarea class="form-control" name="alamat_petugas" id="alamat_petugas" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="username_petugas">Username</label>
                          <input type="text"
                            class="form-control" name="username_petugas" id="username_petugas" aria-describedby="usernameHelpText" placeholder="Username" required onblur="checkUsername(this)" autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label for="password_petugas">Password</label>
                          <input type="password" class="form-control" name="password_petugas" id="password_petugas">
                        </div>
                        <div class="form-group">
                          <label for="level_petugas">Level</label>
                          <select class="form-control" name="level_petugas" id="level_petugas">
                            <option selected disabled>--Pilih--</option>
                            <option>Admin</option>
                            <option>Super Admin</option>
                          </select>
                        </div>
                        
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
                <form action="process/edit_petugas.php" method="post" id="form-edit">
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
                <form action="process/hapus_petugas.php" method="post" id="form-hapus">
                    <div class="modal-body" id="body-edit">
                        <div class="form-check form-check-inline mb-3 ml-2">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="username" id="username">
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
            $("#body-edit").load("process/edit_petugas_ajax.php", {id:id_temp}, function (response, status, request) {
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

        function hapus(id, username) {  
            $("#id").attr("value", id);
            $("#username").attr("value", username);
        }
    </script>