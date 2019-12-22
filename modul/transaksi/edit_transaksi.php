<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
} else {
     die ("Error. No Id Selected! ");
}

$query = "SELECT a.kode_transaksi, a.tanggal, a.kode_member, a.kode_kecamatan, a.kode_kelurahan, a.alamat, a.no_tlp, a.kodepos, a.kode_bank, a.norek, b.nama FROM tbl_transaksi a, tbl_member b WHERE a.kode_member=b.kode_member and kode_transaksi='$id' ";
$sql     = mysqli_query ($koneksi, $query);
$hasil   = mysqli_fetch_array ($sql);
  $kode          = addslashes(strip_tags($hasil['kode_transaksi']));
  $kode_member   = addslashes(strip_tags($hasil['kode_member']));
  $kecamatan     = addslashes(strip_tags($hasil['kode_kecamatan']));
  $kelurahan     = addslashes(strip_tags($hasil['kode_kelurahan']));
  $alamat        = addslashes(strip_tags($hasil['alamat']));
  $tlp           = addslashes(strip_tags($hasil['no_tlp']));
  $kodepos       = addslashes(strip_tags($hasil['kodepos']));
  $bank          = addslashes(strip_tags($hasil['kode_bank']));
  $norek         = addslashes(strip_tags($hasil['norek']));
  $nama         = addslashes(strip_tags($hasil['nama']));

//proses edit berita
  
?>


<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Input Transaksi Penjualan</h3>

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
                                <input type="text" class="form-control" required placeholder="Tanggal" name="tanggal" id="datepicker" value="<?php echo date('Y-m-d') ?>" readonly>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kode Member</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                            <?php if($_POST['cari']){?>
                             <input type="text" class="form-control" autofocus required name="kode_member" placeholder="Kode Manufaktur" value="<?php echo $_POST['kode_member'] ?>">
                            <?php }else{ ?>
                              <input type="text" class="form-control" autofocus required name="kode_member" placeholder="Kode Manufaktur" value="<?php echo $kode_member ?>">
                            <?php }?>
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
                              <?php if($_POST['cari']){ ?>
                                <input type="text" class="form-control" maxlength="50" placeholder="Nama Lengkap" readonly value="<?php echo $r['nama'] ?>">
                              <?php } else {?>
                                <input type="text" class="form-control" maxlength="50" placeholder="Nama Lengkap" readonly value="<?php echo $nama ?>">
                              <?php }?>
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
                            <label for="tiga" class="col-sm-2 control-label">Harga</label>
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
                          if($hasil['kode_kecamatan']==$row['kode_kecamatan']){ // $edit -> kode yang diedit
                              $selected ='selected';
                              }else{
                               $selected ='';
                            }
                         echo '<option value="' . $row['kode_kecamatan'] . '" '.$selected.' > ' . $row['nama_kecamatan'] . '</option>';
                          }
                        }
                            ?>
                          </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kelurahan</label>
                            <div class="col-sm-8">
                              <?php
                              if($_POST['cari']){
                          echo '  <select class="form-control select1" name="kelurahan" id="divkedua">';
                         $sql=mysqli_query($koneksi,"select * from tbl_kelurahan where kode_kecamatan='$_POST[kecamatan]' order by kode_kecamatan");
                        $jsArray = "var kode_link = new Array();\n";
                        while ($data=mysqli_fetch_array($sql)){
                        if($_POST['kelurahan']==$data['kode_kelurahan']){ // $edit -> kode yang diedit
                        $selected ='selected';
                        }else{
                         $selected ='';
                        }
                        echo '<option value="'.$data['kode_kelurahan'].'" '.$selected.'>'.$data['nama_kelurahan'].'</option>';
                        //  $jsArray .= "ip['" . $data['kode_link'] . "'] = '" . addslashes($data['ip']) . "';\n";
                        }
                          echo "</select>";
                        }else{
                          echo '  <select class="form-control select1" name="kelurahan" id="divkedua">';
                         $sql=mysqli_query($koneksi,"select * from tbl_kelurahan where kode_kecamatan='$hasil[kode_kecamatan]' order by kode_kecamatan");
                        $jsArray = "var kode_link = new Array();\n";
                        while ($data=mysqli_fetch_array($sql)){
                        if($hasil['kode_kelurahan']==$data['kode_kelurahan']){ // $edit -> kode yang diedit
                        $selected ='selected';
                        }else{
                         $selected ='';
                        }
                        echo '<option value="'.$data['kode_kelurahan'].'" '.$selected.'>'.$data['nama_kelurahan'].'</option>';
                        //  $jsArray .= "ip['" . $data['kode_link'] . "'] = '" . addslashes($data['ip']) . "';\n";
                        }
                          echo "</select>";  

                          }?>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Alamat Pengiriman</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Alamat" name="alamat" value='<?php echo $alamat ?>'>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">No. Hp</label>
                            <div class="col-sm-8">
                             <input type="text" class="form-control" placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)" value='<?php echo $tlp ?>'>
                             </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">Kode Pos</label>
                            <div class="col-sm-8">
                              <input type="number" class="form-control" placeholder="Kode Pos" name="kodepos" value='<?php echo $kodepos ?>'>
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
                          if($hasil['kode_bank']==$row['kode_bank']){ // $edit -> kode yang diedit
                              $selected ='selected';
                              }else{
                               $selected ='';
                            }
                         echo '<option value="' . $row['kode_bank'] . '" '.$selected.' > ' . $row['nama_bank'] . '</option>';
                          }
                        }
                                ?>
                              </select>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="tiga" class="col-sm-2 control-label">No. Rekening</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Nomor Rekening" name="norek" value='<?php echo $norek?>'>
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

  $quer   = mysqli_query($koneksi, 'SELECT * FROM tbl_barang');
  while ($r = mysqli_fetch_array($quer)) {
  $batas  = $r['jumlah_barang'];
  }

  $que   = mysqli_query($koneksi, 'SELECT * FROM tbl_transaksi_detail');
  while ($rr = mysqli_fetch_array($quer)) {
  $kd  = $rr['kode_barang'];
  }

IF (Isset($_POST['Add']))  {
  $kode                    = addslashes (strip_tags($_POST['kode']));
  $kode_member             = addslashes (strip_tags ($_POST['kode_member']));
  $kode_barang             = addslashes (strip_tags ($_POST['kode_barang']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));
  $jumlah                  = addslashes (strip_tags ($_POST['jumlah']));
  $harga                   = addslashes (strip_tags ($_POST['harga']));
  $tanggal                 = addslashes (strip_tags ($_POST['tanggal']));

//if ($kode_barang == $kode_barang ){
//   $query2 = mysqli_query($koneksi, "UPDATE tbl_transaksi_detail SET jumlah=jumlah+'$jumlah' where kode_barang='$kode_barang' ");
//   $query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$jumlah' where kode_barang='$kode_barang' ");
//}

if ($jumlah > $batas==0 ) {
  $query  = mysqli_query($koneksi, "INSERT INTO tbl_transaksi_detail(id,kode_transaksi,kode_member,kode_barang,jumlah,harga,tanggal_beli)VALUES('','$kode','$kode_member','$kode_barang','$jumlah','$harga','$tanggal')");
  $query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$jumlah' where kode_barang='$kode_barang' ");
}else if($batas == 0){
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
                   <th style="text-align: center;">Tanggal Belli</th>
                   <th style="text-align: center;">Jumlah Barang</th>
                   <th style="text-align: center;">Harga</th>
                   <th style="text-align: center;">Jumlah</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.id, a.kode_transaksi, a.kode_member, a.kode_barang, a.jumlah, a.harga, a.tanggal_beli, b.nama, b.no_ktp, c.nama_barang from tbl_transaksi_detail a, tbl_member b, tbl_barang c WHERE a.kode_member=b.kode_member and a.kode_barang=c.kode_barang and a.kode_member='$kode_member' and kode_transaksi='$kode' order by kode_transaksi ");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $jumlah = $r['jumlah'] * str_replace(".", "",$r['harga']);
                  $total  = $total+$jumlah;
                  $total1  = $total+$jumlah+10000;
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
             ?>

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
  $kecamatan               = addslashes(strip_tags($_POST['kecamatan']));
  $kelurahan               = addslashes(strip_tags($_POST['kelurahan']));
  $alamat                  = addslashes(strip_tags($_POST['alamat']));
  $tlp                     = addslashes(strip_tags($_POST['tlp']));
  $kodepos                 = addslashes(strip_tags($_POST['kodepos']));
  $bank                    = addslashes(strip_tags($_POST['bank']));
  $norek                   = addslashes(strip_tags($_POST['norek']));
  $total                   = $total1;

  $query3 = "UPDATE tbl_transaksi SET tanggal='$tanggal', kode_member='$kode_member', kode_kecamatan='$kecamatan', kode_kelurahan='$kelurahan', alamat='$alamat', no_tlp='$tlp', kodepos='$kodepos', kode_bank='$bank', norek='$norek', total_pembayaran='$total' where kode_transaksi='$id' ";
  //$query3 = "INSERT INTO tbl_transaksi_bahan_baku(kode_transaksi_bk,kode_user,tanggal) VALUES ('$kode','$kode_user','$tanggal')";
  $sql = mysqli_query ($koneksi, $query3);
  
  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
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
    ?>