<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $ft = $_GET['ft'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_barang WHERE kode_barang='$id' ";
$sql     = mysqli_query ($koneksi, $query);
$hasil   = mysqli_fetch_array ($sql);
  $kode_barang  = addslashes (strip_tags ($hasil['kode_barang']));
  $nama_barang  = addslashes (strip_tags ($hasil['nama_barang']));
  $gambar       = addslashes (strip_tags ($hasil['gambar']));
  $harga       = addslashes (strip_tags ($hasil['harga']));
  $tgl_kadaluarsa       = addslashes (strip_tags ($hasil['tgl_kadaluarsa']));

//proses edit berita
if (isset($_POST['edit'])) {
  $target            = "foto/".basename($_FILES['foto']['name']);
  $nama              = addslashes (strip_tags ($_POST['nama']));
  $harga             = addslashes (strip_tags ($_POST['harga']));
  $tgl_kadaluarsa       = addslashes (strip_tags ($_POST['tgl_kadaluarsa']));
  $gambar            = $_FILES['foto']['name'];
  move_uploaded_file($_FILES['foto']['tmp_name'], $target);


  $a = $ft;
  if($gambar ==""){
    $gambar          = addslashes (strip_tags ($hasil['gambar']));
  }else{
    unlink("foto/$a");
  }

  $query = mysqli_query ($koneksi,"UPDATE tbl_barang SET nama_barang='$_POST[nama_barang]', gambar='$gambar', harga='$_POST[harga]', tgl_kadaluarsa='$_POST[tgl_kadaluarsa]' where kode_barang='$id' ");
   
   if ($query) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=barang';
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
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Barang</h3>

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
                            <label for="tiga" class="col-sm-3 control-label">Kode Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required name="kode_barang" value='<?php echo $kode_barang ?>' readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama Barang" name="nama_barang" value='<?php echo $nama_barang ?>'>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Gambar</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" required name="foto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Harga Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Harga" name="harga" value='<?php echo $harga?>'>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Tanggal Kadaluarsa</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" required placeholder="Tanggal" name="tgl_kadaluarsa"/>
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="edit"> Save</button>
                          <a href="index2.php?module=barang" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
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