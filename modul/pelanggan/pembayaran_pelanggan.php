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

<section class="content">
<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box box-danger">
            <div class="box-body box-profile">
              <?php 
                if($_SESSION["jenis_kelamin"] == 'Pria'){
                  echo '<img class="profile-user-img img-responsive img-circle" src="images/pria.png" alt="User profile picture">';
                }else if($_SESSION["jenis_kelamin"] == 'Wanita'){
                  echo '<img class="profile-user-img img-responsive img-circle" src="images/wanita.png" alt="User profile picture">';
                }
              ?>
              
              <h3 class="profile-username text-center"><?php echo $_SESSION["nama"] ?></h3>

              <p class="text-muted text-center">Kode Member : <?php echo $_SESSION["kode_member"] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIK : <?php echo $_SESSION["no_ktp"] ?></b>
                </li>
                <li class="list-group-item">
                  <b>Gender : <?php echo $_SESSION["jenis_kelamin"] ?></b>
                </li>
                <li class="list-group-item">
                  <b>alamat : <?php echo $_SESSION["alamat"] ?></b>
                </li>
                <li class="list-group-item">
                  <b>No Hp  : <?php echo $_SESSION["no_hp"] ?></b> 
                </li>
                <li class="list-group-item">
                  <b> Silahkan Kirim di <br>
                      No Rek : 12345678989000 <br>
                      Nama   : Wiranda <br>
                      Alamat :Jl. Toddopuli Raya No. 333<br>
                      Phone  : (+62)8123459876<br>
                  </b> 
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Pembelian</a></li>
              <li><a href="#timeline" data-toggle="tab">Pembayaran</a></li>
              <li><a href="#timeline1" data-toggle="tab">History Pembelian</a></li>
            </ul>
            <div class="tab-content">

              <div class="active tab-pane" id="activity">
            <div class="box-body">
             <div class="table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Tanggal</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Jumlah Barang</th>
                   <th style="text-align: center;">Harga</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.id, a.kode_transaksi, a.kode_member, a.kode_barang, a.jumlah, a.harga, a.tanggal_beli, b.nama, b.no_ktp, c.nama_barang from tbl_transaksi_detail a, tbl_member b, tbl_barang c WHERE a.kode_member=b.kode_member and a.kode_barang=c.kode_barang and a.kode_member='$_SESSION[kode_member]' and kode_transaksi='$kode' order by kode_transaksi ");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $jumlah = $r['jumlah'] * str_replace(".", "",$r['harga']);
                  $total  = $total+$jumlah;
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td><?php echo $r['nama_barang']; ?></td>
                  <td><?php echo $r['tanggal_beli']; ?></td>
                  <td><?php echo $r['jumlah']; ?></td>
                  <td align='right'><?php echo $r['harga'] ?></td>
                  <td align='right'><?php echo number_format($jumlah) ?></td>
                  <td align="center">
                      <a href="?module=pelanggan&atc=hapus&id=<?php echo $r['id'];?>&nm=<?php echo $r['kode_barang']; ?>&st=<?php echo $r['jumlah'] ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs"> Cancel</a>
                  </td>
                </tr>
              <?php 
                $no++;
               } 

                echo "
                <tr>
                  <td colspan='5' align='center'><b>Total</B></td>
                  <td align='right'><b>".number_format($total)."</b></td>
                  <td></td>
                </tr>";
             ?>

              </table>
            </div>
          </div>
          </div>

              
        <div class="tab-pane" id="timeline">
          <div class="box-body">
          <div class="row">
            <form method="post" enctype="multipart/form-data">
            <div class="col-md-6">
               <!-- /.form-group -->
              <div class="form-group">
                <label >Kode Transaksi</label>
                <input type="text" class="form-control" required name="kode" value='<?php echo $kode; ?>' readonly>
              </div>

              <div class="form-group">
                <label>Kecamatan</label><br>
                <select class="form-control select1" required onchange="javascript:rubah(this)" name='kecamatan' style="width:377px">
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

              <div class="form-group">
                <label>Kelurahan</label><br>
                <select class="form-control select1" required onchange="javascript:rubah(this)" name='kelurahan' style="width:377px">
                  <?php  
                     $result = mysqli_query($koneksi, "select * from tbl_kelurahan order by nama_kelurahan");
                     $jsArray = "var kode_asal = new Array();\n";
                     echo '<option selected="selected"></option>';
                       while ($row = mysqli_fetch_array($result)) {
                       echo '<option value="' . $row['kode_kelurahan'] . '"> ' . $row['nama_kelurahan'] . '</option>';
                       }
                    ?>
                  </select>
              </div>
              <!-- <div class="form-group">
                  <label>Kelurahan</label><br>
                    <select class="form-control select1" id='divkedua' required name='kelurahan' style="width:377px"> 
                    </select>
               </div>
 -->
              <div class="form-group">
                <label >Alamat</label>
                <input type="text" class="form-control" required placeholder="Alamat" name="alamat" >
              </div>

              <div class="form-group">
                <label >No. HP</label>
                <input type="text" class="form-control" required placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)" value='<?php echo $_SESSION["no_hp"] ?>'>
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label >Kode Pos</label>
                <input type="number" class="form-control" required placeholder="Kode Pos" name="kodepos" >
              </div>

              <div class="form-group">
                <label >Biaya Pengiriman</label>
                <input type="text" class="form-control" required placeholder="Biaya Pengiriman" name="ongkir" readonly value='<?php echo '10000' ?>'>
              </div>

              

              <div class="form-group">
                <label>Nama Bank</label><br>
                <select class="form-control select1" required name='bank' style="width:377px">
                  <?php  
                     $result = mysqli_query($koneksi, "select * from tbl_bank order by nama_bank");
                     $jsArray = "var kode_asal = new Array();\n";
                     echo '<option selected="selected"></option>';
                       while ($row = mysqli_fetch_array($result)) {
                       echo '<option value="' . $row['kode_bank'] . '"> ' . $row['nama_bank'] . '</option>';
                       }
                    ?>
                  </select>
              </div>

              <div class="form-group">
                <label >Nomor Rekening</label>
                <input type="text" class="form-control" required placeholder="Nomor Rekening" name="norek" >
              </div>

              <?php if($total!=0){ ?>
              <div class="form-group">
                <label >Total Pembayaran</label>
                <input type="text" class="form-control" required placeholder="Biaya Pengiriman" name="total" readonly value='<?php echo $total+10000 ?>'>
              </div>
              <?php }?>

               <div class="form-group">
                <label >Biaya PPN</label>
                <input type="text" class="form-control" required placeholder="Biaya PPN" name="biayappn" readonly>
              </div>

              <!-- /.form-group -->
            </div><br>

      <div class="row">
        <!-- /.col -->
        <div class="form-group">
            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-5"><br>
              <button class="btn btn-primary" type="submit" name="OK"> Kirim</button>
              <a class="btn btn-danger btnPrevious" >Cancel</a>
            </div>
          </div>
        <!-- /.col -->
      </div><br>
  </div>
  </div>
  </div>

  <div class="tab-pane" id="timeline1">
    <div class="box-body">
             <div class="table-responsive">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Kode Transaksi</th>
                   <th style="text-align: center;">Tanggal</th>
                   <th style="text-align: center;">Total Pembayaran</th>
                    <th style="text-align: center;">Biaya PPN</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $noo += 1;
                $sql = mysqli_query($koneksi, "SELECT * from tbl_transaksi order by kode_transaksi ");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $noo; ?></td>
                  <td style="text-align: center;"><?php echo $r['kode_transaksi']; ?></td>
                  <td style="text-align: center;"><?php echo $r['tanggal']; ?></td>
                  <td align='right'><?php echo $r['total_pembayaran'] ?></td>
                   <td style="text-align: center;"><?php echo $r['biayappn'] ?></td>
                  <td style="text-align: center;">
                    <a href="home.php?module=pelanggan&atc=print&id=<?php echo $r["kode_transaksi"]; ?>" target="_blank" class="btn btn-danger btn-xs">Cetak</a>
                    <a href="home.php?module=pelanggan&atc=lihat&id=<?php echo $r["kode_transaksi"]; ?>" class="btn btn-success btn-xs">Lihat Detail</a>
                  </td>
                </tr>
              <?php 
                $noo++;
               } 
             ?>

              </table>
            </div>
          </div>
  </div>
  </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
      


    </form>
        <!-- /.col -->
      </div>
    </section>


<?php
IF (Isset($_POST['OK']))  {
  $kode                    = addslashes(strip_tags($_POST['kode']));
  $tanggal                 = date('Y-m-d');
  $kode_member             = $_SESSION['kode_member'];
  $kecamatan               = addslashes(strip_tags($_POST['kecamatan']));
  $kelurahan               = addslashes(strip_tags($_POST['kelurahan']));
  $alamat                  = addslashes(strip_tags($_POST['alamat']));
  $tlp                     = addslashes(strip_tags($_POST['tlp']));
  $kodepos                 = addslashes(strip_tags($_POST['kodepos']));
  $bank                    = addslashes(strip_tags($_POST['bank']));
  $norek                   = addslashes(strip_tags($_POST['norek']));
  $total                   = addslashes(strip_tags($_POST['total']));


  $query3 = "INSERT INTO tbl_transaksi(kode_transaksi,tanggal,kode_member,kode_kecamatan,kode_kelurahan,alamat,no_tlp,kodepos,kode_bank,norek,total_pembayaran) VALUES ('$kode','$tanggal','$kode_member','$kecamatan','$kelurahan','$alamat','$tlp','$kodepos','$bank','$norek','$total')";
  $sql = mysqli_query ($koneksi, $query3);

  $query4 = mysqli_query ($koneksi,"UPDATE tbl_transaksi_detail SET status='Bayar' where kode_transaksi='$kode' ");
  
  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=pelanggan&atc=bayar';
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