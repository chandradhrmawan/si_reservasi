<?php
session_start();
include 'config.php';
if(!isset($_SESSION['id_user'])){
	echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('login.php'); </script>";
}

	$id_barang = $_POST['id_barang'];

	$sql = mysql_query("SELECT * FROM m_barang WHERE id_barang = '$id_barang'");
	$row = mysql_fetch_array($sql);

	$jumlah = $_POST['jumlah'];
	$stok = $_POST['stok'];

	if(empty($jumlah)){
		echo "<script> window.alert('Jumlah Belum Di Isi'); location.replace('detail_produk.php?id_barang=$id_barang') </script>";
	}

	if($jumlah > $stok){
		echo "<script> window.alert('Jumlah Melebihi Stok'); location.replace('detail_produk.php?id_barang=$id_barang') </script>";
	}

	/*id_sewa
	id_user
	tgl_sewa
	tgl_selesai
	tgl_expired
	status_bayar
	status_sewa
	total_bayar*/

	/*id_detail
	id_sewa
	id_barang
	jumlah
	status*/

	//kodefikasi id_sewa

	$hariini = date('dmy');
	@$kodeawal = mysql_fetch_array(mysql_query("SELECT MAX(id_sewa) from sewa"));
	$kode = substr($kodeawal[0], 2,3);
	$carikode = mysql_query("select max('$kode') from sewa") or die (mysql_error());
	$datakode = mysql_fetch_array($carikode);
	if ($datakode) {
		$nilaikode = substr($datakode[0], 1);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$hasilkode = "SW".str_pad($kode, 3, "0", STR_PAD_LEFT).$hariini;
	} else {
		$hasilkode = "SW001".$hariini;
	}

	$_SESSION['id_sewa'] = $hasilkode;

	/*echo "<pre>";
	echo "KODE SEWA : ".$hasilkode."<br>";
	echo "ID USER : ".$_SESSION['id_user']."<br>";
	echo "TGL SEWA : ".date('Y-m-d H:i:s')."<br>";
	echo "TGL SELESAI : USER INPUT <br>";
	echo "TGL EXP : ".date('Y-m-d H:i:s',strtotime('+1 days'))."<br>";
	echo "STATUS BAYAR : BOOK : 1, 2 : DP, 3 : LUNAS <br>";
	echo "STATUS SEWA : SEWA : 1, 2 : SELESAI, 3 : PERPANJANG, 4 : BATAL <br>";
	echo "TOTAL BAYAR : SYSTEM INPUT <br>";
	echo "==============INSERT TEMP SEWA====================<br><br>";
	echo "ID DETAIL : AI<br>";
	echo "ID SEWA : ".$hasilkode."<br>";
	echo "ID BARANG : ".$row['id_barang']."<br>";
	echo "JUMLAH : USER INPUT <br>";
	echo "STATUS : 1 CHART, 2 CHECKOUT <br>";*/

/*	echo "<pre>";
	print_r($_POST);

	die();*/

	$cek_detail = mysql_query("SELECT * FROM tmp_detail_sewa WHERE id_barang = '$id_barang'");
	$hit = mysql_num_rows($cek_detail);

	if($hit>0){
		$insert_tmp_detail = mysql_query("UPDATE tmp_detail_sewa SET jumlah = jumlah + '$jumlah'
															 WHERE id_barang = '$id_barang'")or die(mysql_error());;
	}else{
		$insert_tmp_detail = mysql_query("INSERT INTO tmp_detail_sewa VALUES('','$hasilkode','$id_barang','$jumlah','1')")or die(mysql_error());
	}

	if($insert_tmp_detail){
		echo "<script> alert('Barang Berhasil Ditambahkan Ke Keranjang'); location.replace('checkout.php') </script>";
	}else{
		echo "<script> alert('Barang Gagal Ditambahkan Ke Keranjang'); location.replace('checkout.php') </script>";
	}

	?>