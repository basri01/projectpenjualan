<?php
session_start();
include"../database/koneksi.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="images/B2.jpg">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
          <a href="#"><b>Login Admin</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Please Fill in a few Details Below!</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
              <input class="form-control" autofocus required type="text" name="user" placeholder="Username">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <input class="form-control" type="password"  autofocus required name="pass" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             </div>

            <div class="form-group">
            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-3">
              <input class="btn btn-primary" type="submit" name="login" value="Login" />
              <a href="../index.php" class="btn btn-danger btn-md" > Cancel</a>
            </div>
          </div>
        </form><br><br>

      </div><!-- /.login-box-body -->
     
    </div><!-- /.login-box -->

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
  </body>
</html>

<?php
error_reporting(0);
session_start();
if(@$_POST["login"]){ 
  $user = $_POST["user"];
  $pass = md5($_POST["pass"]);
  
  if($user!="" && $pass!=""){
    $em = mysqli_query($koneksi, "select * from tbl_user where password = '$pass' AND username = '$user'");
    $data = mysqli_fetch_assoc($em);
    
    if($data["username"] == $user && $data["password"] == $pass){                                                    
      $_SESSION["user"]   = $data["username"];
      $_SESSION["pass"]   = $data["password"];
      $_SESSION["nama"]   = $data["nama"];
      $_SESSION["status"] = $data["status"];
      
      echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Anda Berhasil Login!',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='../index2.php?module=home';
      }
    })
      </script>";
    
  } else {
    echo '<script language="javascript">
      swal(
          "Oops...",
          "Username dan Password salah!",
          "error"
        )          
    </script>';
  }
}
 }
?>