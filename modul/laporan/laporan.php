<script>
function changeRptParam() {
   if (document.getElementById("rpt").value == "3") {
    	document.getElementById("tgl1").disabled='true';
		document.getElementById("tgl2").disabled='true';
		document.getElementById("tgl1").required = false;
		document.getElementById("tgl2").required = false;
    }
    else {
    	document.getElementById("tgl1").disabled='';
		document.getElementById("tgl2").disabled='';
   		 }
}
</script>
<?php
if (!defined('YBASE')) exit ('Now Allowed');
?>
<form method="post" action="<?php echo $set->folder_modul.'/'.$modul;?>/aksi.php?<?php echo $set->folder_modul.'='.$modul;?>" name="form" id="form">
    <fieldset class="atas">
    <h3>Halaman Cetak Laporan</h3>
	<table>
    <tr>
	<th>Report Name</th>
    <td><div class="styled-select slate semi-square"><select name="rpt" id="rpt" onChange="changeRptParam();">
    <?php $l = yposSQL('SHOW','ypos_rptparam','*','1=1','nama_report');
	$cekRpt = $l->num_rows;
	if ($cekRpt > 0) {
	while ($rpt = $l->fetch_array()) {
		echo "<option value='$rpt[idparam]'>$rpt[nama_report]</option>";
			} //end while
		} else {
		echo "<option value='#'>No Report</option>";
	} $l->free_result();?>
    </select></div></td>
    <input type="hidden" name="param" id="param" value="" />
	<td>Start Date : <input type="text" name="start" class="tgl" id="tgl1" required/></td>
    <td>End Date : <input type="text" name="end" class="tgl" id="tgl2" required/></td>
    <td align="right"><button type="submit" name="save" id="cari" value="ok">Show</button></td></tr>
</table>
</fieldset>
</form>