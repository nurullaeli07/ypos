<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
@$kd = $_POST['id'];

if (@$_GET['proses'] == 'finish') {
	$subttl = abs((int)($_POST['subttl']));
	$diskon = abs((int)($_POST['diskon']));
	$bayar = abs((int)($_POST['bayar']));
	$ket = anti($_POST['ket']);
	$total = $subttl - $diskon;
	$kembali = $bayar - $total;
	
	yposSQL('EDIT','ypos_penjualan',"diskon=$diskon, grand_total=$total, uang_bayar=$bayar, uang_kembali=$kembali, keterangan='$ket'", "kd_penjualan='$kd'");	
} else {
$getData = yposSQL('SHOW','ypos_penjualan','kd_penjualan, subtotal',"kd_penjualan='$kd'")->fetch_array();
	?>
<style>
.input-proses {
 width: 300px;
 height: 20px;
 border: 1px solid #78d0ed;
 font: 1.5em Arial, sans-serif;
}

.font-proses {
	font: 1.1em Arial, sans-serif;
	text-align:left;
	font-weight:bold;
}
</style>
<script type="text/javascript">
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode == 8 || event.keyCode == 46
     || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    	}
    else if ( key < 48 || key > 57 ) {
        return false;
    	}
    else return true;
	};

	$(document).ready(function(){
   		$('[id^=idr]').keypress(validateNumber);
	});
	
	function hitTotal(subttl,idr1){  
			var hasil = eval(subttl) - eval(idr1);
		document.getElementById('grandTotal').innerHTML = hasil;  
	}   

	function kembalian(subttl,idr1,idr2) {
		var total = eval(subttl) - eval(idr1);
		var sisa = eval(idr2) - eval(total);
		document.getElementById('kembali').innerHTML = sisa;
	}
</script>
<form method="post">
<table border="0">
  <tr>
    <th class="font-proses">Kode Transaksi</th>
    <td>:</td>
    <td class="font-proses"><b style="color:#00F"><?php echo $getData['kd_penjualan'];?></b></td>
  </tr>
  <tr>
    <th class="font-proses">Sub-Total</th>
    <td>:</td>
    <td class="font-proses"><b style="color:#00F">Rp <?php echo idr($getData['subtotal']);?></b>
    <input type="hidden" name="subttl" value="<?php echo $getData['subtotal'];?>" id="subttl"/></td>
  </tr>
  <tr>
    <th class="font-proses">Diskon</th>
    <td>:</td>
    <td><input type="text" size="30" name="diskon" class="input-proses" id="idr1" value="0" onkeyup="hitTotal(getElementById('subttl').value,this.value);"></td>
  </tr>
   <tr>
    <th class="font-proses">Grand Total</th>
    <td>:</td>
    <td class="font-proses"><span id="grandTotal" style="color:#00F"><?php echo idr($getData['subtotal']);?></span></td>
  </tr>
    <tr>
    <th class="font-proses">Uang Bayar</th>
    <td>:</td>
    <td><input type="text" size="30" name="bayar" class="input-proses" value="0" id="idr2" onkeyup="kembalian(getElementById('subttl').value,getElementById('idr1').value,this.value);" required></td>
  </tr>
  <tr>
    <th class="font-proses">Kembalian</th>
    <td>:</td>
    <td class="font-proses"><span id="kembali" style="color:#00F"></span></td>
  </tr>
    <tr>
    <th class="font-proses">Catatan</th>
    <td>:</td>
    <td><input type="text" size="30" name="ket" class="input-proses"></td>
  </tr>
</table>
</form>
<?php }
?>