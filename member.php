<?php
session_start();
include"database/koneksi.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Member</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="images/B2.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Sweet Alert -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
</head>

<?php
 $sql=mysqli_query($koneksi, "select * from tbl_member order by kode_member DESC LIMIT 0,1");
 $data=mysqli_fetch_array($sql);
 $kodeawal=substr($data['kode_member'],3,4)+1;
 if($kodeawal<10){
  $kode='M000'.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode='M000'.$kodeawal;
 }else{
  $kode='M00'.$kodeawal;
 }
?>

<body class="hold-transition register-page">
  <div class="row">
        <div class="col-md-6 col-md-offset-3">
  <div class="register-logo"><br>
    <a href="#"><b>Register a New Member</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Please Fill in a few Details Below!</p>

    <div class="box-body">
          <div class="row">
            <form method="post" enctype="multipart/form-data">
            <div class="col-md-6">
               <!-- /.form-group -->
              <div class="form-group">
                <label >Kode Member</label>
                <input type="text" class="form-control" required placeholder="Kode Permohonan" name="kode" value='<?php echo $kode ?>' readonly>
              </div>

              <div class="form-group">
                <label >No. KTP</label>
                <input type="text" class="form-control" required placeholder="No KTP" name="ktp" maxlength="16" onkeypress="return isNumberKey(event)">
              </div>

              <div class="form-group">
                <label >Nama Lengkap</label>
                <input type="text" class="form-control" required placeholder="Nama Lengkap" name="nama" >
              </div>

              <div class="form-group">
                <label>Jenis Kelamin</label>
                  <select class="form-control select1" name="jenis">
                    <option></option>
                    <option value='Pria'>Pria</option>
                    <option value='Wanita'>Wanita</option>
                  </select>
              </div>

              <div class="form-group">
                <label >Alamat Lengkap</label>
                <input type="text" class="form-control" required placeholder="Alamat" name="alamat" >
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label >No. HP</label>
                <input type="text" class="form-control" required placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)">
              </div>

              <div class="form-group">
                <label >Kode Pos</label>
                <input type="text" class="form-control" required placeholder="Kode Pos" name="kode_pos" >
              </div>

              <div class="form-group">
                <label >Username</label>
                <input type="text" class="form-control" required placeholder="Username" name="username" >
              </div>

              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" required placeholder="Password" name="password" >
              </div>
              <!-- /.form-group -->
            </div><br>

      <div class="row">
        <!-- /.col -->
        <div class="form-group">
            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-5">
              <input class="btn btn-danger" type="submit" name="OK" value="Register" />
            </div>
          </div>
        <!-- /.col -->
      </div>
    </form><br>
    <a href="login.php" class="text-center">I Already have a Membership!</a>
  </div>
  </div></div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

<?php 
include "fungsi.php";
?>
  </body>
</html>

<?php
IF (Isset($_POST['OK']))  {

  $query1 = mysqli_query ($koneksi,"SELECT * FROM tbl_member");
  $hasil  = mysqli_fetch_array ($query1);

  $kode            = addslashes (strip_tags ($_POST['kode']));
  $ktp             = addslashes (strip_tags ($_POST['ktp']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  $jenis           = addslashes (strip_tags ($_POST['jenis']));
  $alamat          = addslashes (strip_tags ($_POST['alamat']));
  $username        = addslashes (strip_tags ($_POST['username']));
  $password        = md5($_POST['password']);
  $tlp             = addslashes (strip_tags ($_POST['tlp']));
  $kode_pos        = addslashes (strip_tags ($_POST['kode_pos']));

  if($ktp==$hasil['no_ktp']){
  echo '<script language="javascript">
      swal(
          "Oops...",
          "Maaf No KTP Sudah Terdaftar",
          "error"
        )          
    </script>';
}else{

  $query = "INSERT INTO tbl_member(kode_member,no_ktp,nama,jenis_kelamin,alamat,kode_pos,username,password,no_hp) VALUES ('$kode','$ktp','$nama','$jenis','$alamat','$kode_pos','$username','$password','$tlp')";
  $sql = mysqli_query ($koneksi, $query);

  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Berhasil',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='member.php';
      }
    })
      </script>";
   // echo "<script type='text/javascript'>window.location ='?module=mahasiswa';</script>";
    
  } else {
    echo '<script language="javascript">
      swal(
          "Oops...",
          "Gagal!",
          "error"
        )          
    </script>';
  }
}
}
?>