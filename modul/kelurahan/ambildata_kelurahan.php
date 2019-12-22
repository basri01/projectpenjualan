<?php
include "../../database/koneksi.php";

$kode  = $_GET['kode_kecamatan'];

echo "<select name='kelurahan' id='divkedua' onchange='javascript:rubah(this)'>";
echo "<option></option>";
$rs = mysqli_query ($koneksi, "SELECT kode_kelurahan, nama_kelurahan FROM tbl_kelurahan WHERE (kode_kecamatan='$kode') order by nama_kelurahan asc");
while ($r = mysqli_fetch_array($rs))
    echo "<option value='$r[kode_kelurahan]'>$r[nama_kelurahan]</option>";
echo "</select>";

?>