<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">


<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_kecamatan WHERE id_kecamatan='$id' ";
$sql             = mysqli_query ($koneksi, $query);
$hasil           = mysqli_fetch_array ($sql);
  $kode          = addslashes (strip_tags ($hasil['kode_kecamatan']));
  $nama          = addslashes (strip_tags ($hasil['nama_kecamatan']));

//proses edit berita
if (isset($_POST['edit'])) {
  $kode_kecamatan           = addslashes (strip_tags ($_POST['kode_kecamatan']));
  $nama_kecamatan           = addslashes (strip_tags ($_POST['nama_kecamatan']));

  $query = "UPDATE tbl_kecamatan SET kode_kecamatan='$kode_kecamatan', nama_kecamatan='$nama_kecamatan' where id_kecamatan='$id' ";
  $sql = mysqli_query ($koneksi, $query);
   
   if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=kecamatan';
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
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Kecamatan</h3>

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
                            <label for="tiga" class="col-sm-3 control-label">Kode Kecamatan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required name="kode_kecamatan" value="<?php echo $kode ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Kecamatan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required name="nama_kecamatan" value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="edit"> Save</button>
                          <a href="index2.php?module=kecamatan" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
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