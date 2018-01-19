<?php include '../../config.php'; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Everest Rent Camp</title>
    
    <style>
    @media print {
      #printPageButton {
        display: none;
    }
}
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    padding-top: 20px;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
</head>
<script>
    function cetak()
    {
        document.getElementById('button').style.visibility='hidden';
        window.print();

    }
</script>
<body>
    <br>
    <br>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="../../images/logo.png" width="200" height="130">
                            </td>
                            <td>
                                Invoice #: SW001170118<br>
                                Created: <?php echo date('d-F-Y');  ?><br>
                                <!-- Nama Pelanggan: <br> -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Everest Rent Camp.<br>
                                jalan Budi Luhur No 6A<br>
                                Bandung, Indonesia 14325
                            </td>

                            <td>
                                Everest Rent Camp.<br>
                                everestrentcamp@gmail.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
            $id_sewa = $_GET['id_sewa'];
            $sql = mysql_query("SELECT * FROM sewa,m_user WHERE sewa.id_user = m_user.id_user AND sewa.id_sewa = '$id_sewa'");
            $row = mysql_fetch_array($sql);
            $tgl_temp = strtotime($row['tgl_selesai']) - strtotime($row['tgl_sewa']);
            $lama_sewa = ceil($tgl_temp / (60 * 60 * 24));
            ?>
            <tr class="heading">
                <td width="15%">
                    Nama Barang
                </td>
                <td width="20%">
                    Jumlah
                </td>
                <td width="20%" style="text-align: right;">
                    Harga
                </td>
                <td width="20%" style="text-align: right;">
                    Sub Total
                </td>
            </tr>

            <?php 
            $no=1;
            $id_sewa = $_GET['id_sewa'];
            $sql = mysql_query("SELECT * FROM detail_sewa,m_barang WHERE m_barang.id_barang = detail_sewa.id_barang AND id_sewa = '$id_sewa'")or die(mysql_error()); 
            while($r = mysql_fetch_array($sql)){
                ?>
                <tr class="item">
                    <td>
                        <?php echo $r['nama_barang']; ?>
                    </td>

                    <td>
                        <?php echo $r['jumlah']; ?>
                    </td>
                    <td style="text-align: right;">
                        Rp. <?php echo number_format($r['harga_sewa']); ?>
                    </td>
                    <td style="text-align: right;">
                        Rp. <?php echo number_format($r['harga_sewa'] * $lama_sewa); ?>
                    </td>
                </tr>
                <?php 
                $no++; 
            } ?>
            <tr class="total">
                <td></td>

                <td colspan="3">
                   Total: Rp. <?php echo number_format($row['total_bayar']); ?>
               </td>
           </tr>
           <tr>
            <td><button id="button" onClick="cetak();">Print</button></td>
        </tr>
    </table>
</div>
</body>
</html>