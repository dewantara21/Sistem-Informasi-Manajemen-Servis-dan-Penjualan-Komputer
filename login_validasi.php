<?php 
if(isset($_POST['btnLogin'])){
	$pesanError = array();
	if ( trim($_POST['txtUser'])=="") {
		$pesanError[] = "Data <b> Username </b>  tidak boleh kosong !";		
	}
	if (trim($_POST['txtPassword'])=="") {
		$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
	}
//	if (trim($_POST['cmbLevel'])=="KOSONG") {
//		$pesanError[] = "Data <b>Level</b> belum dipilih !";		
//	}
	
	# Baca variabel form
	$txtUser 	= $_POST['txtUser'];
	$txtUser 	= str_replace("'","&acute;",$txtUser);
	
	$txtPassword=$_POST['txtPassword'];
	$txtPassword= str_replace("'","&acute;",$txtPassword);
	
//	$cmbLevel	=$_POST['cmbLevel'];
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>
											<i class='icon-remove'></i></button>

										<strong>
											";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</strong></div> <br>"; 
		
		// Tampilkan lagi form login
		include "login.php";
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT user.*, level.level FROM user LEFT JOIN level ON user.kd_level=level.kd_level
		WHERE user.username='".$txtUser."' 
					AND user.password='".$txtPassword."'";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Query Salah : ".mysql_error());
		$myData= mysql_fetch_array($myQry);

		$cek = mysqli_num_rows($myQry);
		$data = mysqli_fetch_assoc($myData);

		# JIKA LOGIN SUKSES
		if(mysql_num_rows($myQry) >=1) {
			$_SESSION['SES_LOGIN'] = $myData['kd_user']; 
			$_SESSION['SES_USER'] = $myData['username']; 
			
			// Jika yang login Administrator

			if($myData['level']=="Marketing") {
				$_SESSION['SES_MARKETING'] = "Marketing";
			}
			
			// Jika yang login Teknisi
			if($myData['level']=="Teknisi") {
				$_SESSION['SES_TEKNISI'] = "Teknisi";
			}
			//jika yang login Manager
			if($myData['level']=="Manager") {
				$_SESSION['SES_MANAGER'] = "Manager";
			}
			if($myData['level']=="Keuangan") {
				$_SESSION['SES_KEUANGAN'] = "Keuangan";
			}
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
		}
		else {
			 echo "<h3 style='color:red;'> Username atau Password salah! </h3>";
			  echo "<h5 style='color:red;'> Silakan coba kembali dengan username & password yang benar. </h5>";
		}
	}
} // End POST
?>
 
