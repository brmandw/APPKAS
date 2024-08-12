<?php 
  require 'connection.php';

  $pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran INNER JOIN user ON pengeluaran.id_user = user.id_user");

  if (isset($_POST['btnAddPengeluaran'])) {
    if (addPengeluaran($_POST) > 0) {
      setAlert("Pengeluaran has been added", "Successfully added", "success");
      header("Location: pengeluaran.php");
    }
  }

  if (isset($_POST['btnEditPengeluaran'])) {
    if (editPengeluaran($_POST) > 0) {
      setAlert("Pengeluaran has been changed", "Successfully changed", "success");
      header("Location: pengeluaran.php");
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

  <title>APPKAS - Data Siswa</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

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
      <li class="nav-item">
        <a class="nav-link" href="bulanuangkas.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Uang Kas</span>
        </a>
      </li>

      <!-- Nav Item - Pengeluaran -->
      <li class="nav-item active">
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
          <a class="nav-link" href="login.php" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sign-out-alt fa-fw"></i>
          </a>
        </li>


      </ul>

      </nav>
        <!-- End of Topbar -->

        
    
      <div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Pengeluaran</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPengeluaranModal">
              <i class="fas fa-fw fa-plus"></i>Tambah Pengeluaran
            </button>
        </div>
     
             
              <!-- Modal -->
              <div class="modal fade text-left" id="tambahPengeluaranModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengeluaranModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="tambahPengeluaranModalLabel">Tambah Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                          <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaran" required class="form-control" placeholder="Rp.">
                        </div>
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <textarea name="keterangan" id="keterangan" required class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                        <button type="submit" name="btnAddPengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
           
          
       
     

    <!-- Main content -->
      <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Keterangan</th>
                      <th>Tanggal Pengeluaran</th>
                      <th>Jumlah Pengeluaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($pengeluaran as $dp): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $dp['username']; ?></td>
                      <td><?= $dp['keterangan']; ?></td>
                      <td><?= date("d-m-Y, H:i:s", $dp['tanggal_pengeluaran']); ?></td>
                      <td>Rp. <?= number_format($dp['jumlah_pengeluaran']); ?></td>
                      <td>
                          <a href="" class="badge badge-success" data-toggle="modal" data-target="#editPengeluaranModal<?= $dp['id_pengeluaran']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                          <div class="modal fade text-left" id="editPengeluaranModal<?= $dp['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPengeluaranModalLabel<?= $dp['id_pengeluaran']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post">
                                <input type="hidden" name="id_pengeluaran" value="<?= $dp['id_pengeluaran']; ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editPengeluaranModalLabel<?= $dp['id_pengeluaran']; ?>">Ubah Pengeluaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="jumlah_pengeluaran<?= $dp['id_pengeluaran']; ?>">Jumlah Pengeluaran</label>
                                      <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaran<?= $dp['id_pengeluaran']; ?>" required class="form-control" placeholder="Rp." value="<?= $dp['jumlah_pengeluaran']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="keterangan<?= $dp['id_pengeluaran']; ?>">Keterangan</label>
                                      <textarea name="keterangan" id="keterangan<?= $dp['id_pengeluaran']; ?>" required class="form-control"><?= $dp['keterangan']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                    <button type="submit" name="btnEditPengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                            <a href="hapus_pengeluaran.php?id_pengeluaran=<?= $dp['id_pengeluaran']; ?>" class="badge badge-danger btn-delete" data-nama="Pengeluaran : Rp. <?= number_format($dp['jumlah_pengeluaran']); ?> | <?= $dp['keterangan']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                            <?php endif ?>
                        </td>
                    
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
             
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