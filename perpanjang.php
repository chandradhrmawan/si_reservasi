<?php include 'header.php'; ?>
<!---->
<?php
$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = '$_SESSION[id_user]' 
	AND sewa.id_user = m_user.id_user 
	AND sewa.status_sewa in (2,4,5)");


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
						<th>Status Sewa</th>
						<th style="text-align: center;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1;
					$tombol = '';
					while($row = mysql_fetch_array($sql)){ 
					$link = "form_perpanjang.php?id_sewa=$row[id_sewa]";
						if($row['status_sewa']==0){
							$status_sewa = '<span class="label label-warning"> Belum Sewa </span>';
						}else if($row['status_sewa']==2){
							$status_sewa = '<span class="label label-success"> Sedang Di Sewa </span>';
						}else if($row['status_sewa']==4){
							$link = "";
							$tombol = 'disabled';
							$status_sewa = '<span class="label label-warning"> Proses Perpanjang </span>';
						}else if($row['status_sewa']==5){
							$link = "";
							$tombol = 'disabled';
							$status_sewa = '<span class="label label-danger"> Diperpanjang </span>';
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
								<td><?php echo $status_sewa; ?></td>
								<td>
									<center><a href="<?php echo $link ?>" title="Form Perpanjang" disabled><button type="button" name="batal" <?php echo $tombol; ?> class="btn btn-sm btn-default"><i class="fa fa-check"> Perpanjang </i></button> </a></center>
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

