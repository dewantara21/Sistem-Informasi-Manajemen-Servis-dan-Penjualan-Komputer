<!DOCTYPE html>
	<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="A clean login and registration template based on Bootstrap framework">
	<meta name="author" content="">

			<title>Login | MX Komputer</title>

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
			<h1> Login</h1>
			<form name="logForm" method="post" action="dasboard.php?page=Login-Validasi" class="form-horizontal">
				<div class="form-group">
					<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input type="text" class="form-control input-lg"  name="txtUser" placeholder="Username"  required autofocus>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control input-lg" name="txtPassword" placeholder="Password" required>
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
						<div class="col-sm-7">
							<div class="checkbox">
								<label>
								<!--	<input type="checkbox" checked autocomplete="off"> Keep me login in -->
								<div><a href="forgot-pass.php">Lupa Password ?</a></div>
								</label>
							</div>
						</div>
						<div class="col-sm-5 submitWrap">
							<button type="submit" class="btn btn-primary btn-lg" name="btnLogin">Log In</button>
						</div>
					</div>
					<div class="form-group formNotice">
						
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

<!-- Mirrored from swoopthemes.com/templates/logg/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jan 2015 04:10:04 GMT -->
</html>