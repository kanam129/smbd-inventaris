<!doctype html>
<html lang="en">
<head>
    <title>I-Lab - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="library/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/root.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="library/jquery.js"></script>
    <script src="library/popper.js" ></script>
    <script src="library/bootstrap/js/bootstrap.js"></script>
</head>
<body>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-12 my-auto mx-auto kontainer">
                <h2 class="text-center text-primary mb-3">Login</h2>
                <form action="process/login.php" method="post">
                    <input type="text" name="username_pengguna" class="form-control my-2" placeholder="Username" required>
                    <input type="password" name="password_pengguna" class="form-control my-2" placeholder="Password" required>
                    <input type="submit" value="Login" class="btn btn-outline-primary my-2 w-100">
                </form>
            </div>
        </div>
    </div>

</body>
</html>