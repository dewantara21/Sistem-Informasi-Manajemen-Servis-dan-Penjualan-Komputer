

<!DOCTYPE html>
	<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="A clean login and registration template based on Bootstrap framework">
	<meta name="author" content="">

			<title>Forgot Password | MX Komputer</title>

			<!-- Bootstrap core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<link rel="shortcut icon" href="assets/ico/favicon.png">
			<!-- Custom styles for this template -->
			<link href="css/custom.css" rel="stylesheet">			
			<link href="css/font-awesome.css" rel="stylesheet">
			<link media="screen" rel="stylesheet" href="css/font-awesome-2.css">
</head>

<body>
	<div id="mainWrap">
		<div id="loggit">
			<h1> Forgot Password</h1>
			<form name="logForm" method="post" class="form-horizontal">
				<div class="form-group">
					<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
								<input type="email" class="form-control input-lg"  name="email" placeholder="E-mail"  required autofocus>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12">
		<!--					<div class="input-group"><span class="input-group-addon"><i class="fa fa-align-justify fa-fw"></i></span></span>
					 <select name="cmbLevel" class="form-control input-lg" required>
		<option value="KOSONG">--Pilih--</option>
		<?php
		// $pilihan = array("Marketing", "Teknisi","Manager","Keuangan");
		// foreach ($pilihan as $nilai) {
		//	if ($_POST['cmbLevel']==$nilai) {
		//		$cek="selected";
		//	} else { $cek = ""; }
		//	echo "<option value='$nilai' $cek>$nilai</option>";
		// }
		// ?>
		</select> 
		</div> -->
		</div>
		</div>
	
					<div class="form-group formSubmit">
						<div class="col-sm-9">
							<div class="checkbox">
								<label>
								<div><a href="index.php">Back</a></div>
								</label>
							</div>
						</div>
						<div class="col-sm-1 submitWrap">
							
							<button type="submit" class="btn btn-primary btn-lg" name="btnLogin">Kirim </button>
						</div>
					</div>
					<div class="form-group formNotice">
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
    $mail->Subject = 'MX Komputer | Forgot password !';
    $mail->Body    = "Hi $email, password anda: {$row['password']}";
    $mail->AltBody = "Hi $email, password anda: {$row['password']}";

    $mail->send();
    echo 'Email telah dikirim !';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}
else {
echo "Email tidak ditemukan !";
}
}
?>

					</div>
				</form>
				
			</div>

			</div>
			<footer class="clearfix">
				<p>CV. MX Komputer</a></p>
				<p>Jl. Wates KM 3 No.36 Yogyakarta</p>
			</footer>


			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			
			<script type="text/javascript">
				$(document).ready(function() {
					
					$('.formNotice span').click(function() {
						$("#logForm").toggle();
						$("#regForm").toggle();
					});
					
						
				});
			</script>
	
		</body>


</html>