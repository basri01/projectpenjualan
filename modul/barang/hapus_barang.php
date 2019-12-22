<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
	$ft	  = $_GET['ft'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = mysqli_query ($koneksi,"DELETE FROM tbl_barang WHERE kode_barang = '$id'");
			unlink("foto/$ft");

			?><script language="javascript">document.location.href="?module=barang";</script><?php
}else{
echo "gagal hapus data";
}
?>