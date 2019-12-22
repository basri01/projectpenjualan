<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">


<script>
function daftar() {
swal({
  title: 'Gagal',
  text: "Silahkan melakukan Registrasi terlebih dahulu untuk melakukan Transaksi!",
  type: 'warning',
  showCancelButton: 'true',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
 }).then((result) => {
  if (result) {
    document.location.href="login.php";
    }
  })
} 
</script>

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header ">
            </div>
            <div class="box-body">

        <?php 
          $sql = mysqli_query($koneksi, "SELECT * FROM tbl_barang order by kode_barang");
          while ( $r = mysqli_fetch_assoc( $sql ) ) {
        ?>
            
       <div class="col-sm-2 col-md-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
              <h5 class="text-left text-bold">Stok : <?php echo number_format($r['jumlah_barang']) ?></h5>
              <p align="center"><img class="image-rounded" <?php echo 'src="foto/'.$r['gambar'].'" ' ?> alt="" style="width: 70%; height: 150px;" ></p>
              <h5 class="text-center text-bold"><?php echo $r['nama_barang']; ?></h5>
              <h5 class="text-center text-bold">Rp. <?php echo $r['harga']; ?></h5>
              <h5 class="text-center text-bold"><?php echo $r['nama_supplier']; ?></h5>
              <button type="submit" class="btn btn-danger btn-block btn-flat" onclick="daftar()"> Beli</button>
            </div>
        </div>
      </div>

      <?php  } ?>
             
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>