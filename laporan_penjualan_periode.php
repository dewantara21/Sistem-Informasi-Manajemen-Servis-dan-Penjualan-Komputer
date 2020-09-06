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
	$filterPeriode = "WHERE ( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Jika tombol filter tanggal (Tampilkan) tidak diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	$filterPeriode = "WHERE ( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan $filterPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA  PENJUALAN - PER PERIODE </h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table width="717" height="45" border="0" >
  <tr>
  <td width="74"><strong>Periode </strong>
     <strong>:</strong></td>
    <td width="156"><input name="cmbTglAwal" type="text" class="span10 date-picker" id="id-date-picker-1" value="<?php echo $tglAwal; ?>" data-date-format="dd-mm-yyyy" /></td>
	<td width="19">s/d</td>
    <td width="240"><div align="center">
      <input name="cmbTglAkhir" type="text" class="span10 date-picker" id="id-date-picker-1"  value="<?php echo $tglAkhir; ?>" data-date-format="dd-mm-yyyy"/>
    </div></td>
	<td width="206"> <input name="btnTampil" type="submit" class="btn-primary" value=" Tampilkan " /></td>
  </tr>
</table>
   
</form>

<table id="sample-table-2" class="table table-striped table-bordered table-hover" cellspacing="1" cellpadding="2">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Tanggal</strong></th>
    <th><strong>No. Transaksi </strong></th>
    <th><strong>Pelanggan </strong></th>
    <th><strong>Total Barang </strong></th>
    <th><strong>Total Belanja(Rp) </strong></th>
    <th><strong>Aksi</strong></th>
  </tr>
  </thead>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT penjualan.*, pelanggan.nm_pelanggan FROM penjualan 
				LEFT JOIN pelanggan ON penjualan.kd_pelanggan=pelanggan.kd_pelanggan
				$filterPeriode
				ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
		
		# Menghitung Total Penjualan (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang,  
						  SUM(harga_jual * jumlah) AS total_harga  
				   FROM penjualan_item WHERE no_penjualan='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
		$jumlahBelanja = $myData['total_service'] + $my2Data['total_harga'];
		
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($jumlahBelanja); ?></td>
    <td align="center"><a href="" onclick="window.open('cetak/penjualan_cetak.php?noNota=<?php echo $noNota; ?> ','popuppage','width=840,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Nota</a></td>
  </tr>
  <?php } ?>
</table>

</div></div>

<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

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

	
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        
		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,null,null,null,null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
			 $('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
		</script>