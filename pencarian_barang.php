
<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

// Set variabel SQL
$SQL = "";
$SQLPage = "";

# BACA VARIABEL KATEGORI
$kdKategori = isset($_GET['kdKategori']) ? $_GET['kdKategori'] : 'SEMUA';
$kodeKategori = isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $kdKategori;

# PENCARIAN DATA BERDASARKAN FILTER DATA (Kode Type Kamar)
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Pencarian Multi String (beberapa kata)
	$keyWord 		= explode(" ", $txtKataKunci);
	$filterSQL		= "";
	if(count($keyWord) > 1) {
		foreach($keyWord as $kata) {
			$filterSQL	.= " OR nm_barang LIKE'%$kata%'";
		}
	}
	
	if (trim($_POST['cmbKategori'])=="SEMUA") {
		//Query #1 (all)
		$filterSQL 	= "SELECT * FROM barang WHERE nm_barang LIKE '%$txtKataKunci%' $filterSQL ORDER BY kd_barang";
	}
	else {
		//Query #2 (filter)
		$filterSQL 	= "SELECT barang.*, kategori.nm_kategori FROM barang
					LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
					WHERE kategori.kd_kategori ='$kodeKategori' 
					AND barang.nm_barang LIKE '%$txtKataKunci%' $filterSQL ORDER BY barang.stok DESC";
	}
}
else {
	//Query #1 (all)
	$filterSQL 	= "SELECT * FROM barang ORDER BY kd_barang";
}

# Simpan Variabel TMP
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 19;  // Jumlah baris data
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageQry = mysql_query($filterSQL, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?><div class="row-fluid">
	<div class="span12">

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<h3 align="left" class="header smaller lighter blue">PENCARIAN BARANG</h3>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  
	  <table width="1320" border="0"  class="table-list">
		<tr>
		  <td width="83" height="42"><strong>  Kategori </strong></td>
		  <td width="7"><strong>:</strong></td>
		  <td width="290">
		  <select name="cmbKategori">
            <option value="SEMUA">- SEMUA -</option>
            <?php
		  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($myData = mysql_fetch_array($myQry)) {
			if ($kodeKategori == $myData['kd_kategori']) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myData[kd_kategori]' $cek>$myData[nm_kategori]</option>";
		  }
		  $mySql ="";
		  ?>
          </select></td>
		  <td width="103"><strong>Nama Barang</strong></td>
		  <td width="7"><strong>:</strong></td>
		  <td width="219"><input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="45" maxlength="100" /></td>
		  <td width="592"><input name="btnCari" type="submit" value="Cari" class="btn-primary"/></td>
		</tr>
		
	  </table>
    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
 
    <thead>
      <tr>
        <th><b>No</b></th>
        <th><strong>Kode Barang</strong></th>
    <!--    <th>Barcode</th> -->
        <th><b>Nama Barang </b></th>
        <th align="center"><strong>Stok</strong></th>
        <th ><strong>Hrg Beli(Rp)</strong></th>
        <th ><strong>Hrg Jual(Rp)</strong></th>
        <td ><b>Aksi</b><strong></strong></td>
        </tr>
       </thead>
      <?php
	# MENJALANKAN QUERY FILTER DI ATAS
	$mySql 	= $filterSQL." LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
       <!-- <td><?php // echo $myData['barcode']; ?></td> -->
        <td><?php echo $myData['nm_barang']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga_beli']); ?></td>
        <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td ><a href="?page=Barang-Edit&amp;Kode=<?php echo $Kode; ?>"  alt="Edit Data" class="icon-edit bigger-120" title="Edit"></a>
       <a href="?page=Barang-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" title="Delete" class="icon-trash bigger-120" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')"></a>
      <!-- <a href="" onclick="window.open('barcode128_print.php?Kode=<?php // echo $Kode; ?> ','popuppage','width=300,toolbar=0,resizable=0,scrollbars=no,height=200,top=340,left=800');"  title="Barcode" class="icon-barcode bigger-120"></a> --> </td>
      </tr>
      <?php } ?>
      
      </table>
      
      
</form>
</div></div>
<script src="assets/js/jquery.min.js"></script>


		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<script src="assets/js/ace-elements.min.js"></script>
	<!--	<script src="assets/js/ace.min.js"></script> --> 

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,null,null,null,null,//null,null,null,null,
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
