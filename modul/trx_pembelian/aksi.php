<?php
session_start();
	include '../../config/connect.php';
	include '../../config/function.php';
	include '../../config/config.php';
if (NULL !== cekAkses("$modul","$_SESSION[ylevel]","$act")) {
	@$sup = anti($_POST['sup']);
	@$tgl = anti($_POST['tgl']);
	@$nota = anti($_POST['nota']);
	@$kdbeli = anti($_POST['kode']);
	@$b = explode(' - ',$_POST['brg']);
	@$brg = $b[0];
	@$qty = abs((int)($_POST['qty']));
	@$harga = abs((int)($_POST['total_harga']));
	
	switch($_POST['tipe']) {
	case 'save':
	//cek dulu sudah ada apa belum
	$cek = yposSQL('SHOW','ypos_pembelian',"'x'","kdPembelian='$kdbeli'")->num_rows;
	if($cek > 0) {
		yposSQL('ADD','ypos_pembeliandtl',"kdPembelian='$kode', kd_barang='$brg', qty_beli=$qty, harga_beli=$harga/$qty, total=$harga");
		//Dapetin total harga pembelian
		$t = yposSQL('SHOW','ypos_pembeliandtl','DISTINCT SUM(total) AS t_harga',"kdPembelian='$kode'")->fetch_array();
		yposSQL('EDIT','ypos_pembelian',"total_pembelian=$t[t_harga]","kdPembelian='$kode'");
	} else {
		yposSQL('ADD','ypos_pembelian',"kdPembelian='$kdbeli', no_nota='$nota', kdsup=$sup, userID='$_SESSION[yuser]', tgl_input=now(), tgl_beli='$tgl', ids=$_SESSION[yids]");
		yposSQL('ADD','ypos_pembeliandtl',"kdPembelian='$kdbeli', kd_barang='$brg', qty_beli=$qty, harga_beli=$harga/$qty, total=$harga");
		//Dapetin total harga pembelian
		$t = yposSQL('SHOW','ypos_pembeliandtl','DISTINCT SUM(total) AS t_harga',"kdPembelian='$kdbeli'")->fetch_array();
		yposSQL('EDIT','ypos_pembelian',"total_pembelian=$t[t_harga]","kdPembelian='$kdbeli'");
	}
	header("location:../../$set->folder_modul=$modul&act=new&id=$kdbeli&ttl=$t[t_harga]&nota=$nota");
	break;
	case 'edProd':
	$idp = abs((int)($_GET['idp'])); //untuk get id penjualan produk
	$ttl = abs((int)($_GET['ttl'])); //untuk get ttl produk
	$getNota = anti($_GET['nota']);
	
		yposSQL('EDIT','ypos_pembeliandtl',"kd_barang='$brg', qty_beli=$qty, harga_beli=$harga/$qty, total=$harga","idDtlPembelian=$idp && kdPembelian='$kode'");
   $t = yposSQL('SHOW','ypos_pembeliandtl','DISTINCT SUM(total) AS t_harga',"kdPembelian='$kode'")->fetch_array();
		yposSQL('EDIT','ypos_pembelian',"total_pembelian=$t[t_harga]","kdPembelian='$kode'");
		
		header("location:../../$set->folder_modul=$modul&act=new&id=$kode&ttl=$t[t_harga]&nota=$getNota&msg=sucessfully");
	break;
	}
} else {
	echo $akses;
}
?>