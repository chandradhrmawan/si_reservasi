<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_barang = $_GET['id_barang'];
$sql = mysql_query("SELECT * FROM m_barang WHERE id_barang = '$id_barang'");
$r = mysql_fetch_array($sql);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h3>Tambah Barang</h3>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="col-sm-6">
      <div class="row-fluid">
        <div class="widget-content nopadding">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Barang</h5>
            </div>
            <div class="widget-content nopadding">
              <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="id_barang" value="<?php echo $r['id_barang'] ?>">
                <div class="control-group">
                  <label class="control-label">Nama Barang :</label>
                  <div class="controls">
                    <input type="text" class="span4" name="nama_barang" value="<?php echo $r['nama_barang']; ?>" placeholder="Nama Barang" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Nama Merk</label>
                  <div class="controls">
                    <select name="id_merk" class="span4">
                      <option>TEST</option>
                      <?php 
                      $sql = mysql_query("SELECT * FROM m_merk");
                      while($row = mysql_fetch_array($sql)){ 
                        if($r['id_merk']==$row['id_merk']){?>
                        <option value="<?php echo $row['id_merk'] ?>" selected> <?php echo $row['nama_merk']; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $row['id_merk'] ?>"> <?php echo $row['nama_merk']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Nama Kategori</label>
                    <div class="controls">
                      <select name="id_kategori" class="span4">
                        <?php 
                        $sql = mysql_query("SELECT * FROM m_kategori");
                        while($row = mysql_fetch_array($sql)){ 
                         if($r['id_kategori']==$row['id_kategori']){?>
                         <option value="<?php echo $row['id_kategori'] ?>" selected> <?php echo $row['nama_kategori']; ?></option>
                         <?php }else{ ?>
                         <option value="<?php echo $row['id_kategori'] ?>"> <?php echo $row['nama_kategori']; ?></option>
                         <?php } ?>
                         <?php } ?>
                       </select>
                     </div>
                   </div>
                   <div class="control-group">
                    <label class="control-label">Warna</label>
                    <div class="controls">
                      <select name="id_warna" class="span4">
                        <?php 
                        $sql = mysql_query("SELECT * FROM m_warna");
                        while($row = mysql_fetch_array($sql)){ 
                         if($r['id_warna']==$row['id_warna']){?>
                         <option value="<?php echo $row['id_warna'] ?>" selected> <?php echo $row['nama_warna']; ?></option>
                         <?php }else{ ?>
                         <option value="<?php echo $row['id_warna'] ?>"> <?php echo $row['nama_warna']; ?></option>
                         <?php } ?>
                         <?php } ?>
                       </select>
                     </div>
                   </div>
                   <div class="control-group">
                    <label class="control-label">Ukuran</label>
                    <div class="controls">
                      <select name="id_ukuran" class="span4">
                        <?php 
                        $sql = mysql_query("SELECT * FROM m_ukuran");
                        while($row = mysql_fetch_array($sql)){ 
                         if($r['id_ukuran']==$row['id_ukuran']){?>
                         <option value="<?php echo $row['id_ukuran'] ?>" selected> <?php echo $row['nama_ukuran']; ?></option>
                         <?php }else{ ?>
                         <option value="<?php echo $row['id_ukuran'] ?>"> <?php echo $row['nama_ukuran']; ?></option>
                         <?php } ?>
                         <?php } ?>
                       </select>
                     </div>
                   </div>
                   <div class="control-group">
                    <label class="control-label">Deskripsi Barang :</label>
                    <div class="controls">
                      <textarea class="span4" name="deskripsi" value="" ><?php echo $r['deskripsi'] ?></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Harga Sewa :</label>
                    <div class="controls">
                      <input type="number" class="span4" name="harga_sewa" value="<?php echo $r['harga_sewa'] ?>" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Harga Beli :</label>
                    <div class="controls">
                      <input type="number" class="span4" name="harga_beli" value="<?php echo $r['harga_beli'] ?>" placeholder="Harga Beli" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Stok:</label>
                    <div class="controls">
                      <input type="number" class="span4" name="stok" value="<?php echo $r['stok'] ?>" placeholder="stok" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Foto :</label>
                    <div class="controls">
                      <input type="file" class="span4" name="foto" value="" />
                      <input type="hidden" class="span4" name="foto_sebelumnya" value="<?php echo $r['foto'] ?>" required />
                    </div>
                  </div>
                  <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <a href="kelola_warna.php"><button type="button" class="btn btn-danger">Batal</button></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

  <?php 
  if(isset($_POST['submit'])){

    if(empty($_FILES['foto']['name'])){
      $foto = $_POST['foto_sebelumnya'];
    }else{
      $direktori = "../img/".$_POST['foto_sebelumnya'];
      unlink($direktori);

      $target_dir = "../img/";
      $target_file = $target_dir . basename($_FILES["foto"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $foto = $_FILES['foto']['name'];

      // Check file size
      if ($_FILES["foto"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }
        // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

      // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      echo "</pre>";
    }
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){

    }
  }

    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_merk = $_POST['id_merk'];
    $id_kategori = $_POST['id_kategori'];
    $id_warna = $_POST['id_warna'];
    $id_ukuran = $_POST['id_ukuran'];
    $deskripsi = $_POST['deskripsi'];
    $harga_sewa = $_POST['harga_sewa'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

      $update = mysql_query("UPDATE m_barang SET
                                   nama_barang = '$nama_barang',
                                   id_merk = '$id_merk',
                                   id_kategori ='$id_kategori',
                                   id_warna = '$id_warna',
                                   id_ukuran = '$id_ukuran',
                                   deskripsi = '$deskripsi',
                                   harga_sewa = '$harga_sewa',
                                   harga_beli = '$harga_beli',
                                   stok = '$stok',
                                   foto = '$foto'
                                   WHERE id_barang = '$id_barang'")or die(mysql_error());
      if($update){
        echo "<script> window.alert('Update Berhasil'); location.replace('kelola_barang.php') </script>";
      }else{
        echo "<script> window.alert('Update Gagal'); location.replace('edit_barang.php?id_barang=$id_barang') </script>";
      }

}

?>