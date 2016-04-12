<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]","$act")) {
	$tgl = anti($_POST['tgl']);
	$kd = anti($_POST['kode']);
	$cust = anti($_POST['cust']);
	$diskon = abs((int)($_POST['diskon']));
	$ket = anti($_POST['ket']);
	$b = explode(' - ',$_POST['brg']);
	$brg = $b[0];
	$qty = abs((int)($_POST['qty']));
	$harga = abs((int)($_POST['harga'])); //harga original dari data barang
	$harga_disc = abs((int)($_POST['harga_disc'])); //harga real ketika transaksi
	$item_disc = $harga - $harga_disc;
	//item_disc = nominal pemberian diskon/potongan (auto). Jika harga real ketika transaksi berbeda dengan harga dari data barang
	$ttl = $harga_disc * $qty;
	//total harga real transaksi * dengan qty
	
switch($_POST['tipe']) {
	case 'save':
	//cek dulu sudah ada apa belum
	$cek = yposSQL('SHOW','ypos_penjualan',"'x'","kd_penjualan='$kd'")->num_rows;
	if($cek > 0) {
		yposSQL('ADD','ypos_penjualandtl',"kd_penjualan='$kode', kd_barang='$brg', harga_jual=$harga_disc, diskon=$item_disc, qty=$qty, total_harga=$ttl, userID='$_SESSION[yuser]', date_lastUpdate=NOW(), user_lastUpdate='$_SESSION[yuser]'");
		//Dapetin total harga pembelian
		
		$t = yposSQL('SHOW','ypos_penjualandtl','DISTINCT SUM(total_harga) AS t_harga',"kd_penjualan='$kode'")->fetch_array();
		yposSQL('EDIT','ypos_penjualan',"subtotal=$t[t_harga]","kd_penjualan='$kode'");
	} else {
		yposSQL('ADD','ypos_penjualan',"kd_penjualan='$kd', ids=$_SESSION[yids], customer='$cust', tgl_input=now(), tgl_jual='$tgl', keterangan='$ket', userID='$_SESSION[yuser]'");
		yposSQL('ADD','ypos_penjualandtl',"kd_penjualan='$kd', kd_barang='$brg', harga_jual=$harga_disc, diskon=$item_disc, qty=$qty, total_harga=$ttl, userID='$_SESSION[yuser]', date_lastUpdate=NOW(), user_lastUpdate='$_SESSION[yuser]'");
		//Dapetin total harga pembelian
		$t = yposSQL('SHOW','ypos_penjualandtl','DISTINCT SUM(total_harga) AS t_harga',"kd_penjualan='$kd'")->fetch_array();
		yposSQL('EDIT','ypos_penjualan',"subtotal=$t[t_harga]","kd_penjualan='$kd'");
	}
	header("location:../../$set->folder_modul=$modul&act=new&id=$kd");
	break;
	case 'edProd':
	$idp = abs((int)($_GET['idp'])); //untuk get id penjualan produk
	
		yposSQL('EDIT','ypos_penjualandtl',"kd_barang='$brg', qty=$qty, harga_jual=$harga_disc, total_harga=$ttl","idDtlPenjualan=$idp && kd_penjualan='$kode'");
   $t = yposSQL('SHOW','ypos_penjualandtl','DISTINCT SUM(total_harga) AS t_harga',"kd_penjualan='$kode'")->fetch_array();
		yposSQL('EDIT','ypos_penjualan',"subtotal=$t[t_harga]","kd_penjualan='$kode'");
		
		header("location:../../$set->folder_modul=$modul&act=new&id=$kode&ttl=$t[t_harga]&msg=sucessfully");
	break;
	}
} else {
	echo $akses;
}
?>