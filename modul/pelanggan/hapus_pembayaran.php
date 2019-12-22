<?php
if (isset($_GET['id'])) {
	$id	  = $_GET['id'];
	$nm	  = $_GET['nm'];
	$st	  = $_GET['st'];
} else {
	die ("Error. No Id Selected! ");
}
?>

<?php
		if (!empty($id) && $id != "") {

			$query2 = mysqli_query ($koneksi, "DELETE FROM tbl_transaksi_detail WHERE id='$id' ");
			$query1 = mysqli_query ($koneksi, "UPDATE tbl_barang SET jumlah_barang=jumlah_barang+'$st' where kode_barang='$nm' ");

			?>
			<script language="javascript">document.location.href="?module=pelanggan&atc=bayar";</script>
			<?php
}else{
echo "gagal hapus data";
}
?>