<?php include 'header.php'; ?>
<form action="" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-md-6 contact-top">
				<h3>Form Login User Login</h3>
				<div>
					<span><b>Username</b> </span>		
					<input type="text" class="form-control" name="username">						
				</div>
				<div>
					<span><b>Password</b> </span>		
					<input type="password" class="form-control" name="password">						
				</div>
				<button class="btn btn-success btn-md" type="submit" name="submit">Login</button>
				<p class="well">Belum Memili Akun ? Daftar <a href="form_pendaftaran.php">Disini</a></p>	
			</div>
		</div>
	</div>
</form>
<?php include 'footer.php'; ?>
<?php
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = mysql_query("SELECT * FROM m_user WHERE username = '$username' AND password = '$password'");
	$jumlah = mysql_num_rows($sql);

	if($jumlah>0){
		$row = mysql_fetch_array($sql);
		$_SESSION['id_user'] = $row['id_user'];
		echo "<script> alert('Berhasil Login..'); location.replace('index.php') </script>";	
	}else{
		echo "<script> alert('Gagal Login..'); location.replace('login.php') </script>";	
	}
}
?>