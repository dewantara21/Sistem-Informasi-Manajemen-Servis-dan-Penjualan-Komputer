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

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" /><?php
include_once "library/inc.seslogin.php";

// Variabel SQL
$filterSQL= "";

// Temporary Variabel form
$dataSupplier	= isset($_POST['cmbSupplier']) ? $_POST['cmbSupplier'] : 'SEMUA';

# PENCARIAN DATA BERDASARKAN FILTER DATA
if(isset($_POST['btnTampil'])) {
	# PILIH SUPPLIER
	if (trim($_POST['cmbSupplier']) =="SEMUA") {
		$filterSQL = "";
	}
	else {
		$filterSQL = "WHERE pembelian.kd_supplier='$dataSupplier'";
	}
}
else {
	$filterSQL= "";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pembelian $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN BARANG MASUK - PER SUPPLIER </h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
      <strong>Filter Data : </strong>
	  <select name="cmbSupplier">
        <option value="SEMUA">....</option>
        <?php
	  $dataSql = "SELECT * FROM supplier ORDER BY kd_supplier";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kd_supplier'] == $dataSupplier) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kd_supplier]' $cek>[ $dataRow[kd_supplier] ]  $dataRow[nm_supplier]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampil" type="submit" value=" Tampilkan " />
   
</form>

<table id="sample-table-2" class="table table-striped table-bordered table-hover" cellspacing="1" cellpadding="2">
  <thead>
  <tr>
    <td align="center" ><strong>No</strong></td>
    <td><strong>Tanggal</strong></td>
    <td><strong>No. Transaksi</strong></td>
    <td><strong>Keterangan</strong></td>
    <td align="right"><strong>Total Barang</strong></td>
    <td align="right" ><strong>Total Belanja (Rp) </strong></td>
    <td align="center"><strong>Aksi</strong></td>
  </tr>
  </thead>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Pembelian
	$mySql = "SELECT pembelian.*, supplier.nm_supplier FROM pembelian 
				LEFT JOIN supplier ON pembelian.kd_supplier=supplier.kd_supplier 
				$filterSQL
				ORDER BY pembelian.no_pembelian DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query pembelian salah : ".mysql_error());
	$nomor = $hal;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Pembelian/ Nomor transaksi
		$noNota = $myData['no_pembelian'];
		
		# Menghitung Total Pembelian (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang,  
						  SUM(harga_beli * jumlah) AS total_belanja 
				   FROM pembelian_item WHERE no_pembelian='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_pembelian']); ?></td>
    <td><?php echo $myData['no_pembelian']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td align="right"><?php echo format_angka($my2Data['total_barang']); ?></td>
    <td align="right"><?php echo format_angka($my2Data['total_belanja']); ?></td>
    <td align="center"><a href="" onclick="window.open('cetak/pembelian_cetak.php?noNota=<?php echo $noNota; ?>  ','popuppage','width=840,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Nota</a></td>
  </tr> 
   <?php } ?>
</table>
</div></div>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

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
		</script>