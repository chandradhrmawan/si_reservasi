<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
		<h3>Master User</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<!-- <div class="row">
				<div class="pull-right">
					<button class="btn btn-primary"> <i class="icon-plus"> Tambah User</i></button>
				</div>
			</div> -->
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data User</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Daftar</th>
								<th>Nama User</th>
								<th>Username</th>
								<th>Email</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sql = mysql_query("SELECT * FROM m_user"); 
							while($row = mysql_fetch_array($sql)){ 
								if($row['status']==1){
									$status = 'Aktiv';
								}else{
									$status = 'Passiv';
								}
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $row['tgl_daftar']; ?></td>
								<td><?php echo $row['nama_user']; ?></td>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td style="text-align: center;"><span class="label label-success"> <?php echo $status; ?> </span></td>
								<td style="text-align: center;">
									<a href="" title="Edit"> <button class="btn btn-mini btn-default"> <i class="icon-edit"> Edit</i></button> </a> | 
									<a href="" title="Delete"> <button class="btn btn-mini btn-default"> <i class="icon-trash"> Delete </i></button> </a>
								</td>
							</tr>
							<?php $no++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--Footer-part-->
<div class="row-fluid">
	<div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
</body>
</html>
