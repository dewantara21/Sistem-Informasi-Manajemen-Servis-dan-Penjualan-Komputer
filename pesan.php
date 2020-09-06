<h2>Pesan Masuk</h2>
<?php
include_once "library/inc.seslogin.php";
$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);

$userid = $myData['username'];

$no = $_GET['no'];
$pesan = mysql_query("SELECT * FROM user_chat_messages WHERE id='$no' and recipient='$userid'");
while($p = mysql_fetch_array($pesan)){
    echo "FROM : <br><li>".$p['username']."</li><p>";
    echo "WAKTU : <br><li>".$p['message_time']."</li><p>";
    echo "PESAN :<BR><textarea cols='100' rows='5' disabled='disabled'>".$p['message_content']."</textarea>"."<p>";
}
//set sudah dibaca = Y kalau sudah dibaca
$update = mysql_query("UPDATE user_chat_messages SET sudahbaca='Y'
WHERE id=$no ");


	header('location:?page=Kontak');
	
?>
<a href="?page=Kontak"><input name="" type="button"  value="Balas Pesan"/></a>