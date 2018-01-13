<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Kelola Penyewaan</a> </div>
		<h3>Kelola Penyewaan</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data Barang</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Id Sewa</th>
								<th>Tgl Sewa</th>
								<th>Tgl Selesai</th>
								<th>Status Bayar</th>
								<th>Status Sewa</th>
								<th>Total Bayar</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$dis_pengembalian = '';
							$stat = '';
							$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = m_user.id_user ORDER BY sewa.id_sewa DESC"); 
							while($row = mysql_fetch_array($sql)){
								if($row['status_bayar']==0){
									$status_bayar = '<span class="label label-warning"> Belum Lunas </span>';
									// $tombol = '';
								}else if($row['status_bayar']==1){
									$status_bayar = '<span class="label label-info"> Menunggu Konfirmasi </span>';
									// $tombol = 'disabled';
								}else if($row['status_bayar']==2){
									$status_bayar = '<span class="label label-danger"> Sudah DP </span>';
									// $tombol = 'disabled';
								}else if($row['status_bayar']==3){
									$status_bayar = '<span class="label label-danger"> Lunas </span>';
									// $tombol = 'disabled';
								}

								if($row['status_sewa']==0){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-warning"> Belum Sewa </span>';
								}else if($row['status_sewa']==1){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-info"> Menunggu Konfirmasi </span>';
								}else if($row['status_sewa']==2){
									$stat = 'pengembalian.php?id_sewa='.$row['id_sewa'].'';
									$dis_pengembalian = '';
									$status_sewa = '<span class="label label-success"> Sedang Di Sewa </span>';
								}else if($row['status_sewa']==3){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-success"> Selesai </span>';
								}else if($row['status_sewa']==4){
									$status_sewa = '<span class="label label-info"> Proses Perpanjang </span>';
								}else if($row['status_sewa']==5){
									$stat = 'pengembalian.php?id_sewa='.$row['id_sewa'].'';
									$status_sewa = '<span class="label label-success"> Penyewaan Di Perpanjang </span>';
								}else if($row['status_sewa']==7){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-warning"> Proses Pembatalan </span>';
								}else if($row['status_sewa']==12){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-danger"> Penyewaan Dibatalkan </span>';
								}
								?>
								<tr>
									<form action="" method="POST">
										<input type="hidden" name="id_sewa" value="<?php echo $row['id_sewa']; ?>">
										<td><?php echo $no; ?></td>
										<td><?php echo $row['id_sewa']; ?></td>
										<td><?php echo date('d/m/Y',strtotime($row['tgl_sewa'])); ?></td>
										<td><?php echo date('d/m/Y',strtotime($row['tgl_selesai'])); ?></td>
										<td>
											<?php
											if($row['status_bayar']=='0'){
												?>
												<select class="span6" name="status_bayar" class="form-control" onchange="this.form.submit()">
													<!-- <option value="0" selected >Belum Lunas</option> -->
													<option value="1">Menunggu Konfirmasi</option>
													<option value="2">Sudah Dp</option>
													<option value="3">Lunas</option>
												</select>
												<?php }else if($row['status_bayar']=='1'){
													?>
													<select class="span6" name="status_bayar" class="form-control" onchange="this.form.submit()">
														<!-- <option value="0">Belum Lunas</option> -->
														<option value="1" selected>Menunggu Konfirmasi</option>
														<option value="2">Sudah Dp</option>
														<option value="3">Lunas</option>
													</select>
													<?php }else if($row['status_bayar']=='2'){
														?>
														<select class="span6" name="status_bayar" class="form-control" onchange="this.form.submit()" disabled>
															<!-- <option value="0">Belum Lunas</option> -->
															<option value="1">Menunggu Konfirmasi</option>
															<option value="2" selected>Sudah Dp</option>
															<option value="3">Lunas</option>
														</select>
														<?php }else if($row['status_bayar']=='3'){
															?>
															<select class="span6" name="status_bayar" class="form-control" onchange="this.form.submit()" disabled>
																<!-- <option value="0">Belum Lunas</option> -->
																<option value="1">Menunggu Konfirmasi</option>
																<option value="2" >Sudah Dp</option>
																<option value="3" selected>Lunas</option>
															</select>
															<?php }?>
														</td>
														<td><?php echo $status_sewa; ?></td>
														<td>Rp. <?php echo number_format($row['total_bayar']); ?></td>
														<td style="text-align: center;">
															<a href="detail_sewa.php?id_sewa=<?php echo $row['id_sewa']; ?>"> <button type="button" name="bayar" class="btn btn-sm btn-default"><i class="icon-print"> Invoice </i></button></a> |
															<a href="cek_bayar.php?id_sewa=<?php echo $row['id_sewa']; ?>"> <button type="button" name="bayar" class="btn btn-sm btn-default"><i class="icon-search"> Cek Pembayaran </i></button></a>
															<a href="<?php echo $stat; ?>"> <button type="button" <?php echo $dis_pengembalian; ?> name="bayar" class="btn btn-sm btn-default"><i class="icon-check"> Pengembalian </i></button></a>
														</td>
													</form>
													<?php 
													$no++; 
												} ?>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>



				<?php include 'footer.php'; ?>
				<?php

				if(isset($_POST['status_bayar'])){
					$id_sewa  = $_POST['id_sewa'];
					$status_bayar = $_POST['status_bayar'];

					if($status_bayar == 2){
						$status_sewa = '2';
					}else if ($status_bayar == 3) {
						$status_sewa = '3';
					}else if ($status_bayar == 1) {
						$status_sewa = '1';
					}else if ($status_bayar == 0) {
						$status_sewa = '0';
					}

	/*echo "<pre>";
	print_r($_POST);*/

	$query_stok = mysql_query("SELECT * FROM detail_sewa WHERE id_sewa = '$id_sewa'")or die(mysql_error());
	$jumlah_row = mysql_num_rows($query_stok);
	
	if($status_bayar == '2' OR $status_bayar == 3){
		while($row_stok = mysql_fetch_array($query_stok)){
			$update = mysql_query("UPDATE m_barang SET stok  = stok - '$row_stok[jumlah]' 
				WHERE id_barang = '$row_stok[id_barang]'")or die(mysql_error());
		}
	}
	
	//die();	

	$sql = mysql_query("UPDATE sewa SET status_bayar = '$status_bayar',
		status_sewa = '$status_sewa'
		WHERE id_sewa = '$id_sewa'");
	if($sql){
		echo "<script> window.alert('Ubah Status Berhasil'); location.replace('kelola_penyewaan.php') </script>";
	}else{
		echo "<script> window.alert('Ubah Status Gagal'); location.replace('kelola_penyewaan.php') </script>";
	}
}
?>
