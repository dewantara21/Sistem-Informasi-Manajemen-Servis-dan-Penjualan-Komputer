<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/bar128.php";

$Kode  = isset($_GET['Kode']) ?  $_GET['Kode'] : ''; 
$mySql = "SELECT * FROM barang WHERE kd_barang='$Kode'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
?>
<html>
<head>
<title> :: Cetak Barcode</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body,td,th {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size:12px;
}
body {
	margin-top: 1px;
}
-->
</style>

</head>
<body>
<table class="table-list" width="200" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td width="201" align="center" valign="top">
	<?php 
		if($myData['barcode'] !="") {
			  echo $myData['nm_barang'];
			  echo "<br>Rp. ". format_angka($myData['harga_jual']);
			  echo bar128(stripslashes($myData['barcode'])); 
		} 
	?></td>
  </tr>
</table>
</body>
</html>