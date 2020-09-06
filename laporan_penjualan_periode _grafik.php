<?php
include_once "library/inc.seslogin.php";

?>
<html>
	<head>
<script src="js/grafik/jquery.min.js" type="text/javascript"></script>
<script src="js/grafik/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'GRAFIK PENJUALAN PER KATEGORI'
         },
         xAxis: {
            categories: ['kategori']
         },
         yAxis: {
            title: {
               text: 'Jumlah terjual'
            }
         },
              series:             
            [
            <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT * FROM kategori 
				ORDER BY kd_kategori ";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$kdKategori = $myData['kd_kategori'];
		
		# Menghitung Total Penjualan (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang   
				   FROM penjualan_item WHERE kd_kategori='$kdKategori'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);	
	?>
                  {
                      name: '<?php echo $myData['nm_kategori']; ?>',
                      data: [<?php echo $my2Data['total_barang'];  ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
	</head>
	<body>
		<div id='container'></div>		
	</body>
</html>