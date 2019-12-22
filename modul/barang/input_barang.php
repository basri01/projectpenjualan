<?php
 $sql=mysqli_query($koneksi, "SELECT max(kode_barang) as idMaks FROM tbl_barang");
$data  = mysqli_fetch_array($sql);
 $kode_barang = $data['idMaks'];
     
$noUrut = (int) substr($kode_barang, 5, 5);
$noUrut++;

 $tahun=date('Y');
      $tahunbarang="BRG".substr($tahun, 2, 2);
      $char = $tahunbarang;
      $kode = $char . sprintf("%05s", $noUrut);
?>


<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Input Barang</h3>

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
                                <input type="text" class="form-control" required name="kode" value='<?php echo $kode ?>' readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama Barang" name="nama">
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
                                <input type="number" class="form-control" required placeholder="Harga" name="harga" value='<?php echo $harga ?>'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Nama Supplier</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" required placeholder="Nama Supplier" name="namasupplier" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-3 control-label">Tanggal Kadaluarsa</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" required placeholder="Tanggal Kadaluarsa" name="tglkadaluarsa" >
                            </div>
                        </div>

                        <br>

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
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

<?php
IF (Isset($_POST['OK']))  {
  $target          = "foto/".basename($_FILES['foto']['name']);
  $kode            = addslashes (strip_tags ($_POST['kode']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  $harga           = addslashes (strip_tags ($_POST['harga']));
  $jumlah          = '0';
  $foto            = $_FILES['foto']['name'];

  move_uploaded_file($_FILES['foto']['tmp_name'], $target);
  $namasupplier        = addslashes (strip_tags ($_POST['namasupplier']));
  $tglkadaluarsa          = addslashes (strip_tags ($_POST['tglkadaluarsa']));

  $query = mysqli_query ($koneksi, "INSERT INTO tbl_barang (kode_barang,nama_barang,gambar,jumlah_barang,harga,nama_supplier,tgl_kadaluarsa) VALUES ('$kode','$nama','$foto','$jumlah','$harga', '$namasupplier', '$tglkadaluarsa')");
  
  
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