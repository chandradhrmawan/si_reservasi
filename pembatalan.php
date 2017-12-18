<?php include 'header.php'; ?>
<!---->
<?php
$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = '$_SESSION[id_user]' 
					AND sewa.id_user = m_user.id_user 
					AND sewa.status_sewa in (2,4)");
?>
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
<div class="container">
	<div class="row">
		<h4>Data Pesan</h4>
		<table id="example" class="display" width="100%" cellspacing="0">
			<thead class="thead-inverse">
				<tr class="bg-primary">
					<th>No</th>
					<th>Id Sewa</th>
					<th>Nama User</th>
					<th>Tgl Sewa</th>
					<th>Tgl Selesai</th>
					<th>Status Bayar</th>
					<th>Status Sewa</th>
					<th>Total Bayar</th>
					<th>Dp</th>
					<th style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				while($row = mysql_fetch_array($sql)){ 
					if($row['status_bayar']==0){
						$status_bayar = '<span class="label label-warning"> Belum Lunas </span>';
						$tombol = '';
					}else if($row['status_bayar']==1){
						$status_bayar = '<span class="label label-info"> Menunggu Konfirmasi </span>';
						$tombol = 'disabled';
					}else if($row['status_bayar']==2){
						$status_bayar = '<span class="label label-danger"> Sudah DP </span>';
						$tombol = 'disabled';
					}else if($row['status_bayar']==3){
						$status_bayar = '<span class="label label-danger"> Lunas </span>';
						$tombol = 'disabled';
					}

					if($row['status_sewa']==0){
						$status_sewa = '<span class="label label-warning"> Belum Sewa </span>';
					}else if($row['status_sewa']==1){
						$status_sewa = '<span class="label label-info"> Menunggu Konfirmasi </span>';
					}else if($row['status_sewa']==2){
						$status_sewa = '<span class="label label-success"> Sedang Di Sewa </span>';
					}else if($row['status_sewa']==3){
						$status_sewa = '<span class="label label-success"> Selesai </span>';
					}else if($row['status_sewa']==4){
						$status_sewa = '<span class="label label-success"> Di Perpanjang </span>';
					}

					?>
					<tr>
						<form action="proses_bayar.php" method="POST">
							<input type="hidden" name="id_sewa" value="<?php echo $row['id_sewa']; ?>">
							<td><?php echo $no; ?></td>
							<td><?php echo $row['id_sewa']; ?></td>
							<td><?php echo $row['nama_user']; ?></td>
							<td><?php echo date('d/m/Y',strtotime($row['tgl_sewa'])); ?></td>
							<td><?php echo date('d/m/Y',strtotime($row['tgl_selesai'])); ?></td>
							<td><?php echo $status_bayar; ?></td>
							<td><?php echo $status_sewa; ?></td>
							<td>Rp. <?php echo number_format($row['total_bayar']); ?></td>
							<td>Rp. <?php echo number_format($row['dp']); ?></td>
							<td>
								<a href="form_pembatalan.php?id_sewa=<?php echo $row['id_sewa']; ?>" title="Form Pembatalan" disabled><button type="button" name="batal" class="btn btn-sm btn-default" disabled="disabled"><i class="fa fa-trash"> Pembatalan </i></button> </a>
								<a href="form_perpanjangan.php?id_sewa=<?php echo $row['id_sewa']; ?>" title="Form Perpanjangan"><button type="button" name="perpanjang" class="btn btn-sm btn-default"><i class="fa fa-check"> Perpanjangan </i></button></a>
							</td>
						</form>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
			<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
	.removeClass( 'display' )
	.addClass('table table-striped table-bordered table-hover');
</script>
</div>
</div>
<div class="clearfix"> </div>
<!---->
<?php include 'footer.php'; ?>

