<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
 $sql=mysqli_query($koneksi, "select * from tbl_transaksi order by kode_transaksi DESC LIMIT 0,1");
 $data=mysqli_fetch_array($sql);
 $kodeawal=substr($data['kode_transaksi'],3,4)+1;
 if($kodeawal<10){
  $kode='T000'.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode='T00'.$kodeawal;
 }else{
  $kode='T0'.$kodeawal;
 }
?>


<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_barang WHERE kode_barang='$id' ";
$sql     = mysqli_query ($koneksi, $query);
$hasil   = mysqli_fetch_array ($sql);
  $kode_barang    = addslashes (strip_tags ($hasil['kode_barang']));
  $nama_barang    = addslashes (strip_tags ($hasil['nama_barang']));
  $gambar         = addslashes (strip_tags ($hasil['gambar']));
  $jumlah_barang  = addslashes (strip_tags ($hasil['jumlah_barang']));
  $harga          = addslashes (strip_tags ($hasil['harga']));


?>

<section class="content">
<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box box-danger">
            <div class="box-body box-profile">
        <div class="panel panel-default">
            <div class="panel-body">
              <h5 class="text-left text-bold">Stock : <?php echo $jumlah_barang ?></h5>
              <p align="center"><img class="image-rounded" <?php echo 'src="foto/'.$gambar.'" ' ?> alt="" style="width: 70%; height: 150px;" ></p>
              <h2 class="text-center text-warning"><?php echo $nama_barang ?></h2>
              <h3 class="text-center text-bold">Rp. <?php echo $harga ?></h3> 
            </div>
        </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9">
          <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Pembelian</h3><a class="pull-right"></a>
          </div>
          <div class="box-body">
            
             <div class="col-md-12">
              <div class="form-group">
                <label >Kode Transaksi</label>
                <input type="text" class="form-control" required placeholder="Kode Transaksi" readonly name="kode" value="<?php echo $kode;?>">
              </div>

              <div class="form-group">
                <label >Tanggal</label>
                <input type="text" class="form-control" required readonly name="tanggal" value="<?php echo date('Y-m-d')?>">
              </div>

              <div class="form-group">
                <label >Jumlah Barang</label>
                <input type="number" class="form-control" required placeholder="Jumlah Barang" name="jumlah" >
              </div>
              <!-- /.form-group -->
            </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-14 col-md-offset-4"><br>
              <button class="btn btn-primary" type="submit" name="Add"> Order</button>
             <a href="home.php?module=pelanggan&atc=tambah" class="btn btn-danger btn-md" > Cancel</a>
            </div>
          </div>
          <!-- /.row -->
        </div><br><br>
          
          </div>
          <!-- /.box-body -->
        </div>
          <!-- /.nav-tabs-custom -->
    </form>
        <!-- /.col -->
      </div>
    </section>
<?php
IF (Isset($_POST['Add']))  {

  $quer   = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE kode_barang='$id'");
  while ($r = mysqli_fetch_array($quer)) {
  $batas  = $r['jumlah_barang'];
  }

  $kode                    = addslashes (strip_tags($_POST['kode']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));
  $jumlah                  = addslashes (strip_tags ($_POST['jumlah']));

//if ($kode_barang == $kode_barang ){
//   $query2 = mysqli_query($koneksi, "UPDATE tbl_transaksi_detail SET jumlah=jumlah+'$jumlah' where kode_barang='$kode_barang' ");
//   $query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$jumlah' where kode_barang='$kode_barang' ");
//}

if ($jumlah > $batas== 0 ) {
  $query  = mysqli_query($koneksi, "INSERT INTO tbl_transaksi_detail(id,kode_transaksi,kode_member,kode_barang,jumlah,harga,tanggal_beli,status)VALUES('','$kode','$_SESSION[kode_member]','$hasil[kode_barang]','$jumlah','$hasil[harga]','$tanggal','Belum')");
  $query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$jumlah' where kode_barang='$hasil[kode_barang]' ");

  if($query){
  echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Berhasil',
      'success'
      ).then((result) => {
      if (result) {
       window.location.replace('');
      }
    })
      </script>";
  } 
}else if($batas == 0){
 echo '<script language="javascript">
      swal(
          "Oops...",
          "Maaf Stock Sudah Habis",
          "error"
        )          
    </script>';
}
  
}
?>