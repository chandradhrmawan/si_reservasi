<?php include ('header.php'); ?>
<div class="container">
	<div class="products">
		<h2 class=" products-in">PRODUCTS</h2>
		<div class=" top-products">
			<?php

			@$id_kategori = $_GET['id_kategori'];

			if(empty($id_kategori)){
				$sql = mysql_query("SELECT * FROM m_barang");
			}else{
				$sql = mysql_query("SELECT * FROM m_barang WHERE id_kategori = '$id_kategori'");
			}
			$no=1; 
			while($row = mysql_fetch_array($sql)){
				?>
				<form name="" action="" method="POST">
					<div class="col-md-3 md-col">
						<div class="col-md">
							<a href="detail_produk.php?id_barang=<?php echo $row['id_barang']; ?>" title="<?php echo $row['nama_barang']; ?>" class="compare-in "><img  src="admin/img/<?php echo $row['foto'] ?>" alt="" height = "250" width="100"/>
								<div class="compare">
									<span>Pesan</span>
								</div>
							</a>	
							<div class="top-content">
								<h5><a href="detail_produk.php?id_barang=<?php echo $row['id_barang'] ?>"><?php echo $row['nama_barang'] ?></a></h5>
								<div class="white">
									<a href="detail_produk.php?id_barang=<?php echo $row['id_barang']; ?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2">ADD TO CART</a>
									<p class="dollar"><span class="in-dollar">IDR</span><span><?php echo number_format($row['harga_sewa']); ?></span></p>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>
				</form>
				<?php
				if($no%4==0){
					echo '<div class="clearfix"></div><br>';
				}else{
					echo "";
				}
				?>

				<?php
				$no++;
			}
			?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php include ('footer.php'); ?>