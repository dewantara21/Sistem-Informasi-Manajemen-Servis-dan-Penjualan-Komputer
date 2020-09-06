<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

?>
<html>
<head>
<title>:: Data Kategori - MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
<h2> LAPORAN DATA KATEGORI </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="38" align="center" bgcolor="#00FA9A"><b>No</b></td>
    <td width="437" bgcolor="#00FA9A"><b>Nama Kategori </b></td>
    <td width="109" align="center" bgcolor="#00FA9A"><b>Qty Barang </b> </td>
  </tr>
  <?php
	  // Menampilkan daftar kategori
	$mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_kategori'];
		
		// Menghitung jumlah barang per Kategori
		$my2Sql = "SELECT COUNT(*) As qty_barang FROM barang WHERE kd_kategori='$Kode'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
    <td align="center"><?php echo $my2Data['qty_barang']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>