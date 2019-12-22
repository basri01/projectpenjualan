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


<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Input Transaksi Pembayaran</h3>

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
                            <label for="tiga" class="col-sm-2 control-label">Kode Transaksi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required  name="kode" value="<?php echo $kode;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="datepicker" class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required placeholder="Tanggal" name="tanggal" id="datepicker" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kode Member</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                             <input type="text" class="form-control" autofocus required name="kode_member" placeholder="Kode Member" value="<?php echo $_POST['kode_member'] ?>">
                             <span class="input-group-btn">
                             <input type="submit" name="cari" value="Cari" class="btn btn-danger">
                             </span>
                          </div>
                            </div>
                        </div>

                      <?php 
                      $tampil = mysqli_query($koneksi, "select * from tbl_member where kode_member='$_POST[kode_member]'");
                      $r= mysqli_fetch_array($tampil);
                      $ketemu = mysqli_num_rows($tampil);
                      if($ketemu==0 && $_POST['cari']=='Cari'){
                        echo '<script language="javascript">
                        swal(
                            "Oops...",
                            "Kode User Tidak Ada!",
                            "error"
                          )
                        </script>';
                      }
                      ?>

                         <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" maxlength="50" placeholder="Nama Lengkap" readonly value="<?php echo $r['nama'] ?>">
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Nama Barang</label>
                            <div class="col-sm-8"> 
                            <select class="form-control select1" id='kode_barang' name='kode_barang' onchange='changeValue(this.value)'>
                            <option></option>              
                             <?php 
                              $result = mysqli_query($koneksi, "select * from tbl_barang");  
                              $jsArray = "var prdName = new Array();\n";
                              while ($row = mysqli_fetch_array($result)) {  
                              echo '<option name="kode_barang"  value="' . $row['kode_barang'] . '">' . $row['kode_barang'] . ' || ' . $row['nama_barang'] . '</option>';  
                              $jsArray .= "prdName['" . $row['kode_barang'] . "'] = {stock:'" . addslashes($row['harga']) . "',kode_tuk:'".addslashes($row['harga_jual'])."',nama_tuk:'".addslashes($row['nama_tuk'])."'};\n";
                               }
                            ?>
                             </select> 
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Harga Barang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Harga" id="stock" readonly name='harga'>
                            </div>
                        </div> 

                        <script type="text/javascript"> 
                        <?php echo $jsArray; ?>
                        function changeValue(id){
                            document.getElementById('stock').value = prdName[id].stock;
                            //document.getElementById('kode_tuk').value = prdName[id].kode_tuk;
                            //document.getElementById('nama_tuk').value = prdName[id].nama_tuk;
                        };
                        </script>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Jumlah Barang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Jumlah Barang" name='jumlah'>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-8"> 
                            <select class="form-control select1" onchange="javascript:rubah(this)" name='kecamatan'>
                          <?php  
                       if($_POST['cari']){
                         $result = mysqli_query($koneksi, "select * from tbl_kecamatan order by nama_kecamatan");
                         $jsArray = "var kode_asal = new Array();\n";
                         echo '<option selected="selected"></option>';
                         while ($row = mysqli_fetch_array($result)) {
                          if($_POST['kecamatan']==$row['kode_kecamatan']){ // $edit -> kode yang diedit
                              $selected ='selected';
                              }else{
                               $selected ='';
                            }
                         echo '<option value="' . $row['kode_kecamatan'] . '" '.$selected.' > ' . $row['nama_kecamatan'] . '</option>';
                          }
                        }else{
                             $result = mysqli_query($koneksi, "select * from tbl_kecamatan order by nama_kecamatan");
                             $jsArray = "var kode_asal = new Array();\n";
                             echo '<option selected="selected"></option>';
                               while ($row = mysqli_fetch_array($result)) {
                               echo '<option value="' . $row['kode_kecamatan'] . '"> ' . $row['nama_kecamatan'] . '</option>';
                               }
                             }
                            ?>
                          </select>
                        </div>
                        </div>

                    <div class="form-group">
                    <label for="tiga" class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-8"> 
                    <select class="form-control select1" id='divkedua' name='kelurahan'> 
                    </select>
                   </div>
                   </div>


                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Alamat Pengiriman</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Alamat" name="alamat" value='<?php echo $_POST['alamat'] ?>'>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">No. Hp</label>
                            <div class="col-sm-8">
                             <input type="text" class="form-control" placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)" value='<?php echo $_POST['tlp'] ?>'>
                             </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kode Pos </label>
                            <div class="col-sm-8">
                              <input type="number" class="form-control" placeholder="Kode Pos" name="kodepos" value='<?php echo $_POST['kodepos'] ?>'>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Biaya Pengiriman</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Biaya Pengiriman" name="ongkir" readonly value='<?php echo '10.000' ?>'>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Nama Bank</label>
                            <div class="col-sm-8">
                              <select class="form-control select1" name='bank'>
                              <?php  
                              if($_POST['cari']){
                         $result = mysqli_query($koneksi, "select * from tbl_bank order by nama_bank");
                         $jsArray = "var kode_asal = new Array();\n";
                         echo '<option selected="selected"></option>';
                         while ($row = mysqli_fetch_array($result)) {
                          if($_POST['bank']==$row['kode_bank']){ // $edit -> kode yang diedit
                              $selected ='selected';
                              }else{
                               $selected ='';
                            }
                         echo '<option value="' . $row['kode_bank'] . '" '.$selected.' > ' . $row['nama_bank'] . '</option>';
                          }
                        }else{
                                 $result = mysqli_query($koneksi, "select * from tbl_bank order by nama_bank");
                                 $jsArray = "var kode_asal = new Array();\n";
                                 echo '<option selected="selected"></option>';
                                   while ($row = mysqli_fetch_array($result)) {
                                   echo '<option value="' . $row['kode_bank'] . '"> ' . $row['nama_bank'] . '</option>';
                                   }
                                 }
                                ?>
                              </select>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">No. Rekening</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Nomor Rekening" name="norek" value='<?php echo $_POST['norek'] ?>'>
                            </div>
                        </div>
                        <br>
                        <!--input image awal-->

                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <button class="btn btn-warning glyphicon glyphicon-plus" type="submit" name="Add"> Add</button>
                          <button class="btn btn-primary glyphicon glyphicon-floppy-disk" type="submit" name="OK"> Save</button>
                          <a href="index2.php?module=transaksi" class="btn btn-danger btn-md" > <i class="glyphicon glyphicon-remove "></i> Cancel</a>
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

IF (Isset($_POST['Add']))  {
  $kode                    = addslashes (strip_tags($_POST['kode']));
  $kode_member             = addslashes (strip_tags ($_POST['kode_member']));
  $kode_barang             = addslashes (strip_tags ($_POST['kode_barang']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));
  $jumlah                  = addslashes (strip_tags ($_POST['jumlah']));
  $harga                   = addslashes (strip_tags ($_POST['harga']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));
  $kecamatan               = addslashes(strip_tags($_POST['kecamatan']));
  $kelurahan               = addslashes(strip_tags($_POST['kelurahan']));
  $bank                    = addslashes(strip_tags($_POST['bank']));

  $quer   = mysqli_query($koneksi, "SELECT * FROM tbl_barang  where kode_barang='$kode_barang'"  );
  while ($r = mysqli_fetch_array($quer)) {
  $batas  = $r['jumlah_barang'];
  if ($jumlah > $batas==0) {

  $query  = mysqli_query($koneksi, "INSERT INTO tbl_transaksi_detail(id,kode_transaksi,kode_member,kode_barang,jumlah,harga,tanggal_beli,status)VALUES('','$kode','$kode_member','$kode_barang','$jumlah','$harga','$tanggal','Belum')");

  $query3 = mysqli_query($koneksi, "INSERT INTO tbl_transaksi(kode_transaksi,tanggal,kode_member,kode_kecamatan,kode_kelurahan,alamat,no_tlp,kodepos,kode_bank,norek,total_pembayaran) VALUES ('',' ',' ','$kecamatan','$kelurahan',' ',' ','$kodepos','$bank',' ',' ')");

  $query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$jumlah' where kode_barang='$kode_barang' ");
}else if($batas==0){
 echo '<script language="javascript">
      swal(
          "Oops...",
          "Maaf Stock Sudah Habis",
          "error"
        )          
    </script>';
}else{
  echo '<script language="javascript">
      swal(
          "Oops...",
          "Maaf Stock Tidak Cukup",
          "error"
        )          
    </script>';
}
  }  
}
?>

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="#">
                    <i class="fa fa-wrench"></i></button>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="#"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
             <div class="table-responsive">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No</th>
                   <th style="text-align: center;">No KTP</th>
                   <th style="text-align: center;">Nama</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Tanggal Beli</th>
                   <th style="text-align: center;">Jumlah Barang</th>
                   <th style="text-align: center;">Harga</th>
                   <th style="text-align: center;">Jumlah</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 

           IF (Isset($_POST['cari']) || $_POST['kode_member']!="")  {
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.id, a.kode_transaksi, a.kode_member, a.kode_barang, a.jumlah, a.harga, a.tanggal_beli, a.status, b.nama, b.no_ktp, c.nama_barang from tbl_transaksi_detail a, tbl_member b, tbl_barang c WHERE a.kode_member=b.kode_member and a.kode_barang=c.kode_barang and a.kode_member='$_POST[kode_member]' and kode_transaksi='$kode' and a.status='Belum' order by kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  // $id  = $r['id'];
                  $jumlah = $r['jumlah'] * str_replace(".", "",$r['harga']);
                  $total  = $total+$jumlah;
                  $total1  = $total+10000;
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td><?php echo $r['no_ktp']; ?></td>
                  <td><?php echo $r['nama']; ?></td>
                  <td><?php echo $r['nama_barang']; ?></td>
                  <td><?php echo $r['tanggal_beli']; ?></td>
                  <td><?php echo $r['jumlah']; ?></td>
                  <td align='right'><?php echo $r['harga'] ?></td>
                  <td align='right'><?php echo number_format($jumlah) ?></td>
                  <td align="center">
                      <a href="?module=transaksi&atc=hapus_detail&id=<?php echo $r['id'];?>&nm=<?php echo $r['kode_barang']; ?>&st=<?php echo $r['jumlah'] ?>"  onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><span class="glyphicon glyphicon-trash fa-lg"></span></a>
                  </td>
                </tr>
              <?php 
                $no++;
               } 

                echo "
                <tr>
                  <td colspan='7' align='center'><b>Total</B></td>
                  <td align='right'><b>".number_format($total)."</b></td>
                  <td></td>
                </tr>";
             }?>

              </table>
            </div>
          </div>


          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>

<?php
IF (Isset($_POST['OK']))  {
  $kode                    = addslashes(strip_tags($_POST['kode']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));
  $kode_member             = addslashes (strip_tags ($_POST['kode_member']));
  $alamat                  = addslashes(strip_tags($_POST['alamat']));
  $tlp                     = addslashes(strip_tags($_POST['tlp']));
  $kodepos                 = addslashes(strip_tags($_POST['kodepos']));
  $norek                   = addslashes(strip_tags($_POST['norek']));
  $total                   = $total1;

$querr   = mysqli_query($koneksi, "SELECT * FROM tbl_transaksi"  );
  while ($r1 = mysqli_fetch_array($querr)) {
  $kodee  = $r1['kode_transaksi'];
  if ($kodee==='') {
  $query4 =mysqli_query($koneksi, " UPDATE tbl_transaksi SET kode_transaksi='$kode', tanggal='$tanggal', kode_member='$kode_member', alamat='$alamat', no_tlp='$tlp', kodepos='$kodepos', norek='$norek', total_pembayaran='$total' WHERE kode_transaksi='' ");
   $query1 = mysqli_query($koneksi, "UPDATE tbl_transaksi_detail SET status='Bayar' where kode_transaksi='$kode' ");
  if ($query4) {
    
    echo "<script language='javascript'> 
      swal(
      'Successful!',
      'Data Berhasil Di Simpan',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='?module=transaksi';
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

}
}
?>