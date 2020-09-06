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
        
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA USER</h3>

<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <td width="32" align="center"><b>No</b></td>
    <td width="276"><b>Nama User </b></td>
    <td width="141"><b>No Telepon </b></td>
    <td width="140"><b>Username</b></td>
    <td width="85"><b>Level</b></td>
  </tr>
  </thead>
	<?php
		$mySql 	= "SELECT user.*, level.level FROM user LEFT JOIN level ON user.kd_level=level.kd_level ORDER BY user.kd_user";
		$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor  = 0; 
		while ($myData = mysql_fetch_array($myQry)) {
			$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_user']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
    <td><?php echo $myData['username']; ?></td>
    <td><?php echo $myData['level']; ?></td>
  </tr>
  <?php } ?>
</table>
</div></div>

<br />
<button class="btn btn-app btn-light btn-mini" onclick="window.open('cetak/user.php','popuppage','width=800,toolbar=0,resizable=0,scrollbars=no,height=300,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Print
									</button>