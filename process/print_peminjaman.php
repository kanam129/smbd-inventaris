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
                            <th>ID</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Nama Peminjam</th>
                            <th>No Tlp</th>
                            <th>Alamat</th>
                            <th>Barang</th>
                            <th>Banyak Barang</th>
                            <th>Yang Melayani</th>
                            <th colspan="2">AKSI</th>
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