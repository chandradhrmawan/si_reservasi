<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Kelola Perpanjangan</a> </div>
		<h3>Kelola Perpanjangan</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Perpanjangan</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Id Sewa</th>
								<th>Tgl Sewa</th>
								<th>Tgl Selesai</th>
								<th>Action</th>
								<th>Status Sewa</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$dis_pengembalian = '';
							$stat = '';
							$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = m_user.id_user
								AND sewa.status_sewa in(4,5) ORDER BY sewa.id_sewa DESC"); 
							while($row = mysql_fetch_array($sql)){
								

								if($row['status_sewa']==4){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-warning"> Proses Perpanjangan </span>';
								}else if($row['status_sewa']==5){
									$stat = '';
									$dis_pengembalian = 'disabled';
									$status_sewa = '<span class="label label-danger"> Penyewaan Diperpanjangan </span>';
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
											if($row['status_sewa']=='4'){
												?>
												<select class="span6" name="status_sewa" class="form-control" onchange="this.form.submit()">
													<option value="4" selected>Menunggu Konfirmasi Perpanjangan</option>
													<option value="5">Penyewaan DiPerpanjangan</option>
												</select>
												<?php }else if($row['status_sewa']=='5'){
													?>
													<select class="span6" name="status_sewa" class="form-control" onchange="this.form.submit()">
														<option value="4">Menunggu Konfirmasi Perpanjangan</option>
														<option value="5" selected>Penyewaan DiPerpanjangan</option>
													</select>
													<?php } ?>
												</td>
												<td><?php echo $status_sewa; ?></td>
												<td style="text-align: center;">
													<a href="cek_perpanjang.php?id_sewa=<?php echo $row['id_sewa']; ?>"> <button type="button" name="bayar" class="btn btn-sm btn-default"><i class="icon-search"> Cek Alasan </i></button></a>
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

		if(isset($_POST['status_sewa'])){
			$id_sewa  = $_POST['id_sewa'];
			$status_sewa = $_POST['status_sewa'];

			$sql = mysql_query("UPDATE sewa SET
				status_sewa = '$status_sewa'
				WHERE id_sewa = '$id_sewa'");
			if($sql){
				echo "<script> window.alert('Ubah Status Berhasil'); location.replace('kelola_perpanjangan.php') </script>";
			}else{
				echo "<script> window.alert('Ubah Status Gagal'); location.replace('kelola_perpanjangan.php') </script>";
			}
		}
		?>
