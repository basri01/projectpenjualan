<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
	$foto = $_GET['foto']; 
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {
		
			$query = "DELETE FROM tbl_user WHERE kode_user = '$id'";
			$sql = mysqli_query ($koneksi, $query);

			?><script language="javascript">document.location.href="?module=user";</script><?php
}else{
echo "gagal hapus data";
}
?>