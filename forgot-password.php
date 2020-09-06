<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$connection = new mysqli("localhost","root","","servis_komputer");

if($_POST)
{
$email = $_POST['email'];
$selectquery = mysqli_query($connection, "select * from user where email='{$email}'") or die(mysqli_error($connection));
$count = mysqli_num_rows($selectquery);
$row = mysqli_fetch_array($selectquery);
if($count>0)

{



// Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dewantara2911@gmail.com';                     // SMTP username
    $mail->Password   = 'pengadilan21';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('dewantara2911@gmail.com', 'Mailer');
    $mail->addAddress($email, $email);     // Add a recipient
   
    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'MX Komputer | Forgot password';
    $mail->Body    = "Hi $email your password is {$row['password']}";
    $mail->AltBody = "Hi $email your password is {$row['password']}";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}
else {
echo "<script>alert('email not found!') </script>";
}
}
?>

<html>
<body>
<form method="post">

Email : <input type="email" name="email">
<br/>
<input type="submit">
</html>