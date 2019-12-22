<section class="content">
<div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data Member</h3>

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
              <a href="index2.php?module=member&atc=tambah" class="btn btn-danger btn-md"> <i class="glyphicon glyphicon-plus "></i> Tambah</a> <br><br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th style="text-align: center;">No.</th>
                   <th style="text-align: center;">Kode Member</th>
                   <th style="text-align: center;">No. KTP</th>
                   <th style="text-align: center;">Nama Lengkap</th>
                   <th style="text-align: center;">Alamat Lengkap</th>
                   <th style="text-align: center;">Jenis Kelamin</th>
                   <th style="text-align: center;">No. Hp</th>
                   <th style="text-align: center;">Aksi</th>
                </tr>
             </thead>  

             <?php 
                $no += 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM tbl_member order by kode_member");
                while ( $r = mysqli_fetch_assoc( $sql ) ) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo  $no; ?></td>
                  <td><?php echo $r['kode_member']; ?></td>
                  <td><?php echo $r['no_ktp']; ?></td>
                  <td><?php echo $r['nama']; ?></td>
                  <td><?php echo $r['alamat']; ?></td>
                  <td><?php echo $r['jenis_kelamin']; ?></td>
                  <td><?php echo $r['no_hp']; ?></td>
                  <td align="center">
                      <a href="?module=member&atc=edit&id=<?php echo $r['kode_member']; ?>"><span class="glyphicon glyphicon-edit fa-lg"></span></a>
                      <a href="?module=member&atc=hapus&id=<?php echo $r['kode_member']; ?>"  onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><span class="glyphicon glyphicon-trash fa-lg"></span></a>
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