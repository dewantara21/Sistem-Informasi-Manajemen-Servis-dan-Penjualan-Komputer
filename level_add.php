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
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Level</b> tidak boleh kosong !";		
	}
	
	# Baca Variabel Form
	$txtNama= $_POST['txtNama'];
	
	# Validasi Nama provinsi, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM level WHERE level='$txtNama'";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, Level <b> $txtNama </b> sudah ada, ganti dengan yang lain";
	}

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
	}
	else {
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= buatKode("level", "L");
		$mySql	= "INSERT INTO level (kd_level, level) VALUES ('$kodeBaru','$txtNama')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Level-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# MASUKKAN DATA KE VARIABEL
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataKode	= buatKode("level", "L");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
?>
<form id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table class="table-list" cellpadding="2" cellspacing="1" width="100%">
	<div class="row-fluid">
	<div class="span12">
	  <h3 class="header smaller lighter blue" >TAMBAH LEVEL</h3></div></div>
	
	<tr>
	  <td width="15%"><b>Kode Level</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/></td></tr>
	<tr>
	  <td><b>Nama Level </b></td>
	  <td><b>:</b></td>
	  <td><input id="nama" name="txtNama" title="Nama Level Tidak Boleh Kosong" value="<?php echo $dataNama; ?>" size="70" maxlength="100" class="required" onkeypress="return huruf(event)"/></td>
	</tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " class="btn-primary"></td>
    </tr>
</table>
</form>
