<section class="content">
<div class="row">
        <div class="col-md-12">
           <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Stok Barang</a></li>
              <li><a href="#tab_2" data-toggle="tab">Stok Barang Masuk</a></li>
              <li><a href="#tab_3" data-toggle="tab">Stok Barang Keluar</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="tab_1"><br>
               <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No</th>
                   <th style="text-align: center;">Kode</th>
                   <th style="text-align: center;">Nama</th>
                   <th style="text-align: center;">Stok</th>
                   <th style="text-align: center;">Harga</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.stock, a.harga_jual, b.kode_bahan_baku, b.nama_bahan_baku FROM tbl_stock_bahan_baku a, tbl_bahan_baku b where a.kode_bahan_baku=b.kode_bahan_baku order by kode_bahan_baku");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td><?php echo $r['kode_bahan_baku']; ?></td>
                  <td><?php echo $r['nama_bahan_baku']; ?></td>
                  <td><?php echo $r['stock']; ?></td>
                  <td><?php echo $r['harga_jual']; 
                        // $harga=50000;

                        // $ppn=0.1;

                        // $hitung_ppn =$harga*$ppn;

                        // $harga_sekarang = $harga - $hitung_ppn;

                        // echo" harga asli = $harga<br/> harga sesudah ppn = $harga_sekarang ";





                  ?></td>
                </tr>
              <?php 
                $no++;
               } ?>

              </table>
            </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2"><br>
               <div class="table-responsive">
                <table id="example4" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No</th>
                   <th style="text-align: center;">Kode</th>
                   <th style="text-align: center;">Nama</th>
                   <th style="text-align: center;">Tanggal</th>
                   <th style="text-align: center;">Jumlah</th>
                   <th style="text-align: center;">Harga</th>
                   <th style="text-align: center;">Total</th>
                </tr>
             </thead>  

             <?php 
                $nooo += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_bahan_baku_masuk, a.tanggal, a.harga, a.jumlah, b.kode_bahan_baku, b.nama_bahan_baku FROM tbl_bahan_baku_masuk a, tbl_bahan_baku b where a.kode_bahan_baku=b.kode_bahan_baku order by kode_bahan_baku_masuk");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $total = str_replace(".", "",$r[jumlah])*str_replace(".", "",$r[harga]);


                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $nooo; ?></td>
                  <td><?php echo $r['kode_bahan_baku_masuk']; ?></td>
                  <td><?php echo $r['nama_bahan_baku']; ?></td>
                  <td><?php echo $r['tanggal']; ?></td>
                  <td><?php echo $r['jumlah']; ?></td>
                  <td><?php echo $r['harga']; ?></td>
                  <td><?php echo number_format($total)

                      


                  ?></td>
                  </tr>
              <?php 
                $nooo++;
               } ?>

              </table>
            </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3"><br>
              <div class="table-responsive"> 
               <table id="example5" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No</th>
                   <th style="text-align: center;">Kode</th>
                   <th style="text-align: center;">Nama</th>
                   <th style="text-align: center;">Nama Bahan</th>
                   <th style="text-align: center;">Tanggal</th>
                   <th style="text-align: center;">Jumlah</th>
                   <th style="text-align: center;">Total</th>
                </tr>
             </thead>  

             <?php 
                $noo += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_transaksi_bk, a.tanggal, a.jumlah_barang, a.harga, b.kode_bahan_baku, b.nama_bahan_baku, c.kode_user, c.nama FROM tbl_bahan_baku_keluar a, tbl_bahan_baku b, tbl_user c where a.kode_bahan_baku=b.kode_bahan_baku and a.kode_user=c.kode_user order by kode_transaksi_bk");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                  $total = $r[jumlah]*$r[harga];


                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $noo; ?></td>
                  <td><?php echo $r['kode_transaksi_bk']; ?></td>
                  <td><?php echo $r['nama']; ?></td>
                  <td><?php echo $r['nama_bahan_baku']; ?></td>
                  <td><?php echo $r['tanggal']; ?></td>
                  <td><?php echo $r['jumlah_barang']; ?></td>
                  <td><?php echo $r['harga']; ?></td>
                  </tr>
              <?php 
                $noo++;
               } ?>

              </table>
            </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
    </section>