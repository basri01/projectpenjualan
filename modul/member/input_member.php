<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

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

<section class="content">
<div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data Member</h3>

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
                <label >No KTP</label>
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
                <input type="text" class="form-control" required placeholder="Alamat Pemasangan" name="alamat" >
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label >No HP</label>
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
            </div>
            <!-- /.col -->
          </div><br>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-14 col-md-offset-5">
              <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
             <a href="index2.php?module=member" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
            </div>
          </div>
          <!-- /.row -->
        </div><br><br><br>
        <!-- /.box-body -->
        </form>
    </section>


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
          "Maaf Nomor KTP Sudah Terdaftar!",
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
}
?>