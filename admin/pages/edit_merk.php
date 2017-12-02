<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_merk = $_GET['id_merk'];
$sql = mysql_query("SELECT * FROM m_merk WHERE id_merk = '$id_merk'");
$row = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Edit merk</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-content nopadding">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit merk</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="POST" class="form-horizontal">
              <input type="hidden" name="id_merk" value="<?php echo $row['id_merk'] ?>">
              <div class="control-group">
                <label class="control-label">Nama merk :</label>
                <div class="controls">
                  <input type="text" class="span4" name="nama_merk" value="<?php echo $row['nama_merk'] ?>" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="kelola_merk.php"><button type="button" class="btn btn-danger">Batal</button></a>
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
  $id_merk = $_POST['id_merk'];
  $nama_merk = $_POST['nama_merk'];

  if(!empty($nama_merk)){
    $sql = mysql_query("UPDATE m_merk SET 
      nama_merk = '$nama_merk'
      WHERE id_merk = '$id_merk'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_merk.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_merk.php') </script>";
  }
}else{
    echo "<script> window.alert('Update Gagal Data Kosong'); location.replace('edit_merk.php?id_merk= $id_merk') </script>";
}
}
?>
