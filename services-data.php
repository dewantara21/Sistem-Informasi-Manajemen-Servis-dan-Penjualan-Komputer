
<?php
include_once "library/inc.seslogin.php";
 if ($_GET['step']){
	mysql_query("update services set step='".$_GET['step']."' where kd_service='".$_GET['id']."'"); 
	 
 }
 

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM services";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">JASA SERVIS</h3>
    <a href="?page=Services-Add" target="_self"><div class="table-header">ADD DATA</div></a>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
 <thead>
      <tr>
        <th ><b>No</b></th>
         <th ><b>Tanggal </b></th>
        <th><b>Pelanggan </b></th>
         <th><b>Nama Perangkat</b></th>
         <th>Teknisi</th>
		 <th><b>Biaya Jasa</b></th>
        <th><b>Status</b></th>
        <th ><b>Aksi</b></th>
        </tr>
 </thead>
      <?php
	$mySql = "SELECT services.*, pelanggan.nm_pelanggan, user.nm_user FROM services 
	LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
	LEFT JOIN user ON services.teknisi=user.nm_user
	ORDER BY services.kd_service Desc LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_service'];
		$qryJasa=mysql_query("SELECT * FROM detail_servis WHERE kd_service='$Kode'");
		$dataJasa = mysql_fetch_array($qryJasa);
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['tgl_service']; ?></td>
        <td><?php echo $myData['nm_pelanggan']; ?></td>
        <td><?php echo $myData['nama_brg']; ?></td>
        <td><?php echo $myData['nm_user']; ?></td>
		<td><?php
		if (trim($dataJasa['harga_jasa'])==""){ 
					 ?> <a href="?page=Jasa-Services&id=<?php echo $Kode; ?> " title="Buat harga jasa servis"><button class="btn-danger"> Buat Harga</button></a>
											 <?php }else{ ?>
												 
												<a href="#"><?php echo format_angka($dataJasa['harga_jasa']); ?></a> 
										<?php		 
											 } ?></td>
	     <td><?php
		if ($myData['step']=="ON PROSES"){ 
											 
											 
											 ?> <a href="?page=Data-Services&step=SELESAI&id=<?php echo $Kode; ?> "><button class="btn-danger"> Proses</button></a>
											 <?php }elseif($myData['step']=="DIBAYAR"){ ?>
												 
												<a href="#"><button class="btn-primary"> Sudah Diambil</button></a> 
										<?php		 
											 }else{ echo "<a href='#'><button class='btn-warning'> Selesai</button></a>"; } ?></td>
        <td align="center"><a href="?page=Service-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="icon-edit bigger-120" title="Edit"></a> | <a href="?page=Service-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" title="Hapus" class="icon-trash bigger-120" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SERVIS INI ... ?')"></a> | <a href="?page=Detail-Services&Kode=<?php echo $Kode; ?>"   class="icon-zoom-in bigger-110" title="Detail"></a> </td>
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

		
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,null,null,null,null,null,
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