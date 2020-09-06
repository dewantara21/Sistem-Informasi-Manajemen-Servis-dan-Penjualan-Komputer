<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title> :: Data Barang - MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
<h2>LAPORAN DATA BARANG </h2>
<table class="table-list" width="900" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="32" bgcolor="#00FA9A"><strong>No</strong></td>
    <td width="65" bgcolor="#00FA9A"><strong>Kode</strong></td>
    <!-- <td width="94" bgcolor="#00FA9A"><strong>Barcode</strong></td> -->
    <td width="347" bgcolor="#00FA9A"><strong>Nama Barang</strong></td>
    <td width="170" bgcolor="#00FA9A"><strong>Kategori</strong></td>
    <td width="44" align="center" bgcolor="#00FA9A"><strong>Stok</strong></td>
    <td width="112" align="right" bgcolor="#00FA9A"><strong>Harga Jual (Rp)</strong></td>
  </tr>
  <?php
	# SQL Menampilkan data barang
	$mySql 	= "SELECT barang.*, kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
				ORDER BY barang.kd_barang ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
   <!-- <td><?php echo $myData['barcode']; ?></td> -->
    <td><?php echo $myData['nm_barang']; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
    <td align="center"><?php echo $myData['stok']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>