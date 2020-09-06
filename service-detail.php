<?php
include_once "library/inc.seslogin.php";


# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT  services.*, pelanggan.nm_pelanggan, detail_servis.*, user.nm_user FROM services 
				LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
				LEFT JOIN detail_servis ON services.kd_service=detail_servis.kd_service
				LEFT JOIN user ON services.teknisi=user.nm_user WHERE services.kd_service='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
?>
<table>
    <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">DETAIL SERVIS</h3>
	<tr>
	  <td width="26%"><b>Kode</b> <strong>Pelanggan</strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><?php echo $myData['nm_pelanggan']; ?></td></tr>
	<tr>
	  <td width="21%"><b>Teknisi</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><?php echo $myData['nm_user']; ?></td></tr>
	<tr>
	  <td><b>Tanggal Servis</b></td>
	  <td><b>:</b></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_service']); ?></td>
	</tr>
	<tr>
	  <td><b>Tanggal Selesai</b></td>
	  <td><b>:</b></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_selesai']); ?></td>
	</tr>
	<tr>
	  <td><b>Harga Jasa Servis</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['harga_jasa']; ?></td>
	</tr>
	<tr>
	  <td><b>Nama Perangkat</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['nama_brg']; ?></td>
	</tr>
	<tr>
      <td><strong>Deskripsi / Keluhan</strong></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['deskripsi']; ?></td>
    </tr>
	<tr>
      <td><strong>Status</strong></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['step']; ?></td>
    </tr>
</table>
</div></div>


