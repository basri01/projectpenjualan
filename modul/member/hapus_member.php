<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = "DELETE FROM tbl_member WHERE kode_member = '$id'";
			$sql = mysqli_query ($koneksi, $query);
			unlink("Foto/$ft");

			?><script language="javascript">document.location.href="?module=member";</script><?php
}else{
echo "gagal hapus data";
}
?>