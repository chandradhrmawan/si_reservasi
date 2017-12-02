<?php include 'header.php'; ?>
<!---->
<?php
$id_barang = $_GET['id_barang']; 
$sql = mysql_query("SELECT
	m_barang.id_barang,
	m_barang.nama_barang,
	m_barang.tgl_ditambakan,
	m_barang.deskripsi,
	m_barang.harga_sewa,
	m_barang.harga_beli,
	m_kategori.nama_kategori,
	m_merk.nama_merk,
	m_ukuran.nama_ukuran,
	m_warna.nama_warna,
	m_barang.foto,
	m_barang.stok,
	m_barang.status
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
	m_barang.id_warna = m_warna.id_warna AND
	m_barang.id_barang = '$id_barang'
	"); 
$row = mysql_fetch_array($sql);
?>
<div class="container">
	<div class="single">
		<div class="col-md-9 top-in-single">
			<div class="col-md-5 single-top">	
				<ul id="etalage">
					<li>
						<a href="">
							<img class="etalage_thumb_image img-responsive" src="admin/img/<?php echo $row['foto'] ?>" alt="" >
						</a>
					</li> 
				</ul>

			</div>
			<form id="my_form" action="insert_produk.php" method="POST">
				<input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
				<input type="hidden" name="stok" value="<?php echo $row['stok']; ?>">
				<div class="col-md-7 single-top-in">
					<div class="single-para">
						<h4><?php echo $row['nama_barang'] ?></h4>
						<div class="para-grid">
							<span  class="add-to"></span>IDR <?php echo number_format($row['harga_sewa']) ?></span>					
							<div class="clearfix"></div>
						</div>
						<h5><?php echo $row['stok'] ?> items in stock</h5>

						<p><?php echo $row['deskripsi']; ?></p>
						<p>						
								<label for="inputsm">Jumlah</label>
								<input type="text" name="jumlah" placeholder="Jumlah Sewa" class="form-control">
						</p>
						<a href="#" title="Pesan" onclick="document.getElementById('my_form').submit();" class="hvr-shutter-in-vertical ">Add to Cart</a>

					</div>
				</div>
			</form>
			<div class="clearfix"> </div>

				<!-- <div class="content-top-in">
					<div class="col-md-4 top-single">
						<div class="col-md">
							<img  src="images/pic8.jpg" alt="" />	
							<div class="top-content">
								<h5>Mascot Kitty - White</h5>
								<div class="white">
									<a href="#" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2">ADD TO CART</a>
									<p class="dollar"><span class="in-dollar">$</span><span>2</span><span>0</span></p>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>					
					<div class="clearfix"></div>
				</div> -->
			</div>
			<div class="col-md-3">
				<div class="single-bottom">
					<h4>Kategori</h4>
					<ul>
						<li><a href="products.php?id_kategori=1"><i> </i>Tenda</a></li>
						<li><a href="products.php?id_kategori=2"><i> </i>Jaket</a></li>
						<li><a href="products.php?id_kategori=3"><i> </i>Sepatu</a></li>
						<li><a href="products.php?id_kategori=4"><i> </i>Kompor</a></li>
						<li><a href="products.php?id_kategori=5"><i> </i>Peripheral</a></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!---->
	<?php include 'footer.php'; ?> 