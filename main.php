<?php
if(isset($_SESSION['SES_MARKETING'])) {
	echo include_once('penjualan/penjualan.php');
}
else if(isset($_SESSION['SES_TEKNISI'])) {
	echo include_once('services-data.php');	
}
else if(isset($_SESSION['SES_MANAGER'])) {
	echo include_once('laporan_penjualan_barang.php');	
}
else if(isset($_SESSION['SES_KEUANGAN'])) {
	echo include_once('laporan_penjualan_periode _grafik.php');	
}
else {
	echo "<h2>Selamat datang !</h2>";
	echo "<b>Anda belum login, silahkan <a href='index.php' alt='Login'>login </a>untuk mengakses sitem ini ";	
}
?>
