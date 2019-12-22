<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = "DELETE FROM tbl_bank WHERE kode_bank = '$id'";
			$sql = mysqli_query ($koneksi, $query);
			?><script language="javascript">document.location.href="?module=bank";</script><?php
}else{
echo "gagal hapus data";
}
?>