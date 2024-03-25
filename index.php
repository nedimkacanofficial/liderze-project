<?php
session_start();
ob_start();
define("COMMON", "./common/");
define("CONTENT", "./content/");
define("DB", "./connection/");
include(DB . "/connect.php");
define("SITE_URL", $url);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $title ?></title>
  <meta http-equiv="keywords" name="keywords" content="<?php echo $seo_key ?>">
  <meta http-equiv="description" name="description" content="<?php echo $description ?>">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo SITE_URL ?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo SITE_URL ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITE_URL ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php
    include("./common/header.php");
    include("./common/aside.php");
    if (isset($_GET['page'])) {
      $page = $_GET['page'] . ".php";
      if (file_exists(CONTENT . $page)) {
        include(CONTENT . $page);
      } else {
        include("./content/dashboard.php");
      }
    } else {
      include("./content/dashboard.php");
    }
    ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <?php
    include("./common/footer.php");
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?php echo SITE_URL ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo SITE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo SITE_URL ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo SITE_URL ?>dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="<?php echo SITE_URL ?>dist/js/demo.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="<?php echo SITE_URL ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?php echo SITE_URL ?>plugins/raphael/raphael.min.js"></script>
  <script src="<?php echo SITE_URL ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?php echo SITE_URL ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo SITE_URL ?>plugins/chart.js/Chart.min.js"></script>

  <!-- PAGE SCRIPTS -->
  <script src="<?php echo SITE_URL ?>dist/js/pages/dashboard2.js"></script>
</body>

</html>