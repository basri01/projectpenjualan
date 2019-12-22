<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data Stok Barang</h3>

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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Kode Barang</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Stok Barang</th>
                   <th style="text-align: center;">Harga Barang</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM tbl_barang order by kode_barang");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td style="text-align: center;"><?php echo $r['kode_barang']; ?></td>
                  <td style="text-align: center;"><?php echo $r['nama_barang']; ?></td>
                  <td style="text-align: center;">
                    <?php 
                      if($r['jumlah_barang'] == ''){
                      echo 0; 
                    }else{
                      echo $r['jumlah_barang'];
                    }
                    ?>
                  </td>
                  <td align='right'>
                    <?php 
                      if($r['harga'] == ''){
                      echo 0; 
                    }else{
                      echo $r['harga'];
                    }
                    ?>
                  </td>
                  <td align="center">
                      <a href="?module=stock&atc=tambah&id=<?php echo $r['kode_barang']; ?>&ft=<?php echo $r['gambar']; ?>"><span class="glyphicon glyphicon-edit fa-lg"></span></a>
                  </td>
                  </tr>
              <?php 
                $no++;
               } ?>

              </table>
            </div>
          </div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>