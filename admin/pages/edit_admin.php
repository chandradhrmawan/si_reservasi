<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_admin = $_GET['id_admin'];
$sql = mysql_query("SELECT * FROM m_admin WHERE id_admin = '$id_admin'");
$row = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Edit Admin</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-content nopadding">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit Admin</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="POST" class="form-horizontal">
              <input type="hidden" name="id_admin" value="<?php echo $row['id_admin'] ?>">
              <input type="hidden" name="password" value="<?php echo $row['password'] ?>">
              <div class="control-group">
                <label class="control-label">Nama Admin :</label>
                <div class="controls">
                  <input type="text" class="span4" name="nama_admin" value="<?php echo $row['nama_admin'] ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Username :</label>
                <div class="controls">
                  <input type="text" class="span4" name="username" value="<?php echo $row['username'] ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password Lama :</label>
                <div class="controls">
                  <input type="text" class="span4" name="password_lama" placeholder="Password Lama" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password Baru :</label>
                <div class="controls">
                  <input type="text" class="span4" name="password_baru" placeholder="Passwor Baru" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="kelola_admin.php"><button type="button" class="btn btn-danger">Batal</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>

<?php
if(isset($_POST['submit'])){
  $id_admin = $_POST['id_admin'];
  $nama_admin = $_POST['nama_admin'];
  $username = $_POST['username'];
  $password_lama = $_POST['password_lama'];
  $password_baru = $_POST['password_baru'];

  if(empty($password_lama)){
    $sql = mysql_query("UPDATE m_admin SET username = '$username',
      nama_admin = '$nama_admin'
      WHERE id_admin = '$id_admin'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_admin.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_admin.php') </script>";
  }
}

if($password_lama == $_POST['Password']){
  if(empty($password_baru)){
    echo "<script> window.alert('Password Masih Kosong'); location.replace('kelola_admin.php') </script>";
  }else{
    $sql = mysql_query("UPDATE m_admin SET username = '$username',
     nama_admin = '$nama_admin',
     password   = '$password_baru'
     WHERE id_admin = '$id_admin'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_admin.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_admin.php') </script>";
  }

}
}else{
  echo "<script> window.alert('Password Lama Salah'); location.replace('kelola_admin.php') </script>";
}





}
?>
