<?php 
  require 'connection.php';
  checkLogin();
  $riwayat = mysqli_query($conn, "SELECT * FROM riwayat INNER JOIN user ON riwayat.id_user = user.id_user INNER JOIN uang_kas ON riwayat.id_uang_kas = uang_kas.id_uang_kas INNER JOIN siswa ON uang_kas.id_siswa = siswa.id_siswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran ORDER BY tanggal DESC");

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

  <title>APPKAS - Riwayat Uang Kas</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

 <!-- Page Wrapper -->
 <div id="wrapper">
 

      <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">APPKAS</div>
        </a>
      
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
          <a class="nav-link">
            <i class = "fas fa-money-bill-wave"></i>
            <span>Saldo: <?= number_format($jml_uang_kas - $jml_pengeluaran); ?></span></a>
        </li>


        <!-- Nav Item - Dashboard -->
      <li class="nav-item">
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
      <li class="nav-item active">
        <a class="nav-link" href="riwayatkas.php">
          <i class="fas fa-fw fa-stopwatch"></i>
          <span>Riwayat Uang Kas</span>
        </a>
      </li>

      <!-- Nav Item - Riwayat Pengeluaran -->
      <li class="nav-item">
        <a class="nav-link" href="riwayatpengeluaran.php">
          <i class="fas fa-fw fa-stopwatch"></i>
          <span>Riwayat Pengeluaran</span>
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

           <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Riwayat Pengeluaran Uang Kas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        </div><!-- /.row -->
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="table_id">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Siswa</th>
                <th>Nama Bulan & Tahun</th>
                <th>Username</th>
                <th>Pesan</th>
                <th>Tanggal</th>
              </tr>
              </thead>
             
              <tbody>
              <?php $i = 1; ?>
              <?php foreach ($riwayat as $dr): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= ucwords($dr['nama_siswa']); ?></td>
                  <td><?= ucwords($dr['nama_bulan']); ?> | <?= $dr['tahun']; ?></td>
                  <td><?= $dr['username']; ?></td>
                  <td><?= $dr['aksi']; ?></td>
                  <td><?= date('d-m-Y, H:i:s', $dr['tanggal']); ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>