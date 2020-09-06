<?php
if(isset($_POST['submit_email']) && $_POST['email'])
{
  mysql_connect('localhost','root','');
  mysql_select_db('servis_komputer');
  $select=mysql_query("select email,password from user where email='$email'");
  if(mysql_num_rows($select)==1)
  {
    while($row=mysql_fetch_array($select))
    {
      $email=md5($row['email']);
      $pass=md5($row['password']);
    }
    $link="<a href='www.samplewebsite.com/reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "your_email_id@gmail.com";
    // GMAIL password
    $mail->Password = "your_gmail_password";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='your_gmail_id@gmail.com';
    $mail->FromName='your_name';
    $mail->AddAddress('reciever_email_id', 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$pass.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  } 
}
?>