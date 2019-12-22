<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
 $sql=mysqli_query($koneksi, "select * from tbl_bank order by kode_bank DESC LIMIT 0,1");
 $data=mysqli_fetch_array($sql);
 $kodeawal=substr($data['kode_bank'],3,4)+1;
 if($kodeawal<10){
  $kode='BNK00'.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode='BNK00'.$kodeawal;
 }else{
  $kode='BNK00'.$kodeawal;
 }
?>

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Input Bank</h3>

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
                            <label for="tiga" class="col-sm-3 control-label">Kode Bank</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Kode Bank" name="kode_kecamatan"  value='<?php echo $kode ?>' readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Bank</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama Bank" name="nama">
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
                          <a href="index2.php?module=bank" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
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
  $kode_kecamatan  = addslashes (strip_tags ($_POST['kode_kecamatan']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  

  $query = "INSERT INTO tbl_bank VALUES ('$kode_kecamatan','$nama')";
  $sql = mysqli_query ($koneksi, $query);
  
  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=bank';
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