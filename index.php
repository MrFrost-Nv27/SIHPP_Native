<?php
session_start();
if ($_SESSION) {
    header("Location: user.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login System</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Log In</h1>
                                        <p class="text-capitalize ">Masukan Username dan Password dengan benar !</p>
                                    </div>
                                    <?php
                                    if (isset($_POST['login'])) {
                                        include("koneksi.php");

                                        $username    = $_POST['username'];
                                        $password    = md5($_POST['password']);
                                        $level        = $_POST['level'];

                                        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
                                        if (mysqli_num_rows($query) == 0) {
                                            echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
                                        } else {
                                            $row = mysqli_fetch_assoc($query);

                                            if ($row['level'] == 1 && $level == 1) {
                                                $_SESSION['username'] = $username;
                                                $_SESSION['level'] = 'gudang';
                                                $_SESSION['nama'] = $row['nama'];
                                                header("Location: admin/index.php?page=home");
                                            } else if ($row['level'] == 2 && $level == 2) {
                                                $_SESSION['username'] = $username;
                                                $_SESSION['level'] = 'akuntansi';
                                                $_SESSION['nama'] = $row['nama'];
                                                header("Location: admin/index.php?page=home");
                                            } else if ($row['level'] == 3 && $level == 3) {
                                                $_SESSION['username'] = $username;
                                                $_SESSION['level'] = 'manajer';
                                                $_SESSION['nama'] = $row['nama'];
                                                header("Location: admin/index.php?page=home");
                                            } else {
                                                echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
                                            }
                                        }
                                    }
                                    ?>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernamehelp" placeholder="Masukkan Username anda" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="level" id="level" required>
                                                <option value="">Pilih Level User</option>
                                                <option value="1">Gudang</option>
                                                <option value="2">Akuntansi</option>
                                                <option value="3">Manajer</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block" name="login">
                                            Login
                                        </button>
                                    </form>
                                    <p class="text-center mt-4 mb-0">
                                        Nais Rachmawati &copy; 2022
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>