<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

# Baca variabel URL
$noNota = $_GET['noNota'];

# Perintah untuk mendapatkan data dari tabel penjualan
$mySql = "SELECT penjualan.*, user.nm_user, pelanggan.* FROM penjualan
			LEFT JOIN user ON penjualan.kd_user=user.kd_user 
			LEFT JOIN pelanggan ON penjualan.kd_pelanggan=pelanggan.kd_pelanggan
			WHERE no_penjualan='$noNota'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$kolomData = mysql_fetch_array($myQry);
?>
<html>
<head>
<title> .:Nota Penjualan:.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">
<table width="740">
  <tr>
    <td height="87" colspan="7" align="center"><p><code><strong>MX KOMPUTER</strong><br>
    Jl Wates Km.3 No.36 - Yogyakarta</code></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><code><strong>Invoice </strong></code></td>
    <td width="31" align="right"><code>:</code></td>
    <td width="465" colspan="4" align="right"><div align="left"><code><?php echo $kolomData['no_penjualan']; ?></code></div></td>
 
  </tr>
  <tr>
    <td colspan="2"><code><strong>Tanggal </strong></code></td>
    <td align="right"><code>:</code></td>
    <td colspan="4" align="right"><div align="left"><code>Yogyakarta, <?php echo IndonesiaTgl($kolomData['tgl_penjualan']); ?></code></div></td>
  </tr>
  <tr>
    <td colspan="2"><code><strong>Pelanggan </strong></code></td>
    <td align="right"><code>:</code></td>
    <td colspan="4" align="right"><div align="left"><code><?php echo $kolomData['nm_pelanggan']; ?></code></div></td>
  </tr>
 <!-- <tr>
    <td colspan="2"><code><strong>No. Identitas </strong></code></td>
    <td align="right"><code>:</code></td>
    <td colspan="4" align="right"><div align="left"><code><?php // echo $kolomData['nm_toko']; ?></code></div></td>
  </tr> -->
  
  <tr>
    <td colspan="7"><h3>&nbsp;</h3></td>
  </tr>
  <tr bgcolor="#00FA9A">
    <td colspan="7"><strong><h3><code>JASA SERVIS</code></h3></strong></td>
  </tr>
</table>
<table width="750" >
 <tr>
    <td width="332" align="left" bgcolor="#F5F5F5"><code><strong>Nama Perangkat</strong></code></td>
    
    <!-- <td width="152" align="center" bgcolor="#F5F5F5"><div align="right"><code><strong>Total (Rp)</strong></code></div></td> -->

     <td width="351" align="center" bgcolor="#F5F5F5"><div align="left"><code><strong>Deskripsi </strong></code></div></td>
    <td width="152" align="center" bgcolor="#F5F5F5"><div align="right"><code><strong>Biaya Jasa</strong></code></div></td>

  </tr>
	
  <tr>
    <td align="left"><div align="left"><code><?php echo $kolomData['nama_brg']; ?></code></div></td>
    <td><div align="left"><code><?php echo $kolomData['jasa_service']; ?></code></div></td>
    <td align="center"><code><div align="right"> <?php echo format_angka($kolomData['harga_service']); ?></code></div></td>
   <!-- <td align="right"><div align="center"><code><?php  // echo $kolomData['diskon_service']; ?> %</code></div></td>
    <td align="center"><div align="right"><code><?php // echo format_angka($kolomData['total_service']); ?></code></div></td> -->
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  </table>
<table width="740">
<tr bgcolor="#00FA9A">
    <td colspan="7"><strong><h3><code>BARANG</code></h3></strong></td>
  </tr>
 </table>

<table class="table" width="742" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="43" align="center" bgcolor="#F5F5F5"><code><strong>No</strong></code></td>
    <td width="213" bgcolor="#F5F5F5"><code><strong>Nama Barang</strong></code></td>
    <td width="199" align="center" bgcolor="#F5F5F5"><code><strong>Harga</strong></code></td>
    <td width="66" align="center" bgcolor="#F5F5F5"><code><strong></strong></code></td>
    <td width="35" align="center" bgcolor="#F5F5F5"><code><strong>Qty</strong></code></td>
    <td width="155" align="right" bgcolor="#F5F5F5"><code><strong>Total(Rp)</strong></code></td>
  </tr>
	<?php
	# Menampilkan List Item barang yang dibeli untuk Nomor Transaksi Terpilih
	$notaSql = "SELECT penjualan_item.*, barang.nm_barang FROM penjualan_item
				LEFT JOIN barang ON penjualan_item.kd_barang=barang.kd_barang 
				WHERE penjualan_item.no_penjualan='$noNota'
				ORDER BY barang.kd_barang ASC";
	$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list barang salah : ".mysql_error());
	$nomor   = 0;  $hargaDiskon=0; $totalBayar = 0; $jumlahBarang = 0;  $uangKembali=0;
	while ($notaData = mysql_fetch_array($notaQry)) {
	$nomor++;
	//	$hargaDiskon= $notaData['harga_jual'] - ( $notaData['harga_jual'] * $notaData['diskon'] / 100 );
		$subSotal 	= $notaData['jumlah'] *  $notaData['harga_jual'];
		$totalBayar	= $totalBayar + $subSotal;
		$totalBayar2 = $totalBayar + $kolomData['total_service'];
		$jumlahBarang	= $jumlahBarang + $notaData['jumlah'];
		$uangKembali= $kolomData['uang_bayar'] - $totalBayar2;
	?>
  <tr>
    <td align="center"><code><?php echo $nomor; ?></code></td>
    <td><code><?php echo $notaData['nm_barang']; ?></code></td>
    <td align="center"><code><?php echo format_angka($notaData['harga_jual']); ?></code></td>
    <td align="center"><code><?php // echo $notaData['diskon']; ?></code></td>
    <td align="center"><code><?php echo $notaData['jumlah']; ?></code></td>
    <td align="right"><code><?php echo format_angka($subSotal); ?></code></td>
  </tr>
  <?php } ?>

   <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="3" align="right"><code><strong>Total  (Rp) : </strong></code></td>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><code><strong><?php echo format_angka($totalBayar + $kolomData['harga_service']); ?></strong></code></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><code><strong>  Uang Bayar (Rp) : </strong></code></td>
    <td colspan="3" align="right"><code><strong><?php echo format_angka($kolomData['uang_bayar']); ?></strong></code></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><code><strong>Uang Kembali  (Rp) : </strong></code></td>
    <td colspan="3" align="right"><code><strong><?php echo format_angka($kolomData['uang_bayar'] - ($totalBayar + $kolomData['harga_service'])); ?></strong></code></td>
  </tr>
</table>
<table width="430" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div align="left" class="table-list"><strong><code>Marketing:</code></strong> <code><?php echo $kolomData['nm_user']; ?></code></div></td>
  </tr>
</table>
</body>
</html>