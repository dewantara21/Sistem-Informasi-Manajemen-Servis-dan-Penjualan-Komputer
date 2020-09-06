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
	if (trim($_POST['txtNamaTeknisi'])=="") {
		$pesanError[] = "Data <b>Nama Teknisi</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTelepon'])=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtAlamat'])=="") {
		$pesanError[] = "Data <b>Alamat</b> tidak boleh kosong !";		
	}
//	if (trim($_POST['txtNik'])=="") {
//		$pesanError[] = "Data <b>NIK</b> tidak boleh kosong !";		
//	}
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNamaTeknisi= $_POST['txtNamaTeknisi'];
	$txtAlamat= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	// $txtNik	= $_POST['txtNik'];
	
	# VALIDASI USER LOGIN (USERNAME), jika sudah ada akan ditolak
//	$cekSql="SELECT * FROM teknisi WHERE nik='$txtNik' AND NOT(nik='".$_POST['txtNikLm']."')";
//	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
//	if(mysql_num_rows($cekQry)>=1){
//		$pesanError[] = "NIK<b> $txtNik </b> sudah ada, ganti dengan yang lain";
//	}

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
	
		
		# SIMPAN DATA KE DATABASE (Jika tidak menemukan error, simpan data ke database)
		$mySql  = "UPDATE teknisi SET nm_teknisi='$txtNamaTeknisi', no_telepon='$txtTelepon', 
					alamat='$txtAlamat'
					WHERE kd_teknisi='".$_POST['txtKode']."'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Teknisi-Data'>";
		}
		exit;
		
} // Penutup Tombol Simpan


# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM teknisi WHERE kd_teknisi='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['kd_teknisi'];
	$dataNamaTeknisi	= isset($_POST['txtNamaTeknisi']) ? $_POST['txtNamaTeknisi'] : $myData['nm_teknisi'];
	$dataAlamat	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataTelepon	= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : $myData['no_telepon'];
//	$dataNik	= isset($_POST['txtNik']) ? $_POST['txtNik'] : $myData['nik'];
?>

<form id="myForm"  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
 <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">UBAH DATA TEKNISI</h3></div></div>
    <tr>
      <td width="133"><b>Kode</b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text"  value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><b>Nama Lengkap </b></td>
      <td><b>:</b></td>
      <td><input name="txtNamaTeknisi" type="text" value="<?php echo $dataNamaTeknisi; ?>" size="60" maxlength="100" / title="Nama Tidak Boleh Kosong" class="required" onkeypress="return huruf(event)"></td>
    </tr>
   <!--  <tr>
      <td><b>NIK </b></td>
      <td><b>:</b></td>
      <td><input name="txtNik" type="text" value="<?php // echo $dataNik; ?>" size="60" maxlength="20" />
          <input name="txtNikLm" type="hidden" value="<?php // echo $myData['nik']; ?>" /></td>
    </tr> -->
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input id="telp" name="txtTelepon" type="text" value="<?php echo $dataTelepon; ?>" size="60" maxlength="13" title="No.Telp Tidak Boleh Kosong" class="required" onkeypress="return angka(event)"/></td>
    </tr>
    <tr>
      <td><b>Alamat</b></td>
      <td><b>:</b></td>
      <td><input name="txtAlamat" type="text"  value="<?php echo $dataAlamat; ?>" size="60" maxlength="40" title="Alamat Tidak Boleh Kosong" class="required"/>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value=" Simpan " class="btn-primary" /> </td>
    </tr>
  </table>
</form>
