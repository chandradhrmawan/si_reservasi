<?php include 'header.php'; ?>
<?php
if(!isset($_SESSION['id_user'])){
	echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('login.php'); </script>";
}

$id_sewa = $_GET['id_sewa'];
if(empty($id_sewa)){
	echo "<script> window.alert('Terjadi Kesalahan'); location.replace('index.php'); </script>";	
}

$hariini = date('dmy');
@$kodeawal = mysql_fetch_array(mysql_query("SELECT MAX(id_perpanjang) from perpanjangan"));
$kode = substr($kodeawal[0], 2,3);
$carikode = mysql_query("select max('$kode') from perpanjangan") or die (mysql_error());
$datakode = mysql_fetch_array($carikode);
if ($datakode) {
	$nilaikode = substr($datakode[0], 1);
	$kode = (int) $nilaikode;
	$kode = $kode + 1;
	$id_perpanjang = "PP".str_pad($kode, 3, "0", STR_PAD_LEFT).$hariini;
} else {
	$id_perpanjang = "PP001".$hariini;
}

$sql = mysql_query("SELECT * FROM sewa WHERE id_sewa = '$id_sewa'");
$row = mysql_fetch_array($sql);

?>
<div class="container">
	<div class="check-out">
		<h2 class="account-in">Form Perpanjangan</h2>
		<div class="row">
			<div class="col-sm-6">
				<form action="" method="POST">
					<div class="form-group">
						<label>Kode Sewa</label>
						<input type="text" name="id_sewa" readonly class="form-control" id="id_sewa" value="<?php echo $id_sewa ?>">
					</div>
					<div class="form-group">
						<label>Kode Perpanjangan</label>
						<input type="text" name="id_perpanjang" readonly class="form-control" id="id_sewa" value="<?php echo $id_perpanjang ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="text" name="tgl_sewa" class="form-control" readonly value="<?php echo date('d-F-Y',strtotime($row['tgl_sewa'])) ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="text" name="tgl_selesai" class="form-control" readonly value="<?php echo date('d-F-Y',strtotime($row['tgl_selesai'])) ?>">
					</div>
					<div class="form-group">
						<label>Lama Perpanjang</label>
						<input type="number" required min="1" max="2" name="lama_perpanjang" class="form-control" placeholder="Lama Perpanjang" value=""><code>Max Perpanjang 2 Hari</code>
					</div>
					<div class="form-group">
						<textarea name="alasan_perpanjang" placeholder="Alasan Mengajukan Perpanjangan Sewa" required class="form-control" cols="75" rows="5"></textarea>
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="proses"><i class="fa fa-check"> Proses</i></button> |
						<button class="btn btn-danger" type="button" name="batal"><i class="fa fa-trash"> Batal</i></button>
					</div>
					<div class="form-group">
						<code>Untuk Pembayaran Perpanjangan Akan Di Kalkulasikan Dengan Total Bayar Sewa.</code>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!---->
<?php include 'footer.php'; ?>
<?php
	if(isset($_POST['proses'])){
		$id_sewa = $_POST['id_sewa'];
		$id_perpanjang = $_POST['id_perpanjang'];
		$lama_perpanjang = $_POST['lama_perpanjang'];
		$alasan_perpanjang = $_POST['alasan_perpanjang'];

		$insert = mysql_query("INSERT INTO perpanjangan VALUES ('$id_perpanjang','$id_sewa','$lama_perpanjang','$alasan_perpanjang')")or die(mysql_error());

		$update = mysql_query("UPDATE sewa SET status_sewa = '4' WHERE id_sewa = '$id_sewa'");

		if($insert AND $update){
			echo "<script> alert('Pengajuan Perpanjang Berhasil'); location.replace('pembatalan.php'); </script>";
		}else{
			echo "<script> alert('Pengajuan Perpanjang Gagal'); location.replace('pembatalan.php'); </script>";
		}
	}
?>