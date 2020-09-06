<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TRANSAKSI PENJUALAN / SERVIS</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
</head>
<body>

<?php 
# KONTROL MENU PROGRAM
if(isset($_GET['page'])) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case 'Penjualan' :
			if(!file_exists ("penjualan.php")) die ("Empty Main Page!"); 
			include "penjualan.php";	break;
		case 'Pencarian-Data-Servis' : 
			if(!file_exists ("pencarian_harga.php")) die ("Empty Main Page!"); 
			include "pencarian_harga.php";	break;
		case 'Pencarian-Barang' : 
			if(!file_exists ("pencarian_barang.php")) die ("Empty Main Page!"); 
			include "pencarian_barang.php";	break;
		case 'Daftar-Penjualan' : 
			if(!file_exists ("daftar_penjualan.php")) die ("Empty Main Page!"); 
			include "daftar_penjualan.php";	break;
	}
}
else {
	include "penjualan.php";
}
 ?>
</body>
</html>
