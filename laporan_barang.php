
		<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 19;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA BARANG</h3>
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
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
	# SQL Menampilkan data semua barang
	$mySql 	= "SELECT barang.*, kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
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
 <!-- <td> <?php // echo $myData['barcode']; ?></td> -->
    <td><?php echo $myData['nm_barang']; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
    <td align="center"><?php echo $myData['stok']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
  </tr>
  <?php } ?>
 </table>
  </div></div>
                           <script src="assets/js/jquery.min.js"></script>


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
			      null,null,null,null,
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
        <button class="btn btn-app btn-light btn-mini" onclick="window.open('cetak/barang.php','popuppage','width=800,toolbar=0,resizable=0,scrollbars=no,height=300,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Print
									</button>