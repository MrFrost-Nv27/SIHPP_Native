<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if (empty($_SESSION)) {
    header("Location: ../index.php");
}
extract($_POST);
include 'koneksi.php';
$username                                 = $_SESSION['username'];
$login                                    = mysqli_query($koneksi, "SELECT * FROM users where username='$username'");
while ($r_log = mysqli_fetch_assoc($login)) {
    $nm_log                                  = $r_log['nama'];
    $lv                                      = $r_log['level'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SI HPP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap-date/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!--jquery-->
    <script src="bootstrap-date/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="dist/css/summernote.css">
    <script src="dist/js/summernote.js"></script>
    <script>
    $(document).ready(function() {
        $("#treeview").click(function() {
            $("#treeview").toggleClass("active");
        })
        $("#treeview1").click(function() {
            $("#treeview1").toggleClass("active");
        })
        $("#treeview2").click(function() {
            $("#treeview2").toggleClass("active");
        })
    });
    </script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="index.php?page=home" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><small>SIHPP</small></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Sistem Informasi HPP</span>
            </a>

            <!-- Header Navbar        : style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="glyphicon glyphicon-menu-hamburger"></span>
                </a>
                <a href="../logout.php" class="navbar-text navbar-right" style="color: white; margin-right: 15px"><span
                        class="glyphicon glyphicon-off"></span> Logout</a>
            </nav>

        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content" style="position:fixed auto; height:502px;">
                <?php
                include 'page.php';
                ?>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <?php
        if ($lv == 1) {
            include 'menu_1.php';
        } else if ($lv == 2) {
            include 'menu_2.php';
        } else if ($lv == 3) {
            include 'menu_3.php';
        } else if ($lv == 4) {
            include 'menu_4.php';
        }
        ?>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.0
            </div>
            <strong>Copyright &copy; 2022.</strong> All rights reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.konten').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ],

            onPaste: function(e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                    .getData('Text');
                e.preventDefault();
                setTimeout(function() {
                    document.execCommand('insertText', false, bufferText);
                }, 10);
            }



        });


    });
    </script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
    $(function() {
        $("#example1").DataTable({
            "order": [
                [<?php echo $order; ?>, "desc"]
            ]
        });
    });
    </script>
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <!--<script src                   = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

</body>

</html>