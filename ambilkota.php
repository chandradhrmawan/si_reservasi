<?php
include('config.php');
$propinsi = $_GET['propinsi'];
$kota = mysql_query("SELECT DISTINCT  id_kota,nama_kota FROM kota WHERE id_provinsi='$propinsi' order by nama_kota");
echo "<option>   </option>";
while($k = mysql_fetch_array($kota)){
    echo "<option value=\"".$k['id_kota']."\">".$k['nama_kota']."</option>\n";
}
?>
