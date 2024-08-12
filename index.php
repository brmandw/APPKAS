<?php 
  require 'connection.php';
  checkLogin();
  $jml_pengeluaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(jumlah_pengeluaran) as jml_pengeluaran FROM pengeluaran"));
  $jml_pengeluaran = $jml_pengeluaran['jml_pengeluaran'];

  $jml_uang_kas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as jml_uang_kas FROM uang_kas"));
  $jml_uang_kas = $jml_uang_kas['jml_uang_kas'];

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>APPKAS - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">APPKAS</div>
      </a>
      
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <li class="nav-item active">
          <a class="nav-link">
          <i class = "fas fa-money-bill-wave"></i>
          <span>Saldo: <?= number_format($jml_uang_kas - $jml_pengeluaran); ?></span></a>
      </li>

    <li class="nav-item active">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item -  Siswa -->
    <li class="nav-item">
      <a class="nav-link" href="siswa.php">
        <i class="fas fa-fw fa-user"></i>
        <span>Siswa</span>
      </a>
    </li>

    <!-- Nav Item - Uang kas -->
    <li class="nav-item">
      <a class="nav-link" href="bulanuangkas.php">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>Uang Kas</span>
      </a>
    </li>

    <!-- Nav Item - Pengeluaran -->
    <li class="nav-item">
      <a class="nav-link" href="pengeluaran.php">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Pengeluaran</span>
      </a>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item">
      <a class="nav-link" href="laporan.php">
        <i class="fas fa-fw fa-file"></i>
        <span>Laporan</span>
      </a>
    </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Riwayat Uang Kas -->
    <li class="nav-item">
      <a class="nav-link" href="riwayatkas.php">
        <i class="fas fa-fw fa-stopwatch"></i>
        <span>Riwayat Uang Kas</span>
      </a>
    </li>

    <!-- Nav Item - Riwayat Pengeluaran -->
    <li class="nav-item">
            <a class="nav-link" href="riwayatpengeluaran.php">
              <i class="fas fa-fw fa-stopwatch"></i>
              <span>Riwayat pengeluaran</span>
            </a>
          </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

</ul>
<!-- End of Sidebar -->


      
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
         <!-- Topbar Navbar -->
         <ul class="navbar-nav ml-auto">


      <!-- Nav Item - User Information -->
      <li class="nav-item no-arrow">
        <a class="nav-link" href="profile.php" role="button" aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle" src="assets/img/img_properties/profile.png">
        </a>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - Logout -->
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="logout.php" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-sign-out-alt fa-fw"></i>
        </a>
      </li>


      </ul>

      </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
          </div>

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Welcome, <?php echo $_SESSION['username'] ?></h1>
            
          </div>

          <!-- Content Row -->
          <div class="row">

             <!-- Saldo Uang Kas Card -->
             <div class="col-xl-6 col-md-2 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-success font-weight-bold text-success text-uppercase mb-1">Saldo Uang Kas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($jml_uang_kas - $jml_pengeluaran); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pengeluaran Card Example -->
            <div class="col-xl-6 col-md-2 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-danger font-weight-bold text-success text-uppercase mb-1">Pengeluaran</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($jml_pengeluaran); ?> </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
