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
		<h2 class="account-in">Form Pembatalan</h2>
		<div class="row">
			<div class="col-sm-6">
				<form action="" method="POST">
					<div class="form-group">
						<label>Kode Sewa</label>
						<input type="text" name="id_sewa" disabled class="form-control" id="id_sewa" value="<?php echo $id_sewa ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="text" name="id_sewa" class="form-control" disabled id="id_sewa" value="<?php echo date('d-F-Y',strtotime($row['tgl_sewa'])) ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="text" name="id_sewa" class="form-control" disabled id="id_sewa" value="<?php echo date('d-F-Y',strtotime($row['tgl_selesai'])) ?>">
					</div>
					<div class="form-group">
						<button class="btn btn-default" type="submit" name="proses">Proses</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!---->
<?php include 'footer.php'; ?>