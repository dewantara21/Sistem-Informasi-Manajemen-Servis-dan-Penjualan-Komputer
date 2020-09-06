<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

?>
<html>
<head>
<title> :: Data User - MX Komputer</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
<h2> LAPORAN DATA USER </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="40" align="center" bgcolor="#00FA9A"><strong>No</strong></td>
    <td width="222" bgcolor="#00FA9A"><strong>Nama User</strong></td>
    <td width="192" bgcolor="#00FA9A"><strong>Username</strong></td>
    <td width="125" bgcolor="#00FA9A"><strong>Level</strong></td>
  </tr>
  <?php
	$mySql = "SELECT * FROM user ORDER BY kd_user ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor	 = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_user']; ?></td>
    <td><?php echo $myData['username']; ?></td>
    <td><?php echo $myData['level']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>