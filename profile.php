<?php 
  require 'connection.php';
  $dataUser = dataUser();
  $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");

  if (isset($_POST['btnEditProfile'])) {
  	if (editUser($_POST) > 0) {
  		setAlert("Your Profile has been changed", "Successfully changed", "success");
		header("Location: profile.php");
  	} 
  }

  if (isset($_POST['btnChangePassword'])) {
  	if (changePassword($_POST) > 0) {
  		setAlert("Your Password has been changed", "Successfully changed", "success");
		header("Location: profile.php");
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
            <i class="fas fa-laugh-wink"></i>
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

        <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Profile</h1>
          </div>
            

         <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
        <div class="card">
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item">Nama Lengkap: <?= $dataUser['nama_lengkap']; ?></li>
		    <li class="list-group-item">Username: <?= $dataUser['username']; ?></li>
		    <li class="list-group-item">Jabatan: <?= $dataUser['nama_jabatan']; ?></li>
		  </ul>
		</div>
		</div>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editProfileModal">
		  <i class="fas fa-fw fa-edit"></i> Edit
		</button>
		
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#changePasswordModal">
		  <i class="fas fa-fw fa-lock"></i> Change Password
		</button>
	
		<!-- Modal -->
		<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form method="post">
                <input type="hidden" name="id_user" value="<?= $dataUser['id_user']; ?>">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="nama_lengkap">Nama Lengkap</label>
			        	<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required value="<?= $dataUser['nama_lengkap']; ?>">
			        </div>
			        <div class="form-group">
			        	<label for="username">Username</label>
	        			<input type="hidden" name="username" id="username" value="<?= $dataUser['username']; ?>">
			        	<input style="cursor: not-allowed;" disabled type="text" name="username" id="username" class="form-control" required value="<?= $dataUser['username']; ?>">
			        </div>
			        <div class="form-group">
			        	<label for="id_jabatan">Jabatan</label>
	        			<input type="hidden" name="id_jabatan" id="id_jabatan" value="<?= $dataUser['id_jabatan']; ?>">
			        	<input style="cursor: not-allowed;" disabled type="text" class="form-control" required value="<?= $dataUser['nama_jabatan']; ?>">
		     		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
			        <button type="submit" name="btnEditProfile" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
			      </div>
			    </div>
		    </form>
		  </div>
		</div>
		<!-- Modal change password -->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form method="post">
                <input type="hidden" name="id_user" value="<?= $dataUser['id_user']; ?>">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" minlength="6" name="old_password" id="old_password" class="form-control" required>
                    </div>
					<div class="form-group">
                        <label for="new_password">Password</label>
                        <input type="password" minlength="6" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_verify">Password Verify</label>
                        <input type="password" minlength="6" name="new_password_verify" id="new_password_verify" class="form-control" required>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
			        <button type="submit" name="btnChangePassword" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
			      </div>
			    </div>
		    </form>
		  </div>
		</div>
      </div>
</section>
    <!-- /.content -->

      </div>
        <!-- /.container-fluid -->

  </div>
      <!-- End of wrapper -->

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


  </div>

  
</body>

</html>