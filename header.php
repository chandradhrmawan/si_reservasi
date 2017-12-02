<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bonfire a Ecommerce Category Flat Bootstarp Responsive Website Template | Home :: w3layouts</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Bonfire Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--fonts-->
	<link href='http://fonts.googleapis.com/css?family=Exo:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<link rel="stylesheet" href="fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
	<!--slider-script-->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function () {
			$("#slider1").responsiveSlides({
				auto: true,
				speed: 500,
				namespace: "callbacks",
				pager: true,
			});
		});
	</script>
	<!--//slider-script-->
	<script>$(document).ready(function(c) {
		$('.alert-close').on('click', function(c){
			$('.message').fadeOut('slow', function(c){
				$('.message').remove();
			});
		});	  
	});
</script>
<script>$(document).ready(function(c) {
	$('.alert-close1').on('click', function(c){
		$('.message1').fadeOut('slow', function(c){
			$('.message1').remove();
		});
	});	  
});
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
			$('.message').remove();
		});
	});	  
});
</script>
<script>$(document).ready(function(c) {
	$('.alert-close1').on('click', function(c){
		$('.message1').fadeOut('slow', function(c){
			$('.message1').remove();
		});
	});	  
});
</script>
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="header-top">
			<div class="container">	
				<div class="header-top-in">			
					<div class="logo">
						<a href="index.php"><img src="images/logo.png" alt=" " ></a>
					</div>
					<div class="header-in">
						<ul class="icon1 sub-icon1">
							<li  ><a href="wishlist.php">WISH LIST (0)</a> </li>
							<li  ><a href="account.php">  MY ACCOUNT</a></li>
							<li ><a href="#" > SHOPPING CART</a></li>
							<li > <a href="checkout.php" >CHECKOUT</a> </li>	
							<li><div class="cart">
								<a href="checkout.php" class="cart-in"> </a>
							</div>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<?php
		if(empty($_SESSION['id_user'])){
			$view_login = "<li><a href='login.php' >Login / Sign Up </a></li>";
			$view_login_stat = '<p class="wel"><a href="#">Welcome visitor you can login or create an account.</a></p>';
		}else{
			$view_login = "<li><a href='pembayaran.php' >Pembayaran </a></li>
							<li><a href='logout.php' >logout</a></li>";
			$view_login_stat = '';
		}
	?>
	<div class="header-bottom">
		<div class="container">
			<div class="h_menu4">
				<a class="toggleMenu" href="#">Menu</a>
				<ul class="nav">
					<li class="active"><a href="index.php"><i> </i>HOME</a></li>
					<li><a href="products.php?id_kategori=1" >TENDA</a></li> 						
					<li><a href="products.php?id_kategori=2" >JAKET</a></li>            
					<li><a href="products.php?id_kategori=3" >SEPATU</a></li>						  				 
					<li><a href="products.php?id_kategori=4" >KOMPOR</a></li>
					<li><a href="products.php?id_kategori=5" >PERIPHERAL</a></li>
					<li><a href="products.php" >SEMUA</a></li>
					<li><a href="contact.php" >Contact </a></li>
					<?php echo  $view_login; ?>
				</ul>
				<script type="text/javascript" src="js/nav.js"></script>
			</div>
		</div>
	</div>
	<div class="header-bottom-in">
		<div class="container">
			<div class="header-bottom-on">
				<?php echo $view_login_stat; ?>
				<div class="header-can">
					<ul class="social-in">
						<li><a href="#"><i> </i></a></li>
						<li><a href="#"><i class="facebook"> </i></a></li>
						<li><a href="#"><i class="twitter"> </i></a></li>					
						<li><a href="#"><i class="skype"> </i></a></li>
					</ul>	
					
					<div class="search">
						<form>
							<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
							<input type="submit" value="">
						</form>
					</div>

					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>