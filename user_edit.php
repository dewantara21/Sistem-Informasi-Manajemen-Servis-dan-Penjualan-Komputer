<head>
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#myForm").validate();
})

function angka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
}

function huruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
        return false;
        return true;
}



</script>
<style type="text/css">
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }

</style>
</head>

<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtKode'])=="") {
		$pesanError[] = "Data <b>Kode </b> tidak terbaca !";		
	}
	if (trim($_POST['txtNamaUser'])=="") {
		$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTelepon'])=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtUsername'])=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbLevel'])=="KOSONG") {
		$pesanError[] = "Data <b>Level login</b> belum dipilih !";		
	}
	if (trim($_POST['txtEmail'])=="") {
		$pesanError[] = "Data <b>Email</b> tidak boleh kosong !";		
	}
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNamaUser= $_POST['txtNamaUser'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];
	$txtPassLama= $_POST['txtPassLama'];	
	$txtTelepon	= $_POST['txtTelepon'];	
	$txtEmail	= $_POST['txtEmail'];
	$cmbLevel	= $_POST['cmbLevel'];
	
	# VALIDASI USER LOGIN (USERNAME), jika sudah ada akan ditolak
	$cekSql="SELECT * FROM user WHERE username='$txtUsername' AND NOT(username='".$_POST['txtUsernameLm']."')";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "USERNAME<b> $txtUsername </b> sudah ada, ganti dengan yang lain";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# Cek Password baru
		if (trim($txtPassword)=="") {
			$sqlPasword = ", password='$txtPassLama'";
		}
		else {
			$sqlPasword = ",  password ='".$txtPassword."'";
		}
		
		# SIMPAN DATA KE DATABASE (Jika tidak menemukan error, simpan data ke database)
		$mySql  = "UPDATE user SET nm_user='$txtNamaUser', username='$txtUsername', 
					no_telepon='$txtTelepon', email='$txtEmail', kd_level='$cmbLevel'
					$sqlPasword  
					WHERE kd_user='".$_POST['txtKode']."'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=User-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan


# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM user WHERE kd_user='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['kd_user'];
	$dataNamaUser	= isset($_POST['txtNamaUser']) ? $_POST['txtNamaUser'] : $myData['nm_user'];
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
	$dataTelepon	= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : $myData['no_telepon'];
	$dataEmail	    = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : $myData['email'];
	$dataLevel		= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : $myData['kd_level'];
?>

<form id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
 <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">UBAH USER</h3></div></div>
    <tr>
      <td width="133"><b>Kode User</b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text"  value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><b>Nama Lengkap </b></td>
      <td><b>:</b></td>
      <td><input id="nama"  name="txtNamaUser" type="text"  title="Nama Tidak Boleh Kosong" value="<?php echo $dataNamaUser; ?>" size="60" maxlength="100" class="required" onkeypress="return huruf(event)" /></td>
    </tr>
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input  id="telp" name="txtTelepon" type="text" title="No.Telp Tidak Boleh Kosong" value="<?php echo $dataTelepon; ?>" size="60" maxlength="20" class="required" onkeypress="return angka(event)"/></td>
    </tr>
    <tr>
      <td><b>Username</b></td>
      <td><b>:</b></td>
      <td><input name="txtUsername" type="text"  title="Username Tidak Boleh Kosong" value="<?php echo $dataUsername; ?>" size="60" maxlength="20" class="required"  />
      <input name="txtUsernameLm" type="hidden" value="<?php echo $myData['username']; ?>" /></td>
    </tr>

     <tr>
      <td><b>Email</b></td>
      <td><b>:</b></td>
      <td><input name="txtEmail" type="email"  title="E-mail harus valid" value="<?php echo $dataEmail; ?>" size="60" maxlength="20" class="required"  /> </td>
    </tr>

    <tr>
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword" type="password" size="60" minlength="6" maxlength="100" title="Password Minimal 6 Karakter" class="required"  />
      <input name="txtPassLama" type="hidden" value="<?php echo $myData['password']; ?>" /></td>
    </tr>



    <tr>
      <td><b>Level </b></td>
	  <td><b>:</b></td>
	  <td><select name="cmbLevel" class="required" title="Level Tidak Boleh Kosong">
        <option></option>
        <?php
		$mySql = "SELECT * FROM level ORDER BY level";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myData = mysql_fetch_array($myQry)) {
		if ($myData['kd_level']== $dataLevel) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$myData[kd_level]' $cek>$myData[level] </option>";
		}
		?>
      </select></td>
    </tr>



    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value=" Simpan " /> </td>
    </tr>
  </table>
</form>
