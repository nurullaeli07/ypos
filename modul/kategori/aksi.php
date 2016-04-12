<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]","$act")) {
	$kat = anti($_POST['kat']);
	
	switch($_POST['tipe']) {
	case 'save':
	//cek ada yang sama apa nggak
	$cek = yposSQL('SHOW','ypos_kategori',"'x'","nama_kat='$kat'")->num_rows;
	if($cek > 0) {
		header("location:../../$set->folder_modul=$modul&msg=error&no=1&nama=$kat");
	} else {
		yposSQL('ADD','ypos_kategori',"ids='$_SESSION[yids]', nama_kat='$kat'");
		header("location:../../$set->folder_modul=$modul&msg=done");
	}
	break;
	case 'update':
	yposSQL('EDIT','ypos_kategori',"nama_kat='$kat'","idkat=$id");
	header("location:../../$set->folder_modul=$modul&msg=done");
	break;
	}
} else {
	echo $akses;
}
?>