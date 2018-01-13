<?php include 'header.php'; ?>
<?php
if(!isset($_SESSION['id_user'])){
	echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('login.php'); </script>";
}

$id_sewa = $_GET['id_sewa'];
if(empty($id_sewa)){
	echo "<script> window.alert('Terjadi Kesalahan'); location.replace('index.php'); </script>";	
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
						<label>Tanggal Sewa</label>
						<input type="text" name="" class="form-control" disabled id="" value="<?php echo date('d-F-Y',strtotime($row['tgl_sewa'])) ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="text" name="" class="form-control" id="" value="<?php echo date('d-F-Y',strtotime($row['tgl_selesai'])) ?>">
						<input type="hidden" name="tgl_selesai" value="<?php echo $row['tgl_selesai'] ?>">
						<input type="hidden" name="total_bayar" value="<?php echo $row['total_bayar'] ?>">
					</div>
					<div class="form-group">
						<label>Perpanjang Sebanyak</label>
						<input type="text" name="lama_perpanjang" class="form-control"  id="" value="">
					</div>
					<div class="form-group">
						<label>Alasan Perpanjang</label>
						<textarea name="alasan" class="form-control" cols="5" rows="5"></textarea>
					</div>
					<div class="form-group">
						<a href="pembatalan.php"><button class="btn btn-danger" type="button" name="batal">Batal</button></a>
						<button class="btn btn-success" type="submit" name="proses">Proses</button>
					</div>
				</form>	
				<?php
					if(isset($_POST['proses'])){

						

						$lama_perpanjang = $_POST['lama_perpanjang'];
						$tgl_selesai = $_POST['tgl_selesai'];

						$tgl_ahkir = date('Y-m-d',strtotime($tgl_selesai.'+'.$lama_perpanjang.' day'));


						$total_bayar = $_POST['total_bayar']*$lama_perpanjang;
						

						$id_sewa = $_POST['id_sewa'];
						$alasan = $_POST['alasan'];

						if(empty($alasan)){
							echo "<script> alert('Mohon Isikan Alasan Terlebih Dahulu'); </script>";
						}else{
							$insert = mysql_query("INSERT into perpanjang VALUES('','$id_sewa',
												  '$lama_perpanjang','$alasan')")or die(mysql_error());
							$update = mysql_query("UPDATE sewa SET status_sewa = '4',
																tgl_selesai = '$tgl_ahkir',
																total_bayar = '$total_bayar'
																 WHERE id_sewa = '$id_sewa'");

							echo "<script> alert('Proses Pengajuan Perpanjangan Berhasil'); location.replace('perpanjang.php') </script>";
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
<!---->
<?php include 'footer.php'; ?>