<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
<?php
include_once "library/inc.seslogin.php";

# HAPUS DAFTAR barang DI TMP
if(isset($_GET['Act'])){
	if(trim($_GET['Act'])=="Delete"){
		# Hapus Tmp jika datanya sudah dipindah
		$mySql = "DELETE FROM tmp_penjualan WHERE id='".$_GET['id']."' AND kd_user='".$_SESSION['SES_LOGIN']."'";
		mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
	}
	if(trim($_GET['Act'])=="Sucsses"){
		echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
	}
}
// =========================================================================

# TOMBOL TAMBAH (KODE barang) DIKLIK
if(isset($_POST['btnTambah'])){
	$pesanError = array();
	if (trim($_POST['txtKode'])=="") {
		$pesanError[] = "Data <b>Kode Barang</b> belum!";		
	}
	if (trim($_POST['txtJumlah'])=="" or ! is_numeric(trim($_POST['txtJumlah']))) {
		$pesanError[] = "Data <b>Jumlah Barang (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}
	if (trim($_POST['txtDiskon'])=="" or ! is_numeric(trim($_POST['txtDiskon']))) {
		$pesanError[] = "Data <b>Diskon (%) belum diisi</b>, silahkan <b>isi dengan angka</b>, atau biarkan 0 !";		
	}
	
	# Baca variabel
	$txtKode	= $_POST['txtKode'];
	$txtKode	= str_replace("'","&acute;",$txtKode);
	$txtJumlah	= $_POST['txtJumlah'];
	$txtDiskon	= $_POST['txtDiskon'];

	# Cek Stok, jika stok Opname (stok bisa dijual) < kurang dari Jumlah yang dibeli, maka buat Pesan Error
	$cekSql	= "SELECT stok FROM barang WHERE kd_barang='$txtKode' ";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
	$cekRow = mysql_fetch_array($cekQry);
	if ($cekRow['stok'] <= 3) {
		$pesanError[] = "Stok Barang untuk kode <b>$txtKode</b> adalah <b> $cekRow[stok]</b>, tidak dapat dijual!";
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
		# Jika jumlah error pesanError tidak ada			
		// Periksa, apakah Kode Barang yang diinput ada di dalam tabel barang
		$mySql ="SELECT * FROM barang WHERE kd_barang='$txtKode' ";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		$myRow = mysql_fetch_array($myQry);
		if (mysql_num_rows($myQry) >= 1) {
			// Membaca kode barang/ Barang
			$kodeBarang	= $myRow['kd_barang'];
			
			// Jika Kode  ditemukan, masukkan data ke Keranjang (TMP)
			$tmpSql 	= "INSERT INTO tmp_penjualan (kd_barang, jumlah, diskon, kd_user) 
						VALUES ('$kodeBarang', '$txtJumlah', '$txtDiskon', '".$_SESSION['SES_LOGIN']."')";
			mysql_query($tmpSql, $koneksidb) or die ("Gagal Query tmp : ".mysql_error());
		}
	}

}
// ============================================================================

# ========================================================================================================
# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	$pesanError = array();
	if (trim($_POST['cmbTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi !";		
	}
	if (trim($_POST['cmbPelanggan'])=="KOSONG") {
		$pesanError[] = "Data <b>Pelanggan</b> belum diisi !";		
	}
	if (trim($_POST['txtUangBayar'])==""  or ! is_numeric(trim($_POST['txtUangBayar']))) {
		$pesanError[] = "Data <b> Uang Bayar</b> belum diisi, isi dengan uang (Rp) !";		
	}
	if (trim($_POST['txtUangBayar']) < trim($_POST['txtTotBayar'])) {
		$pesanError[] = "Data <b> Uang Bayar Belum Cukup</b>.  
						 Total belanja adalah <b> Rp. ".format_angka($_POST['txtTotBayar'])."</b>";		
	}
	
	# Periksa apakah sudah ada barang yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM tmp_penjualan WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData = mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR BARANG KOSONG</b>, belum ada barang yang dimasukan, <b>minimal 1 Barang</b>.";
	}
	
	# Baca variabel from
	$cmbTanggal 	= $_POST['cmbTanggal'];
	$cmbPelanggan	= $_POST['cmbPelanggan'];
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtUangBayar	= $_POST['txtUangBayar'];
			
			
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
		# SIMPAN DATA KE DATABASE
		# Jika jumlah error pesanError tidak ada
		$noTransaksi = buatKode("penjualan", "JL");
		$mySql	= "INSERT INTO penjualan SET 
						no_penjualan='$noTransaksi', 
						tgl_penjualan='".InggrisTgl($_POST['cmbTanggal'])."', 
						kd_pelanggan='$cmbPelanggan', 
						keterangan='$txtKeterangan', 
						uang_bayar='$txtUangBayar',
						kd_user='".$_SESSION['SES_LOGIN']."'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		if($myQry){
			# …LANJUTAN, SIMPAN DATA
			# Ambil semua data barang yang dipilih, berdasarkan kasir yg login
			$tmpSql ="SELECT barang.*, tmp.jumlah, tmp.diskon
						FROM barang, tmp_penjualan As tmp
						WHERE barang.kd_barang=tmp.kd_barang 
						AND tmp.kd_user='".$_SESSION['SES_LOGIN']."'";
			$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
			while ($tmpData = mysql_fetch_array($tmpQry)) {
				// Baca data dari tabel barang dan jumlah yang dibeli dari TMP
				$dataKode 	= $tmpData['kd_barang'];
				$dataHargaB	= $tmpData['harga_beli'];
				$dataHargaJ	= $tmpData['harga_jual'];
				$dataDiskon	= $tmpData['diskon'];
				$dataJumlah	= $tmpData['jumlah'];
				
				// MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM
				$itemSql = "INSERT INTO penjualan_item SET 
										no_penjualan='$noTransaksi', 
										kd_barang='$dataKode', 
										harga_beli='$dataHargaB', 
										harga_jual='$dataHargaJ', 
										diskon='$dataDiskon', 
										jumlah='$dataJumlah'";
				mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());
				
				// Skrip Update stok
				$stokSql = "UPDATE barang SET stok = stok - $dataJumlah WHERE kd_barang='$dataKode'";
				mysql_query($stokSql, $koneksidb) or die ("Gagal Query Edit Stok".mysql_error());
			}
			
			# Kosongkan Tmp jika datanya sudah dipindah
			$hapusSql = "DELETE FROM tmp_penjualan WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
			mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
			
			// Refresh form
			//echo "<meta http-equiv='refresh' content='0; url=_penjualan_nota.php?noNota=$noTransaksi'>";
			//header("location: penjualan_nota.php?noNota=$noTransaksi");
			echo "<script>";
			echo "window.open('penjualan/penjualan_nota.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
			echo "</script>";

		}
	}	
}
	
# TAMPILKAN DATA KE FORM
$noTransaksi 	= buatKode("penjualan", "JL");
$tglTransaksi 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');
$dataPelanggan	= isset($_POST['cmbPelanggan']) ? $_POST['cmbPelanggan'] : 'P0001';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtUangBayar'] : '';
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"  name="frmadd">
  <table cellpadding="3" cellspacing="1" class="table-common" width="100%">
    <tr>
      <td colspan="6"><div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">TRANSAKSI  PENJUALAN</h3></div></div></td>
    </tr>
    <tr>
      <td width="20%"><strong>No. Penjualan </strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="28%"><input name="txtNomor"  value="<?php echo $noTransaksi; ?>" size="23" maxlength="20" readonly="readonly"/></td>
      <td width="14%"><strong>Kode Barang</strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="36%"><b>
        <input name="txtKode" id="txtKode" size="40" maxlength="30" autofocus />
      <a href="" onclick="window.open('penjualan/?page=Pencarian-Barang','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');" class="icon-search"></a></b></td>
    </tr>
    <tr>
      <td><strong>Tgl. Penjualan </strong></td>
      <td><strong>:</strong></td>
      <td><input type="text" class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy" name="cmbTanggal" value="<?php echo $tglTransaksi; ?>"/></td>
      <td><b>Jumlah </b></td>
      <td><b>:</b></td>
      <td><b>
        <input class="angkaC" name="txtJumlah" size="6" maxlength="4" value="1" 
				 onblur="if (value == '') {value = '1'}" 
				 onfocus="if (value == '1') {value =''}"/>
      </b></td>
    </tr>
    <tr>
      <td><strong>Pelanggan</strong></td>
      <td><strong>:</strong></td>
      <td><b>
        <select name="cmbPelanggan">
          <option value="KOSONG">....</option>
          <?php
	  $mySql = "SELECT * FROM pelanggan ORDER BY kd_pelanggan";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($myData = mysql_fetch_array($myQry)) {
	  	if ($dataPelanggan == $myData['kd_pelanggan']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$myData[kd_pelanggan]' $cek>[ $myData[kd_pelanggan] ] $myData[nm_toko] => $myData[nm_pelanggan]</option>";
	  }
	  ?>
        </select>
      </b></td>
      <td><b>Diskon(%) </b></td>
      <td><b>:</b></td>
      <td><b>
        <input class="angkaC" name="txtDiskon" size="6" maxlength="4" value="0" 
				 onblur="if (value == '') {value = '0'}" 
				 onfocus="if (value == '0') {value =''}"/>
      </b></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="55" maxlength="100" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>
        <input name="btnTambah" type="submit" style="cursor:pointer;" value=" Tambah " class="btn-primary" />
      </b></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table border="0" cellspacing="1" cellpadding="2" width="100%">
  <thead
  <tr>
    <th colspan="8"><div class="table-header">
      <div align="left">DAFTAR BARANG</div>
    </div></th>
    </tr>
</thead>
	<thead>
  <tr>
    <th width="29" align="center" ><div align="left"><strong>No</strong></div></th>
    <th width="85"><div align="left"><strong>Kode</strong></div></th>
    <th width="432"><div align="left"><strong>Nama Barang </strong></div></th>
    <th width="85" align="right" ><div align="left"><strong>Harga(Rp) </strong></div></th>
    <th width="58" align="center"><div align="left"><strong>Disk(%)</strong></div></th>
    <th width="48" align="center"><div align="left"><strong>Jumlah</strong></div></th>
    <th width="100" align="right" ><div align="left"><strong>Subtotal(Rp) </strong></div></th>
    <th width="22" align="center" ><div align="left"></div></th>
  </tr>
  </thead>
<?php
// deklarasi variabel
$hargaDiskon= 0; 
$totalBayar	= 0; 
$jumlahBarang	= 0;

// Qury menampilkan data dalam Grid TMP_Penjualan 
$tmpSql ="SELECT barang.*, tmp.id, tmp.diskon, tmp.jumlah 
		FROM barang, tmp_penjualan As tmp
		WHERE barang.kd_barang=tmp.kd_barang 
		AND tmp.kd_user='".$_SESSION['SES_LOGIN']."'
		ORDER BY barang.kd_barang ";
$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$nomor=0;  
while($tmpData = mysql_fetch_array($tmpQry)) {
	$nomor++;
	$id			= $tmpData['id'];
	$hargaDiskon= $tmpData['harga_jual'] - ( $tmpData['harga_jual'] * $tmpData['diskon'] / 100 );
	$subSotal 	= $tmpData['jumlah'] * $hargaDiskon;
	$totalBayar	= $totalBayar + $subSotal;
	$jumlahBarang	= $jumlahBarang + $tmpData['jumlah'];
?>
  <tr>
    <td><div align="left"><?php echo $nomor; ?></div></td>
    <td><div align="left"><b><?php echo $tmpData['kd_barang']; ?></b></div></td>
    <td><div align="left"><?php echo $tmpData['nm_barang']; ?></div></td>
    <td><div align="left"><?php echo format_angka($tmpData['harga_jual']); ?></div></td>
    <td><div align="left"><?php echo $tmpData['diskon']; ?>%</div></td>
    <td><div align="center"><?php echo $tmpData['jumlah']; ?></div></td>
    <td><div align="left"><?php echo format_angka($subSotal); ?></div></td>
    <td bgcolor="#FFFFCC"><div align="left"><a href="?Act=Delete&id=<?php echo $id; ?>" target="_self">Delete</a></div></td>
  </tr>
    <?php } ?>
  <tr>
    <td colspan="5" align="right" bgcolor="#F5F5F5"><b>GRAND TOATL BELANJA  (Rp.) : </b></td>
    <td align="center" bgcolor="#F5F5F5"><b><?php echo $jumlahBarang; ?></b></td>
    <td align="right" bgcolor="#F5F5F5"><div align="left"><b><?php echo format_angka($totalBayar); ?></b></div></td>
    <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
   <script type="text/javascript">function startCalc(){interval=setInterval("calc()",1)}function calc()
{one=document.frmadd.txtTotBayar.value;
 two=document.frmadd.txtUangBayar.value;
 document.frmadd.txtUangKembali.value=(two*1-one*1)}function stopCalc(){clearInterval(interval)}</script>
  <tr>
    <td colspan="5" align="right" bgcolor="#F5F5F5"><b>UANG BAYAR (Rp.) : </b></td>
    <td align="center" bgcolor="#F5F5F5"><input name="txtTotBayar" type="hidden" value="<?php echo $totalBayar; ?>" onfocus="startCalc();" onblur="stopCalc();"/></td>
    <td align="right" bgcolor="#F5F5F5"><div align="left">
      <input name="txtUangBayar" value="<?php echo $dataUangBayar; ?>" onfocus="startCalc();" onblur="stopCalc();" size="16" maxlength="12"/>
    </div></td>
    <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
  <tr>
    <td height="40" colspan="5" align="right" bgcolor="#F5F5F5"><b>UANG KEMBALI (Rp.) : </b></td>
    <td align="center" bgcolor="#F5F5F5"></td>
    <td align="right" bgcolor="#F5F5F5"><div align="left">
      <input name="txtUangKembali" disabled="disabled" class="style1" value="" size="16" maxlength="12"/>
    </div></td>
    <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="right"><input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " class="btn-primary"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">[  <a href="" onclick="window.open('penjualan/?page=Daftar-Penjualan','popuppage','width=830,toolbar=0,resizable=0,scrollbars=no,height=500,top=100,left=300');">Daftar Penjualan</a>  ] </td>
    <td align="center">&nbsp;</td>
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