<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data Barang</h3>

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
              <a href="index2.php?module=barang&atc=tambah" class="btn btn-danger btn-md"> <i class="glyphicon glyphicon-plus "></i> Tambah</a> <br><br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Kode Barang</th>
                   <th style="text-align: center;">Nama Barang</th>
                   <th style="text-align: center;">Gambar Barang</th>
                   <th style="text-align: center;">Harga Barang</th>
                   <th style="text-align: center;">Tanggal Kadaluarsa</th>
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
                  <td style="text-align: center;"> <img src="foto/<?php echo $r['gambar']; ?>" with="100px" height="75px" /> </td>
                  <td style="text-align: center;"><?php echo $r['harga']; ?></td>
                  <td style="text-align: center;"><?php echo $r['tgl_kadaluarsa']; ?></td>
                  <td align="center">
                      <a href="?module=barang&atc=edit&id=<?php echo $r['kode_barang']; ?>&ft=<?php echo $r['gambar']; ?>"> <span class="glyphicon glyphicon-edit fa-lg"></span></a>
                      <a href="?module=barang&atc=hapus&id=<?php echo $r['kode_barang']; ?>&ft=<?php echo $r['gambar']; ?>"  onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><span class="glyphicon glyphicon-trash fa-lg"></span></a>
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