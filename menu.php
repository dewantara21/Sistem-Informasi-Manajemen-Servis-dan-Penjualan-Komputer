<?php
if(isset($_SESSION['SES_MARKETING'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
<ul  class="nav nav-list">
	<li ><a href='?page=Halaman-Utama' title='Halaman Utama'><i class="icon-dashboard"></i><span class="menu-text">Home</span></a></li>
	
    <li><a href="#" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text">Data Master</span><b class="arrow icon-angle-down"></b></a>
			<ul class="submenu">
         <li><a href='?page=Level-Data' ><i class="icon-user"></i><span class="menu-text">Data Level</span></a></li>
        <li><a href='?page=User-Data' ><i class="icon-user"></i><span class="menu-text">Data User</span></a></li>
  <!--  <li><a href='?page=Teknisi-Data' ><i class="icon-user"></i><span class="menu-text">Data Teknisi</span></a></li> -->
    <li><a href='?page=Provinsi-Data'><i class="icon-double-angle-right"></i>Data Provinsi</a></li>
    <li><a href='?page=Kabupaten-Data'><i class="icon-double-angle-right"></i>Data Kabupaten</a></li>
            	<li><a href='?page=Supplier-Data'><i class="icon-double-angle-right"></i>Data Supplier</a></li>
                <li><a href='?page=Pelanggan-Data'><i class="icon-double-angle-right"></i>Data Pelanggan</a></li>
                <li><a href='?page=Kategori-Data'><i class="icon-double-angle-right"></i>Data Kategori</a></li>
                <li><a href='?page=KategoriPerangkat-Data'><i class="icon-double-angle-right"></i>Data Kategori Perangkat</a></li>
                <li><a href='?page=Barang-Data'><i class="icon-double-angle-right"></i>Data Barang</a></li>
            </ul></li>
	<li><a href='?page=Pencarian-Barang' title='Pencarian'><i class="icon-search"></i><span class="menu-text">Pencarian Barang</span></a></li>
    <li><a href='?page=Data-Services' title='Pencarian'><i class="icon-file"></i><span class="menu-text"> Jasa Servis</span></a></li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-shopping-cart"></i><span class="menu-text">Transaksi</span><b class="arrow icon-angle-down"></b></a>
    		<ul class="submenu">
            	<li><a href='?page=Transaksi-Pembelian'  title='Transaksi Pembelian'><i class="icon-double-angle-right"></i>Transaksi Barang Masuk</a></li>
                <li><a href='?page=Transaksi-Penjualan'  title='Transaksi Penjualan'><i class="icon-double-angle-right"></i>Transaksi Penjualan</a></li>
            </ul>
			</li>
     <li><a href="#" class="dropdown-toggle"><i class="icon-file-alt"></i><span class="menu-text">Laporan</span><b class="arrow icon-angle-down"></b></a>
    		<ul class="submenu">
            <li><a href="?page=Laporan-User" title='Laporan Data User'><i class="icon-double-angle-right"></i>Data User</a></li>
            <li><a href="?page=Laporan-Supplier"  title='Laporan Data Suppiler'><i class="icon-double-angle-right"></i>Data Suppiler</a></li>
            <li><a href="?page=Laporan-Pelanggan"  title='Laporan Data Pelanggan'><i class="icon-double-angle-right"></i>Data Pelanggan</a></li>
			<li><a href="?page=Laporan-Kategori"  title='Laporan Data Kategori'><i class="icon-double-angle-right"></i>Data Kategori</a></li>
            <li><a href="?page=Laporan-Services"  title='Laporan Data Servis'><i class="icon-double-angle-right"></i>Data Servis</a></li>
            <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Data Barang</span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
							<li>
								<a href="?page=Laporan-Barang"  title='Laporan Data Barang'>
									<i class="icon-double-angle-right"></i>Data Barang</a></li>
                            <li>
								<a href="?page=Laporan-Barang-per-Kategori" title='Laporan Data Barang Per kategori'>
									<i class="icon-double-angle-right"></i>Per Kategori</a></li>
                            <li>
								<a href="?page=Laporan-Barang-per-Supplier" title='Laporan Data Barang Per Supplier'>
									<i class="icon-double-angle-right"></i>Per Supplier</a></li>
             </ul></li>
             
              <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Barang Masuk</span><b class="arrow icon-angle-down"></b></a>
             <ul class="submenu">
							<li>
								<a href="?page=Laporan-Pembelian" title='Laporan Pembelian'>
									<i class="icon-double-angle-right"></i>Barang masuk</a></li>
                            <li>
								<a href="?page=Laporan-Pembelian-per-Periode" title='Laporan Pembelian Per Periode'>
									<i class="icon-double-angle-right"></i>Per Periode</a></li>
                            <li>
								<a href="?page=Laporan-Pembelian-per-Supplier" title='Laporan Pembelian Per Supplier'>
									<i class="icon-double-angle-right"></i>Per Supplier</a></li>
         
          </ul></li>
          
          <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Penjualan</span><b class="arrow icon-angle-down"></b></a>
                <ul class="submenu">
							<li>
								<a href="?page=Laporan-Penjualan" title='Laporan Penjualan'>
									<i class="icon-double-angle-right"></i>Penjualan / INV</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Periode" title='Laporan Penjualan Per Periode'>
									<i class="icon-double-angle-right"></i>Per Periode</a></li>
                                    <li><a href="?page=Laporan-Penjualan-per-Periode-grafik" title='Laporan Penjualan Per Periode Grafik'><i class="icon-double-angle-right"></i>Grafik Penjualan</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Pelanggan" title='Laporan Penjualan Per Pelanggan'>
									<i class="icon-double-angle-right"></i>Per Pelanggan</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Barang" title='Laporan Penjualan Per Barang'>
									<i class="icon-double-angle-right"></i>Per Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                         </li>
                      </ul>
                  
                
          
            
<?php
}
elseif(isset($_SESSION['SES_TEKNISI'])){
# JIKA YANG LOGIN LEVEL TEKNISI, menu di bawah yang dijalankan
?>
<ul  class="nav nav-list">
	<li class="active"><a href='?page' title='Halaman Utama'><i class="icon-dashboard"></i><span class="menu-text">Home</span></a></li>
	 <!--  <li><a href='?page=Profile' title='Profile'><i class="icon-user"></i><span class="menu-text">Profile</span></a></li> 
       <li><a href='?page=Pelanggan-Data'><i class="icon-double-angle-right"></i>Data Pelanggan</a></li> -->
        <li><a href='?page=Data-Services' title='Pencarian'><i class="icon-double-angle-right"></i> Jasa Servis</span></a></li>
  <!--  <li><a href='?page=Transaksi-Pembelian' title='Transaksi Pembelian'><i class="icon-double-angle-right"></i>Transaksi Barang Masuk</span></a></li>
     <li><a href='?page=Transaksi-Penjualan' title='Transaksi Penjualan'><i class="icon-double-angle-right"></i>Transaksi Penjualan</span></a></li> 
<li><a href="?page=Laporan-Penjualan" title='Laporan Penjualan'><i class="icon-double-angle-right"></i>Lap. Penjualan</a></li> -->
 <li><a href="?page=Laporan-Services"  title='Laporan Data Servis'><i class="icon-double-angle-right"></i>Lap. Data servis</a></li>
	 </ul>
   <?php
}
elseif(isset($_SESSION['SES_KEUANGAN'])){
# JIKA YANG LOGIN LEVEL KASIR, menu di bawah yang dijalankan
?>
<ul class="nav nav-list">
  <li><a href="#" class="dropdown-toggle"><i class="icon-file-alt"></i><span class="menu-text">Laporan</span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
          
             
              <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
              <span class="menu-text"> Barang Masuk</span><b class="arrow icon-angle-down"></b></a>
             <ul class="submenu">
              <li>
                <a href="?page=Laporan-Pembelian" title='Laporan Pembelian'>
                  <i class="icon-double-angle-right"></i>Barang masuk</a></li>
                            <li>
                <a href="?page=Laporan-Pembelian-per-Periode" title='Laporan Pembelian Per Periode'>
                  <i class="icon-double-angle-right"></i>Per Periode</a></li>
                            <li>
                <a href="?page=Laporan-Pembelian-per-Supplier" title='Laporan Pembelian Per Supplier'>
                  <i class="icon-double-angle-right"></i>Per Supplier</a></li>
         
          </ul></li>
          
          <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
              <span class="menu-text"> Penjualan</span><b class="arrow icon-angle-down"></b></a>
                <ul class="submenu">
              <li>
                <a href="?page=Laporan-Penjualan" title='Laporan Penjualan'>
                  <i class="icon-double-angle-right"></i>Penjualan / INV</a></li>
                            <li>
                <a href="?page=Laporan-Penjualan-per-Periode" title='Laporan Penjualan Per Periode'>
                  <i class="icon-double-angle-right"></i>Per Periode</a></li>
                                    <li><a href="?page=Laporan-Penjualan-per-Periode-grafik" title='Laporan Penjualan Per Periode Grafik'><i class="icon-double-angle-right"></i>Grafik Penjualan</a></li>
                            <li>
                <a href="?page=Laporan-Penjualan-per-Pelanggan" title='Laporan Penjualan Per Pelanggan'>
                  <i class="icon-double-angle-right"></i>Per Pelanggan</a></li>
                            <li>
                <a href="?page=Laporan-Penjualan-per-Barang" title='Laporan Penjualan Per Barang'>
                  <i class="icon-double-angle-right"></i>Per Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                         </li>
</ul>

<?php
}
elseif(isset($_SESSION['SES_MANAGER'])){
# JIKA YANG LOGIN LEVEL KASIR, menu di bawah yang dijalankan
?>
<ul class="nav nav-list">
  <li><a href="#" class="dropdown-toggle"><i class="icon-file-alt"></i><span class="menu-text">Laporan</span><b class="arrow icon-angle-down"></b></a>
    		<ul class="submenu">
            <li><a href="?page=Laporan-User" title='Laporan Data User'><i class="icon-double-angle-right"></i>Data User</a></li>
            <li><a href="?page=Laporan-Supplier"  title='Laporan Data Suppiler'><i class="icon-double-angle-right"></i>Data Suppiler</a></li>
            <li><a href="?page=Laporan-Pelanggan"  title='Laporan Data Pelanggan'><i class="icon-double-angle-right"></i>Data Pelanggan</a></li>
			<li><a href="?page=Laporan-Kategori"  title='Laporan Data Kategori'><i class="icon-double-angle-right"></i>Data Kategori</a></li>
            <li><a href="?page=Laporan-Services"  title='Laporan Data Servis'><i class="icon-double-angle-right"></i>Data Servis</a></li>
            <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Data Barang</span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
							<li>
								<a href="?page=Laporan-Barang"  title='Laporan Data Barang'>
									<i class="icon-double-angle-right"></i>Data Barang</a></li>
                            <li>
								<a href="?page=Laporan-Barang-per-Kategori" title='Laporan Data Barang Per kategori'>
									<i class="icon-double-angle-right"></i>Per Kategori</a></li>
                            <li>
								<a href="?page=Laporan-Barang-per-Supplier" title='Laporan Data Barang Per Supplier'>
									<i class="icon-double-angle-right"></i>Per Supplier</a></li>
             </ul></li>
             
              <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Barang Masuk</span><b class="arrow icon-angle-down"></b></a>
             <ul class="submenu">
							<li>
								<a href="?page=Laporan-Pembelian" title='Laporan Pembelian'>
									<i class="icon-double-angle-right"></i>Barang masuk</a></li>
                            <li>
								<a href="?page=Laporan-Pembelian-per-Periode" title='Laporan Pembelian Per Periode'>
									<i class="icon-double-angle-right"></i>Per Periode</a></li>
                            <li>
								<a href="?page=Laporan-Pembelian-per-Supplier" title='Laporan Pembelian Per Supplier'>
									<i class="icon-double-angle-right"></i>Per Supplier</a></li>
         
          </ul></li>
          
          <li><a href=""  title='Laporan Data Barang' class="dropdown-toggle"><i class="icon-desktop"></i>
            	<span class="menu-text"> Penjualan</span><b class="arrow icon-angle-down"></b></a>
                <ul class="submenu">
							<li>
								<a href="?page=Laporan-Penjualan" title='Laporan Penjualan'>
									<i class="icon-double-angle-right"></i>Penjualan / INV</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Periode" title='Laporan Penjualan Per Periode'>
									<i class="icon-double-angle-right"></i>Per Periode</a></li>
                                    <li><a href="?page=Laporan-Penjualan-per-Periode-grafik" title='Laporan Penjualan Per Periode Grafik'><i class="icon-double-angle-right"></i>Grafik Penjualan</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Pelanggan" title='Laporan Penjualan Per Pelanggan'>
									<i class="icon-double-angle-right"></i>Per Pelanggan</a></li>
                            <li>
								<a href="?page=Laporan-Penjualan-per-Barang" title='Laporan Penjualan Per Barang'>
									<i class="icon-double-angle-right"></i>Per Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                         </li>
</ul>
<?php
}
else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
<ul class="nav nav-list">
	<li><a href='index.php' title='Login System'><i class="icon-unlock"></i><span class="menu-text">Login</span></a></li>	
</ul>
<?php
}
?>