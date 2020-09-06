<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daftar Transaksi Terakhir - MX Komputer</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2>DAFTAR TRANSAKSI TERAKHIR</h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="33" align="center" bgcolor="#00FA9A"><strong>No</strong></td>
    <td width="89" bgcolor="#00FA9A"><strong>Tanggal</strong></td>
    <td width="152" bgcolor="#00FA9A"><strong>No. Penjualan  </strong></td>  
    <td width="130" bgcolor="#00FA9A"><strong>Pelanggan</strong></td>
    <td width="90" align="right" bgcolor="#00FA9A"><strong>Jumlah Barang </strong></td>
    <td width="140" align="right" bgcolor="#00FA9A"><strong>Total Belanja (Rp) </strong></td>
    <td width="37" align="center" bgcolor="#00FA9A"><strong>Aksi</strong></td>
  </tr>
<?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT penjualan.*, pelanggan.nm_pelanggan FROM penjualan 
				LEFT JOIN pelanggan ON penjualan.kd_pelanggan=pelanggan.kd_pelanggan
				ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
		
		# Menghitung Total Penjualan (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang,  
						  SUM(harga_jual * jumlah) AS total_harga  
				   FROM penjualan_item WHERE no_penjualan='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
		$jumlahBelanja = $myData['total_service'] + $my2Data['total_harga'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="center"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($jumlahBelanja); ?></td>
    <td align="center"><a href="penjualan_nota.php?noNota=<?php echo $noNota; ?>" target="_blank">Nota</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" bgcolor="#00FA9A"><b>Jumlah Data :</b> <?php echo $jml; ?></td>
    <td colspan="4" align="right" bgcolor="#00FA9A"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Daftar-Penjualan?hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</body>
</html>