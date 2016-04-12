<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
//@$idlevel = $_POST['id'];
@$idLM = $_POST['id'];

if (@$_GET['act'] == 'update') {
	@$c = $_POST['c'];
	@$e = $_POST['e'];
	@$d = $_POST['d'];
	
	yposSQL('EDIT','ypos_grouplvlmdl',"c='$c', e='$e',d='$d'","idGroupLM=$idLM");
	
} else {
$q = yposSQL('SHOW','ypos_modul a, ypos_grouplvlmdl b','a.nama_modul, b.*',"a.modulID=b.modulID && idGroupLM=$idLM");
$cekData = $q->num_rows;
if ($cekData > 0) {
$getData = $q->fetch_array();
$getLevel = yposSQL('SHOW','ypos_level','lvl',"idlevel=$getData[idlevel]")->fetch_array();
	?>
<form method="post">
<h3>Modul : <?php echo $getData['nama_modul'];?></h3>
<table border="0" width="100%" align="center">
  <tr>
    <th>Create</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <tr align="center"> 
    <td><input type="text" name="c" value="<?php echo $getData['c'];?>" size="1"/></td>
    <td><input type="text" name="e" value="<?php echo $getData['e'];?>" size="1"/></td>
    <td><input type="text" name="d" value="<?php echo $getData['d'];?>" size="1"/></td>
  </tr>
</table>
<input type="hidden" name="idlvl" value="<?php echo $getData['idlevel'];?>"/>
<input type="hidden" name="lvl" value="<?php echo $getLevel['lvl'];?>"/>
</form>
*Isi dengan Y atau N
<?php } else {
		echo 'Modul belum di aktifkan!';
	} //end cek data
} //end act update
?>