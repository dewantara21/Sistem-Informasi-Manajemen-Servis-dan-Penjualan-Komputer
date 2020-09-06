<?php
session_start();
require_once 'connection.php';
$username = $_POST['username'];
$message = $_POST['message'];
$recipient = $_POST['recipient'];
$sql = "INSERT INTO user_chat_messages
	(message_content,username,
	message_time,recipient,sudahbaca)
	VALUES
	(:a,:b,now(),:d,:e)";
$qry = $con->prepare($sql);
$qry->execute(array(':a'=>$message,':b'=>$username,':d'=>$recipient,':e'=>'N'));
?>