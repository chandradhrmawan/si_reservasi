<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Master Data</a> </div>
		<h3>Master Kategori</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
				<div class="pull-right">
					<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="icon-plus"> Tambah Kategori</i></button>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data Kategori</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kategori</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sql = mysql_query("SELECT * FROM m_kategori"); 
							while($row = mysql_fetch_array($sql)){
								?>
								<tr>
									<form action="" method="POST">
										<input type="hidden" name="id_kategori" value="<?php echo $row['id_kategori']; ?>">
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_kategori']; ?></td>
										<td style="text-align: center;">
											<a href="edit_kategori.php?id_kategori=<?php echo $row['id_kategori']; ?>">
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
							<h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
						</div>
						<div class="modal-body">
							<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">Nama Kategori</label>
									<input type="text" name="nama_kategori" class="form-control" >
								</div>
								<div class="modal-footer">
									<button class="btn btn-success btn-flat" type="submit" name="tambah_kategori">
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
			if(isset($_POST['tambah_kategori'])){

				$nama_kategori = $_POST['nama_kategori'];

				if(empty($nama_kategori)){
					echo "<script> window.alert('Data Masih Belum Lengkap'); </script>";
				}

				$sql = mysql_query("INSERT INTO m_kategori VALUES('','$nama_kategori')")or die(mysql_error());
				if($sql){
					echo "<script> window.alert('Insert Berhasil'); location.replace('kelola_kategori.php') </script>";
				}else{
					echo "<script> window.alert('Insert Gagal'); location.replace('kelola_kategori.php') </script>";
				}
			}

			if(isset($_POST['delete'])){
				$id_kategori = $_POST['id_kategori'];

				$sql = mysql_query("DELETE FROM m_kategori WHERE id_kategori = '$id_kategori'");
				if($sql){
					echo "<script> window.alert('Hapus Berhasil'); location.replace('kelola_kategori.php') </script>";
				}else{
					echo "<script> window.alert('Hapus Gagal'); location.replace('kelola_kategori.php') </script>";
				}
			}
			?>
