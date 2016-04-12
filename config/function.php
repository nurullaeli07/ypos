<?php
//fungsi anti_inject
function anti($data){
  @$filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  @$filter_sql->$mysqli->real_escape_string;
  return $filter_sql;
}

function yposSQL($sql, $table, $field, $where=NULL, $order=NULL, $group=NULL) {
	global $mysqli;
	switch($sql) {
		case 'SHOW':
		if (empty($order) && empty($group)) {
			$query = $mysqli->query("SELECT $field FROM $table WHERE $where");
		} elseif (empty($group)) {
			$query = $mysqli->query("SELECT $field FROM $table WHERE $where ORDER BY $order");
		} else {
			$query = $mysqli->query("SELECT $field FROM $table WHERE $where GROUP BY $group ORDER BY $order");
		}
		break;
		case 'ADD':
			$query = $mysqli->query("INSERT INTO $table SET $field");
		break;
		case 'EDIT':
			$query = $mysqli->query("UPDATE $table SET $field WHERE $where");
		break;
		case 'DELETE':
			$query = $mysqli->query("DELETE FROM $table WHERE $field");
		break;
		} // end case
		return $query;
	} // end function yposSQL
	
//fungsi generate auto kode by yuda
function genCode($first, $field, $table, $char){ //kode awal, field kode, nama table dan panjang kode
global $mysqli;
	$get = yposSQL('SHOW',"$table","MAX(RIGHT($field, $char)) as maxID",'1=1',"$field");
	$code = $get->fetch_array(); 
	$genKode = $code['maxID']; 
	$getCode = (int) substr($genKode, 1, $char); 
	$getCode++; 
	$theCode = $first.sprintf("%0".$char."s", $getCode); 
	return $theCode; 
}

function cekAkses ($modul, $level, $act=NULL) {
	global $mysqli;
	switch($act) {
		case 'new' or 'add':
		$akses = yposSQL('SHOW','ypos_modul a, ypos_grouplvlmdl b',"'x'","a.modulID=b.modulID && modul_folder='$modul' && idlevel=$level && aktif='1' && c='Y'")->fetch_array();
		break;
		case 'edit':
		$akses = yposSQL('SHOW','ypos_modul a, ypos_grouplvlmdl b',"'x'","a.modulID=b.modulID && modul_folder='$modul' && idlevel=$level && aktif='1' && e='Y'")->fetch_array();
		break;
		case 'delete':
		$akses = yposSQL('SHOW','ypos_modul a, ypos_grouplvlmdl b',"'x'","a.modulID=b.modulID && modul_folder='$modul' && idlevel=$level && aktif='1' && d='Y'")->fetch_array();
		break;
		default :
		$akses = yposSQL('SHOW','ypos_modul a, ypos_grouplvlmdl b',"'x'","a.modulID=b.modulID && modul_folder='$modul' && idlevel=$level && aktif='1'")->fetch_array();
		break;
	}
	return $akses;
}

function cekBrowser() {
	if	(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')){
    		$browser = 'Netscape';
	} else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')){
    		$browser = 'Firefox';
	} else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')){
    		$browser = 'Chrome';
	} else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')){
    		$browser = 'Opera';
	} else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')){
    		$browser = 'Internet Explorer';
	} else  {
			$browser = 'Other';
        }
		return $browser;
}

function LgnLogs($user,$ip,$host,$agent,$ket) {
	global $mysqli;
	yposSQL('ADD','ypos_lgnhistories',"username='$user', ip='$ip', hostname='$host', browser='$agent',ket='$ket'");
}

function cekSession($ssi) {
	global $mysqli;
	$ip = $_SERVER['REMOTE_ADDR'];
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	
	$s = yposSQL('SHOW','ypos_users','sessionID',"username='$ssi' && 1=1")->fetch_array();
		if ($s['sessionID'] != $_SESSION['ysess']) {
		LgnLogs($_SESSION['yuser'],$ip,$hostname,cekBrowser(),'OUT');
		session_destroy();
		echo 'Logout . . .';
		echo '<meta http-equiv="refresh" content="0; url=index.php">';
	}
	
}
//fungsi menampilkan record by yuda
function yposRec($field, $table, $where, $order, $sort) {
	global $mysqli;
	if($order == '') {
		$get = $mysqli->query("SELECT $field FROM $table WHERE $where");
	} else {
		$get = $mysqli->query("SELECT $field FROM $table WHERE $where ORDER BY $order $sort");
	}
	return $get;
	
}

//fungsi untuk insert data
function yposADD($table, $field) {
	global $mysqli;
	$add = $mysqli->query("INSERT INTO $table SET $field");
	return $add;
}
//fungsi untuk update
function yposUP($table, $field, $where) {
	global $mysqli;
	$get = $mysqli->query("UPDATE $table SET $field WHERE $where");
	return $get;
}
//Fngsi untuk delete records
function yposDEL($table, $where) {
	global $mysqli;
	$del = $mysqli->query("DELETE FROM $table WHERE $where");
	return $del;
}

//tanggal indo
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}

}

function idr($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}?>