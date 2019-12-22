<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Penjualan</h3>

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
                 <div class="col-lg-6">
                  <div class="input-group">
                       <span class="input-group-addon">
                        <i class="fa fa-fw fa-calendar-o"></i>
                        </span>
                    <input type="text" class="form-control" id="datepicker" name='tgl1' required value='<?php echo "$_POST[tgl1]" ?>'>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                 <div class="col-lg-5">
                  <div class="input-group">
                       <span class="input-group-addon">
                        <i class="fa fa-fw fa-calendar-o"></i>
                        </span>
                    <input type="text" class="form-control" id="datepicker1" name='tgl2' required value='<?php echo "$_POST[tgl2]" ?>'>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                 <div class="col-lg-1">
                  <div class="input-group">
                      <input type="submit" name="cari" class="btn btn-danger  " value='Cari' type="button">
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </form>

                    <?php 
                      $tampil = mysqli_query($koneksi, "select * from tbl_transaksi where tanggal between '$_POST[tgl1]' and '$_POST[tgl2]' ");
                      $r= mysqli_fetch_array($tampil);
                      $ketemu = mysqli_num_rows($tampil);
                      if($ketemu==0 && $_POST['cari']=='Cari'){
                        echo '<script language="javascript">
                        swal(
                            "Oops...",
                            "Tidak Ada!",
                            "error"
                          )
                        </script>';
                      }
                      ?>
                  
            <div class="box-body">
             <div class="table-responsive"> <br>&nbsp;&nbsp;&nbsp;
              <a class="no-print btn btn-danger btn-sm" href="javascript:printDiv('area-1');"> <i class="glyphicon glyphicon-print "></i> Print</a><br>
              <div class="panel-body" id="area-1">
              <img class="image-rounded" src="images/G2.jpg" align="right" border="" style="width: 200px; height: 120px;" >
         <p style="text-align: left;"><h3>BEAUTY KOSMETIK</h3>
         <h3><b>(Laporan Penjualan)</b></h3>
         <h5>Email: beautykosmetik.id@gmail.com <br>
            Alamat : JL.Toddopuli Raya, Kel Paropo, Kec Panakkukang, Kota Makassar, Sulawesi Selatan
        </h5></P>  
              <table id="" class="table table-bordered table-striped" cellspacing="0" cellpadding="2" border="1" align='center'>
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Nama Lengkap</th>
                   <th style="text-align: center;">Kode Barang</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Tanggal</th>
                   <th style="text-align: center;">Jumlah Barang</th>
                   <th style="text-align: center;">Harga Barang</th>
                   <th style="text-align: center;">Total</th>
                </tr>
             </thead>  

             <?php 
             IF (Isset($_POST['cari']) || $_POST['tlgl1']!="" || $_POST['tlgl2']!="")  {
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_transaksi, a.tanggal, a.alamat, a.no_tlp, a.total_pembayaran, a.norek, b.nama_kelurahan, c.nama_kecamatan, d.nama_bank, e.nama FROM tbl_transaksi a, tbl_kelurahan b, tbl_kecamatan c, tbl_bank d, tbl_member e where a.kode_kelurahan=b.kode_kelurahan and a.kode_kecamatan=c.kode_kecamatan and a.kode_bank=d.kode_bank and a.kode_member=e.kode_member order by kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  // $total = str_replace(".", "",$r['harga']) * $r['jumlah']; 
                  $sub_total += $r['total_pembayaran'];
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td align='center'><?php echo $r['kode_transaksi']; ?></td>
                  <td align='center'><?php echo $r['tanggal']; ?></td>
                  <td align='center'><?php echo $r['nama']; ?></td>
                  <td align='center'><?php echo $r['alamat']; ?></td>
                  <td lign='center'><?php echo $r['nama_kelurahan']; ?></td>
                  <td lign='center'><?php echo $r['nama_kecamatan']; ?></td>
                  <td lign='center'><?php echo $r['nama_bank']; ?></td>
                  <td lign='center'><?php echo $r['norek']; ?></td>
                  <td align='right'><?php echo number_format($r['total_pembayaran']) ?></td>
                  <!-- <td align='right'><?php //echo number_format($r['jumlah']) ?></td> -->
                  <!-- <td align='right'><?php //echo number_format($total)?></td> -->
                  </tr>
              <?php 
              $no++; 
             } 
                 echo "
                <tr>
                  <td colspan='9' align='center'><b>Total</B></td>
                  <td align='right'><b>".number_format($sub_total)."</b></td>
                </tr>";

             } 
               ?>

              </table>
                <br><br>
               <p style="text-align: right;">
              <?php
                  $tgl= date("d-m-Y");
               echo "Makassar, Tanggal $tgl";
               ?>
               <br>Pimpinan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br> 
               <img class="image-rounded" src="images/logo2.jpg" align="right" style="width: 200px; height: 100px;" >
           
            </div>
          </div>


          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>

     <textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
   <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
   // window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
   // window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>