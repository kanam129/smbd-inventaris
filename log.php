<div class="container mt-lg-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID Log</th>
                            <th>Tipe Log</th>
                            <th>Nama Tabel</th>
                            <th>ID Tabel</th>
                            <th>Waktu Log</th>
                            <th>User Petugas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $select = mysqli_query($conn, "select * from log");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["id_log"] ?></td>
                                <td><?php echo $data["tipe_log"] ?></td>
                                <td><?php echo $data["nama_tabel"] ?></td>
                                <td><?php echo $data["id_tabel"] ?></td>
                                <td><?php echo $data["waktu_log"] ?></td>
                                <td><?php echo $data["user_petugas"] ?></td>
                                
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="process/print_log.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    
    