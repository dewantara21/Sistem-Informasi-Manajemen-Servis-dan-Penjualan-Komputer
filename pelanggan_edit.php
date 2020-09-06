
<head> 
        <script src="assets/js/jquery.min.js"></script>
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
include_once "library/inc.library.php";
# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Pelanggan</b> tidak boleh kosong !";		
	}
//	if (trim($_POST['txtToko'])=="") {
//		$pesanError[] = "Data <b>Identitas</b> tidak boleh kosong !";		
//	}
	if (trim($_POST['txtAlamat'])=="") {
		$pesanError[] = "Data <b>Alamat Lengkap</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTelepon'])=="") {
		$pesanError[] = "Data <b>No Telepon</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbProvinsi'])=="KOSONG") {
		$pesanError[] = "Data <b>Provinsi</b> belum dipilih !";		
	}
	if (trim($_POST['cmbKabupaten'])=="") {
		$pesanError[] = "Data <b>Kabupaten</b> belum dipilih !";		
	}	
	
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
//	$txtToko	= $_POST['txtToko'];
	$txtAlamat	= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	$cmbKabupaten		= $_POST['cmbKabupaten'];
	$cmbProvinsi		= $_POST['cmbProvinsi'];

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
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$mySql	= "UPDATE pelanggan SET nm_pelanggan='$txtNama', alamat='$txtAlamat',
					no_telepon='$txtTelepon', kd_provinsi='$cmbProvinsi', kd_kabupaten='$cmbKabupaten' WHERE kd_pelanggan ='".$_POST['txtKode']."'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Pelanggan-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM pelanggan WHERE kd_pelanggan='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode	= $myData['kd_pelanggan'];
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_pelanggan'];
// $dataToko	= isset($_POST['txtToko']) ? $_POST['txtToko'] : $myData['nm_toko'];
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : $myData['no_telepon'];
$dataProvinsi= isset($_POST['cmbProvinsi']) ? $_POST['cmbProvinsi'] :  $myData['kd_provinsi'];
$dataKabupaten= isset($_POST['cmbKabupaten']) ? $_POST['cmbKabupaten'] :  $myData['kd_kabupaten'];

?>
<form  id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table class="table-list" width="100%">
	<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">UBAH DATA PELANGGAN</h3></div></div>
	<tr>
	  <td width="15%"><strong>Kode Pelanggan</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><input type="text" name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="9"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /> </td>
	</tr>
	<tr>
	  <td><strong>Nama Pelanggan </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" title="Nama Tidak Boleh Kosong" class="required" onkeypress="return huruf(event)"/></td>
	</tr>
<!--	<tr>
      <td><strong>Nomor Identitas</strong></td>
	  <td><strong>:</strong></td>
	  <td><input type="text" name="txtToko" value="<?php // echo $dataToko; ?>" size="80" maxlength="200" /></td>
    </tr> -->


	<tr>
      <td><strong>Provinsi </strong></td>
	  <td><strong>:</strong></td>
	  <td><select id="cmbProvinsi" name="cmbProvinsi" class="required" title="Provinsi Tidak Boleh Kosong">
        <option></option>
        <?php
		$mySql = "SELECT * FROM Provinsi ORDER BY nm_provinsi";
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

  	<tr>
      <td><strong>Kabupaten/Kota </strong></td>
	  <td><strong>:</strong></td>
	  <td><select id="cmbKabupaten" name="cmbKabupaten" class="required" title="Kabupaten Tidak Boleh Kosong"> 
          <option></option>


          <?php
		$mySql = "SELECT * FROM Kabupaten INNER JOIN Provinsi ON Kabupaten.kd_provinsi = Provinsi.kd_provinsi ORDER BY nm_kabupaten";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myData = mysql_fetch_array($myQry)) { 
		if ($myData['kd_kabupaten']== $dataKabupaten) {
			$cek = " selected";
		} else { $cek=""; } ?>

		 <option id="cmbKabupaten" class="<?php echo $myData['kd_provinsi']; ?>" value="<?php echo $myData['kd_kabupaten']; ?>" <?php echo $cek; ?> >
                                                        <?php echo $myData['nm_kabupaten']; ?>
                                                    </option>
                                                <?php } ?>
      </select></td>
    </tr>



	<tr>
      <td><strong>Alamat Lengkap </strong></td>
	  <td><strong>:</strong></td>
	  <td><textarea name="txtAlamat" rows="5" class="required" title="Alamat Tidak Boleh Kosong"/><?php echo $dataAlamat; ?></textarea></td>
    </tr>
	<tr>
      <td><strong>No. Telepon </strong></td>
	  <td><strong>:</strong></td>
	  <td><input type="text" name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="13" title="No.Telp Tidak Boleh Kosong" class="required" onkeypress="return angka(event)" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " class="btn-primary"></td>
    </tr>
</table>
</form>

 <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-chained.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
        <script>
            $(document).ready(function() {
                $("#cmbKabupaten").chained("#cmbProvinsi");
            });
        </script>