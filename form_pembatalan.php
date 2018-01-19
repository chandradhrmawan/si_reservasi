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
						<input type="text" name="id_sewa" readonly class="form-control" id="id_sewa" value="<?php echo $id_sewa ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="text" name="" class="form-control" disabled id="" value="<?php echo date('d-F-Y',strtotime($row['tgl_sewa'])) ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="text" name="" class="form-control" disabled id="" value="<?php echo date('d-F-Y',strtotime($row['tgl_selesai'])) ?>">
					</div>
					<div class="form-group">
						<label>Alasan Pembatalan</label>
						<textarea name="alasan" class="form-control" cols="5" rows="5"></textarea>
					</div>
					<div class="form-group">
						<a href="pembatalan.php"><button class="btn btn-danger" type="button" name="batal">Batal</button></a>
						<button class="btn btn-success" type="submit" name="proses">Proses</button>
					</div>
				</form>	
				<?php
				if(isset($_POST['proses'])){
					$id_sewa = $_POST['id_sewa'];
					$alasan = $_POST['alasan'];

					if(empty($alasan)){
						die("<script> alert('Mohon Isikan Alasan Terlebih Dahulu'); </script>");
					}

					$sql_detail = mysql_query("SELECT * FROM detail_sewa WHERE id_sewa = '$id_sewa'")or die(mysql_error());
					$jml_id_sewa = mysql_num_rows($sql_detail);

					while ($row = mysql_fetch_array($sql_detail)) {
						$id_barang = $row['id_barang'];
						$stok = $row['jumlah'];
						$update_barang = mysql_query("UPDATE m_barang SET stok = stok + '$stok'
							WHERE id_barang = '$id_barang'")or die(mysql_error());
						$update_detail_sewa = mysql_query("UPDATE detail_sewa SET status_pinjam = '0'
							WHERE id_barang = '$id_barang'")or die(mysql_error());
					}

					if(empty($alasan)){
						echo "<script> alert('Mohon Isikan Alasan Terlebih Dahulu'); </script>";
					}else{
						$insert = mysql_query("INSERT into batal VALUES('','$id_sewa','$alasan')")or die(mysql_error());
						$update = mysql_query("UPDATE sewa SET status_sewa = '7' WHERE id_sewa = '$id_sewa'");
						echo "<script> alert('Proses Pengajuan Pembatalan Berhasil'); location.replace('pembatalan.php') </script>";
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<!---->
<?php include 'footer.php'; ?>