<?php 
  require 'connection.php';
 
  $bulan_pembayaran = mysqli_query($conn, "SELECT * FROM bulan_pembayaran ORDER BY tahun ASC");
  if (isset($_POST['btnAddBulanPembayaran'])) {
    if (addBulanPembayaran($_POST) > 0) {
      setAlert("Bulan Pembayaran has been added", "Successfully added", "success");
      header("Location: bulanuangkas.php");
    }
  }

  if (isset($_POST['btnEditBulanPembayaran'])) {
    if (editBulanPembayaran($_POST) > 0) {
      setAlert("Bulan Pembayaran has been changed", "Successfully changed", "success");
      header("Location: bulanuangkas.php");
    }
  }

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

  <title>APPKAS - Bulan Pembayaran</title>

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
      <li class="nav-item active">
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Bulan Pembayaran</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBulanPembayaranModal"><i class="fas fa-fw fa-plus"></i> Tambah Bulan</button>
            </div>

            <!-- Modal -->
            <div class="modal fade text-left" id="tambahBulanPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="tambahBulanPembayaranModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="tambahBulanPembayaranModalLabel">Tambah Bulan Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-lg">
                            <div class="form-group">
                              <label for="nama_bulan">Nama Bulan</label>
                              <select name="nama_bulan" id="nama_bulan" class="form-control">
                                <option value="januari">Januari</option>
                                <option value="februari">Februari</option>
                                <option value="maret">Maret</option>
                                <option value="april">April</option>
                                <option value="mei">Mei</option>
                                <option value="juni">Juni</option>
                                <option value="juli">Juli</option>
                                <option value="agustus">Agustus</option>
                                <option value="september">September</option>
                                <option value="november">November</option>
                                <option value="desember">Desember</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg">
                            <div class="form-group">
                              <label for="tahun">Tahun</label>
                              <input type="number" required name="tahun" value="<?= date('Y'); ?>" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pembayaran_perminggu">Pembayaran Perminggu</label>
                          <input type="number" name="pembayaran_perminggu" id="pembayaran_perminggu" required class="form-control" placeholder="Rp.">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                        <button type="submit" name="btnAddBulanPembayaran" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg text-left">
            <h5>Pilih Bulan Pembayaran</h5>
          </div>
        </div>
        <div class="row">
          <?php foreach ($bulan_pembayaran as $dbp): ?>
            <?php 
              $id_bulan_pembayaran = $dbp['id_bulan_pembayaran'];
              $total_uang_kas_bulan_ini = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_uang_kas_bulan_ini FROM uang_kas WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'"));
              $total_uang_kas_bulan_ini = $total_uang_kas_bulan_ini['total_uang_kas_bulan_ini'];
            ?>
            <div class="col-lg-3">
              <div class="card shadow">
                <div class="card-body">
                  <h5><a href="detailuangkas.php?id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>" class="text-dark"><?= ucwords($dbp['nama_bulan']); ?></a></h5>
                  <h6 class="text-muted"><?= $dbp['tahun']; ?></h6>
                  <h6>Rp. <?= number_format($dbp['pembayaran_perminggu']); ?> / minggu</h6>
                  <h6>Total Uang Kas Bulan Ini: <span class="my-2 btn btn-success">Rp. <?= number_format($total_uang_kas_bulan_ini); ?></span></h6>
                  <a href="detailuangkas.php?id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
                  <!-- <button type="button" data-toggle="modal" data-target="#editBulanPembayaranModal<?= $dbp['id_bulan_pembayaran']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i></button> -->
                  <!-- Modal -->
                  <div class="modal fade" id="editBulanPembayaranModal<?= $dbp['id_bulan_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editBulanPembayaranModalLabel<?= $dbp['id_bulan_pembayaran']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post">
                        <input type="hidden" name="id_bulan_pembayaran" value="<?= $dbp['id_bulan_pembayaran']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editBulanPembayaranModalLabel<?= $dbp['id_bulan_pembayaran']; ?>">Ubah Bulan Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg">
                                <div class="form-group">
                                  <label for="nama_bulan<?= $dbp['id_bulan_pembayaran']; ?>">Nama Bulan</label>
                                  <input type="hidden" name="nama_bulan" value="<?= $dbp['nama_bulan']; ?>">
                                  <input style="cursor: not-allowed;" disabled type="text" class="form-control" id="nama_bulan<?= $dbp['id_bulan_pembayaran']; ?>" value="<?= $dbp['nama_bulan']; ?>">
                                </div>
                              </div>
                              <div class="col-lg">
                                <div class="form-group">
                                  <label for="tahun<?= $dbp['id_bulan_pembayaran']; ?>">Tahun</label>
                                  <input type="hidden" name="tahun" value="<?= $dbp['tahun']; ?>">
                                  <input style="cursor: not-allowed;" disabled type="number" id="tahun<?= $dbp['id_bulan_pembayaran']; ?>" value="<?= $dbp['tahun']; ?>" class="form-control">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="pembayaran_perminggu<?= $dbp['id_bulan_pembayaran']; ?>">Pembayaran Perminggu</label>
                              <input type="number" name="pembayaran_perminggu" id="pembayaran_perminggu<?= $dbp['id_bulan_pembayaran']; ?>" required class="form-control" placeholder="Rp." value="<?= $dbp['pembayaran_perminggu']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                            <button type="submit" name="btnEditBulanPembayaran" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                          </div>
                        </div>
                      </form>
                    </div> 
                  </div>
                 
                    <a href="hapus_bulan_pembayaran.php?id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>" class="btn btn-danger btn-delete" data-nama="<?= ucwords($dbp['nama_bulan']); ?> | <?= $dbp['tahun']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                 
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>

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
