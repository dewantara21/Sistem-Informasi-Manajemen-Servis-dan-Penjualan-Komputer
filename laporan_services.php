<link rel="stylesheet" href="assets/css/datepicker.css" />
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">LAPORAN DATA SERVIS</h3>
                            
<?php 
# Deklarasi variabel
$filterPeriode = ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Set Tanggal skrg
$tglAwal 	= isset($_POST['cmbTglAwal']) ? $_POST['cmbTglAwal'] : "01-".date('m-Y');
$tglAkhir 	= isset($_POST['cmbTglAkhir']) ? $_POST['cmbTglAkhir'] : date('d-m-Y');

// Jika tombol filter tanggal (Tampilkan) diklik
if (isset($_POST['btnTampil'])) {
	$filterPeriode = "WHERE ( tgl_service BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Jika tombol filter tanggal (Tampilkan) tidak diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	$filterPeriode = "WHERE ( tgl_service BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
?>
 <div class="btn-group pull-right">
      <button data-toggle="dropdown" class="btn dropdown-toggle">Status <span class="caret"></span></button>
         <ul class="dropdown-menu">
                 <li><a href="?page=Laporan-Services">All</a></li>
                 <li><a href="?page=Laporan-Services&step=ON PROSES">Proses</a></li>
                 <li><a href="?page=Laporan-Services&step=SELESAI">Selesai</a></li>
				  <li><a href="?page=Laporan-Services&step=DIBAYAR">Dibayar</a></li>
         </ul>
</div>

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
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
      <tr>
        <th >No.</th>
        <th >Tanggal</th>
        <th >Pelanggan</th>
        <th >Nama Barang</th>
        <th >Teknisi</th>
        <th>Status</th>
        <th>Aksi</th>
        </tr>
</thead>
    <?php
if (isset($_GET['step'])) {
	$filterStatus = " AND (step='".$_GET['step']."')";
}
else {
	// Jika tombol filter Status tidak diklik
	$filterStatus = "";
}
	# Perintah untuk menampilkan Semua Daftar Transaksi Permintaan Material
	$mySql = "SELECT services.*, pelanggan.nm_pelanggan, user.nm_user FROM services 
				LEFT JOIN pelanggan ON services.kd_pelanggan=pelanggan.kd_pelanggan
				LEFT JOIN user ON services.teknisi=user.nm_user
				   $filterPeriode
				   $filterStatus 
				ORDER BY services.kd_service DESC ";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor =0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$noNota = $myData['kd_service'];
	?>
      <tr>
      <td> <?php echo $nomor; ?> </td>
        <td><?php echo IndonesiaTgl($myData['tgl_service']); ?></td>
        <td><?php echo $myData['nm_pelanggan']; ?></td>
   		<td><?php echo $myData['nama_brg']; ?></td> 
        <td><?php echo $myData['nm_user']; ?></td>
        <td><?php echo $myData['step'];?></td>
     
        <td><a href="?page=Detail-Services&Kode=<?php echo $noNota; ?>">Detail</a></li>
          
</td>
      </tr>
      <?php } ?>
      
    </table>
    <p></p>
    <a href="cetak/list_services.php?periode=<?php echo $filterPeriode ;?>&id=<?php echo  $filterStatus ; ?>" target="new" class="btn btn-app btn-light btn-mini" title="Cetak List Services"><i class="icon-print bigger-160"></i> Print</a>
    <td>
        

                    </div>
                </div>
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