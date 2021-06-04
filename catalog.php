<div class="container mt-lg-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-inverse w-100 text-center">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nama Trigger</th>
                            <th>Query</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $select = mysqli_query($conn, "select trigger_schema, trigger_name, action_statement from information_schema.triggers WHERE trigger_schema = 'projek_smbd_inventaris'");
                        while($data = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <td><?php echo $data["trigger_name"] ?></td>
                                <td class="w-50"><?php echo $data["action_statement"] ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="process/print_barang.php" class="btn btn-secondary rounded-circle tombol-cetak"><i class="fas fa-print"></i></a>

    