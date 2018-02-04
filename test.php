<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>DataTables example - Zero configuration</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

	<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="container-fluid">
		<div class="row">
			<h4>Test</h4>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="table-responsive">
				<table id="example" class="display" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Age</th>
							<th>Start date</th>
							<th>Salary</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>61</td>
							<td>2011/04/25</td>
							<td>$320,800</td>
						</tr>
						<tr>
							<td>Donna Snider</td>
							<td>Customer Support</td>
							<td>New York</td>
							<td>27</td>
							<td>2011/01/25</td>
							<td>$112,000</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<h4>Test Min Max Mean</h4>
				<?php
				$angka = 5;
				$hasil = 1;
				for ($i=0; $i < $angka; $i++) { 
					$hasil = $hasil * $angka;
					$temp = $i*$angka;
					echo $i." * ".$angka." = ".$temp."<br>";
				}
				echo number_format($hasil);
				?>
			</div>
			<div class="col-sm-6">
				<h4>Pengurutan</h4>
				<?php
				$angka = array('5','6','1','2','3','9');
				$max_angka = count($angka);
				$max=0;
				$min = 100;
				$sum = 0;
				$sort = array_multisort($angka);
				for ($i=0; $i < $max_angka; $i++) { 
					echo $angka[$i]."<br>";
					if($angka[$i]>$max){
						$max = $angka[$i];
					}
					if($angka[$i]<$min){
						$min = $angka[$i];
					}
					$sum = $sum + $angka[$i];
				}
				echo "JUMLAH ANGKA : ".$max_angka."<br>";
				echo "ANGKA TERBESAR : ".$max."<br>";
				echo "ANGKA TERENDAH : ".$min."<br>";
				echo "NILAI RATA - RATA : ".$sum/$max_angka."<br>";
				// echo "Pengurutan : ".$sort."<br>";
				$mid = $max_angka/2;
				echo "NILAI TENGAHNY ADALAH : ".$angka[$mid];
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
	.removeClass( 'display' )
	.addClass('table table-striped table-bordered');
</script>

</body>
</html>