<?php include 'header.php'; ?>
<?php
if(!isset($_SESSION['id_user'])){
	echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('login.php'); </script>";
}

if(!isset($_SESSION['id_sewa'])){
	echo "<script> window.alert('Terjadi Kesalahan'); location.replace('products.php'); </script>";
}

$sql = mysql_query("SELECT * FROM tmp_detail_sewa,m_barang 
	WHERE 
	tmp_detail_sewa.id_barang = m_barang.id_barang
	AND
	tmp_detail_sewa.id_sewa = '$_SESSION[id_sewa]'")or die(mysql_error());

$count = mysql_num_rows($sql);
$sta = "";
//$row = mysql_fetch_array($sql);
if($count==0){
	echo '<div class="container"><div class="check-out"><h4 class="title">Shopping cart is empty</h4>
	<p class="cart">You have no items in your shopping cart.<br>Click<a href="products.php"> here</a> to shopping</p></div></div>';
}else{

?>
<div class="container">
	<div class="check-out">
		<h2 class="account-in">Account</h2>
		<div class="row">
			<div class="col-sm-6">
				<form action="" method="POST">
					<div class="form-group">
						<label>Kode Sewa</label>
						<input type="text" name="id_sewa" class="form-control" id="id_sewa" value="<?php echo $_SESSION['id_sewa'] ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="date" name="tgl_sewa" class="form-control">
					</div>
					<div class="form-group">
						<label>Lama Sewa</label>
						<input type="number" name="lama_sewa" class="form-control" id="datepicker">
					</div>
					<div class="form-group">
						<button class="btn btn-default" type="submit" name="proses">Proses</button>
					</div>
				</form>
				<?php
				if(isset($_POST['proses'])){
					/*echo "<pre>";
					print_r($_POST);*/

					$date_now = date('Y-m-d');
					$lama_sewa = $_POST['lama_sewa'];
					$tgl_sewa = $_POST['tgl_sewa'];

					if(empty($tgl_sewa)){
						echo "<script> alert('Tanggal Belum Di Isi'); location.replace('checkout.php') </script>";
					}

					if(empty($lama_sewa)){
						echo "<script> alert('Lama Sewa Belum Di Isi'); location.replace('checkout.php') </script>";	
					}

					if(strtotime($tgl_sewa) <= strtotime($date_now)){
						echo "<script> alert('Tanggal Salah'); location.replace('checkout.php') </script>";
					}

					$tgl_selesai = date('Y-m-d',strtotime($tgl_sewa.'+'.$lama_sewa.' day'));

					$tgl_expired = date('Y-m-d',strtotime($tgl_sewa.'+1 day'));

					$durasi_sewa = strtotime($tgl_selesai) - strtotime($tgl_sewa);

					$durasi_sewa = ($durasi_sewa / (60 * 60 * 24));

					if($durasi_sewa>7){
						echo "<script> alert('Maksimal Sewa 7 Hari'); location.replace('checkout.php') </script>";	
					}

					if($durasi_sewa<2){
						echo "<script> alert('Minimum Sewa 2 Hari'); location.replace('checkout.php') </script>";	
					}

					/*
					echo "TANGGAL SELESAI : ".$tgl_selesai."<br>";
					echo "DURASI SEWA : ".$durasi_sewa." HARI <br>";*/
				}
				?>
			</div>
		</div>
		<h4>Detail Transaksi</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Barang</th>
					<th>Jumlah Barang</th>
					<th>Harga Per Hari</th>
					<th>Sub Total</th>
					<th>Hapus</th>
				</tr>
			</thead>
			<?php
			$total = 0;
			$no=1;
			if($count!=0){ ?>
			<?php while($row = mysql_fetch_array($sql)){ ?>
			<tr>
				<form action="#" method="POST">
					<input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
					<td><?php echo $no++;?></td>
					<td><?php echo $row['nama_barang']; ?></td>
					<td><?php echo $row['jumlah']; ?></td>
					<td>Rp. <?php echo number_format($row['harga_sewa']); ?></td>
					<td>Rp. <?php echo number_format($row['harga_sewa']*$row['jumlah']); ?></td>
					<td><center><button type="submit" name="hapus" class="btn btn-danger btn-sm"><li class="fa fa-trash"> Hapus</li></button></center></td>
				</form>
			</tr>
			<?php
			@$total = $total + ($row['harga_sewa']*$row['jumlah']);
		}
		?>
		<tr>
			<td colspan="4">Sub Total</td>
			<td colspan="2">Rp. <?php echo number_format($total); ?> / Per Hari</td>
		</tr>
		<tr>
			<td colspan="4">Lama Sewa</td>
			<td colspan="2"><?php echo @$durasi_sewa ?> Hari</td>
		</tr>
		<tr>
			<td colspan="4">Mulai Sewa</td>
			<td colspan="2"><?php echo @date('d-m-Y',strtotime($tgl_sewa)); ?></td>
		</tr>
		<tr>
			<td colspan="4">Tanggal Kembali</td>
			<td colspan="2"><?php echo @date('d-m-Y',strtotime($tgl_selesai)); ?></td>
		</tr>
		<tr>
			<td colspan="4">Total Bayar</td>
			<td colspan="2">Rp. <?php echo number_format(@$total*@$durasi_sewa); ?></td>
		</tr>

		<?php
	}else{
		?>
		<td class="invert" colspan="7"><h4><strong>Keranjang Kosong</strong></h4></td>
		<?php } ?>

	</table>

	<?php
	if(isset($_POST['hapus'])){
		$id_barang = $_POST['id_barang'];
		$delete = mysql_query("DELETE FROM tmp_detail_sewa WHERE id_barang = '$id_barang' AND id_sewa = '$_SESSION[id_sewa]'");
		if($delete){
			echo "<script> alert('Hapus Berhasil'); location.replace('checkout.php') </script>";	
		}else{
			echo "<script> alert('Hapus Gagal'); location.replace('checkout.php') </script>";
		}	

	}
	?>
	<h4>Daftar Bank Tersedia</h4>
	<div class="row">
		<div class="col-sm-6">
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Atas Nama</th>
					<th>No Rekening</th>
				</tr>
				<?php 
				$no=1;
				$sql = mysql_query("SELECT * FROM m_bank");
				while($row = mysql_fetch_array($sql)){
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['nama_bank']; ?></td>
						<td><?php echo $row['atas_nama']; ?></td>
						<td><?php echo $row['no_rek']; ?></td>
					</tr>
					<?php $no++; } ?>
				</table>
			</div>
			<p>
				<ul> - Maksimal Sewa 7 Hari</ul>
				<ul> - Minimun Sewa 2 Hari</ul>
				<ul> - Pemesanan Akan Dibatalkan Jika Tidak Konfirmasi Max 1x24 Jam</ul>
				<ul> - Minimum Pembayaran Awal Adalah 50% Dari Harga Total</ul>
				<ul> - Pesanan Akan Otomatis Dibatalkan Sistem Jika Tidak Di Bayar Pada <?php echo @$tgl_expired; ?></ul>

			</p>
		</div>
		<form action="" method="POST">
		<input type="hidden" name="tgl_expired" value="<?php echo @$tgl_expired; ?>">
		<input type="hidden" name="id_sewa" value="<?php echo @$_SESSION['id_sewa'];; ?>">
		<input type="hidden" name="id_user" value="<?php echo @$_SESSION['id_user']; ?>">
		<input type="hidden" name="tgl_sewa" value="<?php echo @$tgl_sewa; ?>">
		<input type="hidden" name="tgl_selesai" value="<?php echo @$tgl_selesai; ?>">
		<input type="hidden" name="status_bayar" value="<?php echo '0'; ?>">
		<input type="hidden" name="status_sewa" value="<?php echo '0'; ?>">
		<input type="hidden" name="total_bayar" value="<?php echo @$total; ?>">
		<input type="hidden" name="dp" value="<?php echo '0'; ?>">
			<button class="btn btn-warning" type="submit" name="checkout"> <i class="fa fa-money"> Checkout </i></button>
			<a href="products.php"><button type="button" class="btn btn-success"> <i class="fa fa-shopping-cart"> Lanjutkan Belanja</i></button></a>
		</form>

		<?php 
			if(isset($_POST['checkout'])){
				/*echo "<pre>";
				print_r($_POST);*/

				$id_sewa = $_POST['id_sewa'];
				$id_user = $_POST['id_user'];
				$tgl_sewa = $_POST['tgl_sewa'];
				$tgl_selesai = $_POST['tgl_selesai'];
				$tgl_expired = $_POST['tgl_expired'];
				$status_bayar = $_POST['status_bayar'];
				$status_sewa = $_POST['status_sewa'];
				$total_bayar = $_POST['total_bayar'];

				$dp = $_POST['dp'];

				if(empty($_POST['tgl_expired'])){
					die("<script> alert('Silahkan Lengkap Data Terlebih Dahulu Sebelum Check'); location.replace('checkout.php') </script>");
				}

				//die();

				$insert_detail = mysql_query("INSERT INTO detail_sewa SELECT * FROM tmp_detail_sewa WHERE id_sewa = '$id_sewa'")or die(mysql_error());

				$insert_sewa = mysql_query("INSERT INTO sewa VALUES('$id_sewa','$id_user','$tgl_sewa','$tgl_selesai','$tgl_expired','$status_bayar','$status_sewa','$total_bayar','$dp')")or die(mysql_error());

				$hapus_tmp_detail = mysql_query("DELETE FROM tmp_detail_sewa");

				echo "<script> alert('Silahkan Lajutan Ke Menu Pembayaran'); location.replace('pembayaran.php') </script>";
			}
		?>

	</div>

</div>
<?php } ?>
<!---->
<?php include 'footer.php'; ?>