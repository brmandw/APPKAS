<?php 

require 'connection.php';
$siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");

if (isset($_POST['btnEditSiswa'])) {
    if (editSiswa($_POST) > 0) {
        setAlert("Siswa has been changed", "Successfully changed", "success");
        header("Location: siswa.php");
        exit();
    }
}

if (isset($_POST['btnTambahSiswa'])) {
    if (addSiswa($_POST) > 0) {
        setAlert("Siswa has been added", "Successfully added", "success");
        header("Location: siswa.php");
        exit();
    }
}

if (isset($_GET['toggle_modal'])) {
    $toggle_modal = $_GET['toggle_modal'];
    echo "
    <script>
        $(document).ready(function() {
            $('#$toggle_modal').modal('show');
        });
    </script>
    ";
}

$jml_pengeluaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(jumlah_pengeluaran) as jml_pengeluaran FROM pengeluaran"));
$jml_pengeluaran = $jml_pengeluaran['jml_pengeluaran'];

$jml_uang_kas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as jml_uang_kas FROM uang_kas"));
$jml_uang_kas = $jml_uang_kas['jml_uang_kas'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... other meta and link tags ... -->
    <title>APPKAS - Data Siswa</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      
         <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i
             class="fas fa-laugh-wink"></i>
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
        <li class="nav-item active">
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
                    <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Daftar Data Siswa</h1>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal">
                            <i class="fas fa-fw fa-plus"></i> Tambah Siswa
                        </button>
                    </div>
                    <?php endif ?>

                    <!-- Modal Tambah Siswa -->
                    <div class="modal fade text-left" id="tambahSiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_siswa">Nama Siswa</label>
                                            <input type="text" id="nama_siswa" name="nama_siswa" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label><br>
                                            <input type="radio" id="pria" name="jenis_kelamin" value="pria"> <label for="pria">Pria</label> |
                                            <input type="radio" id="wanita" name="jenis_kelamin" value="wanita"> <label for="wanita">Wanita</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">No. Telepon</label>
                                            <input type="number" name="no_telepon" id="no_telepon" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                        <button type="submit" class="btn btn-primary" name="btnTambahSiswa"><i class="fas fa-fw fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Modal Tambah Siswa -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No.Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswa as $ds): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= ucwords(htmlspecialchars_decode($ds['nama_siswa'])); ?></td>
                                                <td><?= ucwords($ds['jenis_kelamin']); ?></td>
                                                <td><?= $ds['no_telepon']; ?></td>
                                                <td><?= $ds['email']; ?></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="ubah_siswa.php?id_siswa=<?= $ds['id_siswa']; ?>" class="badge badge-success" data-toggle="modal" data-target="#editSiswa<?= $ds['id_siswa']; ?>">
                                                        <i class="fas fa-fw fa-edit"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editSiswa<?= $ds['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSiswa<?= $ds['id_siswa']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="post">
                                                                <input type="hidden" name="id_siswa" value="<?= $ds['id_siswa']; ?>">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editSiswaModalLabel<?= $ds['id_siswa']; ?>">Ubah Siswa</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nama_siswa<?= $ds['id_siswa']; ?>">Nama Siswa</label>
                                                                            <input type="text" id="nama_siswa<?= $ds['id_siswa']; ?>" value="<?= $ds['nama_siswa']; ?>" name="nama_siswa" class="form-control" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jenis Kelamin</label><br>
                                                                            <?php if ($ds['jenis_kelamin'] == 'pria'): ?>
                                                                                <input type="radio" id="pria<?= $ds['id_siswa']; ?>" name="jenis_kelamin" value="pria" checked="checked"> <label for="pria<?= $ds['id_siswa']; ?>">Pria</label> |
                                                                                <input type="radio" id="wanita<?= $ds['id_siswa']; ?>" name="jenis_kelamin" value="wanita"> <label for="wanita<?= $ds['id_siswa']; ?>">Wanita</label>
                                                                            <?php else: ?>
                                                                                <input type="radio" id="pria<?= $ds['id_siswa']; ?>" name="jenis_kelamin" value="pria"> <label for="pria<?= $ds['id_siswa']; ?>">Pria</label> |
                                                                                <input type="radio" id="wanita<?= $ds['id_siswa']; ?>" name="jenis_kelamin" value="wanita" checked="checked"> <label for="wanita<?= $ds['id_siswa']; ?>">Wanita</label>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="no_telepon<?= $ds['id_siswa']; ?>">No. Telepon</label>
                                                                            <input type="number" name="no_telepon" id="no_telepon<?= $ds['id_siswa']; ?>" value="<?= $ds['no_telepon']; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email<?= $ds['id_siswa']; ?>">Email</label>
                                                                            <input type="email" name="email" id="email<?= $ds['id_siswa']; ?>" value="<?= $ds['email']; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="btnEditSiswa"><i class="fas fa-fw fa-save"></i> Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                                                        <a data-nama="<?= $ds['nama_siswa']; ?>" class="btn-delete badge badge-danger" href="hapus_siswa.php?id_siswa=<?= $ds['id_siswa']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End DataTales Example -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- ... Footer code ... -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- ... Logout Modal code ... -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
