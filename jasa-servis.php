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

<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";
# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtKodeServis'])=="") {
		$pesanError[] = "Data <b>Kode</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtHargaJasa'])=="0") {
		$pesanError[] = "Data <b>Harga</b> tidak boleh 0 !";		
	}
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
	
	
	# Baca Variabel Form
	$txtKode	= $_POST['txtKodeServis'];
	$txtTanggal	= InggrisTgl($_POST['txtTanggal']);
	$txtHargaJasa	= $_POST['txtHargaJasa'];
	
	
		# SIMPAN DATA KE DATABASE. 
		$mySql	= "INSERT INTO detail_servis (kd_service,tgl_selesai, harga_jasa) 
					VALUES ('$txtKode',
					         '$txtTanggal',
							'$txtHargaJasa')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Data-Services'>";
		}
		exit;
	}
} // Penutup Tombol Simpan
	
# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)

$mySql = "SELECT services.*, pelanggan.nm_pelanggan, user.nm_user FROM services 
	LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
	LEFT JOIN user ON services.teknisi=user.nm_user 
	WHERE kd_service='$_GET[id]'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	
	$tglTransaksi 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');

?>
<form id="myForm"  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list">
    <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">BUAT HARGA JASA SERVIS</h3></div></div>
	<tr>
	  <td width="21%"> <strong>Pelanggan</strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><?php echo $myData['nm_pelanggan']; ?></td>
	</tr>
   <tr>
	  <td width="21%"><b>Teknisi</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><?php echo $myData['nm_user']; ?></tr>
	<tr>
	  <td><b>Tanggal Servis</b></td>
	  <td><b>:</b></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_service']); ?></td>
	</tr>
	<tr>
      <td><strong>Deskripsi / Keluhan</strong></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['deskripsi']; ?></td>
    </tr>
	
</table>
<hr/>
<table width="100%" cellpadding="2" cellspacing="1" class="table-list">
  <input type="hidden" name="txtKodeServis" value="<?php echo $_GET['id']; ?>"/>
   <tr>
	  <td width="21%"><b>Tanggal Selesai</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><input class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy" type="text" name="txtTanggal" value="<?php echo $tglTransaksi; ?>"/></tr>
	<tr>
	  <td><b>Harga Jasa Servis</b></td>
	  <td><b>:</b></td>
	  <td><input type="number" class="form-control" title="Harga Jasa Servis Tidak Boleh Kosong"  name="txtHargaJasa" required class="required" onkeypress="return angka(event)"></td>
	</tr>
	
	
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " class="btn-primary"></td>
    </tr>
	
</table>
</form>
<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		
		
		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/date-time/moment.min.js"></script>
		<script src="assets/js/date-time/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/jquery.knob.min.js"></script>
		<script src="assets/js/jquery.autosize-min.js"></script>
		<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>

<script type="text/javascript">
			
			 $('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
		</script>