<?php
 $sql=mysqli_query($koneksi, "select * from tbl_barang_masuk order by kode_bm DESC LIMIT 0,1");
 $data=mysqli_fetch_array($sql);
 $kodeawal=substr($data['kode_bm'],3,4)+1;
 if($kodeawal<10){
  $kode='BM00'.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode='BM00'.$kodeawal;
 }else{
  $kode='BM00'.$kodeawal;
 }
?>

<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_barang WHERE kode_barang='$id' ";
$sql              = mysqli_query ($koneksi, $query);
$hasil            = mysqli_fetch_array ($sql);
$kode_barang      = addslashes (strip_tags ($hasil['kode_barang']));

?>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Input Barang Masuk</h3>

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
                            <label for="tiga" class="col-sm-3 control-label">Kode</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required name="kode" value='<?php echo $kode ?>' readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-4">
                            <select class="form-control select1" name='kode_barang'>
                              <?php  
                                $result = mysqli_query($koneksi, "select kode_barang, nama_barang from tbl_barang order by kode_barang");
                                $jsArray = "var kode_asal = new Array();\n";
                                echo '<option selected="selected"></option>';
                                while ($row = mysqli_fetch_array($result)) {
                                if($hasil['kode_barang']==$row['kode_barang']){ // $edit -> kode yang diedit
                                $selected ='selected';
                                }else{
                                 $selected ='';
                                }
                                echo '<option value="' . $row['kode_barang'] . '"'.$selected.'> ' . $row['kode_barang'] . ' || ' . $row['nama_barang'] . '</option>';
                                }
                             ?>
                             </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Tanggal" name="tanggal" id="datepicker" name="tanggal" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Jumlah Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Jumlah" name="jumlah">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Harga Beli / Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Harga Beli" name="harga" id="tanpa-rupiah" maxlength="15">
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
                          <a href="index2.php?module=barang_masuk" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cencel</a>
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
  $kode            = addslashes (strip_tags ($_POST['kode']));
  $kode_barang     = addslashes (strip_tags ($_POST['kode_barang']));
  $tanggal         = addslashes (strip_tags ($_POST['tanggal']));
  $jumlah          = addslashes (strip_tags ($_POST['jumlah']));
  $harga           = addslashes (strip_tags ($_POST['harga']));
  //$harga1          = addslashes (strip_tags ($_POST['harga1']));


  $query  = mysqli_query ($koneksi, "INSERT INTO tbl_barang_masuk (kode_bm,kode_barang,tanggal,jumlah_bm,harga_beli) VALUES ('$kode','$kode_barang','$tanggal','$jumlah','$harga')");
  $query2 = mysqli_query ($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang+'$jumlah' where kode_barang='$kode_barang' ");

  if ($query && $query2) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=barang_masuk';
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