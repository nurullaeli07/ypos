<?php
ini_set('display_errors','On'); //nilai ON untuk kepentingan development, mengetahui error - set ke OFF jika sudah di server production
error_reporting(E_ALL); //^E_NOTICE^E_STRICT^E_DEPRECATED);
date_default_timezone_set("Asia/Jakarta"); //setinggan untuk timezone
	if (isset($_SESSION['yuser'])) {
			$set = yposSQL('SHOW','ypos_settings','*',"ids=$_SESSION[yids] && 1=1")->fetch_object();
		}
@$getDate = date('Y-m-d'); //tanggal sekarang
@$ip = $_SERVER['REMOTE_ADDR'];
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
@$referrer = getenv('HTTP_REFERER');
@$url = $_SERVER['REQUEST_URI'];
@$site = $_SERVER['SERVER_NAME'];
@$jam = date("H:i:s");
@$id = abs((int)($_GET['id'])); //nilai dari id dengan tipe int, digunakan untuk mengedit semua modul
@$kode = anti($_GET['id']); //nilai dari id dengan tipe varchar, digunakan untuk mengedit semua modul
@$modul = anti($_GET[$set->folder_modul]); //untuk mengambil nilai modul
@$act = $_GET['act']; //untuk mengambil nilai act (action)
@$akses = '<b>Anda tidak ada  hak untuk akses modul ini, silahkan hubungi administrator!</b>';
@$checked = 'checked="checked"';
@$disabled = 'disabled="disabled"';
?>