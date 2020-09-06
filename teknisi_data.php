<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM teknisi";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">DATA TEKNISI </h3>
<a href="?page=Teknisi-Add" target="_self"><div class="table-header">ADD DATA</div></a>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
      <tr>
        <th width="24"><b>No</b></th>
        <th width="231"><b>Nama Lengkap </b></th>
       <!-- <th width="145"><b>NIK </b></th> -->
        <th width="170"><b>No. Telpon / Hp</b></th>
        <th width="102"><b>Alamat</b></th>
        <th align="center" ><b>Aksi</b><b></b></th>
        </tr>
 </thead>
      <?php
	$mySql 	= "SELECT * FROM teknisi ORDER BY kd_teknisi DESC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_teknisi'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_teknisi']; ?></td>
     <!--   <td><?php// echo $myData['nik']; ?></td> -->
        <td><?php echo $myData['no_telepon']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="41" align="center"><a href="?page=Teknisi-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="icon-edit bigger-120" title="Edit"></a> | <a href="?page=Teknisi-Delete&Kode=<?php echo $Kode; ?>" target="_self" title="Delete" class="icon-trash bigger-120" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TEKNISI INI ?')"></a></td>
       
      </tr>
      <?php } ?>
    </table>
    </div></div>
     
	
<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="assets/js/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->



		<!--page specific plugin scripts-->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null,
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