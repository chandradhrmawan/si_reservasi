<?php
	session_start();
	include '../../config.php';

	if(!isset($_SESSION['id_admin'])){
		echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('../index.php')  </script>";
	}else{
		$sql = mysql_query("SELECT * FROM m_admin WHERE id_admin = '$_SESSION[id_admin]'")or die(mysql_error());
		$admin = mysql_fetch_array($sql);
		$nama_admin = $admin['nama_admin'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Everest Camp</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Everest Camp</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="search" class="navbar navbar-inverse pull-right">
  <ul class="nav">
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text"><?php echo $nama_admin; ?></span></a></li>
    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
