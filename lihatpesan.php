<?php
session_start();
include_once "library/inc.seslogin.php";
include 'connection.php';

$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);

$userid = $myData['username'];
$pesan = mysql_query("SELECT * FROM user_chat_messages WHERE username!='$userid' and sudahbaca='N'");
$j = mysql_num_rows($pesan);

$p = mysql_fetch_array($pesan);
   
    echo "<a href=pesan.php?no=".$p['id']."> ".$p['username']."</a>".$p['message_time']."";


?>

