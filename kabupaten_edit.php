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
include_once "library/inc.library.php";
# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama kabupaten</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbProvinsi'])=="KOSONG") {
		$pesanError[] = "Data <b>Provinsi</b> belum dipilih !";		
	}

	# Baca Variabel Form
	$txtNama= $_POST['txtNama'];
	$cmbProvinsi		= $_POST['cmbProvinsi'];

	# Validasi Nama kabupaten, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM kabupaten WHERE nm_kabupaten='$txtNama' AND NOT(nm_kabupaten='".$_POST['txtLama']."')";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, kabupaten <b> $txtNama </b> sudah ada, ganti dengan yang lain";
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
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$mySql	= "UPDATE kabupaten SET nm_kabupaten='$txtNama', kd_provinsi='$cmbProvinsi' WHERE kd_kabupaten ='".$_POST['txtKode']."'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Kabupaten-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# TAMPILKAN DATA LOGIN UNTUK DIEDIT
$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	 = "SELECT * FROM kabupaten WHERE kd_kabupaten='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

	// Menyimpan data ke variabel temporary (sementara)
	$dataKode	= $myData['kd_kabupaten'];
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_kabupaten'];
	$dataProvinsi= isset($_POST['cmbProvinsi']) ? $_POST['cmbProvinsi'] :  $myData['kd_provinsi'];


?>
<form id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table class="table-list"  cellpadding="2" cellspacing="1" width="100%">
	<div class="row-fluid">
	<div class="span12">
	  <h3 class="header smaller lighter blue">UBAH  KABUPATEN </h3>
	
	<tr>
	  <td width="15%"><b>Kode Kabupaten</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="10"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Kabupaten </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="70" maxlength="100" title="Nama Kabupaten Tidak Boleh Kosong" class="required" onkeypress="return huruf(event)" />
      <input name="txtLama" type="hidden" value="<?php echo $myData['nm_kabupaten']; ?>" /></td></tr>

  <tr>
      <td><strong>Provinsi </strong></td>
	  <td><strong>:</strong></td>
	  <td><select name="cmbProvinsi" class="required" title="Provinsi Tidak Boleh Kosong">
        <option></option>
        <?php
		$mySql = "SELECT * FROM provinsi ORDER BY nm_provinsi";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myData = mysql_fetch_array($myQry)) {
		if ($myData['kd_provinsi']== $dataProvinsi) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$myData[kd_provinsi]' $cek>$myData[nm_provinsi] </option>";
		}
		?>
      </select></td>
    </tr>



	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " class="btn-primary"></td>
    </tr>
</table>
</form>

