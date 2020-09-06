<?php

include('connection.php');
		
$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
  
$username = $myData['username'];
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">KIRIM PESAN</h3>

<html lang="EN">
	<head>
		<meta charset="utf-8">
		<style>
			body {
				font-family:"Tahoma",Arial Narrow;
				font-size: 12px;
			}
			.holder {
				padding:3px;
				margin-left:0;
				margin-right:auto;
				margin-top:0;
				display:table;
				border:solid 1px #cccccc;
				border-width: thin;
			}
			.style {
				bottom:0px;
				border:1px solid #666;
				background-color:#FFF;
				border-radius:3px;
				-webkit-border-radius:3px;
				-moz-border-radius:3px;
				box-shadow:0 0 5px #000;			
				-moz-box-shadow:0 0 5px #000;			
				-webkit-box-shadow:0 0 5px #000;			
			}
			.alpha {
				float:right;
				width:100%px;
				padding:2px;
				border:1px solid #666;
				background-color:#FFF;
				border-radius: 3px;
				}
			.refresh {
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				color: green;
				font-family: tahoma;
				font-size: 12px;
				height: 225px;
				overflow: auto;
				width: 100%px;
				padding:10px;
				background-color:#FFFFFF;
			}	
			#post_button{
				border: 1px solid #3366FF;
				background-color:#3366FF;
				width: 50px;
				color:#FFFFFF;
				font-weight: bold;
				margin-left: -04px; padding-top: 4px; padding-bottom: 4px;
				cursor:pointer;
			}
			#textb{
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 5px;
				width: 220px;
			}
			#texta{
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				width: 300px;
				margin-bottom: 10px;
				padding:5px;
			}
			#johnlei{
				margin-left:3px;
				color: #ffffff;
				text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
				background-color: #49afcd;
				*background-color: #2f96b4;
				background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
				background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
				background-repeat: repeat-x;
				border-color: #2f96b4 #2f96b4 #1f6377;
				border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
				filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
				float:right;
				cursor:pointer;	
				height: 53px;
				width:70px;
			}
			#johnlei:hover,
			#johnlei:active,
			#johnlei.active,
			#johnlei.disabled,
			#johnlei[disabled] {
				color: #ffffff;
				background-color: #51a351;
				*background-color: #499249;
			}
			#johnlei:active,
			#johnlei.active {
				background-color: #408140;
			}
			#johnlei:hover{
				background-color: #2f96b4;
			}
		</style>
		<script src="js/jquery.js"></script>
	</head>
	<body>                        
	<div class="holder">
		<label ="welcomemsg">Selamat Datang: </label><label for="name"><?php echo $username; ?></label>
			<div class="style">	
				<div class="alpha">
					<b align="center">Kamu bisa melihat percakapan anda disini:</b>
					<input name="user" type="hidden" id="texta" value="<?php echo $username; ?>"/>
					<div class="refresh">
					</div>
					<br/>
					<form name="newMessage" class="newMessage" action="" onSubmit="return false">
						<select name="recipient" id="recipient" style="width:100%px;">
							<option>--Pilih Anggota Percakapan--</option>
								<?php 
									$sql = "SELECT * FROM user where username!='$username' ORDER BY username";
									$qry = $con->prepare($sql);
									$qry->execute();
									$fetch = $qry->fetchAll();
									foreach ($fetch as $fe):
										$name = $fe['username'];
								?>
									<option title="<?php echo $name; ?>"><?php echo $fe['username']; ?> </option>
								<?php endforeach; ?>
						</select>
					<textarea name="textb" id="textb" >Tulis Pesanmu disini</textarea>
					<input name="submit" type="submit" value="Kirim" id="johnlei" />
				</form>
			</div>
		</div>
		<script src="js/sendchat.js" type="text/javascript"></script>
		<script src="js/refresh.js" type="text/javascript"></script>
	</div>	
	</body>
</html>
<script src="assets/js/jquery.min.js"></script>


		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		
