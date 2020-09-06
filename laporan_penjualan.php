
<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN PENJUALAN</h3>
<table id="sample-table-2" class="table table-striped table-bordered table-hover" width="100%" cellspacing="1" cellpadding="2">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Tanggal</strong></th>
    <th><strong>No. Transaksi  </strong></th>  
    <th><strong>Pelanggan </strong></th>
    <th><strong>Total Barang  </strong></th>
    <th><strong>Total Belanja (Rp) </strong></th>
    <th><strong>Aksi</strong></th>
  </tr>
</thead>
<?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT penjualan.*, pelanggan.nm_pelanggan FROM penjualan 
				LEFT JOIN pelanggan ON penjualan.kd_pelanggan=pelanggan.kd_pelanggan
				ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
		
		# Menghitung Total Penjualan (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang,  
						  SUM(harga_jual * jumlah) AS total_belanja  
				   FROM penjualan_item WHERE no_penjualan='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);	
		$jumlahBelanja = $myData['total_service'] + $my2Data['total_belanja'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($jumlahBelanja); ?></td>
    <td align="center"><a href="#" onclick="window.open('cetak/penjualan_cetak.php?noNota=<?php echo $noNota; ?> ','popuppage','width=840,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');">
										<i class="icon-print bigger-160"></i>
										Nota</a></td>
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