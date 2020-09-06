<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$noNota = $_GET['noNota'];
	
	# Perintah untuk mendapatkan data dari tabel pembelian
	$mySql = "SELECT pembelian.*, supplier.nm_supplier, user.nm_user FROM pembelian 
				LEFT JOIN supplier ON pembelian.kd_supplier=supplier.kd_supplier 
				LEFT JOIN user ON pembelian.kd_user=user.kd_user 
				WHERE pembelian.no_pembelian='$noNota'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Nota Pembelian - MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
  window.print();
  window.onfocus=function(){ window.close();}
</script>
</head>
<body>
<h2>LAPORAN BARANG MASUK</h2>
<table width="500" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="160"><b>No. Masuk </b></td>
    <td width="10"><b>:</b></td>
    <td width="302"><?php echo $kolomData['no_pembelian']; ?></td>
  </tr>
  <tr>
    <td><b>Tgl. Masuk </b></td>
    <td><b>:</b></td>
    <td><?php echo IndonesiaTgl($kolomData['tgl_pembelian']); ?></td>
  </tr>
  <tr>
    <td><b>Supplier</b></td>
    <td><b>:</b></td>
    <td><?php echo $kolomData['nm_supplier']; ?></td>
  </tr>
  <tr>
    <td><strong>Keterangan</strong></td>
    <td><b>:</b></td>
    <td><?php echo $kolomData['keterangan']; ?></td>
  </tr>
  <tr>
    <td><strong>Marketing</strong></td>
    <td><b>:</b></td>
    <td><?php echo $kolomData['nm_user']; ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="6" bgcolor="#00FA9A"><strong>DAFTAR BARANG</strong></td>
  </tr>
  <tr>
    <td width="35" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="74" bgcolor="#F5F5F5"><strong>Kode </strong></td>
    <td width="390" bgcolor="#F5F5F5"><b>Nama Barang</b></td>
    <td width="103" align="center" bgcolor="#F5F5F5"><strong>Harga Beli(Rp)</strong></td>
    <td width="51" align="center" bgcolor="#F5F5F5"><b>Jumlah</b></td>
    <td width="116" align="center" bgcolor="#F5F5F5"><strong>Harga Total(Rp)</strong> </td>
  </tr>
<?php
// Variabel data
$subTotalBeli=0; 
$grandTotalBeli = 0; 
$totalBarang = 0; 

// Skrip untuk mengambil data daftar barang yang dibeli
$mySql ="SELECT pembelian_item.*, barang.nm_barang, kategori.nm_kategori FROM pembelian_item 
		 LEFT JOIN barang ON pembelian_item.kd_barang=barang.kd_barang 
		 LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
		 WHERE pembelian_item.no_pembelian='$noNota' ORDER BY pembelian_item.kd_barang";
$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$nomor=0; 
while($myData = mysql_fetch_array($myQry)) {
	$totalBarang	= $totalBarang + $myData['jumlah'];
	$subTotalBeli	= $myData['harga_beli'] * $myData['jumlah']; // harga beli dari tabel pembelian_item (harga terbaru dari supplier)
	$grandTotalBeli	= $grandTotalBeli + $subTotalBeli;
	$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_beli']); ?></td>
    <td align="center"><?php echo $myData['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subTotalBeli); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right" bgcolor="#F5F5F5"><b> Grand Total (Rp)  : </b></td>
    <td align="center" bgcolor="#F5F5F5"><strong><?php echo format_angka($totalBarang); ?></strong></td>
    <td align="right" bgcolor="#F5F5F5"><strong><?php echo format_angka($grandTotalBeli); ?></strong></td>
  </tr>
</table>
<br/>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>