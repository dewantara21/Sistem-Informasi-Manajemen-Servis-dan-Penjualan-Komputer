<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title> :: Data Servis- MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<script>
<body>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
<h2>LAPORAN DATA SERVIS</h2>
<table class="table-list" width="900" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td width="42" bgcolor="#00FA9A"><strong>No</strong></td>
    <td width="95" bgcolor="#00FA9A"><strong>Tanggal</strong></td>
    <td width="147" bgcolor="#00FA9A"><strong>Pelanggan</strong></td>
    <td width="150" bgcolor="#00FA9A"><strong>Nama Barang</strong></td>
    <td width="144" bgcolor="#00FA9A"><strong>Teknisi</strong></td>
    <td width="62" bgcolor="#00FA9A"><strong>Status</strong></td>
  </tr>

      <?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
$periode = $_GET['periode'];
$status  = $_GET['id'];
# Perintah untuk menampilkan Semua Daftar Transaksi Permintaan Material
	$mySql = "SELECT services.*, pelanggan.nm_pelanggan, user.nm_user FROM services 
				LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
				LEFT JOIN user ON services.teknisi=user.nm_user
				   $periode
				   $status
				ORDER BY services.kd_service DESC ";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor =0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['kd_service'];
		
	?>
      <tr>
        <td>&nbsp;<?php echo $nomor; ?></td>
        <td>&nbsp;<?php echo IndonesiaTgl($myData['tgl_service']); ?></td>
        <td>&nbsp;<?php echo $myData['nm_pelanggan']; ?></td>
        <td>&nbsp;<?php echo $myData['nama_brg']; ?></div></td>
        <td><?php echo $myData['nm_user']; ?></td>
        <td><?php echo $myData['step']; ?></td>
      </tr>
    
      <?php } ?>
     
    </table>
    <img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>         
