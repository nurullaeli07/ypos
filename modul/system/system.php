<?php 
if (!defined('YBASE')) exit ('Now Allowed');
include 'notification.php';
switch(@$_GET['sub']) {
	case 'modul-akses':
	$l = anti($_GET['level']);
	echo '<h3>Settings Hak Akses '.$l.'</h3>';
	echo '<hr width="800" align="left">';
	echo '<br/><b>Modul Akses : </b><br/>'; 
	$qm = yposSQL('SHOW','ypos_modul LEFT JOIN ypos_grouplvlmdl ON ypos_modul.`modulID`=ypos_grouplvlmdl.`modulID` OR ypos_grouplvlmdl.`modulID` IS NULL INNER JOIN ypos_level ON ypos_level.`idlevel`=ypos_grouplvlmdl.`idlevel`','ypos_modul.`modulID` AS modID, ypos_modul.nama_modul,idGroupLM, ypos_grouplvlmdl.modulID,c,e,d, ypos_grouplvlmdl.idlevel, ypos_level.`lvl`',"ypos_modul.modulID != 0 && ypos_grouplvlmdl.idlevel=$id && lvl='$l'",'ypos_modul.nama_modul','ypos_modul.nama_modul');
?>
<form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul.'&sub='.$act.'&level='.anti($_GET['level']).'&id='.$id;?>" name="form" id="form">
<table>
<tr>
<th rowspan="2">No</th>
<th colspan="2" rowspan="2" align="left">Enable Modules</th>
<th colspan="3" align="center">Permission</th>
<th rowspan="2">Edit Permission</th>
</tr>
<tr>
  <th>C</th>
  <th>E</th>
  <th>D</th>
  </tr>
<tr>
<tr>
<?php
$no = 1;
while ($rm = $qm->fetch_array()) {?>
<tr>
<td align='center' width="7"><?php echo $no;?></td>
<td width="10"><input type='checkbox' class="Blocked" name='mod[]' value='<?php echo $rm['modID'];?>' <?php //if ($cekM > 0) { 
if ($rm['modID'] == $rm['modulID']) { echo $checked; }//}?>></td>
<td><?php echo $rm['nama_modul'];?></td>
<td><input type='checkbox' name='C[]' <?php if ($rm['c'] == 'Y') { echo $checked; };?> disabled="disabled"/></td>
<td><input type='checkbox' name='E[]' <?php if ($rm['e'] == 'Y') { echo $checked; };?>/ disabled="disabled"></td>
<td><input type='checkbox' name='D[]' <?php if ($rm['d'] == 'Y') { echo $checked; };?> disabled="disabled"/></td>
<td align="center"><a href="#dialog-permission" id="<?php echo $rm['idGroupLM'];?>" class="proses" data-toggle="modal"><img src="images/icon-edit-on.png" border="0" width="20" height="20" /></a></td>
</tr>
<?php $no++; };?>
<tr>
<td><button type="reset" name="reset">Reset</button></td>
<td><button type="submit" name="save">Simpan</button></td>
<td><button onclick="">Back</button></td>
</tr>
</table>
<input type="hidden" name="tipe" value="edLM"/>
</form>
<i>*C = Create, E= Edit, D= Delete</i>
<!-- awal untuk modal dialog -->
<div id="dialog-permission" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">[x]</button>
		<h3 id="myModalLabel">Edit Permission</h3>
	</div>
	<!-- tempat untuk menampilkan form mahasiswa -->
	<div class="modal-body"></div>
	<div class="modal-footer">
	<button id="simpan-permission" class="submit">Update</button>
	</div>
</div>
<!-- akhir kode modal dialog -->
<?php
	break;
	case 'level':
	if (isset($_GET['op'])) {
	$ed = yposSQL('SHOW','ypos_level','*',"idlevel=$id && 1=1")->fetch_array();
	};?>
	<form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul.'&sub='.$act.'&id='.@$ed['idlevel'];?>" name="form" id="form">
    <fieldset class="atas">
<table>
		<tr>
		<th><?php if (isset($_GET['op'])) { echo 'Edit'; } else { echo 'New';}?> Level</th>
		<td><input type="text" class="inp-form" name="nama" placeholder="Level Name" value="<?php echo @$ed['lvl'];?>" required="required" size="30"/></td>
        <td>
        <?php if (isset($_GET['op'])) { echo "<input type='text' name='aktif' value='$ed[aktif]' size='2' "; if ($ed['idlevel'] == 1) { 
		echo 'disabled=disabled';
		}; echo '/>';}?></td>
        <td><button type="submit" name="save" value="ok">Simpan</button><?php if (isset($_GET['op'])) {?>
        <a href="<?php echo $set->folder_modul.'='.$modul;?>&sub=<?php echo $act;?>">Back</a><?php };?></td></tr>
</table>
</fieldset>
<input type="hidden" name="tipe" value="<?php if (isset($_GET['op'])) { echo 'edLvl'; } else { echo 'saveLvl';};?>">
</form>
<table id="dataTable">
<tr id="tbl">
<th width="30">No</th>
<th width="200">Level</th>
<th width="25">Aktif</th>
<th width="100">Modul Akses</th>
<th width="50"></th></tr>
<?php
$no =1;
$q = yposSQL('SHOW','ypos_level','*','1=1','lvl');
				while ($r = $q->fetch_array()) {?>
				<tr align="center">			
                <td><?php echo $no;?></td>
					<td><?php echo $r['lvl'];?></td>
                    <td align="center"><?php echo $r['aktif'];?></td>
                    <td><a href="<?php echo $set->folder_modul.'='.$modul?>&sub=modul-akses&op=ed&id=<?php echo $r['idlevel'].'&level='.$r['lvl'];?>">Set</a></td>
					<td align="center">
					<a href="<?php echo $set->folder_modul.'='.$modul?>&sub=level&op=ed&id=<?php echo $r['idlevel'];?>">Edit</a>
					</td>
				</tr>
                <?php
				$no++;
				}?>
				
				</table>
<?php
	break;
	case 'modul':
	if (isset($_GET['op'])) {
	$ed = yposSQL('SHOW','ypos_modul a, ypos_menu b','a.modulID, a.nama_modul, a.modul_folder, a.aktif, b.menuID',"a.modulID=$id and a.menuID=b.menuID and 1=1")->fetch_array();
	};?>
	<form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul.'&sub='.$act.'&id='.$ed['modulID'];?>" name="form" id="form">
    <fieldset class="atas">
<table>
		<tr>
		<th><?php if (isset($_GET['op'])) { echo 'Edit'; } else { echo 'New';}?> Modul</th>
		<td><input type="text" class="inp-form" name="nama" placeholder="Nama Modul" value="<?php echo @$ed['nama_modul'];?>" required="required" size="30"/> <input type="text" required="required" name="folder" size="30" value="<?php echo @$ed['modul_folder'];?>"/></td>
        <td>
        <?php if (isset($_GET['op'])) {?> <input type="text" name="aktif" value="<?php echo $ed['aktif'];?>" size="2"/><?php };?> Set in <select name="menu"><option value="#">Pilih Menu</option>
    <?php
	if (isset($_GET['op'])) { 
    	$m = yposSQL('SHOW','ypos_menu','menuID, menu',"1=1",'menu'); //jika kondisi edit
	} else {
		$m = yposSQL('SHOW','ypos_menu','menuID, menu',"aktif='Y' and 1=1",'menu'); //jika kondisi create
	}
	while ($rm = $m->fetch_array()) {
		if ($ed['menuID'] == $rm['menuID']) {
			echo "<option value='$rm[menuID]' selected='selected'>$rm[menu]</option>";
		} else {
			echo "<option value='$rm[menuID]'>$rm[menu]</option>";
		}
	}?>
    </select>
        <td><button type="submit" name="save" value="ok">Simpan</button><?php if (isset($_GET['op'])) {?>
        <a href="<?php echo $set->folder_modul.'='.$modul;?>&sub=<?php echo $act;?>">Back</a><?php };?></td></tr>
</table>
</fieldset>
<input type="hidden" name="tipe" value="<?php if (isset($_GET['op'])) { echo 'edMod'; } else { echo 'saveMod';};?>">
</form>
<table id="dataTable">
<tr id="tbl">
<th width="30">No</th>
<th width="200">Modul</th>
<th width="200">Folder Name</th>
<th width="200">Menu</th>
<th width="25">Aktif</th>
<th width="50"></th></tr>
<?php
$no =1;
$q = yposSQL('SHOW','ypos_modul a, ypos_menu b',"a.modulID, a.nama_modul, a.modul_folder, a.aktif, b.menu","a.menuID=b.menuID and 1=1",'a.nama_modul');
				while ($r = $q->fetch_array()) {?>
				<tr align="center">			
                <td><?php echo $no;?></td>
					<td><?php echo $r['nama_modul'];?></td>
                    <td><?php echo $r['modul_folder'];?></td>
                    <td><?php echo $r['menu'];?></td>
                    <td align="center"><?php echo $r['aktif'];?></td>
					<td align="center">
					<a href="<?php echo $set->folder_modul.'='.$modul?>&sub=modul&op=ed&id=<?php echo $r['modulID'];?>">Edit</a>
					</td>
				</tr>
                <?php
				$no++;
				}?>
				
				</table>
<?php
	break;
	case 'menu':
	if (isset($_GET['op'])) {
	$ed = yposSQL('SHOW','ypos_menu','*',"menuID=$id")->fetch_array();
	}; ?>
	<form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul.'&sub='.$act.'&id='.$ed['menuID'];?>" name="form" id="form">
    <fieldset class="atas">
<table>
		<tr>
		<th><?php if (isset($_GET['op'])) { echo 'Edit'; } else { echo 'New';}?> Menu</th>
		<td><input type="text" class="inp-form" name="nama" placeholder="Nama Menu" value="<?php echo @$ed['menu'];?>" required="required" size="30"/></td>
        <td><input type="text" name="order" placeholder="Order" size="3" value="<?php echo @$ed['sort'];?>"/>
		<?php if (isset($_GET['op'])) {?> <input type="text" name="aktif" value="<?php echo $ed['aktif'];?>" size="2"/><?php };?>
        <td><button type="submit" name="save" value="ok">Simpan</button></td></tr>
</table>
</fieldset>
<input type="hidden" name="tipe" value="<?php if (isset($_GET['op'])) { echo 'edMenu'; } else { echo 'saveMenu';};?>">
</form>
<table id="dataTable" width="90%">
<tr id="tbl">
<th width="20">No</th>
<th width="300">Menu</th>
<th width="20">Order</th>
<th width="20">Aktif</th>
<th width="50"></th></tr>
<?php
$no =1;
$q = yposSQL('SHOW','ypos_menu','menuID, menu, aktif, sort','1=1','menu');
				while ($r = $q->fetch_array()) {?>
				<tr align="center">			
                <td><?php echo $no;?></td>
					<td><?php echo $r['menu'];?></td>
                    <td><?php echo $r['sort'];?></td>
                    <td align="center"><?php echo $r['aktif'];?></td>
					<td align="center">
					<a href="<?php echo $set->folder_modul.'='.$modul?>&sub=menu&op=ed&id=<?php echo $r['menuID'];?>">Edit</a>
					</td>
				</tr>
                <?php
				$no++;
				}?>
				
				</table><?php
	break;
	case 'report-param':?>
     <form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul.'&act='.$act;?>" name="form" id="form">
    <fieldset class="atas">
<table>
		<tr>
			<th>Report Name</th>
			<td><input type="text" class="inp-form" name="nm" required="required" size="30" maxlength="50"/></td>
            <th>Location</th>
            <td><input type="text" class="inp-form" name="source" required="required" size="50" maxlength="100"/></td>
            <td><input type="hidden" name="tipe" value="addRpt"/>
        	<button type="submit" name="save" value="ok">Simpan</button></td>
		</tr>
</table>
</fieldset>
</form>
<table id="dataTable" width="90%">
<tr id="tbl">
<th width="20">No</th>
<th width="300">Report Name</th>
<th>Location</th>
<th width="50"></th></tr>
<?php
$no =1;
$q = yposSQL('SHOW','ypos_rptparam','idparam, nama_report, report_source','1=1','nama_report');
				while ($r = $q->fetch_array()) {?>
				<tr align="center">			
                <td><?php echo $no;?></td>
					<td><?php echo $r['nama_report'];?></td>
                    <td><?php echo $r['report_source'];?></td>
					<td align="center">
					<a href="<?php echo $set->folder_modul.'='.$modul?>&sub=report-param&op=ed&id=<?php echo $r['idparam'];?>">Edit</a>
					</td>
				</tr>
                <?php
				$no++;
				}?>
				</table><?php
	break;
}?>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/action_permission.js"></script>