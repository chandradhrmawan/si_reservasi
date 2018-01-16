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
$sql = mysql_query("SELECT * FROM pengembalian,m_user 
  WHERE pengembalian.id_user = m_user.id_user
  AND pengembalian.tgl_pengembalian
  BETWEEN '$dari' AND '$sampai'")or die(mysql_error());

  ?>
  <div class="pull-center">
    <table cellpadding="2" cellspacing="2" class=""   border="0" width='100%' >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <tr>
              <td style="border:none;" colspan="10" align="center" ><h5><font face="verdana" align="center">Laporan Data Pengembalian</font></h5></td>
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
        <h5 align="center"> Laporan Data Pengembalian Periode <?php echo $dari; ?> s/d <?php echo $sampai; ?></h5>
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
      <th style="background-color: gray  !important; border-color: white !important;">Id pengembalian</th>
      <th style="background-color: gray  !important; border-color: white !important;">Tgl pengembalian</th>
      <th style="background-color: gray  !important; border-color: white !important;">Nama User</th>
      <th style="background-color: gray  !important; border-color: white !important;">Id Sewa</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=0;
    while($row = mysql_fetch_array($sql)){
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row['id_pengembalian']; ?></td>
        <td><?php echo date('d/m/Y',strtotime($row['tgl_pengembalian'])); ?></td>
        <td><?php echo $row['nama_user']; ?></td>
        <td><?php echo $row['id_sewa']; ?></td>
      </tr>
      <?php $no++; 
    } ?>
  </tbody>
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
