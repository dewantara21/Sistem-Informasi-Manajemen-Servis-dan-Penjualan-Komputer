-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 15 Mei 2018 pada 13.48
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `servis_komputer`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` char(7) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `stok` int(10) NOT NULL,
  `kd_kategori` char(4) NOT NULL,
  `kd_supplier` char(4) NOT NULL,
  PRIMARY KEY (`kd_barang`),
  UNIQUE KEY `kd_buku` (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `barcode`, `nm_barang`, `keterangan`, `satuan`, `harga_beli`, `harga_jual`, `stok`, `kd_kategori`, `kd_supplier`) VALUES
('B000009', '000009', 'Lenovo S8', 'Putih', 'Unit', 3200000, 3500000, 7, 'K006', 'S007'),
('B000008', '000008', 'Tablet T8 L', 'Hitam', 'Unit', 1500000, 1800000, 37, 'K007', 'S006'),
('B000007', '000007', 'Motorola BT 421', 'Hitam', 'Unit', 700000, 1000000, 28, 'K004', 'S005'),
('B000006', '000006', 'BB 360', 'Hitam', 'Unit', 1200000, 1400000, 3, 'K003', 'S004'),
('B000005', '000005', 'nokia s', 'merah', 'Unit', 1000000, 1000000, 4, 'K002', 'S001'),
('B000004', '000004', 'Samsung S3 Mini', 'Putih', 'Unit', 2500000, 2700000, 10, 'K001', 'S001'),
('B000003', '000003', 'Nokia X', 'Hitam', 'Unit', 1000000, 1500000, 5, 'K002', 'S003'),
('B000002', '000002', 'Evercoss A26', 'Hitam', 'Unit', 900000, 1300000, 1, 'K005', 'S002'),
('B000001', '000001', 'Oli', 'Putih', 'Unit', 700000, 950000, 86, 'K001', 'S001'),
('B000010', '000010', 'Catrid HP 720 INK', '-', 'Buah', 80000, 110000, 0, 'K008', 'S005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa_services`
--

CREATE TABLE IF NOT EXISTS `jasa_services` (
  `id_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_service` varchar(10) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `harga_jasa` int(12) NOT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `jasa_services`
--

INSERT INTO `jasa_services` (`id_jasa`, `kd_service`, `tgl_selesai`, `harga_jasa`) VALUES
(3, '1', '2018-05-15', 200000),
(4, '3', '2018-05-15', 230000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` char(4) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K005', 'Evercoss'),
('K004', 'Motorola'),
('K003', 'Blackbary'),
('K002', 'Nokia'),
('K001', 'Samsung'),
('K006', 'Lenovo'),
('K007', 'Advance'),
('K008', 'Catrid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kd_pelanggan` char(5) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `nm_toko` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `nm_toko`, `alamat`, `no_telepon`) VALUES
('P0003', 'Rudi', 'B 44546 GIJ', 'Bsd Tangerang', '02183847444'),
('P0002', 'Andri', 'B 06351 GDF', 'Citra Raya Square', '09863844733');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `no_pembelian` char(7) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `kd_supplier` char(4) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `kd_user` char(4) NOT NULL,
  PRIMARY KEY (`no_pembelian`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `tgl_pembelian`, `kd_supplier`, `keterangan`, `kd_user`) VALUES
('NP00012', '2015-10-29', 'S007', '', 'U001'),
('NP00011', '2015-10-28', 'S006', '', 'U001'),
('NP00010', '2015-10-28', 'S005', '', 'U001'),
('NP00009', '2015-10-28', 'S004', '', 'U001'),
('NP00008', '2015-01-28', 'S001', '', 'U001'),
('NP00007', '2015-01-02', 'S001', '', 'U001'),
('NP00006', '2014-12-27', 'S003', 'Hitam', 'U001'),
('NP00005', '2014-12-26', 'S001', '', 'U001'),
('NP00004', '2014-12-26', 'S001', '', 'U001'),
('NP00003', '2014-12-26', 'S001', '', 'U001'),
('NP00002', '2014-12-25', 'S001', '', 'U001'),
('NP00001', '2014-12-21', 'S002', '', 'U001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_item`
--

CREATE TABLE IF NOT EXISTS `pembelian_item` (
  `no_pembelian` char(7) NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `jumlah` int(4) NOT NULL,
  KEY `nomor_penjualan_tamu` (`no_pembelian`,`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_item`
--

INSERT INTO `pembelian_item` (`no_pembelian`, `kd_barang`, `harga_beli`, `jumlah`) VALUES
('NP00012', 'B000009', 3200000, 10),
('NP00011', 'B000008', 1500000, 50),
('NP00010', 'B000007', 700000, 40),
('NP00009', 'B000006', 1200000, 10),
('NP00008', 'B000004', 2500000, 6),
('NP00008', 'B000005', 1000000, 10),
('NP00007', 'B000004', 2500000, 6),
('NP00006', 'B000003', 1000000, 10),
('NP00005', 'B000001', 700000, 10),
('NP00004', 'B000001', 700000, 10),
('NP00003', 'B000001', 700000, 80),
('NP00002', 'B000001', 700000, 10),
('NP00001', 'B000002', 900000, 10),
('NP00007', 'B000029', 37000, 10),
('NP00007', 'B000030', 29000, 10),
('NP00007', 'B000031', 20000, 10),
('NP00007', 'B000032', 30000, 10),
('NP00008', 'B000020', 30000, 10),
('NP00008', 'B000006', 26000, 10),
('NP00008', 'B000011', 25000, 10),
('NP00008', 'B000033', 120000, 5),
('NP00009', 'B000018', 26000, 10),
('NP00009', 'B000016', 36000, 10),
('NP00009', 'B000034', 20000, 10),
('NP00009', 'B000035', 40000, 10),
('NP00010', 'B000038', 20000, 10),
('NP00010', 'B000037', 40000, 10),
('NP00010', 'B000036', 40000, 10),
('NP00011', 'B000042', 27000, 10),
('NP00011', 'B000041', 28000, 10),
('NP00011', 'B000040', 35000, 10),
('NP00011', 'B000039', 40000, 10),
('NP00012', 'B000045', 60000, 10),
('NP00012', 'B000044', 30000, 10),
('NP00012', 'B000043', 29000, 10),
('NP00013', 'B000001', 40000, 5),
('NP00014', 'B000002', 20000, 5),
('NP00014', 'B000003', 40000, 5),
('NP00015', 'B000058', 20000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `no_penjualan` varchar(7) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `kd_pelanggan` char(5) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `jasa_service` varchar(100) NOT NULL,
  `harga_service` int(12) NOT NULL,
  `diskon_service` int(3) NOT NULL,
  `total_service` int(12) NOT NULL,
  `kd_user` char(4) NOT NULL,
  PRIMARY KEY (`no_penjualan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tgl_penjualan`, `kd_pelanggan`, `keterangan`, `uang_bayar`, `jasa_service`, `harga_service`, `diskon_service`, `total_service`, `kd_user`) VALUES
('JL00009', '2015-10-29', 'P0004', '', 10500000, '', 0, 0, 0, 'U001'),
('JL00008', '2015-10-28', 'P0004', '', 19010000, '', 0, 0, 0, 'U001'),
('JL00007', '2015-10-28', 'P0002', '', 10800000, '', 0, 0, 0, 'U001'),
('JL00006', '2015-10-28', 'P0003', '', 9500000, '', 0, 0, 0, 'U001'),
('JL00005', '2015-10-28', 'P0003', '', 3000000, '', 0, 0, 0, 'U001'),
('JL00004', '2015-10-29', 'P0003', '', 950000, '', 0, 0, 0, 'U001'),
('JL00003', '2015-10-27', 'P0003', '', 3800000, '', 0, 0, 0, 'U001'),
('JL00002', '2015-10-28', 'P0002', '', 1300000, '', 0, 0, 0, 'U001'),
('JL00001', '2015-10-28', 'P0002', '', 950000, '', 0, 0, 0, 'U001'),
('JL00012', '2018-05-15', 'P0003', '', 200000, 'JASA SERVICE', 200000, 0, 200000, 'U001'),
('JL00011', '2018-05-15', 'P0002', '', 950000, 'JASA SERVICE', 0, 0, 0, 'U001'),
('JL00010', '2018-05-15', 'P0003', '', 230000, 'JASA SERVICE', 230000, 0, 230000, 'U001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_item`
--

CREATE TABLE IF NOT EXISTS `penjualan_item` (
  `no_penjualan` char(7) NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `kd_kategori` char(7) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `diskon` int(4) NOT NULL,
  `jumlah` int(4) NOT NULL,
  KEY `nomor_penjualan_tamu` (`no_penjualan`,`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_item`
--

INSERT INTO `penjualan_item` (`no_penjualan`, `kd_barang`, `kd_kategori`, `harga_beli`, `harga_jual`, `diskon`, `jumlah`) VALUES
('JL00009', 'B000009', 'K006', 3200000, 3500000, 0, 3),
('JL00008', 'B000008', 'K007', 1500000, 1800000, 12, 12),
('JL00007', 'B000007', 'K004', 700000, 1000000, 10, 12),
('JL00006', 'B000006', 'K003', 1200000, 1400000, 4, 7),
('JL00005', 'B000003', 'K002', 1000000, 1500000, 0, 2),
('JL00004', 'B000001', 'K001', 700000, 950000, 0, 1),
('JL00003', 'B000001', 'K001', 700000, 950000, 0, 4),
('JL00002', 'B000002', 'K005', 900000, 1300000, 0, 1),
('JL00001', 'B000001', 'K001', 700000, 950000, 0, 1),
('JL00011', 'B000001', 'K001', 700000, 950000, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `kd_service` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pelanggan` varchar(10) NOT NULL,
  `teknisi` varchar(7) NOT NULL,
  `tgl_service` date NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `step` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`kd_service`, `kd_pelanggan`, `teknisi`, `tgl_service`, `deskripsi`, `step`) VALUES
(1, 'P0002', 'T0003', '2017-05-22', 'Service', 'DIBAYAR'),
(3, 'P0003', 'T0003', '2018-05-15', 'dsjfhsofklnmspkf fsdhfkl sdfsdjf s\r\n', 'CLOSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `kd_supplier` char(4) NOT NULL,
  `nm_supplier` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nm_supplier`, `alamat`, `no_telepon`) VALUES
('S006', 'Advance celuler', 'Jakarta', '0894044'),
('S005', 'Motorola Ltd', 'PT. Motorola indonesia', '02199595555'),
('S004', 'Blackbarry LTD', 'Jakarta', '0219040444'),
('S003', 'PT. NOKIA INDONESIA', 'Tangerang Selatan', '02190763535'),
('S002', 'PT. Super Electric', 'Tangerang', '021896364'),
('S001', 'PT . Electro Indonesia', 'Jakarta Selatan', '0895363635'),
('S007', 'PT Lenovo electric ltd', 'Jakarta', '0219776653');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

CREATE TABLE IF NOT EXISTS `teknisi` (
  `kd_teknisi` varchar(5) NOT NULL,
  `nm_teknisi` varchar(30) NOT NULL,
  `no_telepon` int(13) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nik` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`kd_teknisi`, `nm_teknisi`, `no_telepon`, `alamat`, `nik`) VALUES
('T0002', 'Rudi Aryanji', 8675555, 'Jakarta', 7383838),
('T0003', 'Adetia Nugraha', 2147483647, 'Bekasi', 1667638);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_pembelian`
--

CREATE TABLE IF NOT EXISTS `tmp_pembelian` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `kd_user` char(4) NOT NULL,
  `kd_supplier` char(4) NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data untuk tabel `tmp_pembelian`
--

INSERT INTO `tmp_pembelian` (`id`, `kd_user`, `kd_supplier`, `kd_barang`, `harga_beli`, `jumlah`, `satuan`) VALUES
(89, 'U001', 'S001', 'B000001', 4500000, 3, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_penjualan`
--

CREATE TABLE IF NOT EXISTS `tmp_penjualan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `kd_user` char(4) NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `diskon` int(4) NOT NULL,
  `jumlah` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kd_user` char(4) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'Kasir'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `no_telepon`, `username`, `password`, `level`) VALUES
('U001', 'Ahmad Andriansyah', '089624037824', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
('U002', 'Fitria Prasetya', '081911111111111', 'CS', '202cb962ac59075b964b07152d234b70', 'Customer Service'),
('U003', 'Fitria Prasetiawati', '081911111111111', 'fitria', '202cb962ac59075b964b07152d234b70', 'Customer Service'),
('U004', 'Ahmad Andriansyah', '089624037824', 'Manager', '202cb962ac59075b964b07152d234b70', 'Manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_chat_messages`
--

CREATE TABLE IF NOT EXISTS `user_chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_content` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `message_time` datetime NOT NULL,
  `recipient` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sudahbaca` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data untuk tabel `user_chat_messages`
--

INSERT INTO `user_chat_messages` (`id`, `message_content`, `username`, `message_time`, `recipient`, `sudahbaca`) VALUES
(17, 'tes1', 'Manager', '2015-10-30 12:07:46', 'admin', 'Y'),
(22, 'test2', 'Manager', '2015-10-30 03:04:33', 'admin', 'N'),
(23, 'test3', 'Manager', '2015-10-30 12:07:10', 'admin', 'Y'),
(25, 'test2', 'kasir', '2015-10-30 00:00:12', 'admin', 'Y'),
(26, 'test', 'kasir', '2015-10-30 01:02:13', 'admin', 'Y'),
(27, 'tttttt', 'admin', '0000-00-00 00:00:00', 'kasir', 'Y'),
(28, 'ping', 'admin', '2015-10-30 13:28:16', 'fitria', 'N'),
(29, 'ggggg', 'admin', '2015-10-30 13:56:42', 'kasir', 'Y'),
(30, ' ping test', 'kasir', '2015-10-30 14:08:59', 'Manager', 'N'),
(31, 'Hay admin', 'CS', '2017-05-23 00:54:57', 'admin', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
