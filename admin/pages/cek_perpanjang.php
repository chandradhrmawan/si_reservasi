<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
	$id_sewa = $_GET['id_sewa'];
	$sql = mysql_query("SELECT * FROM perpanjang WHERE id_sewa = '$id_sewa'")or die(mysql_error());
	$row = mysql_fetch_array($sql);
?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Perpanjangan</a> </div>
		<h3>Data Perpanjangan</h3>
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
					<table class="table table-bordered" width="100%">
                <tr width="25%">
                  <th>Id Sewa</th>
                  <td><?php echo $row['id_sewa']; ?></td>
                </tr>
                <tr>
                  <th>Alasan Perpanjangan</th>
                  <td><?php echo $row['alasan']; ?></td>
                </tr>
                <td align="left" colspan="2"><a href="kelola_perpanjangan.php">
                  <button type="button" class="btn btn-primary btn-flat">
                    <i class="fa fa-arrow-left"></i> Kembali</button></a>
                </td>
              </table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<?php
