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

    <script>
        window.print();
    </script>

</body>
</html>