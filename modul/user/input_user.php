<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Input User</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="#">
                    <i class="fa fa-wrench"></i></button>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="#"><i class="fa fa-times"></i></button>
              </div>
            </div><br>

            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama" name="nama">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Username" name="username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" required placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-4">
                              <select class="form-control select1" name="status">
                                <option></option>
                                <option value='Admin'>Admin</option>
                                <option value='User'>User</option>
                              </select>
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
                          <a href="index2.php?module=user" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cencel</a>
                        </div>
                      </div>

                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-footer -->
                </form>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>

<?php
IF (Isset($_POST['OK']))  {
  $nama            = addslashes (strip_tags ($_POST['nama']));
  $username        = addslashes (strip_tags ($_POST['username']));
  $status          = addslashes (strip_tags ($_POST['status']));
  $password        = md5($_POST['password']);


  $query = "INSERT INTO tbl_user (kode_user,nama,username,password,status) VALUES (' ','$nama','$username','$password','$status')";
  $sql = mysqli_query ($koneksi, $query);
  
  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=user';
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
?>