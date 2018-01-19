<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_warna = $_GET['id_warna'];
$sql = mysql_query("SELECT * FROM m_warna WHERE id_warna = '$id_warna'");
$row = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Edit Warna</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-content nopadding">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit Warna</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="POST" class="form-horizontal">
              <input type="hidden" name="id_warna" value="<?php echo $row['id_warna'] ?>">
              <div class="control-group">
                <label class="control-label">Nama Warna :</label>
                <div class="controls">
                  <input type="text" class="span4" name="nama_warna" value="<?php echo $row['nama_warna'] ?>" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="kelola_warna.php"><button type="button" class="btn btn-danger">Batal</button></a>
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
  $id_warna = $_POST['id_warna'];
  $nama_warna = $_POST['nama_warna'];

  if(!empty($nama_warna)){
    $sql = mysql_query("UPDATE m_warna SET 
      nama_warna = '$nama_warna'
      WHERE id_warna = '$id_warna'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_warna.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_warna.php') </script>";
  }
}else{
    echo "<script> window.alert('Update Gagal Data Kosong'); location.replace('edit_warna.php?id_warna= $id_warna') </script>";
}
}
?>
