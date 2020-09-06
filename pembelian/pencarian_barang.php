<script language="JavaScript">
<!-- Begin
function sendValue (s){

window.opener.document.getElementById('txtKode').value = s;

window.close();
}
//  End -->
</script>
<?php

include_once "../library/inc.seslogin.php";
  if (!isset($_SESSION)) {
        session_start();
    }
# Simpan Variabel KATA KUNCI
$kataKunci = isset($_GET['kataKunci']) ? $_GET['kataKunci'] : '';
$kataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : $kataKunci;

//Query #1 (all)
$filterSQL 	= "SELECT barang.*, kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
				WHERE barang.nm_barang LIKE '%".$kataKunci."%' 
				ORDER BY barang.kd_barang";

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
<title>Pencarian Barang - MX Komputer</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h2><b>PENCARIAN BARANG </b></h2></td>
  </tr>
  <tr>
    <td colspan="2"><table width="552" height="63" border="0"  class="table-list">
      <tr>
        <td colspan="3" bgcolor="#00FA9A"><strong>PENCARIAN </strong></td>
      </tr>
      <tr>
        <td width="134"><strong>Cari Nama Barang </strong></td>
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
        <td width="58" bgcolor="#00FA9A"><strong>Kode</strong></td>
     <!--   <td width="95" bgcolor="#00FA9A"><strong>Barcode</strong></td> -->
        <td width="358" bgcolor="#00FA9A"><strong>Nama Barang </strong></td>
        <td width="184" bgcolor="#00FA9A"><strong>Kategori</strong></td>
        <td width="40" align="center" bgcolor="#00FA9A"><strong>Stok</strong></td>
        <td width="91" align="right" bgcolor="#00FA9A"><strong>Hrg.  Jual (Rp)</strong></td>
        <td width="91" align="right" bgcolor="#00FA9A"><strong>Aksi</strong></td>
        </tr>
      <?php
	# MENJALANKAN QUERY CARI DI ATAS
	$mySql 	= $filterSQL." LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
      <!--  <td><?php // echo $myData['barcode']; ?></td> -->
        <td><?php echo $myData['nm_barang']; ?></td>
        <td><?php echo $myData['nm_kategori']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td align="right"><a href="#" onClick="sendValue('<?php echo $myData['kd_barang']; ?>');"><span class="btn-xs btn-success"><i class="icon-edit"></i>Pilih</span></a></td>
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