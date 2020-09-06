



<head>
<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
  $('#btn1').click(function() {
      $("#myForm").validate();

  });
	
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
include_once "../library/inc.seslogin.php";

$dates = date('d-m-Y', strtotime("-1 day"));
$dates2 = date('d-m-Y', strtotime("-2 day"));
$dates3 = date('d-m-Y', strtotime("-3 day"));

# HAPUS DAFTAR BARANG DI TMP
if(isset($_GET['Act'])){
	if(trim($_GET['Act'])=="Delete"){
		# Hapus Tmp jika datanya sudah dipindah
		$mySql = "DELETE FROM pembelian_item WHERE id='".$_GET['id']."' ";
		mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
	}
	if(trim($_GET['Act'])=="Sucsses"){
		echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
	}
}
// =========================================================================

# TOMBOL TAMBAH DIKLIK
if(isset($_POST['btnTambah'])){
	$pesanError = array();
	if (trim($_POST['txtKode'])=="") {
		$pesanError[] = "Data <b>Kode barang</b> belum diisi!";		
	}
	if (trim($_POST['txtHargaBeli'])=="" or ! is_numeric(trim($_POST['txtHargaBeli']))) {
		$pesanError[] = "Data <b>Harga beli (Rp) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}
	if (trim($_POST['txtJumlah'])=="" or ! is_numeric(trim($_POST['txtJumlah']))) {
		$pesanError[] = "Data <b>Jumlah (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}
	if (trim($_POST['txtJumlah'])=="0" or ! is_numeric(trim($_POST['txtJumlah']))) {
		$pesanError[] = "<b>Jumlah Barang</b> tidak boleh 0 !";		
	}
	if (trim($_POST['txtHargaBeli'])=="0" or ! is_numeric(trim($_POST['txtHargaBeli']))) {
		$pesanError[] = "<b>Harga Beli (Rp.)</b> tidak boleh  0 !";		
	}
	
	# BACA VARIABEL DARI FORM INPUT BARANG
	$cmbSupplier	= $_POST['cmbSupplier'];
	$txtKode	= $_POST['txtKode'];
	$txtKode	= str_replace("'","&acute;",$txtKode);
	
	$txtHargaBeli	= $_POST['txtHargaBeli'];
	$txtHargaBeli	= str_replace("'","&acute;",$txtHargaBeli);
	$txtHargaBeli	= str_replace(".","",$txtHargaBeli);
	
	$txtJumlah		= $_POST['txtJumlah'];


	# Cek supplier Barang, jika bukan distirbutornya akan ditolak
	$cekSql	= "SELECT supplier.* FROM barang, supplier WHERE barang.kd_supplier=supplier.kd_supplier
				AND ( kd_barang='$txtKode' )";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
	$cekRow = mysql_fetch_array($cekQry);
	if ($cekRow['kd_supplier'] != $cmbSupplier) {
		$pesanError[] = "<b> SALAH MEMILIH SUPPLIER</b>, untuk Barang dengan kode <b>$txtKode</b> 
						 suppliernya <b> $cekRow[kd_supplier] | $cekRow[nm_supplier]</b>!";
	}
		
	# JIKA ADA PESAN ERROR DARI VALIDASI
	
	if (count($pesanError)>=1 ){
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>
											<i class='icon-remove'></i></button><strong>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</strong></div> <br>"; 
	}
	else {
		# Jika jumlah error pesanError tidak ada, skrip di bawah dijalankan
		
		# Jika sudah pernah dipilih, cukup datanya di update jumlahnya			
		$cekSql ="SELECT * FROM pembelian_item As tmp, barang As barang 
				  WHERE barang.kd_barang=tmp.kd_barang AND ( tmp.kd_barang='$txtKode' )
				  AND tmp.status='2' "; 
		$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
		if (mysql_num_rows($cekQry) >= 1) {
			// Membaca kode barang/ barang
			$cekRow = mysql_fetch_array($cekQry);
			$kodeBarang	= $cekRow['kd_barang'];
			
			// Jika tadi sudah dipilih, cukup jumlahnya diupdate
			$tmpSql = "UPDATE pembelian_item SET jumlah=jumlah + $txtJumlah 
						WHERE kd_barang='$kodeBarang' AND status='2' ";
			mysql_query($tmpSql, $koneksidb) or die ("Gagal Query : ".mysql_error());
		}
		else {
			# Kode barang Baru, membuka tabel barang

			# Cek data di dalam tabel barang, mungkin yang diinput dari form adalah Barcode dan mungkin Kode-nya
			$mySql ="SELECT * FROM barang WHERE kd_barang='$txtKode'";
			$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
			$myRow = mysql_fetch_array($myQry);
			$myQty = mysql_num_rows($myQry);
			if ($myQty >= 1) {
				// Membaca kode barang/ barang
				$kodeBarang	= $myRow['kd_barang'];
				
				// Data yang ditemukan dimasukkan ke keranjang transaksi
				$tmpSql 	= "INSERT INTO pembelian_item (kd_supplier, kd_barang, harga_beli, jumlah, status) 
							VALUES ('$cmbSupplier','$kodeBarang','$txtHargaBeli', '$txtJumlah', 2)";
				mysql_query($tmpSql, $koneksidb) or die ("Gagal Query tmp : ".mysql_error());				
			}
		}
	}
}
// ============================================================================

# ========================================================================================================
# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	$pesanError = array();
	if (trim($_POST['cmbSupplier'])=="") {
		$pesanError[] = "Data <b> Nama Supplier</b> belum diisi, pilih pada combo !";		
	}
	if (trim($_POST['cmbTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada combo !";		
	}
	if (trim($_POST['cmbTanggal'])!=date('d-m-Y') xor trim($_POST['cmbTanggal'])==$dates xor trim($_POST['cmbTanggal'])==$dates2 xor trim($_POST['cmbTanggal'])==$dates3 ) {
		$pesanError[] = "<b>Tanggal</b> Transaksi tidak boleh melewati tanggal saat ini !";		
	}

	# Validasi jika belum ada satupun data item yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM pembelian_item WHERE status=2";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData = mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR BARANG KOSONG !</b> Daftar item barang belum ada yang dimasukan, <b>minimal 1 barang</b>.";
	}

	# Validasi jika sudah input barang, tapi Supplier-nya ganti
	$tmp2Sql ="SELECT supplier.* FROM pembelian_item, supplier 
	WHERE supplier.kd_supplier=pembelian_item.kd_supplier 
				AND pembelian_item.status=2 ";
	$tmp2Qry = mysql_query($tmp2Sql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmp2Row = mysql_fetch_array($tmp2Qry);
	if ($tmp2Row['kd_supplier'] != $_POST['cmbSupplier']) {
		$pesanError[] = "<b>SUPPLIER TIDAK SAMA</b>, Barang yang dimasukkan adalah milik <b>$tmp2Row[kd_supplier] - $tmp2Row[nm_supplier]</b>.";
	}

	# Baca variabel
	$cmbSupplier	= $_POST['cmbSupplier'];
	$txtKeterangan	= $_POST['txtKeterangan'];
	$cmbTanggal 	= $_POST['cmbTanggal'];			

			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>
											<i class='icon-remove'></i></button><strong>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</strong></div> <br>"; 
	}
	else {
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dikalkukan
		
		// Membuat kode Transaksi baru
		$noTransaksi = buatKode("pembelian", "NP");
		
		// Skrip menyimpan data ke tabel transaksi utama
		$mySql	= "INSERT INTO pembelian SET 
						no_pembelian='$noTransaksi', 
						tgl_pembelian='".InggrisTgl($_POST['cmbTanggal'])."', 
						keterangan='$txtKeterangan', 
						kd_supplier='$cmbSupplier', 
						kd_user='".$_SESSION['SES_LOGIN']."'";
		mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		# Ambil semua data barang/barang yang dipilih, berdasarkan user yg login
		$tmpSql ="SELECT barang.*, tmp.jumlah, tmp.harga_beli FROM barang, pembelian_item As tmp
				 WHERE barang.kd_barang=tmp.kd_barang AND tmp.status='2'" ;
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		while ($tmpData = mysql_fetch_array($tmpQry)) {
			$dataKode 	= $tmpData['kd_barang'];
			$dataHarga 	= $tmpData['harga_beli'];
			$dataJumlah	= $tmpData['jumlah'];
			
			// Masukkan semua barang/barang dari TMP ke tabel pembelian detail
			$itemSql = "INSERT INTO pembelian_item SET 
									no_pembelian='$noTransaksi', 
									kd_barang='$dataKode', 
									harga_beli='$dataHarga',
									jumlah='$dataJumlah',
									status='1'";
			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());

			// Update stok (stok barang + jumlah barang masuk)
			$stokSql = "UPDATE barang SET stok=stok + $dataJumlah, harga_beli='$dataHarga' WHERE kd_barang='$dataKode'";
			mysql_query($stokSql, $koneksidb) or die ("Gagal Query Update Stok".mysql_error());
		}
		
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM pembelian_item WHERE status=2";
		mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		echo "window.open('cetak/pembelian_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
	}	
}

# TAMPILKAN DATA KE FORM
$noTransaksi 	= buatKode("pembelian", "NP");
$tglTransaksi 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';

$kodeSupplier= isset($_GET['kodeSupplier']) ? $_GET['kodeSupplier'] : '';
$dataSupplier= isset($_POST['cmbSupplier']) ? $_POST['cmbSupplier'] : $kodeSupplier;
?>
<style type="text/css">
<!--
.style2 {color: #C0C0C0}
.style3 {color: #000000; font-weight: bold; }
-->
</style>
<form id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post"  name="frmadd">
<table width="100%"  cellpadding="3" cellspacing="1" class="table-common table-responsive" style="margin-top:0px;">
	<tr>
	  <td colspan="6"><div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">TRANSAKSI BARANG MASUK</h3></div></div> </td>
	</tr>
	<tr>
	  <td width="11%"><strong>No. Masuk</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="30%"><input type="text" class="form-control" name="txtNomor" value="<?php echo $noTransaksi; ?>" size="23" maxlength="20" readonly="readonly"/></td>
	  <td width="15%"><strong>Kode Barang</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="42%"><input type="text" class="form-control" name="txtKode" id="txtKode" size="35" maxlength="20" autofocus readonly="readonly"/> <a onclick="window.open('pembelian/?page=Pencarian-Barang','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');" class="icon-search"  ></a>
     </td>
	</tr>
	<tr>
      <td height="33"><strong>Tgl.  Pembelian </strong></td>
	  <td><strong>:</strong></td>
	  <td><input type="text" class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy" name="cmbTanggal" value="<?php echo $tglTransaksi; ?>" /></td>
      <td><strong>Harga Beli (Rp.) </strong></td>
	  <td><strong>:</strong></td>
	  <td>
	    <input title=" Harga Beli (Rp) Tidak Boleh Kosong" class="required" onkeypress="return angka(event)"  type="text" name="txtHargaBeli" size="18" maxlength="12" />
	  </td>
	</tr>
	<tr>
      <td height="31"><strong>Supplier</strong></td>
	  <td><strong>:</strong></td>
	  <td><b>
        <select name="cmbSupplier"  class="required" title="Supplier Tidak Boleh Kosong">
          <option></option>
          <?php
	  $mySql = "SELECT * FROM supplier ORDER BY kd_supplier";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($myData = mysql_fetch_array($myQry)) {
	  	if ($dataSupplier == $myData['kd_supplier']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$myData[kd_supplier]' $cek>[ $myData[kd_supplier] ] $myData[nm_supplier]</option>";
	  }
	  ?>
        </select>
	  </b></td>
      <td><b>Jumlah</b></td>
	  <td><strong>:</strong></td>
	  <td><b>
	    <input title="Jumlah Tidak Boleh Kosong" class="required" onkeypress="return angka(event)" type="text" class="angkaC" name="txtJumlah" size="3" maxlength="4" value="1" 
	  		 onblur="if (value == '') {value = '1'}" 
      		 onfocus="if (value == '1') {value =''}"/>
	  </b></td>
	</tr>
	<tr>
      <td><strong>Keterangan</strong></td>
	  <td><strong>:</strong></td>
	  <td><input type="text" class="form-control" name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="60" maxlength="100" /></td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><b>
	    <input id="btn1" name="btnTambah" type="submit" style="cursor:pointer;" value=" Tambah " class="btn-primary" />
	  </b>
      <input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " class="btn-primary" /></td>
	</tr>
	<tr><td height="28">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
</table>

<table id="sample-table-2" class="table table-striped table-bordered table-hover" width="100%" border="0" cellspacing="1" cellpadding="2">
  <div class="table-header">
      <div align="left">DAFTAR BARANG</div>
   <thead> 
  <tr>
    <th width="26" align="center"><strong>No</strong></th>
    <th width="56"><strong>Kode </strong></th>
    <th width="387"><strong>Nama Barang </strong></th>
    <th width="116" align="center"><strong>Harga Beli (Rp) </strong></th>
    <th width="48" align="center"><strong>Jumlah</strong></th>
    <th width="89" align="center"><strong>Subtotal (Rp)</strong></th>
    <th width="42" align="center">&nbsp;</th>
  </tr>
  </thead>
	<?php
	// Variabel
	$subTotal=0; 
	$totalBelanja = 0; 
	$jumlahBarang = 0; 
	
	# Skrip SQL Mengambil data dari tabel TMP_pembelian
	$tmpSql ="SELECT barang.*, tmp.id, tmp.harga_beli, tmp.jumlah FROM barang, pembelian_item As tmp
			  WHERE barang.kd_barang=tmp.kd_barang AND status=2 ORDER BY tmp.id";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$nomor=0; 
	while($tmpData = mysql_fetch_array($tmpQry)) {
		$nomor++;
		$id		= $tmpData['id'];
		$jumlahBarang	= $jumlahBarang + $tmpData['jumlah'];
		$subTotal		= $tmpData['harga_beli'] * $tmpData['jumlah']; // Harga beli dari tabel tmp_pembelian (harga terbaru yang diinput)
		$totalBelanja	= $totalBelanja + $subTotal;

		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $tmpData['kd_barang']; ?></td>
    <td><?php echo $tmpData['nm_barang']; ?></td>
    <td align="center"><?php echo format_angka($tmpData['harga_beli']); ?></td>
    <td align="center"><?php echo $tmpData['jumlah']; ?></td>
    <td align="center"><div align="right"><?php echo format_angka($subTotal); ?></div></td>
    <td align="center" bgcolor="#FFFFCC"><a href="?page=Transaksi-Pembelian&Act=Delete&id=<?php echo $id; ?>" target="_self">Hapus</a></td>
  </tr>
<?php } ?>
<tfoot>
  <tr>
    <td colspan="4" align="right" bgcolor="#CCCCCC"><div align="right" class="style3"> GRAND TOTAL BELI : </div></td>
    <td align="center" bgcolor="#CCCCCC"><span class="style3"><?php echo $jumlahBarang; ?></span></td>
    <td align="center" bgcolor="#CCCCCC"><div align="right" class="style3">Rp. <?php echo format_angka($totalBelanja); ?></div></td>
    <td align="center" bgcolor="#CCCCCC"><span class="style2"></span></td>
  </tr>
  </tfoot>
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