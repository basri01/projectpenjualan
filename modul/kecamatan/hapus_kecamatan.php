<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = "DELETE FROM tbl_kecamatan WHERE id_kecamatan = '$id'";
			$sql = mysqli_query ($koneksi, $query);
			?><script language="javascript">document.location.href="?module=kecamatan";</script><?php
}else{
echo "gagal hapus data";
}
?>