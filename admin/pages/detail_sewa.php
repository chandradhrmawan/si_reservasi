<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
	$id_sewa = $_GET['id_sewa'];
	$sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = m_user.id_user AND sewa.id_sewa = '$id_sewa'");
	$row = mysql_fetch_array($sql);

?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Addons pages</a> <a href="#" class="current">invoice</a> </div>
    <h1>Detail Sewa</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >Detail Sewa</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td><h4><?php echo $row['nama_user']; ?></h4></td>
                    </tr>
                    <!-- <tr>
                      <td>Your Town</td>
                    </tr>
                    <tr>
                      <td>Your Region/State</td>
                    </tr>
                    <tr>
                      <td>Mobile Phone: +4530422244</td>
                    </tr>
                    <tr>
                      <td >me@company.com</td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">ID Sewa:</td>
                      <td class="width70"><strong><?php echo $row['id_sewa']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Tanggal Sewa:</td>
                      <td><strong><?php echo $row['tgl_sewa']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Tanggal Selesai:</td>
                       <td><strong><?php echo $row['tgl_selesai']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Lama Sewa:</td>
                      	<?php
                      	$tgl_temp = strtotime($row['tgl_selesai']) - strtotime($row['tgl_sewa']);
                      	$lama_sewa = ceil($tgl_temp / (60 * 60 * 24));
                      	?>
                       <td><strong><?php echo $lama_sewa; ?> Hari</strong></td>
                    </tr>
                  <!-- <td class="width30">Client Address:</td>
                    <td class="width70"><strong>Cliente Company name.</strong> <br>
                      501 Mafia Street., washington, <br>
                      NYNC 3654 <br>
                      Contact No: 123 456-7890 <br>
                      Email: youremail@companyname.com </td> -->
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <thead>
                    <tr>
                      <th class="head0">No</th>
                      <th class="head1">Nama Barang</th>
                      <th class="head0 right">Jumlah</th>
                      <th class="head1 right">Harga</th>
                      <th class="head1 right">Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $sql = mysql_query("SELECT * FROM detail_sewa,m_barang WHERE m_barang.id_barang = detail_sewa.id_barang AND id_sewa = '$id_sewa'")or die(mysql_error()); 
                    while($r = mysql_fetch_array($sql)){
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $r['nama_barang']; ?></td>
                      <td class="right"><?php echo $r['jumlah']; ?></td>
                      <td class="right">Rp. <?php echo number_format($r['harga_sewa']); ?></td>
                      <td class="right">Rp. <?php echo number_format($r['harga_sewa'] * $lama_sewa); ?></td>
                    </tr>
                    <?php 
                    $no++; 
                	} ?>
                  </tbody>
                </table>
                <table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="85%"><h4>Total </h4>
                        </td>
                      <td class="right"><strong>Total</strong> <br>
                        
                      <td class="right"><strong>Rp. <?php echo number_format($row['total_bayar']); ?> <br>
                       </td>
                    </tr>
                  </tbody>
                </table>
                <div class="pull-right">
                  <h4><span>Total Bayar:</span> Rp. <?php echo number_format($row['total_bayar']); ?></h4>
                  <br>
                  <a class="btn btn-primary btn-large pull-right" href="">Pay Invoice</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
