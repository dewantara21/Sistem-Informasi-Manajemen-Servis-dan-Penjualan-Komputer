<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />


		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
<?php
include_once "library/inc.seslogin.php";
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA SUPPLIER</h3>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
  
  <thead>
  <tr>
    <td width="30" align="center" ><strong>No</strong></td>
    <td width="215" ><strong>Nama Supplier </strong></td>
    <td width="150" ><strong>Kabupaten/Kota </strong></td>  
    <td width="250" ><strong>Alamat Lengkap  </strong></td>  
    <td width="134"><strong>No. Telepon </strong></td>
  </tr>
 </thead>


<?php
	$mySql = "SELECT supplier.*, kabupaten.nm_kabupaten from Supplier LEFT JOIN kabupaten ON supplier.kd_kabupaten=kabupaten.kd_kabupaten ORDER BY kd_supplier ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_supplier']; ?></td>
    <td><?php echo $myData['nm_kabupaten']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
<?php } ?>
</table>
</div></div>
<br />
<button class="btn btn-app btn-light btn-mini" onclick="window.open('cetak/supplier.php','popuppage','width=800,toolbar=0,resizable=0,scrollbars=no,height=300,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Print
									</button>