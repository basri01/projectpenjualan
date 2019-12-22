<?php

$harga=50000;

$ppn=0.1;

$hitung_ppn =$harga*$ppn;

$harga_sekarang = $harga - $hitung_ppn;

echo" harga asli = $harga<br/> harga sesudah ppn = $harga_sekarang ";