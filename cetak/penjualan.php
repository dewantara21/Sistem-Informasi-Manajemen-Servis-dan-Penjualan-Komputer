


<?php

session_start();
// ob_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

$periode = $_GET['periode'];

$tanggalawal = substr($periode,25,10);
$tanggalakhir = substr($periode,42,10);
?>
<html>
<head>
<title>:: Data Penjualan - MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">

</head>
<body>
<script type="text/javascript">
	window.print();
	// window.onfocus=function(){ window.close();} auto close
</script>
<h2> LAPORAN DATA PENJUALAN </h2>
<h3>Periode <?php echo  IndonesiaTgl($tanggalawal) ." s/d ". IndonesiaTgl($tanggalakhir) ;?> </h3>

<table class="table-list" width="800" border="2" cellspacing="1" cellpadding="2">        
<thead>
  <tr>
    <th rowspan="2" align="center" bgcolor="#00FA9A"><b>No</b></th>
    <th rowspan="2" bgcolor="#00FA9A"><strong>Tanggal</strong></th>
    <th rowspan="2" bgcolor="#00FA9A"><strong>No.Nota</strong></th>
    <th rowspan="2" bgcolor="#00FA9A" ><strong>Kode </strong></th>
    <th width="285" rowspan="2" bgcolor="#00FA9A"><b>Nama Barang</b></th>
    <th colspan="2" align="center" bgcolor="#00FA9A"><div align="center"><strong>HARGA DASAR </strong></div></th>
  <!--  <th rowspan="2" align="center" bgcolor="#00FA9A"><strong>Disc</strong></th> -->
    <th colspan="2" rowspan="2" align="center" bgcolor="#00FA9A"><b>Jumlah</b></th>
    <th colspan="2" align="center" bgcolor="#00FA9A"><div align="center"><strong>TOTAL HARGA </strong></div></th>
  </tr>
  <tr>
    <th align="right" bgcolor="#00FA9A"><b> Beli (Rp)</b></th>
    <th align="right" bgcolor="#00FA9A"><b> Jual (Rp) </b></th>
    <th align="right" bgcolor="#00FA9A"><strong>  Beli (Rp)</strong> </th>
    <th align="right" bgcolor="#00FA9A"><strong>  Jual (Rp)</strong></th>
  </tr>
 </thead>

  <?php
//	$hargaJualDiskon=0; 
  $totalJual = 0; 
  $totalBeli = 0; 
  $jumlahBarang = 0;  
  $uangKembali=0;
  //  tabel menu AND $filterPeriode 
  $mySql ="SELECT penjualan_item.*, penjualan.tgl_penjualan, barang.nm_barang 
       FROM penjualan, penjualan_item
        LEFT JOIN barang ON penjualan_item.kd_barang=barang.kd_barang 
       WHERE penjualan.no_penjualan=penjualan_item.no_penjualan
       AND $periode
       ORDER BY penjualan_item.kd_barang";
  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
  $nomor  = 0;   
  while($myData = mysql_fetch_array($myQry)) {
    $nomor++;
//    $hargaJualDiskon= $myData['harga_jual'] - ( $myData['harga_jual'] * $myData['diskon'] / 100 );
    $subTotalJual   = $myData['jumlah'] * $myData['harga_jual'];
    $totalJual    = $totalJual + $subTotalJual;
    
    $subTotalBeli   = $myData['jumlah'] * $myData['harga_beli'];
    $totalBeli    = $totalBeli + $subTotalBeli ;
    
    $jumlahBarang = $jumlahBarang + $myData['jumlah'];

  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><strong><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></strong></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td align="right"><div align="right"><?php echo format_angka($myData['harga_beli']); ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($myData['harga_jual']); ?></div></td>
  <!--  <td align="center"><div align="right"><?php // echo $myData['diskon']; ?>%</div></td> -->
    <td colspan="2" align="center"><div align="center"><?php echo $myData['jumlah']; ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($subTotalBeli); ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($subTotalJual); ?></div></td>
  </tr>
  <?php 
}?>
  <tr>
    <td colspan="8" align="right"><div align="right"><b> Grand Total  : </b></div></td>
    <td align="center" bgcolor="#F5F5F5"><div align="center"><strong><?php echo $jumlahBarang; ?></strong></div></td>
    <td align="right" bgcolor="#F5F5F5"><div align="right"><strong> <?php echo format_angka($totalBeli); ?></strong></div></td>
    <td align="right" bgcolor="#F5F5F5"><div align="right"><strong> <?php echo format_angka($totalJual); ?></strong></div></td>
  </tr>
  <tr>
    <td colspan="8" align="right"><div align="right"><b>NETO :</b></div></td>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><div align="justify"><strong>Rp. <?php echo format_angka($totalJual-$totalBeli); ?></strong></div></td>
  </tr>

 
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>


<!-- $html = ob_get_contents();
ob_end_clean();    
require_once("../assets/html2pdf/html2pdf.class.php");
$pdf = new HTML2PDF('P','A4','en');
$pdf->setDefaultFont('Courier');
$pdf->WriteHTML($html);
$pdf->Output('Data Penjaauaalasan.pdf', 'D');
  
?> -->