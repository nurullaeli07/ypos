<?php
/* Short description for file
 * yPOS 2014 v1.0.0 - Aplikasi Stock Brang - Penjualan - Kasir Gratis 
 * @copyright	Copyright (C) 2014 remoxp a.k.a yudaadp@yLabs, All rights reserved.
 * @author		remoxp a.k.a Yuda <remo.xp89@gmail.com>
 * Warning :
   Anda bebas menyalin, menggunakan aplikasi ini untuk kepentingan pembelajaran, personal ataupun komersil.
   Dilarang keras menghapus credit bagian footer pada aplikasi ini.
   Dilarang menjualbelikan aplikasi yPOS 2014 ini, aplikasi ini GRATIS!
 */
session_start();
if (empty($_SESSION['yuser'])) {
	include 'login.php';
} else {
include 'home.php';
}
?>
