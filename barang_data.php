
<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);

?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">DATA BARANG </h3>
<a href="?page=Barang-Add" target="_self"><div class="table-header">ADD DATA</div></a>
	<table id="sample-table-2" class="table table-striped table-bordered table-hover">
       <thead>
      <tr>
        <th><strong>No</strong></th>
        <th><strong>Kode</strong></th>
  <!--      <th><strong>Barcode</strong></th> -->
        <th><strong>Nama Barang</strong></th>
        <th>Stok</th>
        <th><strong>Harga Beli(Rp)</strong></th>
        <th><strong>Harga Jual(Rp)</strong></th>
        <td><strong>Aksi</strong></td>
        </tr>
       </thead>
      <?php
	$mySql = "SELECT * FROM barang ORDER BY kd_barang DESC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
   <!--     <td><?php // echo $myData['barcode']; ?></td> -->
        <td><?php echo $myData['nm_barang']; ?></td>
        <td><div align="right"><?php echo $myData['stok']; ?></div></td>
        <td align="right"><div align="right"><?php echo format_angka($myData['harga_beli']); ?></div></td>
        <td align="right"><div align="right"><?php echo format_angka($myData['harga_jual']); ?></div></td>
        <td width="41" align="center"><a href="?page=Barang-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="icon-edit bigger-120" title="Edit"></a>
        <a href="?page=Barang-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" title="Delete" class="icon-trash bigger-120" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
    </div></div>
<script src="assets/js/jquery.min.js"></script>

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