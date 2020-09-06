<head> 
	<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <script src="assets/js/jquery.min.js"></script>
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

$dates = date('d-m-Y', strtotime("-1 day"));
$dates2 = date('d-m-Y', strtotime("-2 day"));
$dates3 = date('d-m-Y', strtotime("-3 day"));
$today = date('Y-m-d');

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtKodePelanggan'])=="") {
		$pesanError[] = "Data <b>Kode Pelanggan</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTanggal'])!=date('d-m-Y') xor trim($_POST['txtTanggal'])==$dates xor trim($_POST['txtTanggal'])==$dates2 xor trim($_POST['txtTanggal'])==$dates3 ) {
		$pesanError[] = "<b>Tanggal</b> servis tidak boleh melewati tanggal saat ini !";		
	}
	if (trim($_POST['txtDeskripsi'])=="") {
		$pesanError[] = "Data <b>Keluhan</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbTeknisi'])=="KOSONG") {
		$pesanError[] = "Data <b>Teknisi</b> belum diisi, pilih pada combo !";		
	}
	if (trim($_POST['cmbPerangkat'])=="KOSONG") {
		$pesanError[] = "Data <b>Perangkat</b> belum diisi, pilih pada combo !";		
	}
	if (trim($_POST['txtBarang'])=="") {
		$pesanError[] = "Data Nama<b>Barang</b> belum diisi!";		
	}




	# Baca Variabel Form
	$txtKodePelanggan	= $_POST['txtKodePelanggan'];
	$txtTanggal	= $_POST['txtTanggal'];
	$txtDeskripsi	= $_POST['txtDeskripsi'];
	$txtBarang	= $_POST['txtBarang'];
	$cmbTeknisi	= $_POST['cmbTeknisi'];
	$cmbPerangkat	= $_POST['cmbPerangkat'];


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

	# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$mySql	= "UPDATE services SET kd_pelanggan='$txtKodePelanggan', teknisi='$cmbTeknisi', 
				nm_kategori='$cmbPerangkat',
					tgl_service='".InggrisTgl($_POST['txtTanggal'])."', nama_brg='$txtBarang', deskripsi='$txtDeskripsi' WHERE kd_service ='".$_POST['txtKode']."'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Data-Services'>";
		}
		exit;
	}
} // Penutup Tombol Simpan

# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM services WHERE kd_service='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode	= $myData['kd_service'];
$dataKodePelanggan	= isset($_POST['txtKodePelanggan']) ? $_POST['txtKodePelanggan'] : $myData['kd_pelanggan'];
$dataTanggal = isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : $myData['tgl_service'];
$dataDeskripsi= isset($_POST['txtDeskripsi']) ? $_POST['txtDeskripsi'] : $myData['deskripsi'];
$dataBarang= isset($_POST['txtBarang']) ? $_POST['txtBarang'] : $myData['nama_brg'];
$dataTeknisi	= isset($_POST['cmbTeknisi']) ? $_POST['cmbTeknisi'] : $myData['teknisi'];
$dataPerangkat	= isset($_POST['cmbPerangkat']) ? $_POST['cmbPerangkat'] : $myData['nm_kategori'];
?>
<form id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list">
    <div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">UBAH DATA SERVIS</h3></div></div>
	<tr>
	  <td width="21%"><b>Kode</b> <strong>Pelanggan</strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><input type="hidden" name="txtKode" value="<?php echo $dataKode; ?>" /><input type="text" id="txtKodePelanggan" name="txtKodePelanggan" value="<?php echo $dataKodePelanggan; ?>" size="10" maxlength="10" readonly="readonly" class="required" title="Pelanggan Tidak Boleh Kosong"/> <a href="" onclick="window.open('pencarian_pelanggan.php','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');" class="icon-search"></a></td></tr>
	<tr>
   <tr>
	  <td width="21%"><b>Teknisi</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"> <select name="cmbTeknisi" class="required" title="Teknisi Tidak Boleh Kosong">
          <option></option>
          <?php
	  $mySql = "SELECT * FROM user  WHERE kd_level='L002' ORDER BY kd_user";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($myData = mysql_fetch_array($myQry)) {
	  	if ($dataTeknisi == $myData['nm_user']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$myData[nm_user]' $cek>$myData[nm_user]</option>";
	  }
	  ?>
        </select></td></tr>
	<tr>
	  <td><b>Tanggal Servis</b></td>
	  <td><b>:</b></td>
	   <td><input type="text" name="txtTanggal" value="<?php echo IndonesiaTgl($dataTanggal); ?>"  class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy"/></td>
	</tr>

	<tr>
	  <td width="21%"><b>Kategori Perangkat</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"> <select name="cmbPerangkat" class="required" title="Kategori Perangkat Tidak Boleh Kosong">
          <option></option>
          <?php
	  $mySql2 = "SELECT * FROM kategori_perangkat ORDER BY kd_kategori";
	  $myQry2 = mysql_query($mySql2, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($myData2 = mysql_fetch_array($myQry2)) {
	  	if ( $dataPerangkat == $myData2['nm_kategori'] ) {
			$cek1 = " selected";
		} else { $cek1=""; }
	  	echo "<option value='$myData2[nm_kategori]' $cek1>$myData2[nm_kategori]</option>";
	  }
	  ?>
        </select></td></tr>

	<tr>
      <td><strong>Nama Perangkat</strong></td>
	  <td><b>:</b></td>
	  <td><input type="text" name="txtBarang" size="20" maxlength="40" value="<?php echo $dataBarang; ?>" title="Perangkat Tidak Boleh Kosong" class="required"/></td>
    </tr>
	<tr>
      <td><strong>Deskripsi / Keluhan</strong></td>
	  <td><b>:</b></td>
	  <td><textarea name="txtDeskripsi" rows="5" /><?php echo $dataDeskripsi; ?></textarea></td>
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

        
		<!--inline scripts related to this page-->

		<script type="text/javascript">
			
			 $('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
		</script>