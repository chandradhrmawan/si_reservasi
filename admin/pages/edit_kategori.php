<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_kategori = $_GET['id_kategori'];
$sql = mysql_query("SELECT * FROM m_kategori WHERE id_kategori = '$id_kategori'");
$row = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Edit Kategori</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-content nopadding">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit Kategori</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="POST" class="form-horizontal">
              <input type="hidden" name="id_kategori" value="<?php echo $row['id_kategori'] ?>">
              <div class="control-group">
                <label class="control-label">Nama Kategori :</label>
                <div class="controls">
                  <input type="text" class="span4" name="nama_kategori" value="<?php echo $row['nama_kategori'] ?>" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="kelola_kategori.php"><button type="button" class="btn btn-danger">Batal</button></a>
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
  $id_kategori = $_POST['id_kategori'];
  $nama_kategori = $_POST['nama_kategori'];

  if(!empty($nama_kategori)){
    $sql = mysql_query("UPDATE m_kategori SET 
      nama_kategori = '$nama_kategori'
      WHERE id_kategori = '$id_kategori'");
    if($sql){
     echo "<script> window.alert('Update Berhasil'); location.replace('kelola_kategori.php') </script>";
   }else{
    echo "<script> window.alert('Update Gagal'); location.replace('kelola_kategori.php') </script>";
  }
}else{
    echo "<script> window.alert('Update Gagal Data Kosong'); location.replace('edit_kategori.php?id_kategori= $id_kategori') </script>";
}
}
?>
