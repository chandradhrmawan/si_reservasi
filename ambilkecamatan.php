<?php
include('config.php');
$kota = $_GET['kota'];
$kec = mysql_query("SELECT DISTINCT  id_kecamatan,nama_kecamatan FROM kecamatan WHERE id_kota='$kota' order by nama_kecamatan");
echo "<option>  </option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['id_kecamatan']."\">".$k['nama_kecamatan']."</option>\n";
}
?>
