<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_ukuran = $_GET['id_ukuran'];
$sql = mysql_query("SELECT * FROM m_ukuran WHERE id_ukuran = '$id_ukuran'");
$row = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Edit Ukuran</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-content nopadding">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit Ukuran</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="POST" class="form-horizontal">
              <input type="hidden" name="id_ukuran" value="<?php echo $row['id_ukuran'] ?>">
              <div class="control-group">
                <label class="control-label">Nama Ukuran :</label>
                <div class="controls">
                  <input type="text" class="span4" name="nama_ukuran" value="<?php echo $row['nama_ukuran'] ?>" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="kelola_ukuran.php"><button type="button" class="btn btn-danger">Batal</button></a>
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
  $id_ukuran = $_POST['id_ukuran'];
  $nama_ukuran = $_POST['nama_ukuran'];

  if(!empty($nama_ukuran)){
    $sql = mysql_query("UPDATE m_ukuran SET 
      nama_ukuran = '$nama_ukuran'
      WHERE id_ukuran = '$id_ukuran'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_ukuran.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_ukuran.php') </script>";
  }
}else{
    echo "<script> window.alert('Update Gagal Data Kosong'); location.replace('edit_ukuran.php?id_ukuran= $id_ukuran') </script>";
}
}
?>
