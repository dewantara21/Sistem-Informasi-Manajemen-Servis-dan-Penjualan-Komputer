<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/inc.pilihan.php";
include_once "library/inc.pilihan.php";
// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>CV. MX Komputer</title>
		<link rel="shortcut icon" href="assets/ico/favicon.png">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="assets/css/font.css" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--notifikasi pesan-->
		 

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="?page=Halaman-utama" class="brand">
						<small><img src='assets/img/logo1.png'>	</small></a><!--/.brand-->

					 
					<ul class="nav ace-nav pull-right">
						<!-- <li class="grey">
							<a href="#">
								<i class="icon-calendar icon-animated-vertical"></i>
								<span id='tanggalnya'/></a>
                       

						</li>

						<li class="purple">
							<a  href="#">
								<i class="icon-time icon-animated-vertical"></i>
								 <span id='jamnya'/>							</a>

							
						</li> -->
                        <li class="blue">
							<?php
$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
?>                                      <a href="#">      
								<i class="icon-user "></i> <!--dalam class icon-animated-vertical -->
								 					 <?php echo $myData['nm_user']; ?></a>
							
						</li>

						<li class="read">
							<a href="?page=Logout">
								<i class="icon-off "></i>
								Logout							</a>
						</li>
						
                      <!-- UNTUK PESAN <li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php $mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query user salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);

$userid = $myData['username'];
// $pesan = mysql_query("SELECT * FROM user_chat_messages WHERE recipient='$userid' and sudahbaca='N'");
// $j = mysql_num_rows($pesan);  
// echo  $j; ?> </span>							</a>

						 <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-envelope-alt"></i>
								<?php // echo  $j; ?> Messages	</li>
                                   <?php  
			/*					  while($p = mysql_fetch_array($pesan)){
								   
							   echo "<li><span class='msg-body'> <a href=?page=Lihat-Pesan&no=".$p['id'].">"."<img src='assets/avatars/avatar.png' class='msg-photo' alt='Alex's Avatar' /><span class='msg-title'>"." <span class='red'>" .$p['username']."</span>"."</a></span></span><span class=msg-time><i class='icon-time'></i><span>"."".$p['message_time']."</span></span><hr></li>";
								  } */
?>
												
													
							  				  

							 <li class="nav-header">
								 <div align="left"><a href="?page=Kontak">
								     See all messages
									  <i class="icon-arrow-right"></i> </a> </div>
								</li>
						   </ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span></a>

			<div class="sidebar" id="sidebar">
				
                <!--#sidebar-shortcuts-->

				<?php include "menu.php"; ?>

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>				</div>
			</div>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
						
							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>							</span>						</li>
						<li class="active">	<a href="?page=Halaman-Utama">Dashboard /</a> <a href="javascript:history.back()" class="btn-link">Back</a> <a href="javascript:history.forward()" class="btn-link">Next</a></li>
					</ul><!--.breadcrumb-->
				  <!--#nav-search-->
			  </div>
				<div class="page-content"><!--/.page-header-->
				<div class="row-fluid">
						<div class="span12">
						<div class="row-fluid"><!--/span--><!--/span-->
							  <?php include "fetch.php";?>
							  
							</div><!--/row-->
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<!-- PEMILIHAN WARNA
                
              <div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
                                    <option data-class="default" value="#438EB9" />#438EB9
									<option data-class="skin-1" value="#222A2D" />#222A2D
									<option data-class="skin-2" value="#C6487E" />#C6487E
									<option data-class="skin-3" value="#D0D0D0" />#D0D0D0
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container--> 
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i></a>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>


		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/flot/jquery.flot.min.js"></script>
		<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
        
		<!--inline scripts related to this page-->

		
        <script type='text/javascript'>
//<![CDATA[
function showdate(){
var months=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];var myDays=['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
var date=new Date();var day=date.getDate();var month=date.getMonth();
var thisDay=date.getDay(),thisDay=myDays[thisDay];var yy=date.getYear();
var year=(yy<1000)?yy+1900:yy;
document.getElementById('tanggalnya').innerHTML=thisDay+", "+day+" "+months[month]+" "+year;}showdate();
function showtime(){
var a_p="";var today=new Date();var curr_hour=today.getHours();var curr_minute=today.getMinutes();var curr_second=today.getSeconds();
if(curr_hour<12){a_p="AM";}else{a_p="PM";}if(curr_hour==0){curr_hour=12;}if(curr_hour>12){curr_hour=curr_hour-12;}curr_hour=checkTime(curr_hour);curr_minute=checkTime(curr_minute);curr_second=checkTime(curr_second);document.getElementById('jamnya').innerHTML=curr_hour+":"+curr_minute+":"+curr_second+" "+a_p;;}
function checkTime(i){if(i<10){i="0"+i;}return i;}
setInterval(showtime,500);
//]]></script>
	
	</body>
</html>
