<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query     = "SELECT a.kode_transaksi, a.tanggal, a.kode_member, a.kode_kecamatan, a.kode_kelurahan, a.alamat, a.no_tlp, a.kodepos, a.kode_bank, a.norek, b.nama, b.no_ktp, b.jenis_kelamin, b.alamat, b.no_hp FROM tbl_transaksi a, tbl_member b WHERE a.kode_member=b.kode_member and kode_transaksi='$id' ";
$sql       = mysqli_query ($koneksi, $query);
$hasil     = mysqli_fetch_array ($sql);
  $kode          = addslashes(strip_tags($hasil['kode_transaksi']));
  $kode_member   = addslashes(strip_tags($hasil['kode_member']));
  $kecamatan     = addslashes(strip_tags($hasil['kode_kecamatan']));
  $kelurahan     = addslashes(strip_tags($hasil['kode_kelurahan']));
  $alamat        = addslashes(strip_tags($hasil['alamat']));
  $tlp           = addslashes(strip_tags($hasil['no_tlp']));
  $kodepos       = addslashes(strip_tags($hasil['kodepos']));
  $bank          = addslashes(strip_tags($hasil['kode_bank']));
  $norek         = addslashes(strip_tags($hasil['norek']));
  $nama          = addslashes(strip_tags($hasil['nama']));
  $jenis_kelamin = addslashes(strip_tags($hasil['jenis_kelamin']));
  $no_ktp        = addslashes(strip_tags($hasil['no_ktp']));
  $alamat1       = addslashes(strip_tags($hasil['alamat']));
  $kode_pos      = addslashes(strip_tags($hasil['kode_pos']));
  $no_hp         = addslashes(strip_tags($hasil['no_hp']));
  $tanggal       = addslashes(strip_tags($hasil['tanggal']));


?>

<section class="content">
<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box box-danger">
            <div class="box-body box-profile">
              <?php 
                if($jenis_kelamin == 'Pria'){
                  echo '<img class="profile-user-img img-responsive img-circle" src="images/pria.png" alt="User profile picture">';
                }else if($jenis_kelamin == 'Wanita'){
                  echo '<img class="profile-user-img img-responsive img-circle" src="images/wanita.png" alt="User profile picture">';
                }
              ?>
              
              <h3 class="profile-username text-center"><?php echo $nama?></h3>

              <p class="text-muted text-center">Kode Member : <?php echo $kode_member?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIK : <?php echo $no_ktp ?></b>
                </li>
                <li class="list-group-item">
                  <b>Gender : <?php echo $jenis_kelamin ?></b>
                </li>
                <li class="list-group-item">
                  <b>alamat : <?php echo $alamat1 ?></b>
                </li>
                <li class="list-group-item">
                  <b>No Hp  : <?php echo $no_hp?></b> 
                </li>
                <li class="list-group-item">
                 <b> Silahkan Kirim Di <br>
                      No. Rekening : 12345678910 <br>
                      Nama   : Wiranda <br>
                      Alamat : Jl. Toddopuli Raya No. 111<br>
                      No. Telfon : 085394111119 <br>
                  </b> 
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9">
          <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Pembayaran</h3><a class="pull-right"><i class="fa fa-clock-o"></i> <?php echo $tanggal ?></a>
          </div>
          <div class="box-body">
              
             <div class="row"><br>
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
           <thead>
                  <tr>
                   <th style="text-align: center;">Kode Transaksi</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Jumlah</th>
                   <th style="text-align: center;">Harga / Unit</th>
                   <th style="text-align: right;">Total</th>
                </tr>
            </thead>  
            <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_transaksi, a.kode_member, a.jumlah, a.harga, c.kode_barang, c.jumlah_barang, c.nama_barang FROM tbl_transaksi_detail a, tbl_barang c where  a.kode_barang=c.kode_barang and a.kode_transaksi='$id' order by a.kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $total = str_replace(".", "",$r['harga'])*$r['jumlah'];
                ?>
                <tr>
                  <td align='center'><?php echo $r['kode_transaksi']; ?></td>
                  <td align='center'><?php echo $r['nama_barang']; ?></td>
                  <td align='center'><?php echo $r['jumlah']; ?></td>
                  <td align='center'>Rp.&nbsp;&nbsp; <?php echo $r['harga']; ?></td>
                  <td align='right'>Rp.&nbsp;&nbsp; <?php echo $total; ?></td>
                  </tr>
              <?php 
                $no++;
               } ?>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        <?php 
               $sql = mysqli_query($koneksi, "SELECT * FROM tbl_transaksi  where kode_transaksi='$id' order by kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $nor = $r['norek'];
          ?>
          <p class="lead">Payment Methods:</p>
          <img src="dist/img/credit/visa.png" alt="Visa">
          <img src="dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="dist/img/credit/american-express.png" alt="American Express">
          <img src="dist/img/credit/paypal2.png" alt="Paypal">
          
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <?php echo "$nor"; ?>
            <?php 
               } ?>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6"><br>
          <?php 
                $sql = mysqli_query($koneksi, "SELECT * FROM tbl_transaksi  where kode_transaksi='$id' order by kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $total1 = $r['total_pembayaran'];
          ?>

          <div class="table-responsive"><br><br>
            <table class="table">
              <tr>
                <th style="width:50%">Ongkos Kirim :</th>
                <td align='right'>Rp. &nbsp;&nbsp; <?php echo '10.000' ?></td>
              </tr>
              <tr>
                <th>Total :</th>
                <td align='right'><b>Rp. &nbsp;&nbsp;<?php echo number_format($total1) ?></b></td>
              </tr>
            </table>
            <?php 
                $no++;
               } ?>
          </div><br><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
    </form>
        <!-- /.col -->
      </div>
    </section>

