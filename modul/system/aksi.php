<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]")) {
	@$nama = anti($_POST['nama']);
	@$url = anti($_POST['url']);
	@$folder = anti($_POST['folder']);
	@$aktif = anti($_POST['aktif']);
	@$menu = abs((int)($_POST['menu']));
	@$order = abs((int)($_POST['order']));
	@$level = anti($_GET['level']);
	
	switch($_POST['tipe']) {
	case 'saveMod':
	//cek ada yang sama apa nggak
	$cek = yposSQL('SHOW','ypos_modul',"'x'","nama_modul='$nama'")->num_rows;
	if($cek > 0) {
		header("location:../../index.php?$set->folder_modul=$modul&sub=modul&msg=error&no=1&nama=$nama");
	} else {
		yposSQL('ADD','ypos_modul',"nama_modul='$nama', modul_folder='$folder', aktif='1', createdBy='$_SESSION[yuser]', menuID=$menu");
		header("location:../../index.php?$set->folder_modul=$modul&sub=modul&msg=done");
	}
	break;
	case 'edMod':
		yposSQL('EDIT','ypos_modul',"nama_modul='$nama', modul_folder='$folder', aktif='$aktif', menuID=$menu","modulID=$id");
		header("location:../../index.php?$set->folder_modul=$modul&sub=modul&msg=done");
	break;
	case 'saveMenu':
	//cek ada yang sama apa nggak
	$cek = yposRec("'x'",'ypos_menu',"menu='$nama'",'','')->num_rows;
	if($cek > 0) {
		header("location:../../index.php?$set->folder_modul=$modul&sub=$act&msg=error&no=1&nama=$nama");
	} else {
		yposADD('ypos_menu',"menu='$nama', aktif='Y', sort=$order");
		header("location:../../index.php?$set->folder_modul=$modul&sub=menu&msg=done");
	}
	break;
	case 'edMenu':
		yposUP('ypos_menu',"menu='$nama', aktif='$aktif', sort=$order","menuID=$id");
		header("location:../../index.php?$set->folder_modul=$modul&sub=menu&msg=done");
	break;
	case 'saveLvl':
	//cek ada yang sama apa nggak
	$cek = yposRec("'x'",'ypos_level',"menu='$nama'",'','')->num_rows;
	if($cek > 0) {
		header("location:../../index.php?$set->folder_modul=$modul&sub=modul-akses&msg=error&no=1&nama=$nama");
	} else {
		yposADD('ypos_level',"lvl='$nama', aktif='Y', createdBy='$_SESSION[yuser]'");
		//set default akses ke modul profile
		$idLvl = yposSQL('SHOW','ypos_level','MAX(idlevel) AS maxID',"createdBy='$_SESSION[yuser]' && 1=1")->fetch_array();
		$JM = yposSQL('SHOW','ypos_modul','count(modulID) as JM',"1=1")->fetch_array();
			for ($i=0; $i < $JM['JM']; $i++) {
				if ($i == 0) { //default level, akses ke modul profile
					yposSQL('ADD','ypos_grouplvlmdl',"idlevel=$idLvl[maxID], modulID=8, userID='$_SESSION[yuser]'"); 
						} else {
					yposSQL('ADD','ypos_grouplvlmdl',"idlevel=$idLvl[maxID], userID='$_SESSION[yuser]'");
						}
					} //end for
		header("location:../../index.php?$set->folder_modul=$modul&sub=level&msg=done");
	}
	break;
	case 'edLvl':
		yposSQL('EDIT','ypos_level',"lvl='$nama', aktif='$aktif'","idlevel=$id");
		header("location:../../index.php?$set->folder_modul=$modul&sub=level&msg=done");
	break;
	/* case 'saveLM': 
	$JM = yposSQL('SHOW','ypos_modul','count(modulID) as JM',"1=1")->fetch_array();
	for ($i=0; $i < $JM['JM']; $i++) {
		if (isset($_POST['item'][$i])) {
			$cm = abs((int)($_POST['item'][$i]));
			$c = anti($c);
			$e = anti($e);
			$d = anti($d);
			yposSQL('ADD','ypos_grouplvlmdl',"idlevel=$id, modulID=$cm, create='$c', edit='$e', delete='$d', userID='$_SESSION[yuser]'");
		} else {
			yposSQL('ADD','ypos_grouplvlmdl',"idlevel=$id, create='N', edit='N', delete='N', userID='$_SESSION[yuser]'");
		}
		header("location:../../index.php?$set->folder_modul=$modul&sub=modul-akses&level=$level&id=$id&msg=done");
	}
	break; */
	case 'edLM':
	if ($id == 1) {
		yposSQL('DELETE','ypos_grouplvlmdl',"idlevel=$id && (modulID IS NULL OR modulID !=0)");
		//$JM = yposSQL('SHOW','ypos_modul','count(modulID) as JM',"1=1")->fetch_array();
	} else {
		yposSQL('DELETE','ypos_grouplvlmdl',"idlevel=$id");
		//$JM = yposSQL('SHOW','ypos_modul','count(modulID) as JM',"1=1")->fetch_array();
	}
	
	$m = $_POST['mod']; 
	if (isset($m)) {
			// lanjutkan dengan chek apa C statusnya checked apa tidak
			if (isset($_POST['C']) && isset($_POST['E']) && isset($_POST['D'])) {
				foreach ($m as $mods) {
					foreach ($_POST['C'] as $c) {
						foreach ($_POST['E'] as $e) {
							foreach ($_POST['D'] as $d) {
							yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', modulID='.$m.', c="Y", e="Y", d="Y", userID="CED"');
								} //end for d
							} //end for e
						} //end for c
					}//end for m
				} //end isset C & E
			else if (isset($_POST['C']) && isset($_POST['E'])) {
				foreach ($m as $mods) {
					foreach ($_POST['C'] as $c) {
						foreach ($_POST['E'] as $e) {
							yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', modulID='.$m.', c="Y", e="Y", userID="CE"');
							} //end for e
						} //end for c
					}//end for m
				} //end isset C & E
			else if (isset($_POST['C'])) {
				foreach ($m as $mods) {
					foreach ($_POST['C'] as $c) {
						yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', modulID='.$m.', c="Y", userID="C"');
						} //end for c
					} //end for m
				} //end isset c
			else {
				foreach ($m as $mods) {
						yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', modulID='.$m.', userID="M"');
				} //end for m
			}
		//yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', modulID='.$cm[$i].', c="Y", e="Y", d="Y", userID="all"');
	} else {
		yposSQL('ADD','ypos_grouplvlmdl','idlevel='.$id.', userID="NOMOD"');
	}
	// end isset M
	header("location:../../index.php?$set->folder_modul=$modul&sub=modul-akses&level=$level&id=$id&msg=done");
	break;
	case 'addRpt':
	$rpt = anti($_POST['nm']);
	$source = anti($_POST['source']);
	yposSQL('ADD','ypos_rptparam',"nama_report='$rpt', report_source='$source'");
	header("location:../../index.php?$set->folder_modul=$modul&sub=report-param&msg=done");
	break;
	/* case 'update':
	yposUP('ypos_modul',"nama_nama='$nama'","idnama=$id");
	header("location:../../index.php?$set->folder_modul=$modul&sub=modul&msg=done");
	break;*/
	} 
} else {
	echo $akses;
}
?>