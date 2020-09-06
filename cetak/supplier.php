<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title>:: Data Supplier - MX KOMPUTER</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
<h2> LAPORAN DATA SUPPLIER </h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="30" align="center" bgcolor="#00FA9A"><strong>No</strong></td>
    <td width="200" bgcolor="#00FA9A"><strong>Nama Supplier </strong></td>
    <td width="150" bgcolor="#00FA9A"><strong>Kabupaten/Kota </strong></td>
    <td width="250" bgcolor="#00FA9A"><strong>Alamat Lengkap </strong></td>
    <td width="134" bgcolor="#00FA9A"><strong>No. Telepon </strong></td>
  </tr>
  <?php
	$mySql = "SELECT supplier.*, kabupaten.nm_kabupaten from Supplier LEFT JOIN kabupaten ON supplier.kd_kabupaten=kabupaten.kd_kabupaten ORDER BY kd_supplier ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_supplier']; ?></td>
    <td><?php echo $myData['nm_kabupaten']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>