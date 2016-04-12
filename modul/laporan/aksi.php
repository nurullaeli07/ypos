<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]")) {
	$rpt = anti($_POST['rpt']);
	$str = anti($_POST['start']);
	$end = anti($_POST['end']);
	
	$rpt = yposSQL('SHOW','ypos_rptparam','*',"idparam=$rpt && 1=1")->fetch_array();
	header("location:../../$rpt[report_source].php?rpt=$rpt[nama_report]&start=$str&end=$end");
} else {
	echo $akses;
}
?>