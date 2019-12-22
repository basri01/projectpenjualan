<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi Pembayaran</h3>

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
              <a href="index2.php?module=transaksi&atc=tambah" class="btn btn-danger btn-md"> <i class="glyphicon glyphicon-plus "></i> Tambah</a> <br><br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Kode Member</th>
                   <th style="text-align: center;">Tanggal Pembelian</th>
                   <th style="text-align: center;">Nama Lengkap</th>
                   <th style="text-align: center;">Alamat Lengkap</th>
                   <th style="text-align: center;">Total Pembayaran</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT a.kode_transaksi, a.tanggal, a.alamat, a.total_pembayaran, b.kode_member, b.nama FROM tbl_transaksi a, tbl_member b where a.kode_member=b.kode_member order by kode_transaksi");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td style="text-align: center;"><?php echo $r['kode_transaksi']; ?></td>
                  <td style="text-align: center;"><?php echo $r['tanggal']; ?></td>
                  <td style="text-align: center;"><?php echo $r['nama']; ?></td>
                  <td style="text-align: center;"><?php echo $r['alamat']; ?></td>
                  <td style="text-align: center;"><?php echo $r['total_pembayaran']; ?></td>
                  <td align="center">
                      <a href="?module=transaksi&atc=lihat&id=<?php echo $r['kode_transaksi']; ?>"><span class="glyphicon glyphicon-eye-open fa-lg"></span></a>
                      <a href="?module=transaksi&atc=edit&id=<?php echo $r['kode_transaksi']; ?>"><span class="glyphicon glyphicon-edit fa-lg"></span></a>
                      <a href="?module=transaksi&atc=hapus&id=<?php echo $r['kode_transaksi']; ?>&nm=<?php echo $r['kode_barang']; ?>&st=<?php echo $r['jumlah']; ?>"  onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><span class="glyphicon glyphicon-trash fa-lg"></span></a>
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