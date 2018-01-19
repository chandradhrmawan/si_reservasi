<?php include ('header.php'); ?>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript">

	var htmlobjek;
	$(document).ready(function() {
   //apabila terjadi event onchage terhadap objek <select id=pripinsi>
   $("#propinsi").change(function(){
   	var propinsi = $("#propinsi").val();
   	$.ajax({
   		url: "ambilkota.php",
   		data: "propinsi="+propinsi,
   		cache: false,
   		success: function(msg){
         $("#kota").html(msg);
     }

 });

   });
   $("#kota").change(function(){
   	var kota= $("#kota").val();
   	$.ajax({
   		url:"ambilkecamatan.php",
   		data:"kota="+kota,
   		cache:false,
   		success: function(msg){
   			$("#kec").html(msg);
   		}
   	});
   });
});

</script>
<div class="container">
	<h2>Form Pendaftaran User</h2>
	<div class="row">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group">
					<label>Nama User</label>
					<input type="text" name="nama_user" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password1" class="form-control">
				</div>
				<div class="form-group">
					<label>Konfirmasi Password</label>
					<input type="password" name="password2" class="form-control">
				</div>
			</div>
			<div class="col-sm-6">
				<!-- <div class="form-group">
					<label>Provinsi</label>
					<select name="id_provinsi" id="propinsi" class="form-control">
						<option>Pilih Provinsi</option>
						<?php
						$sql = mysql_query("SELECT * FROM provinsi")or die(mysql_error());
						while($row_provinsi = mysql_fetch_array($sql)){?>
						<option value="<?php echo $row_provinsi['id_provinsi']; ?>">
							<?php echo $row_provinsi['nama_provinsi']; ?>
						</option>
						<?php } ?>
					</select>
				</div> -->
				<!-- <div class="form-group">
					<label>Kota</label>
					<select name="id_kota" id="kota" required class="form-control">
						<option value="#">
							Pilih Kota/Kabupaten
						</option>
					</select>
				</div> -->
				<!-- <div class="form-group">
					<label>Kecamatan</label>
					<select name="id_kecamatan" id="kec" required class="form-control">
						<option value="#">
							Pilih Kecamatan
						</option>
					</select>
				</div> -->
				<div class="form-group">
					<label>Kode Pos</label>
					<input type="number" name="kode_pos" class="form-control">
				</div>
				<div class="form-group">
					<label>Alamat Lengkap</label>
					<textarea name="alamat_lengkap" class="form-control"> </textarea>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success btn-md">Daftar</button>
					<button type="button" class="btn btn-danger btn-md">Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include ('footer.php'); ?>
<?php
		if(isset($_POST['submit'])){

			echo "<pre>";
			print_r($_POST);
			echo "</pre>";

			$id_user = '';
			$tgl_daftar = date('Y-m-d H:i:s');
			$nama_user = $_POST['nama_user'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			//CEK PASSWORD
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];

			if($password1 != $password2){
				echo "<script> alert('Password Tidak Sama'); location.replace('form_pendaftaran.php') </script>";
			}

			$id_provinsi = null;
			$id_kota = null;
			$id_kecamatan = null;
			$kode_pos = $_POST['kode_pos'];
			$alamat_lengkap = $_POST['alamat_lengkap'];
			$status = '1';

			$insert = mysql_query("INSERT INTO m_user VALUES('$id_user','$tgl_daftar','$nama_user','$username','$email',
								   '$password1','$id_provinsi','$id_kota','$id_kecamatan','$kode_pos','$alamat_lengkap','$status')")or die(mysql_error());
			if($insert){
				echo "<script> alert('Berhasil Daftar Akun Silahkan Login..'); location.replace('login.php') </script>";	
			}else{
				echo "<script> alert('Gagal Daftar Akun'); location.replace('form_pendaftaran.php') </script>";
			}
		}
?>