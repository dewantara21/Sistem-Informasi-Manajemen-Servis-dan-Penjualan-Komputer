<?php
$mySql = "SELECT user.*, level.level FROM user LEFT JOIN level ON user.kd_level=level.kd_level WHERE user.kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
?> <br><br>

  <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue"><strong>INFO LOGIN </strong></h3>
 <table id="sample-table-2" class="table table-striped table-bordered table-hover">
  <tr>
    <td><strong>Nama Anda </strong></td>
    <td><?php echo $myData['nm_user']; ?></td>
  </tr>
    <td width="195"><strong>Username</strong></td>
    <td width="381"><?php echo $myData['no_telepon']; ?></td>
  </tr>
  <tr>
    <td width="195"><strong>Username</strong></td>
    <td width="381"><?php echo $myData['username']; ?></td>
  </tr>
  <tr>
    <td><strong>Level</strong></td>
    <td><?php echo $myData['level']; ?></td>
  </tr>
</table>
