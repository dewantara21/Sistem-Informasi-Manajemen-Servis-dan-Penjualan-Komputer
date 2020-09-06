<?php
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  mysql_connect('localhost','root','');
  mysql_select_db('servis_komputer');
  $select=mysql_query("update user set password='$pass' where email='$email'");
}
?>