<?php
session_start();
include '../../config.php';

if(!isset($_SESSION['id_admin'])){
  echo "<script> window.alert('Silahkan Login Terlebih Dahulu'); location.replace('../index.php')  </script>";
}else{
  $sql = mysql_query("SELECT * FROM m_admin WHERE id_admin = '$_SESSION[id_admin]'")or die(mysql_error());
  $admin = mysql_fetch_array($sql);
  $nama_admin = $admin['nama_admin'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Everest Camp</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<?php
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
$sql = mysql_query("SELECT * FROM sewa,m_user 
  WHERE sewa.id_user = m_user.id_user
  AND sewa.tgl_sewa 
  BETWEEN '$dari' AND '$sampai'")or die(mysql_error());

  ?>
  <div class="pull-center">
    <table cellpadding="2" cellspacing="2" class=""   border="0" width='100%' >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <tr>
              <td style="border:none;" colspan="10" align="center" ><h5><font face="verdana" align="center">Laporan Data Penyewaan</font></h5></td>
            </tr>
            <tr>
              <td style="border:none;" colspan="10" align="center" ><h5><font face="verdana" align="center">Everest Camp Dan Outdoor Equipment.</h5></font></td>
            </tr>
            <tr>
              <td style="border:none;" colspan="10"  align="center"><h5> Jl. Tubagus Ismail Bawah No4 Bandung Kec Coblong</h5></td>
            </tr>
            <tr>
             <td style="border:none;" colspan="10" align="center"><h5>Tlp.  08987997351</h5></td>
           </tr>
         </div>
       </div>
     </div>
   </table>
 </div>
 <table class="table" align="center" border="1">
   <thead>
    <tr>
      <th colspan="9" align="left">
        <h5 align="center"> Laporan Data Penyewaan Periode <?php echo $dari; ?> s/d <?php echo $sampai; ?></h5>
      </th>
    </tr>
  </thead>
  <thead>
    <tr>
      <th colspan="9" align="center">
      </th>
    </tr>
  </thead>
  <thead>
    <tr>
      <th style="background-color: gray  !important; border-color: white !important;">No</th>
      <th style="background-color: gray  !important; border-color: white !important;">Id Sewa</th>
      <th style="background-color: gray  !important; border-color: white !important;">Tgl Sewa</th>
      <th style="background-color: gray  !important; border-color: white !important;">Tgl Selesai</th>
      <th style="background-color: gray  !important; border-color: white !important;">Status Bayar</th>
      <th style="background-color: gray  !important; border-color: white !important;">Status Sewa</th>
      <th style="background-color: gray  !important; border-color: white !important;">Total Bayar</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $no=0;
    $total_bayar = 0;
    while($row = mysql_fetch_array($sql)){
      if($row['status_bayar']==0){
        $status_bayar = ' Belum Lunas ';
      }else if($row['status_bayar']==1){
        $status_bayar = ' Menunggu Konfirmasi ';
      }else if($row['status_bayar']==2){
        $status_bayar = ' Sudah DP ';
      }else if($row['status_bayar']==3){
        $status_bayar = ' Lunas ';
      }

      if($row['status_sewa']==0){
        $stat = '';
        $dis_pengembalian = 'disabled';
        $status_sewa = 'Belum Sewa';
      }else if($row['status_sewa']==1){
        $stat = '';
        $dis_pengembalian = 'disabled';
        $status_sewa = 'Menunggu Konfirmasi';
      }else if($row['status_sewa']==2){
        $stat = 'pengembalian.php?id_sewa='.$row['id_sewa'].'';
        $dis_pengembalian = '';
        $status_sewa = 'Sedang Di Sewa ';
      }else if($row['status_sewa']==3){
        $stat = '';
        $dis_pengembalian = 'disabled';
        $status_sewa = ' Selesai ';
      }else if($row['status_sewa']==4){
        $status_sewa = 'Proses Perpanjang';
      }else if($row['status_sewa']==5){
        $stat = 'pengembalian.php?id_sewa='.$row['id_sewa'].'';
        $status_sewa = 'Penyewaan Di Perpanjang ';
      }else if($row['status_sewa']==7){
        $stat = '';
        $dis_pengembalian = 'disabled';
        $status_sewa = 'Proses Pembatalan ';
      }else if($row['status_sewa']==12){
        $stat = '';
        $dis_pengembalian = 'disabled';
        $status_sewa = ' Penyewaan Dibatalkan';
      }
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row['id_sewa']; ?></td>
        <td><?php echo date('d/m/Y',strtotime($row['tgl_sewa'])); ?></td>
        <td><?php echo date('d/m/Y',strtotime($row['tgl_selesai'])); ?></td>
        <td><?php echo $status_bayar; ?></td>
        <td><?php echo $status_sewa; ?></td>
        <td>Rp. <?php echo number_format($row['total_bayar']); ?></td>
      </tr>
      <?php $no++; 
      $total_bayar = $total_bayar + $row['total_bayar'];
    } ?>
  </tbody>
  <tr>
    <td colspan="6" style="background-color: gray  !important; border-color: white !important;">Total Bayar</td>
    <td style="background-color: gray  !important; border-color: white !important;">Rp. <?php echo number_format($total_bayar) ?></td>
  </tr>

  <tr>


    <td colspan="9" align="center">

      <script>

        function cetak()
        {
          document.getElementById('hhhh').style.visibility='hidden';

          window.print();

          location.replace('laporan_penyewaan.php');

        }

      </script>
      <a href="javascript:cetak()" id="hhhh"><h5>PRINT</h5></a>

    </td>
  </tr>


</tbody>

</table>

<!--end-Footer-part-->
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
</body>
</html>
