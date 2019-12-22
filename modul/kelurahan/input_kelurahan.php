<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Input Kelurahan</h3>

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
                            <label for="tiga" class="col-sm-3 control-label">Nama Provinsi</label>
                            <div class="col-sm-4">
                            <select class="form-control select1" required name="kode_kecamatan">
                              <?php  
                                $result = mysqli_query($koneksi, "select * from tbl_kecamatan order by nama_kecamatan");
                                $jsArray = "var kode_asal = new Array();\n";
                                echo '<option selected="selected"></option>';
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['kode_kecamatan'] . '"> ' . $row['nama_kecamatan'] . '</option>';
                                }
                             ?>
                             </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Kode Kelurahan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Kode Kelurahan" name="kode_kelurahan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Kelurahan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama Kelurahan" name="nama">
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
                          <a href="index2.php?module=kelurahan" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
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
  $id_kelurahan    = addslashes (strip_tags ($_POST['id_kelurahan']));
  $kode_kelurahan  = addslashes (strip_tags ($_POST['kode_kelurahan']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  

  $query = "INSERT INTO tbl_kelurahan (id_kelurahan, kode_kelurahan, kode_kecamatan, nama_kelurahan) VALUES ('','$kode_kelurahan','$kode_kecamatan','$nama')";
  $sql = mysqli_query ($koneksi, $query);
  
  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=kelurahan';
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