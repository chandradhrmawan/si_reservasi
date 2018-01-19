<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
		<h3>Master Admin</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
				<div class="pull-right">
					<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="icon-plus"> Tambah Admin</i></button>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data User</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Passaword</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sql = mysql_query("SELECT * FROM m_admin"); 
							while($row = mysql_fetch_array($sql)){ 
								if($row['status']==1){
									$status = 'Aktiv';
								}else{
									$status = 'Passiv';
								}
								?>
								<tr>
									<form action="" method="POST">
										<input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_admin']; ?></td>
										<td><?php echo $row['username']; ?></td>
										<td><?php echo $row['password']; ?></td>
										<td style="text-align: center;"><span class="label label-success"> <?php echo $status; ?> </span></td>
										<td style="text-align: center;">
											<a href="edit_admin.php?id_admin=<?php echo $row['id_admin']; ?>">
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
							<h4 class="modal-title" id="myModalLabel">Tambah Admin</h4>
						</div>
						<div class="modal-body">
							<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">Nama Admin</label>
									<input type="text" name="nama_admin" class="form-control" >
								</div>
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">Username</label>
									<input type="text" name="username" class="form-control" >
								</div>
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">Password</label>
									<input type="password" name="password1" class="form-control" >
								</div>
								<div class="form-group" style="padding-bottom: 5px;">
									<label for="Modal Name">konfirmasi Password</label>
									<input type="password" name="password2" class="form-control" >
								</div>
								<div class="modal-footer">
									<button class="btn btn-success btn-flat" type="submit" name="tambah_admin">
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
			<script src="jquery.js"></script> 
			<script type="text/javascript">
				$(document).ready(function () {
					$(".open_modal").click(function(e) {
						var m = $(this).attr("id");
						$.ajax({
							url: "edit_admin.php",
							type: "GET",
							data : {id_admin: m,},
							success: function (ajaxData){
								$("#ModalEdit").html(ajaxData);
								$("#ModalEdit").modal('show',{backdrop: 'true'});
							}
						});
					});
				});
			</script>
			<?php include 'footer.php'; ?>
			<?php
  	//TAMBAH
			if(isset($_POST['tambah_admin'])){

				$nama_admin = $_POST['nama_admin'];
				$username = $_POST['username'];
				$password1 = $_POST['password1'];
				$password2 = $_POST['password2'];

				if($password1 != $password2){
					echo "<script> window.alert('Password Tidak Sama'); </script>";
				}

				if($nama_admin =='' || $username == ''){
					echo "<script> window.alert('Data Masih Belum Lengkap'); </script>";
				}

				$sql = mysql_query("INSERT INTO m_admin VALUES('','$nama_admin','$username','$password1','1')")or die(mysql_error());
				if($sql){
					echo "<script> window.alert('Insert Berhasil'); location.replace('kelola_admin.php') </script>";
				}else{
					echo "<script> window.alert('Insert Gagal'); location.replace('kelola_admin.php') </script>";
				}
			}

			if(isset($_POST['delete'])){
				$id_admin = $_POST['id_admin'];

				$sql = mysql_query("DELETE FROM m_admin WHERE id_admin = '$id_admin'");
				if($sql){
					echo "<script> window.alert('Hapus Berhasil'); location.replace('kelola_admin.php') </script>";
				}else{
					echo "<script> window.alert('Hapus Gagal'); location.replace('kelola_admin.php') </script>";
				}
			}
			?>
