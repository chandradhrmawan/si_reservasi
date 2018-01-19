<?php include 'header.php'; ?>
<!---->
<?php
@$id_sewa = $_POST['id_sewa'];
    
if(empty($id_sewa)){
     echo "<script> window.alert('Terjadi Kesahalahan..'); location.replace('pembayaran.php') </script>";
}

$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = '$_SESSION[id_user]' AND sewa.id_user = m_user.id_user AND sewa.id_sewa = '$id_sewa'");
$row = mysql_fetch_array($sql);

$hariini = date('dmy');
@$kodeawal = mysql_fetch_array(mysql_query("SELECT MAX(id_pembayaran) from pembayaran_awal"));
$kode = substr($kodeawal[0], 2,3);
$carikode = mysql_query("select max('$kode') from pembayaran_awal") or die (mysql_error());
$datakode = mysql_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 1);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "DP".str_pad($kode, 3, "0", STR_PAD_LEFT).$hariini;
} else {
    $hasilkode = "DP001".$hariini;
}


?>

<div class="container">
    <div class="row">
        <h4>Data Pesan</h4>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Id Sewa</label>
                  <input type="text" name="id_sewa"  class="form-control" value="<?php echo $row['id_sewa']; ?>" readonly required/>
              </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Id Pembayaran</label>
              <input type="text" name="id_pembayaran"  class="form-control" value="<?php echo $hasilkode; ?>" readonly required/>
          </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Tanggal Pembayaran</label>
          <input type="text" name="tgl_pembayaran"  class="form-control" value="<?php echo date ("d/m/Y"); ?>" readonly required/>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Nama User</label>
      <input type="text" name="nama_user"  class="form-control" value="<?php echo $row['nama_user']; ?>" readonly required/>
  </div>
</div>
<div class="col-md-3">
    <div class="form-group">
      <label>Harga Total</label>
      <input type="number" name="total_bayar"  class="form-control" value="<?php  echo $row['total_bayar']; ?>" readonly required/>
  </div>
</div>
<div class="col-md-4">
    <div class="form-group">
      <label>Minimum Pembayaran 50%</label>
      <input type="text" name="minimum_pembayaran"  class="form-control" value="<?php echo $row['total_bayar'] - ($row['total_bayar']*0.50); ?>" readonly required/>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Bank Pengirim </label>
      <input type="text" name="bank_pengirim"  class="form-control" id="" placeholder="Bank Pengirim" required/>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label>No Rek Pengirim </label>
    <input type="text" name="no_rek_pengirim"  class="form-control" id="" placeholder="Nomor Rekening Pengirim" required/>
</div>
</div>
<div class="col-md-4">
  <div class="form-group">
    <label>Atas Nama </label>
    <input type="text" name="atas_nama_pengirim"  class="form-control" id="" placeholder="Atas Nama Pengirim" required/>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label>Bank Tujuan</label>
      <select name="id_bank" required class="form-control">
       <option value="0">-------Pilih Bank----------</option>
       <?php
       $sql = mysql_query("SELECT * FROM m_bank");
       while($bank = mysql_fetch_array($sql)){ ?>
       <option value="<?php echo $bank['id_bank']; ?>"><?php echo $bank['nama_bank']; ?></option>
       <?php } ?>
   </select>
</div>
</div>
<div class="col-md-5">
    <div class="form-group">
      <label>Jumlah Pembayaran</label>
      <input type="number" name="jumlah_transfer"  class="form-control" value="<?php echo $row['total_bayar'] - ($row['total_bayar']*0.50); ?>" required/>
      <code> Jumlah Pembayaran Harus Sesuai Dengan Sisa Pembayaran </code>
  </div>
</div>
<div class="col-md-7">
    <div class="form-group">
      <label>Bukti Pembayaran </label>
      <input type="file" name="foto" class="form-control" id="" required>
  </div>
</div>
<div class="col-md-7">
    <div class="form-group">
      <label>Catatan </label>
      <textarea name="catatan" class="form-control" id="" required></textarea>
  </div>
</div>
</div>
<div class="row">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" name="submit" class="btn btn-primary"><span class="fa fa-send"> Kirim</span></button>
            <button type="button" name="batal" class="btn btn-danger"><span class="fa fa-trash"> Batal</span></button>
        </div>
    </div>
</div>
</form>
<?php 
if(isset($_POST['submit'])){
    /*echo "<pre>";
    print_r($_POST);
    print_r($_FILES);*/

    $target_dir = "images/";

    if(empty($_FILES['foto']['name'])){
        $foto = '';
    }else{
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

          if ($_FILES["foto"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
          }

          if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
          }
            $foto = $_FILES['foto']['name'];

        }

        $total_bayar = $_POST['total_bayar'];
        $minimum_pembayaran = $_POST['minimum_pembayaran'];

        $id_pembayaran = $_POST['id_pembayaran'];
        $id_sewa = $_POST['id_sewa'];
        $tgl_pembayaran = date('Y-m-d H:i:s');
        $id_bank = $_POST['id_bank'];
        $bank_pengirim = $_POST['bank_pengirim'];
        $no_rek_pengirim = $_POST['no_rek_pengirim'];
        $atas_nama_pengirim = $_POST['atas_nama_pengirim'];
        $jumlah_transfer = $_POST['jumlah_transfer'];
        $bukti_transfer = $foto;
        $catatan = $_POST['catatan'];

        if(empty($bank_pengirim) OR $id_bank == 0){
            echo "<script> window.alert('Kesalahan Pengisian Data'); location.replace('pembayaran.php') </script>";
        }

        if($jumlah_transfer > $total_bayar){
            echo "<script> window.alert('Jumlah Pembayaran Salah'); location.replace('pembayaran.php') </script>";
        }

        if($jumlah_transfer < $minimum_pembayaran){
            echo "<script> window.alert('Jumlah Pembayaran Salah'); location.replace('pembayaran.php') </script>";
        }

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $insert = mysql_query("INSERT INTO pembayaran_awal VALUES('$id_pembayaran','$id_sewa','$tgl_pembayaran','$id_bank','$bank_pengirim','$no_rek_pengirim','$atas_nama_pengirim','$jumlah_transfer','$bukti_transfer','$catatan')")or die(mysql_error());
            $update = mysql_query("UPDATE sewa SET status_bayar = '1',
                                                   status_sewa = '1',
                                                   dp = '$jumlah_transfer'
                                                   WHERE id_sewa = '$id_sewa'")or die(mysql_error());
          if($insert AND $update == TRUE){
            echo "<script> window.alert('Insert Berhasil'); location.replace('pembayaran.php') </script>";
          }else{
            echo "<script> window.alert('Insert Gagal'); location.replace('pembayaran.php') </script>";
          }
      }
}
?>
</div>
</div>
<div class="clearfix"> </div>
<!---->
<?php include 'footer.php'; ?> 
