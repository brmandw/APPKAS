<?php 
  require 'connection.php';
  checkLogin();
  $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
  if (isset($_POST['btnEditJabatan'])) {
    if (editJabatan($_POST) > 0) {
      setAlert("Jabatan has been changed", "Successfully changed", "success");
      header("Location: jabatan.php");
    }
  }

  if (isset($_POST['btnTambahJabatan'])) {
    if (addJabatan($_POST) > 0) {
      setAlert("Jabatan has been added", "Successfully added", "success");
      header("Location: jabatan.php");
    }
  }
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
            <i
             class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">APPKAS</div>
        </a>
      
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        

        <!-- Nav Item - Dashboard -->

      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <?php if ($_SESSION['id_jabatan'] == '1'): ?>
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>User</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="jabatan.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Jabatan</span></a>
      </li>
      <?php endif ?>
     

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
              <a class="nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false">
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
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-center mb-2">
          <div class="col-sm text-left">
            <h1 class="m-0 text-dark">Jabatan</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahJabatanModal"><i class="fas fa-fw fa-plus"></i> Tambah Jabatan</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="tambahJabatanModal" tabindex="-1" role="dialog" aria-labelledby="tambahJabatanModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahJabatanModalLabel">Tambah Jabatan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                      <button type="submit" class="btn btn-primary" name="btnTambahJabatan"><i class="fas fa-fw fa-save"></i> Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-striped table-hover table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($jabatan as $dj): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $dj['nama_jabatan']; ?></td>
                      <td>
                        <?php if ($dj['id_jabatan'] !== '1'): ?>
                          <!-- Button trigger modal -->
                          <a href="ubah_jabatan.php?id_jabatan=<?= $dj['id_jabatan']; ?>" class="badge badge-success" data-toggle="modal" data-target="#editJabatanModal<?= $dj['id_jabatan']; ?>">
                            <i class="fas fa-fw fa-edit"></i> Ubah
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="editJabatanModal<?= $dj['id_jabatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="editJabatanModalLabel<?= $dj['id_jabatan']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post">
                                <input type="hidden" name="id_jabatan" value="<?= $dj['id_jabatan']; ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editJabatanModalLabel<?= $dj['id_jabatan']; ?>">Ubah Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_jabatan<?= $dj['id_jabatan']; ?>">Nama Jabatan</label>
                                      <input type="text" name="nama_jabatan" id="nama_jabatan<?= $dj['id_jabatan']; ?>" class="form-control" value="<?= $dj['nama_jabatan']; ?>">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                    <button type="submit" name="btnEditJabatan" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <a data-nama="<?= $dj['nama_jabatan']; ?>" class="btn-delete badge badge-danger" href="hapus_jabatan.php?id_jabatan=<?= $dj['id_jabatan']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
    </section>
    <!-- /.content -->
        </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  </div>

  
</body>

</html>