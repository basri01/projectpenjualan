<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

<?php
 $sql=mysqli_query($koneksi, "select * from tbl_permohonan order by kode_permohonan DESC LIMIT 0,1");
 $data=mysqli_fetch_array($sql);
 $kodeawal=substr($data['kode_permohonan'],3,4)+1;
 if($kodeawal<10){
  $kode='P000'.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode='P000'.$kodeawal;
 }else{
  $kode='P00'.$kodeawal;
 }
?>

<script type="text/javascript">
function validasiFile(){
    var inputFile  = document.getElementById('file');
    var pathFile   = inputFile.value;
    var ekstensiOk = /(\.jpg)$/i;
    if(!ekstensiOk.exec(pathFile)){
        
      swal(
          "Oops...",
          "Silakan upload file yang memiliki ekstensi .jpg !",
          "error"
        )    

        inputFile.value = '';
        return false;
    }
}
</script>

<section class="content">
<div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data Permohonan Pemasangan Instalasi Listrik  </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget=""><i class="fa fa-remove"></i></button>
          </div>
        </div><br>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form method="post" enctype="multipart/form-data">
            <div class="col-md-6">
               <!-- /.form-group -->
              <div class="form-group">
                <label >Kode Permohonan</label>
                <input type="text" class="form-control" required placeholder="Kode Permohonan" name="kode" value='<?php echo $kode ?>' readonly>
              </div>

              <div class="form-group">
                <label >No KTP</label>
                <input type="text" class="form-control" required placeholder="No KTP" name="ktp" maxlength="16" onkeypress="return isNumberKey(event)">
              </div>

              <div class="form-group">
                <label >Nama Lengkap</label>
                <input type="text" class="form-control" required placeholder="Nama Lengkap" name="nama" >
              </div>

              <div class="form-group">
                <label>Jenis Kelamin</label>
                  <select class="form-control select1" name="jenis">
                    <option></option>
                    <option value='Pria'>Pria</option>
                    <option value='Wanita'>Wanita</option>
                  </select>
              </div>

              <div class="form-group">
                <label >Alamat Pemasangan</label>
                <input type="text" class="form-control" required placeholder="Alamat Pemasangan" name="alamat" >
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control select1" required onchange="javascript:rubah(this)" name='kecamatan'>
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
                  <label>Kelurahan</label>
                    <select class="form-control select1" id='divkedua' required name='kelurahan'> 
                    </select>
               </div>

              <div class="form-group">
                <label >No HP</label>
                <input type="text" class="form-control" required placeholder="No HP" name="tlp" maxlength="13" onkeypress="return isNumberKey(event)">
              </div>

              <div class="form-group">
                <label >Email</label>
                <input type="email" class="form-control" required placeholder="Email" name="email" >
              </div>

              <div class="form-group">
                <label >Upload Foto KTP</label>
                <input type="file" class="form-control" id='file' placeholder="Foto KTP" required name="Foto" onchange="return validasiFile()">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div><br><br>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-14 col-md-offset-5">
              <button class="btn btn-primary" type="submit" name="OK"> Kirim</button>
              <button class="btn btn-danger" type="reset"> Batal </button>
            </div>
          </div>
          <!-- /.row -->
        </div><br>
        <!-- /.box-body -->
        </form>
    </section>

<?php
$query1 = mysqli_query ($koneksi,"SELECT * FROM tbl_permohonan");
$hasil  = mysqli_fetch_array ($query1);
//$ketemu = mysqli_num_rows($query1);

//$hasil['no_ktp'];
IF(Isset($_POST['OK']))  {
  $target          = "Foto/".basename($_FILES['Foto']['name']);
  $kode            = addslashes (strip_tags ($_POST['kode']));
  $ktp             = addslashes (strip_tags ($_POST['ktp']));
  $nama            = addslashes (strip_tags ($_POST['nama']));
  $jenis           = addslashes (strip_tags ($_POST['jenis']));
  $alamat          = addslashes (strip_tags ($_POST['alamat']));
  $kecamatan       = addslashes (strip_tags ($_POST['kecamatan']));
  $kelurahan       = addslashes (strip_tags ($_POST['kelurahan']));
  $tlp             = addslashes (strip_tags ($_POST['tlp']));
  $email           = addslashes (strip_tags ($_POST['email']));
  $Foto            = $_FILES['Foto']['name'];
  $status          = 'Sedang di proses';

  move_uploaded_file($_FILES['Foto']['tmp_name'], $target);

  if($ktp==$hasil['no_ktp']){
  echo '<script language="javascript">
      swal(
          "Oops...",
          "Maaf Permohonan Anda Sedang Di proses Mohon Sabar",
          "error"
        )          
    </script>';
}else{

  $query = "INSERT INTO tbl_permohonan(kode_permohonan,no_ktp,nama,jenis_kelamin,kode_kecamatan,kode_kelurahan,alamat,no_tlp,status,foto,tanggal,email) VALUES ('$kode','$ktp','$nama','$jenis','$kecamatan','$kelurahan','$alamat','$tlp','$status','$Foto',now(),'$email')";
  $sql = mysqli_query ($koneksi, $query);

  if ($sql) {
    
    echo "<script language='javascript'> 
      swal(
      'successful!',
      'Data Berhasil Terkirim',
      'success'
      ).then((result) => {
      if (result) {
        window.location.href='index.php?module=pengunjung&atc=tambah';
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
?>