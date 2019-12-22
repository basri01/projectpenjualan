<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
	$idd  = $_GET['idd'];
	$ss	  = $_GET['ss'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = "DELETE FROM tbl_barang_masuk WHERE kode_bm = '$id'";
			$sql = mysqli_query ($koneksi, $query);

			$query1 = mysqli_query($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang-'$ss' where kode_barang='$idd' ");

			?><script language="javascript">document.location.href="?module=barang_masuk";</script><?php
}else{
echo "gagal hapus data";
}
?>