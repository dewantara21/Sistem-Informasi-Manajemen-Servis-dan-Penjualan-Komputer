<style>
p{
border-top: 1px solid #EEEEEE;
margin-top: 0px; margin-bottom: 5px; padding-top: 5px;
}
</style>
<?php
session_start();
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
require_once 'connection.php';

$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
  
$username = $myData['username'];

$sql = "SELECT * FROM user_chat_messages where username='$username' OR recipient='$username' ORDER BY message_time";
$qry = $con->prepare($sql);
$qry->execute();
$fetch = $qry->fetchAll();
foreach ($fetch as $row):

	$time = date("Y-m-d",strtotime($row['message_time']));
	$now = date("Y-m-d");
	if (($row['username'] == $username) && ($time == $now)) {
		$user = '<strong style="color:blue;">'.$row['username'].'</strong>'.' To <strong style="color:red;">'.$row['recipient'].'</strong>'; 
	}else{
		$user = '<strong style="color:red;">'.$row['username'].'</strong>'.' To <strong style="color:blue;"> '.$row['recipient'].'</strong>'; 			
	}	
	if ($time == $now) {
		$hourAndMinutes = date("h:i A", strtotime($row['message_time']));
	}else{
		$hourAndMinutes = date("Y-m-d", strtotime($row['message_time']));
	}
	echo '<p>'.$user.',  Time : <em>('.$hourAndMinutes.')</em>'.'<br/>'.' '.'<img src="images/icon-mm.png" width="10" height="10">'.'<em><font style="color:black;"> '. $row['message_content']. '</font></em></p>';

endforeach; 

?>