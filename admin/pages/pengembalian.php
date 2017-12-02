<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
$id_sewa = $_GET['id_sewa'];
$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = m_user.id_user AND sewa.id_sewa = '$id_sewa'");
$row = mysql_fetch_array($sql);
$id_user = $row['id_user'];
?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Kelola Penyewaan</a> </div>
		<h3>Data Pembayaran</h3>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="row">
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Master Data Barang</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered" style="width: 70%">
            <tr>
              <td class="width30">ID Sewa:</td>
              <td class="width70"><strong><?php echo $row['id_sewa']; ?></strong></td>
            </tr>
            <tr>
              <td>Tanggal Sewa:</td>
              <td><strong><?php echo date('d-m-Y',strtotime($row['tgl_sewa'])); ?></strong></td>
            </tr>
            <tr>
              <td>Tanggal Selesai:</td>
              <td><strong><?php echo date('d-m-Y',strtotime($row['tgl_selesai'])); ?></strong></td>
            </tr>
            <tr>
              <td>Tanggal Kembali:</td>
              <td><strong><?php echo date('d-m-Y'); ?></strong></td>
            </tr>

            <tr>
              <td>Telat Sebanyak:</td>
              <?php
              $telat_temp =  strtotime(date('Y-m-d') - strtotime($row['tgl_selesai']));
              $lama_telat = ceil($telat_temp / (60 * 60 * 24));
              ?>
              <td><strong><?php echo $lama_telat; ?> Hari</strong></td>
            </tr>

            <?php 
            if($lama_telat==0){
              $lama_telat = 1;
            }
            ?>

            <tr>
              <td>Lama Sewa:</td>
              <?php
              $tgl_temp = strtotime($row['tgl_selesai']) - strtotime($row['tgl_sewa']);
              $lama_sewa = ceil($tgl_temp / (60 * 60 * 24));
              ?>
              <td><strong><?php echo $lama_sewa; ?> Hari</strong></td>
            </tr>

          </table>
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th class="head0">No</th>
                <th class="head1">Nama Barang</th>
                <th class="head0 right">Jumlah</th>
                <th class="head1 right">Harga</th>
                <th class="head1 right">Sub Total</th>
                <th class="head1 right">Status</th>
                <th class="head1 right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              $tombol = '';
              $sql = mysql_query("SELECT * FROM detail_sewa,m_barang WHERE m_barang.id_barang = detail_sewa.id_barang AND id_sewa = '$id_sewa'")or die(mysql_error()); 
              while($r = mysql_fetch_array($sql)){
                if($r['status_pinjam']==1){
                  $status = '<span class="label label-warning"> Belum Dikembalikan </span>';
                }else if($r['status_pinjam']==0){
                  $status = '<span class="label label-danger"> Sudah Dikembalikan </span>';
                  $tombol = 'disabled';
                }
                ?>
                <form action="" method="POST">
                  <input type="hidden" name="id_sewa" value="<?php echo $r['id_sewa']; ?>">
                  <input type="hidden" name="id_barang" value="<?php echo $r['id_barang']; ?>">
                  <input type="hidden" name="jumlah" value="<?php echo $r['jumlah']; ?>">
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $r['nama_barang']; ?></td>
                    <td class="right"><?php echo $r['jumlah']; ?></td>
                    <td class="right">Rp. <?php echo number_format($r['harga_sewa']); ?> X <?php echo $lama_sewa; ?> Hari</td>
                    <td class="right">Rp. <?php echo number_format($r['harga_sewa'] * $lama_sewa * $lama_telat); ?></td>
                    <td style="text-align: center;"><?php echo $status; ?></td>
                    <td style="text-align: center;">
                      <button type="submit" name="kembali" class="btn btn-success" <?php echo $tombol; ?>>Kembalikan</button>
                    </td>
                  </tr>
                </form>
                <?php 
                $no++; 
              } ?>
              <tr>
                <td colspan="4">Dp</td>
                <td colspan="2"><?php echo number_format($row['dp']); ?></td>
              </tr>
              <tr>
                <td colspan="4">Total Bayar</td>
                <td colspan="2"><?php echo number_format($row['total_bayar'] * $lama_telat); ?></td>
              </tr>
              <tr>
                <td colspan="4">Sisa Bayar</td>
                <td colspan="2"><?php echo number_format(($row['total_bayar'] - $row['dp']) * $lama_telat); ?></td>
              </tr>
            </tbody>
          </table>
          <form action="" method="POST">
            <input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <!-- <a href="kelola_penyewaan.php">
              <button type="button" class="btn btn-default btn-flat">
                <i class="fa fa-arrow-left"></i> Kembali</button></a> -->
                <button type="submit" name="selesai" class="btn btn-primary btn-flat">
                  <i class="fa fa-arrow-left"></i> Selesai</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include 'footer.php'; ?>
      <?php
      if(isset($_POST['selesai'])){

       $id_sewa = $_POST['id_sewa'];
       $id_user = $_POST['id_user'];

       $hariini = date('dmy');
       @$kodeawal = mysql_fetch_array(mysql_query("SELECT MAX(id_pengembalian) from pengembalian"));
       $kode = substr($kodeawal[0], 2,3);
       $carikode = mysql_query("select max('$kode') from pengembalian") or die (mysql_error());
       $datakode = mysql_fetch_array($carikode);
       if ($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $id_pengembalian = "PN".str_pad($kode, 3, "0", STR_PAD_LEFT).$hariini;
      } else {
        $id_pengembalian = "PN001".$hariini;
      }

      $tgl_pengembalian = date('Y-m-d H:i:s');

      $insert = mysql_query("INSERT INTO pengembalian VALUES('$id_pengembalian',
                            '$tgl_pengembalian',
                            '$id_user',
                            '$id_sewa')")or die(mysql_error());

      $sql = mysql_query("UPDATE sewa SET status_bayar = '3',
                                          status_sewa = '3'
                                          WHERE
                                          id_sewa = '$id_sewa'")or die(mysql_error());
      if($sql){
       echo "<script> alert('Pengembalian Berhasil'); location.replace('kelola_penyewaan.php') </script>";
     } 
   }


   if(isset($_POST['kembali'])){

    $id_barang = $_POST['id_barang'];
    $id_sewa = $_POST['id_sewa'];
    $jumlah = $_POST['jumlah'];

    $update = mysql_query("UPDATE m_barang SET stok = stok + '$jumlah' WHERE id_barang = '$id_barang'")or die(mysql_error());
    $update_brg =  mysql_query("UPDATE detail_sewa SET status_pinjam = '0' WHERE id_sewa = '$id_sewa' AND id_barang = '$id_barang'")or die(mysql_error());
    if($update AND $update_brg){
      $tombol = 'disabled';
      echo "<script> alert('berhasil kembalikan barang'); location.replace('pengembalian.php?id_sewa=$id_sewa') </script>";
    }


  }
  ?>
