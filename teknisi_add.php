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
//	$txtNik	= $_POST['txtNik'];
	

		$kodeBaru	= buatKode("teknisi", "T");
		$mySql  	= "INSERT INTO teknisi (kd_teknisi, nm_teknisi, no_telepon, 
										 alamat)
						VALUES ('$kodeBaru', 
								'$txtNamaTeknisi', 
								'$txtTelepon', 
								'$txtAlamat')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Teknisi-Data'>";
		}
		exit;
	
} // Penutup Tombol Simpan

# MASUKKAN DATA KE VARIABEL
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataKode		= buatKode("teknisi", "T");
$dataNamaTeknisi	= isset($_POST['txtNamaTeknisi']) ? $_POST['txtNamaTeknisi'] : '';
$dataAlamat	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataTelepon	= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
// $dataNik		= isset($_POST['txtNik']) ? $_POST['txtNik'] : '';
?>

<form  id="myForm"  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">TAMBAH DATA TEKNISI</h3></div></div>
    <tr>
      <td width="133"><b>Kode</b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><b>Nama Lengkap </b></td>
      <td><b>:</b></td>
      <td><input name="txtNamaTeknisi" type="text" value="<?php echo $dataNamaTeknisi; ?>" size="60" maxlength="100" title="Nama Tidak Boleh Kosong" class="required" onkeypress="return huruf(event)"/></td>
    </tr>
<!--      <tr>
      <td><b>NIK</b></td>
      <td><b>:</b></td>
      <td><input name="txtNik" type="text" value="<?php // echo $dataNik; ?>" size="60" maxlength="100" /></td>
    </tr> -->
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input  id="telp" name="txtTelepon" type="text" value="<?php echo $dataTelepon; ?>" size="60" maxlength="13" title="No.Telp Tidak Boleh Kosong" class="required" onkeypress="return angka(event)"/></td>
    </tr>
    <tr>
      <td><b>Alamat</b></td>
      <td><b>:</b></td>
      <td> <input name="txtAlamat" type="text"  value="<?php echo $dataAlamat; ?>" size="60" maxlength="40" title="Alamat Tidak Boleh Kosong" class="required" /></td>
    </tr>
  
   
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value=" Simpan " class="btn-primary"/>      </td>
    </tr>
  </table>
</form>
