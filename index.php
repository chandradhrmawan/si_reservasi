<?php include('header.php'); ?>

<div class="banner-mat">
	<div class="container">
		<div class="banner">
			<!-- Slideshow 4 -->
			<div class="slider">
				<ul class="rslides" id="slider1">
					<li><img src="images/banner.jpg" alt="">
					</li>
					<!-- <li><img src="images/banner1.jpg" alt="">
					</li>
					<li><img src="images/banner.jpg" alt="">
					</li>
					<li><img src="images/banner2.jpg" alt="">
					</li> -->
				</ul>
			</div>
			<div class="banner-bottom">
				<div class="clearfix"></div>
			</div>
		</div>				
		<!-- //slider-->
	</div>
</div>
<!---->
<div class="container">
	<div class="content">
		
		<!---->
		<div class="content-middle">
			<h3 class="future">BRANDS</h3>
			<div class="content-middle-in">
				<ul id="flexiselDemo1">			
					<li><img src="images/ap.png"/></li>
					<li><img src="images/ap1.png"/></li>
					<li><img src="images/ap2.png"/></li>
					<li><img src="images/ap3.png"/></li>
					
				</ul>
				<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems: 2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
						
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>

			</div>
		</div>
		<!---->
		<div class="content-bottom">
			<h3 class="future">NEW</h3>
			<div class="content-bottom-in">
				<ul id="flexiselDemo2">
					<?php 
					$sql = mysql_query("SELECT * FROM m_barang");
					while($row = mysql_fetch_array($sql)){
						?>		
						<li>
							<div class="col-md men">
								<a href="detail_produk.php?id_barang=<?php echo $row['id_barang'] ?>" title="<?php echo $row['nama_barang']; ?>" class="compare-in "><img  src="admin/img/<?php echo $row['foto'] ?>" alt="" height = "200" width="100" />
									<div class="compare in-compare">
										<span>Pesan</span>
									</div></a>
									<div class="top-content bag">
										<h5><a href="" title="<?php echo $row['nama_barang']; ?>"><?php echo $row['nama_barang']; ?></a></h5>
										<div class="white">
											<a href="detail_produk.php?id_barang=<?php echo $row['id_barang']; ?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2">ADD TO CART</a>
											<p class="dollar"><span class="in-dollar">IDR</span><span><?php echo number_format($row['harga_sewa']); ?></span></p>
											<div class="clearfix"></div>
										</div>
									</div>							
								</div>
							</li>
							<?php } ?>
						</ul>
						<script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo2").flexisel({
									visibleItems: 4,
									animationSpeed: 1000,
									autoPlay: true,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 1
										}, 
										landscape: { 
											changePoint:640,
											visibleItems: 2
										},
										tablet: { 
											changePoint:768,
											visibleItems: 3
										}
									}
								});
								
							});
						</script>
					</div>
				</div>
			</div>
		</div>
		<!---->
		<?php include('footer.php'); ?>