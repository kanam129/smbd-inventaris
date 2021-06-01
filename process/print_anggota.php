<?php

include("../system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:../login.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>I-Lab</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../library/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="../library/fontawesome/css/all.css">

    <link rel="stylesheet" href="../css/page.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../library/jquery.js"></script>
    <script src="../library/popper.js" ></script>
    <script src="../library/bootstrap/js/bootstrap.js"></script>
</head>
<body>

    <div class="container my-2">
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
                            <th>Tgl Masuk</th>
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
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>
</html>