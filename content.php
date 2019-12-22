<?php
if($_GET['module']=='home' || $_GET['module']==''){
include"modul/home/home.php";

}else if($_GET['module']=='user'){
if($_GET['atc']=='tambah'){
include"modul/user/input_user.php";
}else if($_GET['atc']=='hapus'){
include"modul/user/hapus_user.php";
}else if($_GET['atc']=='edit'){
include"modul/user/edit_user.php";
}else{
include"modul/user/data_user.php";
}

}else if($_GET['module']=='kelurahan'){
if($_GET['atc']=='tambah'){
include"modul/kelurahan/input_kelurahan.php";
}else if($_GET['atc']=='edit'){
include"modul/kelurahan/edit_kelurahan.php";
}else if($_GET['atc']=='hapus'){
include"modul/kelurahan/hapus_kelurahan.php";
}else{
include"modul/kelurahan/data_kelurahan.php";
}

}else if($_GET['module']=='kecamatan'){
if($_GET['atc']=='tambah'){
include"modul/kecamatan/input_kecamatan.php";
}else if($_GET['atc']=='edit'){
include"modul/kecamatan/edit_kecamatan.php";
}else if($_GET['atc']=='hapus'){
include"modul/kecamatan/hapus_kecamatan.php";
}else{
include"modul/kecamatan/data_kecamatan.php";
}

}else if($_GET['module']=='barang'){
if($_GET['atc']=='tambah'){
include"modul/barang/input_barang.php";
}else if($_GET['atc']=='hapus'){
include"modul/barang/hapus_barang.php";
}else if($_GET['atc']=='edit'){
include"modul/barang/edit_barang.php";
}else{
include"modul/barang/data_barang.php";
}

}else if($_GET['module']=='stock'){
if($_GET['atc']=='tambah'){
include"modul/stock/tambah_stock.php";
}else if($_GET['atc']=='kosong'){
include"modul/stock/kosong.php";
}else{
include"modul/stock/data_stock.php";
}

}else if($_GET['module']=='barang_masuk'){
if($_GET['atc']=='tambah'){
include"modul/barang_masuk/input_barang_masuk.php";
}else if($_GET['atc']=='hapus'){
include"modul/barang_masuk/hapus_barang_masuk.php";
}else if($_GET['atc']=='edit'){
include"modul/barang_masuk/edit_barang_masuk.php";
}else if($_GET['atc']=='laporan'){
include"modul/barang_masuk/laporan_barang_masuk.php";
}else{
include"modul/barang_masuk/data_barang_masuk.php";
}

}else if($_GET['module']=='transaksi'){
if($_GET['atc']=='tambah'){
include"modul/transaksi/input_transaksi.php";
}else if($_GET['atc']=='hapus'){
include"modul/transaksi/hapus_transaksi.php";
}else if($_GET['atc']=='hapus_detail'){
include"modul/transaksi/hapus_transaksi_detail.php";
}else if($_GET['atc']=='edit'){
include"modul/transaksi/edit_transaksi.php";
}else if($_GET['atc']=='laporan'){
include"modul/transaksi/laporan_transaksi.php";
}else if($_GET['atc']=='laporan_pendapatan'){
include"modul/transaksi/laporan_pendapatan.php";
}else if($_GET['atc']=='lihat'){
include"modul/transaksi/lihat_transksi.php";
}else{
include"modul/transaksi/data_transaksi.php";
}

}else if($_GET['module']=='member'){
if($_GET['atc']=='tambah'){
include"modul/member/input_member.php";
}else if($_GET['atc']=='hapus'){
include"modul/member/hapus_member.php";
}else if($_GET['atc']=='edit'){
include"modul/member/edit_member.php";
}else{
include"modul/member/data_member.php";
}

}else if($_GET['module']=='pelanggan'){
if($_GET['atc']=='tambah'){
include"modul/pelanggan/input_pelanggan.php";
}else if($_GET['atc']=='pesan'){
include"modul/pelanggan/pesan_pelanggan.php";
}else if($_GET['atc']=='bayar'){
include"modul/pelanggan/pembayaran_pelanggan.php";
}else if($_GET['atc']=='hapus'){
include"modul/pelanggan/hapus_pembayaran.php";
}else if($_GET['atc']=='print'){
include"modul/pelanggan/print.php";
}else if($_GET['atc']=='lihat'){
include"modul/pelanggan/lihat.php";
}else{
include"modul/pelanggan/data_pelanggan.php";
}

}else if($_GET['module']=='bank'){
if($_GET['atc']=='tambah'){
include"modul/bank/input_bank.php";
}else if($_GET['atc']=='hapus'){
include"modul/bank/hapus_bank.php";
}else if($_GET['atc']=='edit'){
include"modul/bank/edit_bank.php";
}else{
include"modul/bank/data_bank.php";
}

}
?>