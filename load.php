<?php //tampilkan konten berdasarkan hak akses pada modul by yuda
if (!defined('YBASE')) exit ('Now Allowed');
$mod = yposSQL('SHOW','ypos_modul','nama_modul, modul_folder as modDIR',"modul_folder='$modul' && aktif='1' && 1=1",'nama_modul');
if (!empty($modul)) {
	if (NULL !== cekAkses("$modul","$_SESSION[ylevel]","$act")) {
while($getMod = $mod->fetch_array()) {
	if ($modul == $getMod['modDIR']) {
	include "$set->folder_modul/$getMod[modDIR]/$getMod[modDIR].php";
	$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0];
	$tend = $mtime; // Calculate Difference 
	$totaltime = ($tend - $tstart); // Output the result 
	printf ("<center><i>Page loaded %f seconds.", $totaltime. '</i></center>');
			} //end if 
		} //end while
	} else {
		echo $akses;
	}
}
if (@$_GET['page'] == 'about') {
	include 'about.php';
}
?>