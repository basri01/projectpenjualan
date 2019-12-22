

<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT * FROM tbl_transaksi WHERE kode_transaksi='$id' ";
$sql             = mysqli_query ($koneksi, $query);
$hasil           = mysqli_fetch_array ($sql);
  $kode           = addslashes (strip_tags ($hasil['kode_transaksi']));
  $ktp            = addslashes (strip_tags ($hasil['no_ktp']));
  $nama           = addslashes (strip_tags ($hasil['nama']));
  $alamat         = addslashes (strip_tags ($hasil['alamat']));
  $jenis          = addslashes (strip_tags ($hasil['jenis_kelamin']));
  $kode_kecamatan = addslashes (strip_tags ($hasil['kode_kecamatan']));
  $kode_kelurahan = addslashes (strip_tags ($hasil['kode_kelurahan']));
  $tlp            = addslashes (strip_tags ($hasil['no_tlp']));
  $tgl            = addslashes (strip_tags ($hasil['tanggal']));


?>

<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Beauty Kosmetik
          <small class="pull-right"><?php echo $tgl ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          Jalan Toddopuli Raya Timur No. 111<br>
          Phone  : 085237378989 <br>
          Email: beautykosmetik.id@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <address>
          <strong> Nama     : <?php echo $_SESSION['nama'] ?></strong><br>
                   Alamat   : <?php echo $alamat ?><br>
                   No Tlpon : <?php echo $tlp ?><br>
        </address>
      </div>
      <!-- /.col --> 
           
      <div class="col-sm-4 invoice-col">
        <b>Kode Transaksi : <?php echo $kode ?></b><br>
        <b>Tanggal Pembelian : </b> <?php echo $tgl ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
         <table class="table table-striped">
           <thead>
                  <tr>
                   <th style="text-align: center;">Kode Barang</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Jumlah Barang</th>
                    <th style="text-align: center;">Harga Barang</th>
                   <th style="text-align: right;">Total Pembayaran</th>
                </tr>
            </thead>
             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_transaksi, a.kode_member, a.jumlah, a.harga, c.kode_barang, c.jumlah_barang, c.nama_barang FROM tbl_transaksi_detail a, tbl_barang c where  a.kode_barang=c.kode_barang and a.kode_transaksi='$id' order by a.kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $total = str_replace(".", "",$r['harga'])*$r['jumlah'];
                ?>

                <tr>
                   <td  align='center'><?php echo $r['kode_barang']; ?></td>
                  <td  align='center'><?php echo $r['nama_barang']; ?></td>
                  <td align='center'><?php echo $r['jumlah']; ?></td>
                  <td align='center'>Rp.&nbsp;&nbsp;<?php echo $r['harga']; ?></td>
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
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
