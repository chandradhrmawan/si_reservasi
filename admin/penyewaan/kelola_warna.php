<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Master Data</a> </div>
		<h3>Master Warna</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
				<div class="pull-right">
					<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="icon-plus"> Tambah Warna</i></button>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data Warna</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Warna</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sql = mysql_query("SELECT * FROM m_warna"); 
							while($row = mysql_fetch_array($sql)){
								?>
								<tr>
									<form action="" method="POST">
										<input type="hidden" name="id_warna" value="<?php echo $row['id_warna']; ?>">
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_warna']; ?></td>
										<td style="text-align: center;">
											<a href="edit_warna.php?id_warna=<?php echo $row['id_warna']; ?>">
												<button type="button" class="btn btn-mini btn-default">
													<i class="icon-pencil"></i> Edit</button></a> | 
													<button type="submit" name="delete" class="btn btn-mini btn-default"> <i class="icon-trash"> Delete </i></button>
												</td>
											</form>
										</tr>
										<?php $no++; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Untuk Tambah Data-->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">Tambah Warna</h4>
						</div>
						<div class="modal-body">
							<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">Nama Warna</label>
									<input type="text" name="nama_warna" class="form-control" >
								</div>
								<div class="modal-footer">
									<button class="btn btn-success btn-flat" type="submit" name="tambah_warna">
										Confirm
									</button>
									<button type="reset" class="btn btn-danger btn-flat"  data-dismiss="modal" aria-hidden="true">
										Cancel
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
			
			<?php include 'footer.php'; ?>
			<?php
  			//TAMBAH
			if(isset($_POST['tambah_warna'])){

				$nama_warna = $_POST['nama_warna'];

				if(empty($nama_warna)){
					echo "<script> window.alert('Data Masih Belum Lengkap'); </script>";
				}

				$sql = mysql_query("INSERT INTO m_warna VALUES('','$nama_warna')")or die(mysql_error());
				if($sql){
					echo "<script> window.alert('Insert Berhasil'); location.replace('kelola_warna.php') </script>";
				}else{
					echo "<script> window.alert('Insert Gagal'); location.replace('kelola_warna.php') </script>";
				}
			}

			if(isset($_POST['delete'])){
				$id_warna = $_POST['id_warna'];

				$sql = mysql_query("DELETE FROM m_warna WHERE id_warna = '$id_warna'");
				if($sql){
					echo "<script> window.alert('Hapus Berhasil'); location.replace('kelola_warna.php') </script>";
				}else{
					echo "<script> window.alert('Hapus Gagal'); location.replace('kelola_warna.php') </script>";
				}
			}
			?>
