<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<?php
include_once "library/inc.seslogin.php";
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA KATEGORI</h3>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <td width="30" ><strong>No</strong></td>
    <td width="544"><strong>Nama Kategori </strong></td>
    <td width="110" ><strong>Qty Barang  </strong></td>  
  </tr>
</thead>
  <?php
	  // Menampilkan daftar kategori
	$mySql = "SELECT kategori.*,  
					( SELECT COUNT(*) FROM barang WHERE kd_kategori=kategori.kd_kategori ) As  qty_barang
			  FROM kategori ORDER BY kd_kategori ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
    <td align="center"><?php echo $myData['qty_barang']; ?></td>
  </tr>
  <?php } ?>
</table>
</div></div>
<br />
<button class="btn btn-app btn-light btn-mini" onclick="window.open('cetak/kategori.php','popuppage','width=600,toolbar=0,resizable=0,scrollbars=no,height=300,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Print
									</button>