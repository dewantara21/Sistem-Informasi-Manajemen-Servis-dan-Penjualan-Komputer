<script language="JavaScript">
<!-- Begin
function sendValue (s){

window.opener.document.getElementById('txtHargaJasa').value = s;

window.close();
}
function sendValue2 (s){

window.opener.document.getElementById('txtKodeS').value = s;

window.close();
}
function sendValue3 (s){

window.opener.document.getElementById('txtPerangkat').value = s;

window.close();
}
function sendValue4 (s){

window.opener.document.getElementById('txtJasaService').value = s;

window.close();
}
//  End -->
</script>
<?php

include_once "../library/inc.seslogin.php";

# Simpan Variabel KATA KUNCI
$kataKunci = isset($_GET['kataKunci']) ? $_GET['kataKunci'] : '';
$kataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : $kataKunci;




//Query #1 (all)
$filterSQL 	= "SELECT detail_servis.*, services.*, pelanggan.* FROM detail_servis 
				LEFT JOIN services ON detail_servis.kd_service=services.kd_service 
				LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
				WHERE pelanggan.nm_pelanggan LIKE '%".$kataKunci."%' AND services.step='SELESAI' 
				ORDER BY detail_servis.id_jasa";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;  // Jumlah baris data
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageQry = mysql_query($filterSQL, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pencarian Data Servis</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h2><b>PENCARIAN DATA SERVIS </b></h2></td>
  </tr>
  <tr>
    <td colspan="2"><table width="552" height="63" border="0"  class="table-list">
      <tr>
        <td colspan="3" bgcolor="#00FA9A"><strong>PENCARIAN </strong></td>
      </tr>
      <tr>
        <td width="134"><strong>Cari Nama Pelanggan </strong></td>
        <td width="20"><strong>:</strong></td>
        <td width="384"><input name="txtKataKunci" type="text" value="<?php echo $kataKunci; ?>" size="40" maxlength="100" />
            <input name="btnCari" type="submit" value="Cari" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="32" bgcolor="#00FA9A"><strong>No</strong></td>
        <td width="108" bgcolor="#00FA9A"><strong>Tanggal</strong></td>
        <td width="135" bgcolor="#00FA9A"><strong>Pelanggan</strong></td>
        <td width="195" bgcolor="#00FA9A"><strong>Nama Perangkat</strong></td>
        <td width="108" bgcolor="#00FA9A"><strong>Harga Jasa </strong></td>
         <td width="130" bgcolor="#00FA9A"><strong>Deskripsi </strong></td>
        <td width="104" bgcolor="#00FA9A"><strong>Status</strong></td>
        <td width="91" align="right" bgcolor="#00FA9A"><strong>Aksi</strong></td>
        </tr>
      <?php
	# MENJALANKAN QUERY CARI DI ATAS
	$mySql 	= $filterSQL." LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['id_jasa'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['tgl_service']; ?></td>
        <td><?php echo $myData['nm_pelanggan']; ?></td>
         <td><?php echo $myData['nama_brg']; ?></td>
        <td><?php echo format_angka($myData['harga_jasa']); ?></td>
        <td><?php echo $myData['deskripsi']; ?></td>
        <td><?php echo $myData['step']; ?></td>
        <td align="right"><a href="#" onClick="sendValue4('<?php echo $myData['deskripsi']; ?>'); sendValue3('<?php echo $myData['nama_brg']; ?>'); sendValue2('<?php echo $myData['kd_service']; ?>'); sendValue('<?php echo $myData['harga_jasa']; ?>');"><span class="btn-xs btn-success"><i class="icon-edit"></i>Pilih</span></a></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="4" bgcolor="#00FA9A"><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
        <td colspan="5" align="right" bgcolor="#00FA9A"><b>Halaman ke :</b>
        <?php
		for ($h = 1; $h <= $max; $h++) {
			$list[$h] = $row * $h - $row;
			echo " <a href='?page=Pencarian-Barang&hal=$list[$h]&kataKunci=$kataKunci'>$h</a> ";
		}
		?>	</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>


</body>
</html>