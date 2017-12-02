<?php
	session_start();
	if(!isset($_SESSION['id_admin'])){
		echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('../index.php')  </script>";
	}

	unset($_SESSION['id_admin']);
	echo "<script> window.alert('Logout Berhasil'); location.replace('../index.php')  </script>";

?>