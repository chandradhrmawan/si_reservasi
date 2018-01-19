<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
	$id_sewa = $_GET['id_sewa'];
	$sql = mysql_query("SELECT * FROM pembayaran_awal WHERE id_sewa = '$id_sewa'")or die(mysql_error());
	$row = mysql_fetch_array($sql);
?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Kelola Penyewaan</a> </div>
		<h3>Data Pembayaran</h3>
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
					<table class="table table-bordered">
                <tr>
                  <th>Id Pembayaran</th>
                  <td><?php echo $row['id_pembayaran']; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Pembayaran</th>
                  <td><?php echo $row['tgl_pembayaran']; ?></td>
                </tr>
                <tr>
                  <th>Bank Pengirim</th>
                  <td><?php echo $row['bank_pengirim']; ?></td>
                </tr>
                <tr>
                  <th>No Rekening Pengirim</th>
                  <td><?php echo $row['no_rek_pengirim']; ?></td>
                </tr>
                <tr>
                  <th>Atas Nama</th>
                  <td><?php echo $row['atas_nama_pengirim']; ?></td>
                </tr>
                <tr>
                  <th>Jumlah Transfer</th>
                  <td> Rp.<?php echo number_format($row['jumlah_transfer']); ?></td>
                </tr>
                <tr>
                  <th>Bukti Transfer</th>
                  <td><a href="../../images/<?php echo $row['bukti_transfer']; ?>">
                    <img src="../../images/<?php echo $row['bukti_transfer']; ?>" height="100" width="100"></a>
                  </td>
                </tr>
                <tr>
                  <th>Catatan</th>
                  <td><?php echo $row['catatan']; ?></td>
                </tr>
                <td align="left" colspan="2"><a href="kelola_penyewaan.php">
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
