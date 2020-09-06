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
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<?php
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
		$filterSQL = "WHERE barang.kd_supplier='$dataSupplier'";
	}
}
else {
	$filterSQL= "";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA BARANG PER SUPPLIER</h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
   
    <tr>
      <td width="120"><b>Nama Supplier </b></td>
      <td width="5"><b>:</b></td>
      <td width="361"><select name="cmbSupplier">
          <option value="SEMUA">....</option>
          <?php
	  $dataSql = "SELECT * FROM supplier ORDER BY kd_supplier";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kd_supplier'] == $dataSupplier) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kd_supplier]' $cek>[ $dataRow[kd_supplier] ] $dataRow[nm_supplier]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Kode</strong></th>
   <!-- <th><strong>Barcode</strong></th> -->
    <th><strong>Nama Barang</strong></th>
    <th><strong>Kategori</strong></th>
    <th><strong>Stok</strong></th>
    <th><strong>Harga Jual (Rp)</strong></th>
  </tr>
 </thead>
  <?php
	# SQL Menampilkan data barang per Supplier
	$mySql 	= "SELECT barang.*, kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
				$filterSQL
				ORDER BY barang.kd_barang ASC LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
 <!--   <td><?php // echo $myData['barcode']; ?></td> -->
    <td><?php echo $myData['nm_barang']; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
    <td align="center"><?php echo $myData['stok']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
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
			      null,null,null,null, //null,
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