<?php

include("system/connection.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}

if(!isset($_GET["page"])){
    header("location:index.php?page=barang");
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
    <link rel="stylesheet" href="library/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="library/fontawesome/css/all.css">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/page.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="library/jquery.js"></script>
    <script src="library/popper.js" ></script>
    <script src="library/bootstrap/js/bootstrap.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand font-weight-bold" href="index.php"><i class="fas fa-box-open    "></i> Inventaris Lab</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item <?php if($_GET['page']=='barang'){echo 'active';} ?>">
                    <a class="nav-link <?php if($_GET['page']=='barang'){echo 'nav-active';} ?>" href="index.php?page=barang">Barang <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if($_GET['page']=='peminjaman'){echo 'active';} ?>">
                    <a class="nav-link <?php if($_GET['page']=='peminjaman'){echo 'nav-active';} ?>" href="index.php?page=peminjaman">Peminjaman</a>
                </li>
                <li class="nav-item <?php if($_GET['page']=='pengembalian'){echo 'active';} ?>">
                    <a class="nav-link <?php if($_GET['page']=='pengembalian'){echo 'nav-active';} ?>" href="index.php?page=pengembalian">Pengembalian</a>
                </li>
                
                <?php 
                    if($_SESSION["level_petugas"] == "Super Admin"){
                        ?>
                        <li class="nav-item <?php if($_GET['page']=='pengguna'){echo 'active';} ?>">
                            <a class="nav-link <?php if($_GET['page']=='pengguna'){echo 'nav-active';} ?>" href="index.php?page=pengguna">Pengguna</a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
            <a class="btn btn-light" href="#modal-user" data-toggle="modal" role="button"><i class="fas fa-user mr-1"></i> <?php echo $_SESSION["user"] ?></a>
        </div>
    </nav>

    <?php
    include($_GET["page"].".php");
    ?>
    
    <!-- Modal -->
    <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body text-center">
                    <div class="h1"><i class="fas fa-user    "></i></div>
                    <div>
                        Username : <?php echo $_SESSION["user"] ?><br>
                        Nama : <?php echo $_SESSION["nama_petugas"] ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger w-100" href="process/logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>