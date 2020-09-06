 <!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->
<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" /> 
		<?php
include_once "library/inc.seslogin.php";

# Deklarasi variabel
$filterPeriode = ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Set Tanggal skrg
$tglAwal 	= isset($_POST['cmbTglAwal']) ? $_POST['cmbTglAwal'] : "01-".date('m-Y');
$tglAkhir 	= isset($_POST['cmbTglAkhir']) ? $_POST['cmbTglAkhir'] : date('d-m-Y');

// Jika tombol filter tanggal (Tampilkan) diklik
if (isset($_POST['btnTampil'])) {
	$filterPeriode = "( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Jika tombol filter tanggal (Tampilkan) tidak diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	$filterPeriode = "( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue"> LAPORAN PENJUALAN BARANG</h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <strong>Periode </strong><input name="cmbTglAwal" type="text" class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy" value="<?php echo $tglAwal; ?>" />
        s/d
        <input name="cmbTglAkhir" type="text" class="date-picker" id="id-date-picker-1" data-date-format="dd-mm-yyyy" value="<?php echo $tglAkhir; ?>" />
   <input name="btnTampil" type="submit" value=" Tampilkan " />
</form>
</div></div>
<br />
	<div class="row-fluid">
<div class="row-fluid">
	<div class="span6">
		<div class="row-fluid">
			<div class="span12 label label-large label-info arrowed-in arrowed-right" ><b>DAFTAR BARANG TERJUAL</b></div>
		</div>
	</div>
</div>
</div>

<table id="sample-table-2" class="table table-striped table-bordered table-hover" cellspacing="1" cellpadding="2">       	
<thead>
  <tr>
    <th rowspan="2" align="center"><b>No</b></th>
    <th rowspan="2"><strong>Tanggal</strong></th>
    <th rowspan="2"><strong>No.Nota</strong></th>
    <th rowspan="2" ><strong>Kode </strong></th>
    <th width="285" rowspan="2"><b>Nama Barang</b></th>
    <th colspan="2" align="center" ><div align="center"><strong>HARGA DASAR </strong></div></th>
  <!--  <th rowspan="2" align="center" ><strong>Disc</strong></th> -->
    <th rowspan="2" colspan="2"  align="center" ><b>Jumlah</b></th>
    <th colspan="2" align="center" ><div align="center"><strong>TOTAL HARGA </strong></div></th>
  </tr>
  <tr>
    <th align="right"><b> Beli (Rp)</b></th>
    <th align="right"><b> Jual (Rp) </b></th>
    <th align="right"><strong>  Beli (Rp)</strong> </th>
    <th align="right"><strong>  Jual (Rp)</strong></th>
  </tr>
 </thead>
  <?php
  	// deklarasi variabel
//	$hargaJualDiskon=0; 
	$totalJual = 0; 
	$totalBeli = 0; 
	$jumlahBarang = 0;  
	$uangKembali=0;
	//  tabel menu 
	$mySql ="SELECT penjualan_item.*, penjualan.tgl_penjualan, barang.nm_barang 
			 FROM penjualan, penjualan_item
			 	LEFT JOIN barang ON penjualan_item.kd_barang=barang.kd_barang 
			 WHERE penjualan.no_penjualan=penjualan_item.no_penjualan
			 AND $filterPeriode 
			 ORDER BY penjualan_item.kd_barang";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	$nomor  = 0;   
	while($myData = mysql_fetch_array($myQry)) {
		$nomor++;
//		$hargaJualDiskon= $myData['harga_jual'] - ( $myData['harga_jual'] * $myData['diskon'] / 100 );
		$subTotalJual 	= $myData['jumlah'] * $myData['harga_jual'];
		$totalJual		= $totalJual + $subTotalJual;
		
		$subTotalBeli 	= $myData['jumlah'] * $myData['harga_beli'];
		$totalBeli 		= $totalBeli + $subTotalBeli ;
		
		$jumlahBarang	= $jumlahBarang + $myData['jumlah'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><strong><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></strong></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td align="right"><div align="right"><?php echo format_angka($myData['harga_beli']); ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($myData['harga_jual']); ?></div></td>
   <!-- <td align="center"><div align="right"><?php //echo $myData['diskon']; ?>%</div></td> -->

    <td colspan="2" align="center"><div align="center"><?php echo $myData['jumlah']; ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($subTotalBeli); ?></div></td>
    <td align="right"><div align="right"><?php echo format_angka($subTotalJual); ?></div></td>
  </tr>
  <?php 
}?>
  <tr>
    <td colspan="8" align="right"><div align="right"><b> Grand Total  : </b></div></td>
    <td align="center" bgcolor="#F5F5F5"><div align="center"><strong><?php echo $jumlahBarang; ?></strong></div></td>
    <td align="right" bgcolor="#F5F5F5"><div align="right"><strong>Rp. <?php echo format_angka($totalBeli); ?></strong></div></td>
    <td align="right" bgcolor="#F5F5F5"><div align="right"><strong>Rp. <?php echo format_angka($totalJual); ?></strong></div></td>
  </tr>
  <tr>
    <td colspan="8" align="right"><div align="right"><b>NETO :</b></div></td>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><div align="justify"><strong>Rp. <?php echo format_angka($totalJual-$totalBeli); ?></strong></div></td>
  </tr>
</table>

 <!-- <button class="btn btn-app btn-light btn-mini" onclick="window.open('cetak/penjualan.php','popuppage','width=800,toolbar=0,resizable=0,scrollbars=no,height=300,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Print
									</button>  -->

 <p></p>
    <a href="cetak/penjualan.php?periode=<?php echo $filterPeriode ;?>" target="new" class="btn btn-app btn-light btn-mini" title="Cetak List Penjualan"><i class="icon-print bigger-160"></i> Print</a>



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