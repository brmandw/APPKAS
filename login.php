<?php 
  require 'connection.php';
  checkLoginAtLogin();

  if (isset($_POST['btnLogin'])) {
  	$username = htmlspecialchars($_POST['username']);
  	$password = htmlspecialchars($_POST['password']);

  	$checkUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  	if ($data = mysqli_fetch_assoc($checkUsername)) {
  		if (password_verify($password, $data['password'])) {
  			$_SESSION = [
  				'id_user' => $data['id_user'],
  				'username' => $data['username'],
          'id_jabatan' => $data['id_jabatan']
  			];
  			header("Location: index.php");
  		} else {
			setAlert("Password your insert is false!", "Check your Password BACK!", "error");
			header("Location: login.php");
	  	}
  	} else {
		setAlert("Username is not registered!", "Check your Username BACK!", "error");
		header("Location: login.php");
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

  <title>APPKAS - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5 mx-5 py-4 px-5">
          <div class="card-body p-50">
            <!-- Nested Row within Card Body -->
           
            
              <div class="col-lg-15">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to APPKAS, Login First!</h1>
                  </div>
                  <form method="post">
                    <div class="form-group">
                    <input required class="form-control rounded-pill" type="text" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                    <input required class="form-control rounded-pill" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    
                    <button class="btn btn-primary btn-user btn-block"type="submit" name="btnLogin"><i class="fas fa-fw fa-sign-in-alt"></i> 
                    Login
                    </button>
                    
                    <hr>
                  
                  </form>
                  <hr>
                </div>
              </div>
           
          </div>
        </div>

      </div>

    </div>

  </div>


</body>

</html>
