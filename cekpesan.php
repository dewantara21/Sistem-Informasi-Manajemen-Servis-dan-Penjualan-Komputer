<?php
session_start();
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
require_once 'connection.php';
$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
                       
$userid = $myData['username'];
$pesan = mysql_query("SELECT username FROM user_chat_messages
    WHERE username!='$userid' and sudahbaca='N'");
$j = mysql_num_rows($pesan);
if($j>0){
    echo $j;
}
?>
