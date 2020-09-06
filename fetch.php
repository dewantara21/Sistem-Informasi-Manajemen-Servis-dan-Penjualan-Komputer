<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case '' :
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("Sorry Empty Page!"); 
			include "main.php";	break;
			
		case 'Login' :
			if(!file_exists ("index.php")) die ("Sorry Empty Page!"); 
			include "index.php"; break;
			
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!"); 
			include "login_validasi.php"; break;
			
		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!"); 
			include "login_out.php"; break;		

		# USER LOGIN (Admin, Kasir)
		case 'User-Data' :
			if(!file_exists ("user_data.php")) die ("Sorry Empty Page!"); 
			include "user_data.php";	 break;		
		case 'User-Add' :
			if(!file_exists ("user_add.php")) die ("Sorry Empty Page!"); 
			include "user_add.php";	 break;		
		case 'User-Delete' :
			if(!file_exists ("user_delete.php")) die ("Sorry Empty Page!"); 
			include "user_delete.php"; break;		
		case 'User-Edit' :
			if(!file_exists ("user_edit.php")) die ("Sorry Empty Page!"); 
			include "user_edit.php"; break;	

		# KATEGORI / PENGELOMPOKAN JENIS BARANG
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Sorry Empty Page!"); 
			include "kategori_data.php"; break;		
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("Sorry Empty Page!"); 
			include "kategori_add.php";	break;		
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("Sorry Empty Page!"); 
			include "kategori_delete.php"; break;		
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("Sorry Empty Page!"); 
			include "kategori_edit.php"; break;	

		case 'KategoriPerangkat-Data' :
			if(!file_exists ("kategorip_data.php")) die ("Sorry Empty Page!"); 
			include "kategorip_data.php"; break;		
		case 'KategoriPerangkat-Add' :
			if(!file_exists ("kategorip_add.php")) die ("Sorry Empty Page!"); 
			include "kategorip_add.php";	break;		
		case 'KategoriPerangkat-Delete' :
			if(!file_exists ("kategorip_delete.php")) die ("Sorry Empty Page!"); 
			include "kategorip_delete.php"; break;		
		case 'KategoriPerangkat-Edit' :
			if(!file_exists ("kategorip_edit.php")) die ("Sorry Empty Page!"); 
			include "kategorip_edit.php"; break;	

			
		# PROVINSI 
		case 'Provinsi-Data' :
			if(!file_exists ("provinsi_data.php")) die ("Sorry Empty Page!"); 
			include "provinsi_data.php"; break;		
		case 'Provinsi-Add' :
			if(!file_exists ("provinsi_add.php")) die ("Sorry Empty Page!"); 
			include "provinsi_add.php";	break;		
		case 'Provinsi-Delete' :
			if(!file_exists ("provinsi_delete.php")) die ("Sorry Empty Page!"); 
			include "provinsi_delete.php"; break;		
		case 'Provinsi-Edit' :
			if(!file_exists ("provinsi_edit.php")) die ("Sorry Empty Page!"); 
			include "provinsi_edit.php"; break;	
		
		# Kabupaten sasd
		case 'Kabupaten-Data' :
			if(!file_exists ("kabupaten_data.php")) die ("Sorry Empty Page!"); 
			include "kabupaten_data.php"; break;		
		case 'Kabupaten-Add' :
			if(!file_exists ("kabupaten_add.php")) die ("Sorry Empty Page!"); 
			include "kabupaten_add.php";	break;		
		case 'Kabupaten-Delete' :
			if(!file_exists ("kabupaten_delete.php")) die ("Sorry Empty Page!"); 
			include "kabupaten_delete.php"; break;		
		case 'Kabupaten-Edit' :
			if(!file_exists ("kabupaten_edit.php")) die ("Sorry Empty Page!"); 
			include "kabupaten_edit.php"; break;		

# LEVEL 
		case 'Level-Data' :
			if(!file_exists ("level_data.php")) die ("Sorry Empty Page!"); 
			include "level_data.php"; break;		
		case 'Level-Add' :
			if(!file_exists ("level_add.php")) die ("Sorry Empty Page!"); 
			include "level_add.php";	break;		
		case 'Level-Delete' :
			if(!file_exists ("level_delete.php")) die ("Sorry Empty Page!"); 
			include "level_delete.php"; break;		
		case 'Level-Edit' :
			if(!file_exists ("level_edit.php")) die ("Sorry Empty Page!"); 
			include "level_edit.php"; break;	

		# BARANG / PRODUK YANG DIJUAL
		case 'Barang-Data' :
			if(!file_exists ("barang_data.php")) die ("Sorry Empty Page!"); 
			include "barang_data.php"; break;		
		case 'Barang-Add' :
			if(!file_exists ("barang_add.php")) die ("Sorry Empty Page!"); 
			include "barang_add.php"; break;		
		case 'Barang-Delete' :
			if(!file_exists ("barang_delete.php")) die ("Sorry Empty Page!"); 
			include "barang_delete.php"; break;		
		case 'Barang-Edit' :
			if(!file_exists ("barang_edit.php")) die ("Sorry Empty Page!"); 
			include "barang_edit.php"; break;
			
		case 'Pencarian-Barang' :
			if(!file_exists ("pencarian_barang.php")) die ("Sorry Empty Page!"); 
			include "pencarian_barang.php"; break;		

		# SUPPLIER (PEMASOK)
		case 'Supplier-Data' :
			if(!file_exists ("supplier_data.php")) die ("Sorry Empty Page!"); 
			include "supplier_data.php";	 break;		
		case 'Supplier-Add' :
			if(!file_exists ("supplier_add.php")) die ("Sorry Empty Page!"); 
			include "supplier_add.php";	 break;		
		case 'Supplier-Delete' :
			if(!file_exists ("supplier_delete.php")) die ("Sorry Empty Page!"); 
			include "supplier_delete.php"; break;		
		case 'Supplier-Edit' :				
			if(!file_exists ("supplier_edit.php")) die ("Sorry Empty Page!"); 
			include "supplier_edit.php"; break;	

		# PELANGGAN (CUSTOMER)
		case 'Pelanggan-Data' :
			if(!file_exists ("pelanggan_data.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_data.php"; break;		
		case 'Pelanggan-Add' :
			if(!file_exists ("pelanggan_add.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_add.php"; break;
		case 'Pelanggan-Delete' :
			if(!file_exists ("pelanggan_delete.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_delete.php"; break;
		case 'Pelanggan-Edit' :
			if(!file_exists ("pelanggan_edit.php")) die ("Sorry Empty Page!"); 
			include "pelanggan_edit.php"; break;

		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA (User, Supplier, Pelanggan, Kategori dan Barang)
			case 'Laporan-User' :
				if(!file_exists ("laporan_user.php")) die ("Sorry Empty Page!"); 
				include "laporan_user.php"; break;
	
			case 'Laporan-Supplier' :
				if(!file_exists ("laporan_supplier.php")) die ("Sorry Empty Page!"); 
				include "laporan_supplier.php"; break;
				
			case 'Laporan-Pelanggan' :
				if(!file_exists ("laporan_pelanggan.php")) die ("Sorry Empty Page!"); 
				include "laporan_pelanggan.php"; break;

			case 'Laporan-Kategori' :
				if(!file_exists ("laporan_kategori.php")) die ("Sorry Empty Page!"); 
				include "laporan_kategori.php"; break;

			case 'Laporan-Barang' :	
				if(!file_exists ("laporan_barang.php")) die ("Sorry Empty Page!"); 
				include "laporan_barang.php"; break;
					
			case 'Laporan-Barang-per-Kategori' :
				if(!file_exists ("laporan_barang_kategori.php")) die ("Sorry Empty Page!"); 
				include "laporan_barang_kategori.php"; break;
				
			case 'Laporan-Barang-per-Supplier' :
				if(!file_exists ("laporan_barang_supplier.php")) die ("Sorry Empty Page!"); 
				include "laporan_barang_supplier.php"; break;
			
			# LAPORAN TRANSAKSI PEMBELIAN
			case 'Laporan-Pembelian' :
				if(!file_exists ("laporan_pembelian.php")) die ("Sorry Empty Page!"); 
				include "laporan_pembelian.php"; break;
				
			case 'Laporan-Pembelian-per-Periode' :
				if(!file_exists ("laporan_pembelian_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pembelian_periode.php"; break;
				
			case 'Laporan-Pembelian-per-Supplier' :
				if(!file_exists ("laporan_pembelian_supplier.php")) die ("Sorry Empty Page!"); 
				include "laporan_pembelian_supplier.php"; break;
				
			# LAPORAN TRANSAKSI PENJUALAN
			case 'Laporan-Penjualan' :
				if(!file_exists ("laporan_penjualan.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan.php"; break;
				
			case 'Laporan-Penjualan-per-Periode' :
				if(!file_exists ("laporan_penjualan_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_periode.php"; break;
				
			case 'Laporan-Penjualan-per-Pelanggan' :
				if(!file_exists ("laporan_penjualan_pelanggan.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_pelanggan.php"; break;
				
			case 'Laporan-Penjualan-per-Barang' :
				if(!file_exists ("laporan_penjualan_barang.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_barang.php"; break;
			case 'Laporan-Penjualan-per-Periode-grafik' :
				if(!file_exists ("laporan_penjualan_periode _grafik.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_periode _grafik.php"; break;
				# TRANSAKSI PENJUALAN
			case 'Transaksi-Penjualan' :
				if(!file_exists ("penjualan/penjualan.php")) die ("Sorry Empty Page!"); 
				include "penjualan/penjualan.php"; break;
				
				# TRANSAKSI PEMBELIAN
			case 'Transaksi-Pembelian' :
				if(!file_exists ("pembelian/pembelian.php")) die ("Sorry Empty Page!"); 
				include "pembelian/pembelian.php"; break;
					# LOGIN INFO
			case 'Profile' :
				if(!file_exists ("login_info.php")) die ("Sorry Empty Page!"); 
				include "login_info.php"; break;
				# PESAN
			case 'Kontak' :
				if(!file_exists ("kontak.php")) die ("Sorry Empty Page!"); 
				include "kontak.php"; break;
			case 'View-Pesan' :
				if(!file_exists ("view_pesan.php")) die ("Sorry Empty Page!"); 
				include "view_pesan.php"; break;
			case 'Lihat-Pesan' :
				if(!file_exists ("pesan.php")) die ("Sorry Empty Page!"); 
				include "pesan.php"; break;

            case 'Teknisi-Data' :
				if(!file_exists ("teknisi_data.php")) die ("Sorry Empty Page!"); 
				include "teknisi_data.php"; break;
			case 'Teknisi-Add' :
				if(!file_exists ("teknisi_add.php")) die ("Sorry Empty Page!"); 
				include "teknisi_add.php"; break;
			case 'Teknisi-Edit' :
				if(!file_exists ("teknisi_edit.php")) die ("Sorry Empty Page!"); 
				include "teknisi_edit.php"; break;
			case 'Teknisi-Delete' :
				if(!file_exists ("teknisi_delete.php")) die ("Sorry Empty Page!"); 
				include "teknisi_delete.php"; break;
			case 'Data-Services' :
				if(!file_exists ("services-data.php")) die ("Sorry Empty Page!"); 
				include "services-data.php"; break;
			case 'Services-Add' :
				if(!file_exists ("service-add.php")) die ("Sorry Empty Page!"); 
				include "service-add.php"; break;
			case 'Jasa-Services' :
				if(!file_exists ("jasa-servis.php")) die ("Sorry Empty Page!"); 
				include "jasa-servis.php"; break;
			case 'Service-Edit' :
				if(!file_exists ("service-edit.php")) die ("Sorry Empty Page!"); 
				include "service-edit.php"; break;
			case 'Service-Delete' :
				if(!file_exists ("service-delete.php")) die ("Sorry Empty Page!"); 
				include "service-delete.php"; break;
			case 'Laporan-Services' :
				if(!file_exists ("laporan_services.php")) die ("Sorry Empty Page!"); 
				include "laporan_services.php"; break;
			case 'Detail-Services' :
				if(!file_exists ("service-detail.php")) die ("Sorry Empty Page!"); 
				include "service-detail.php"; break;

		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";						
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("main.php")) die ("Empty Main Page!"); 
	include "main.php";	
}
?>