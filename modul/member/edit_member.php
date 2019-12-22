<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_member WHERE kode_member='$id' ";
$sql              = mysqli_query ($koneksi, $query);
$hasil            = mysqli_fetch_array ($sql);
  $kode           = addslashes (strip_tags ($hasil['kode_member']));
  $ktp            = addslashes (strip_tags ($hasil['no_ktp']));
  $nama           = addslashes (strip_tags ($hasil['nama']));
  $alamat         = addslashes (strip_tags ($hasil['alamat']));
  $jenis          = addslashes (strip_tags ($hasil['jenis_kelamin']));
  $tlp            = addslashes (strip_tags ($hasil['no_hp']));
  $email          = addslashes (strip_tags ($hasil['kode_pos']));
  $username       = addslashes (strip_tags ($hasil['username']));
  $password       = addslashes (strip_tags ($hasil['password']));

//proses edit berita
if (isset($_POST['edit'])) {
  $ktp             = addslashes (strip_tags ($_POST['ktp']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  $jenis           = addslashes (strip_tags ($_POST['jenis']));
  $alamat          = addslashes (strip_tags ($_POST['alamat']));
  $username        = addslashes (strip_tags ($_POST['username']));
  $password        = md5($_POST['password']);
  $tlp             = addslashes (strip_tags ($_POST['tlp']));
  $kode_pos        = addslashes (strip_tags ($_POST['kode_pos']));

  if($hasil['password'] ==''){
    $password       = addslashes (strip_tags ($hasil['password']));
  }
    

  $query = "UPDATE tbl_member SET no_ktp='$ktp', nama='$nama', jenis_kelamin='$jenis', alamat='$alamat', kode_pos='$kode_pos', username='$username', password='$password', no_hp='$tlp' where kode_member='$id' ";
  $sql = mysqli_query ($koneksi, $query);
   
   if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Data Berhasil Disimpan!',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=member';
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

<section class="content">
<div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Member</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget=""><i class="fa fa-remove"></i></button>
          </div>
        </div><br>

        <!-- /.box-header -->
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
                <input type="text" class="form-control" required placeholder="No KTP" name="ktp" maxlength="16" onkeypress="return isNumberKey(event)" value='<?php echo $ktp ?>'>
              </div>

              <div class="form-group">
                <label >Nama Lengkap</label>
                <input type="text" class="form-control" required placeholder="Nama Lengkap" name="nama" value='<?php echo $nama ?>'>
              </div>

              <div class="form-group">
                <label>Jenis Kelamin</label>
                  <select class="form-control select1" name="jenis">
                    <option></option>
                    <option value='Pria' <?php if( $jenis=='Pria') {echo "selected"; } ?>>Pria</option>
                    <option value='Wanita'<?php if( $jenis=='Wanita') {echo "selected"; } ?>>Wanita</option>
                  </select>
              </div>

              <div class="form-group">
                <label >Alamat</label>
                <input type="text" class="form-control" required placeholder="Alamat Pemasangan" name="alamat" value='<?php echo $alamat ?>'>
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label >No. HP</label>
                <input type="text" class="form-control" required placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)" value='<?php echo $tlp ?>'>
              </div>

              <div class="form-group">
                <label >Kode Pos</label>
                <input type="text" class="form-control" required placeholder="Kode Pos" name="kode_pos" value='<?php echo $email ?>'>
              </div>

              <div class="form-group">
                <label >Username</label>
                <input type="text" class="form-control" required placeholder="Username" name="username" value='<?php echo $username ?>'>
              </div>

              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div><br>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-14 col-md-offset-5">
              <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="edit"> Save</button>
             <a href="index2.php?module=member" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
            </div>
          </div>
          <!-- /.row -->
        </div><br><br><br>
        <!-- /.box-body -->
        </form>
    </section>