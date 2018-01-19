<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Master Barang</a> </div>
		<h3>Master Barang</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
				<div class="pull-right">
					<a href="tambah_barang.php">
						<button class="btn btn-primary"> <i class="icon-plus"> Tambah Barang</i>
						</button></a>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
						<h5>Master Data Barang</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered data-table">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Barang</th>
									<th>Tgl Ditambahkan</th>
									<th>Nama Merk</th>
									<th>Nama Kategori</th>
									<th>Warna</th>
									<th>Ukuran</th>
									<th>Deskripsi Produk</th>
									<th>Harga Sewa</th>
									<th>Harga Beli</th>
									<th>Status</th>
									<th>Stok</th>
									<th>Foto Barang</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								$sql = mysql_query("SELECT
									m_barang.id_barang,
									m_barang.nama_barang,
									m_barang.tgl_ditambakan,
									m_barang.deskripsi,
									m_barang.harga_sewa,
									m_barang.harga_beli,
									m_barang.stok,
									m_barang.status,
									m_kategori.nama_kategori,
									m_merk.nama_merk,
									m_ukuran.nama_ukuran,
									m_warna.nama_warna,
									m_barang.foto
									FROM
									m_barang ,
									m_kategori ,
									m_merk ,
									m_ukuran ,
									m_warna
									WHERE
									m_barang.id_merk = m_merk.id_merk AND
									m_barang.id_kategori = m_kategori.id_kategori AND
									m_barang.id_ukuran = m_ukuran.id_ukuran AND
									m_barang.id_warna = m_warna.id_warna
									"); 
								while($row = mysql_fetch_array($sql)){
									if($row['status']==1){
										$status = '<span class="label label-success"> Tersedia </span>';
									}else{
										$status = '<span class="label label-danger"> Tidak Tersedia </span>';
									}
									?>
									<tr>
										<form action="" method="POST">
											<input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
											<td><?php echo $no; ?></td>
											<td><?php echo $row['nama_barang']; ?></td>
											<td><?php echo $row['tgl_ditambakan']; ?></td>
											<td><?php echo $row['nama_merk']; ?></td>
											<td><?php echo $row['nama_kategori']; ?></td>
											<td><?php echo $row['nama_warna']; ?></td>
											<td><?php echo $row['nama_ukuran']; ?></td>
											<td><?php echo $row['deskripsi']; ?></td>
											<td>Rp. <?php echo number_format($row['harga_sewa']); ?></td>
											<td>Rp. <?php echo number_format($row['harga_beli']); ?></td>
											<td><?php echo $status; ?></td>
											<td><?php echo $row['stok']; ?></td>
											<td><img src="../img/<?php echo $row['foto']; ?>" width="100" height="100"></td>
											<td style="text-align: center;">
												<a href="edit_barang.php?id_barang=<?php echo $row['id_barang']; ?>">
													<button type="button" class="btn btn-mini btn-default">
														<i class="icon-pencil"></i> Edit</button></a> | 
														<button type="submit" name="delete" class="btn btn-mini btn-default"> <i class="icon-trash"> Delete </i></button>
													</td>
												</form>
											</tr>
											<?php 
											$no++; 
										} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>


				
				<?php include 'footer.php'; ?>
				<?php

				if(isset($_POST['delete'])){
					$id_barang = $_POST['id_barang'];

					$sql = mysql_query("DELETE FROM m_barang WHERE id_barang = '$id_barang'");
					if($sql){
						echo "<script> window.alert('Hapus Berhasil'); location.replace('kelola_barang.php') </script>";
					}else{
						echo "<script> window.alert('Hapus Gagal'); location.replace('kelola_barang.php') </script>";
					}
				}
				?>
