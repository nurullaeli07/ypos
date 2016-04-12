<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]","$act")) {
	$nama = anti($_POST['nm']); $hp = anti($_POST['hp']); 
	$pass = md5($_POST['pass']); $lvl = anti($_POST['level']);
	$user = anti($_POST['username']); 
	
	switch(@$_POST['tipe']) {
	case 'add':
	yposSQL('ADD','ypos_users',"username='$user', nama_lengkap='$nama', pass='$pass', hp='$hp', level='$lvl', ids='$_SESSION[yids]'");
	header("location:../../index.php?$set->folder_modul=$modul&msg=sucessfully");
	break;
	case 'edit':
	if (!empty($_POST['pass'])) {
		yposSQL('EDIT','ypos_users',"nama_lengkap='$nama', pass='$pass', hp='$hp', level='$lvl'","username='$user' && 1=1");
	} else {
		yposSQL('EDIT','ypos_users',"nama_lengkap='$nama', hp='$hp', level='$lvl'","username='$user' && 1=1");
	}
	header("location:../../index.php?$set->folder_modul=$modul&msg=sucessfully");
	break;
	} //end case
} else {
	echo $akses;
}
?>