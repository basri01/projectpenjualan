<!-- Pajak 10% -->

<?php

$harga=50000;

$ppn=0.1;

$hitung_ppn =$harga*$ppn;

$harga_sekarang = $harga - $hitung_ppn;

echo" harga asli = $harga<br/> harga sesudah ppn = $harga_sekarang ";





$harga=$_POST['harga'];

$diskon=$harga * 0.1;

$harga_setelah_diskon=$harga - $diskon;

$pajak=$harga * 0.1;

$harga_setelah_pajak=$harga - $pajak;

$simpen=mysql_query("INSERT INTO produk values('','$harga','$harga_setelah_diskon','$$harga_setelah_pajak')");