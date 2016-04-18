-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2016 at 11:05 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbypos`
--

-- --------------------------------------------------------

--
-- Table structure for table `ypos_barang`
--

CREATE TABLE IF NOT EXISTS `ypos_barang` (
  `kdbarang` varchar(5) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `stok` smallint(3) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `idkat` int(3) NOT NULL,
  `ids` tinyint(1) NOT NULL,
  PRIMARY KEY (`kdbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ypos_barang`
--

INSERT INTO `ypos_barang` (`kdbarang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `lokasi`, `gambar`, `idkat`, `ids`) VALUES
('B0001', 'Test barang', '8000.00', '10000.00', 100, 'A1', '', 1, 1),
('B0002', 'Sepatu', '80000.00', '100000.00', 10, 'B1', '', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_grouplvlmdl`
--

CREATE TABLE IF NOT EXISTS `ypos_grouplvlmdl` (
  `idGroupLM` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `idlevel` tinyint(2) DEFAULT NULL,
  `modulID` tinyint(3) DEFAULT NULL,
  `c` varchar(1) NOT NULL DEFAULT 'N',
  `e` varchar(1) NOT NULL DEFAULT 'N',
  `d` varchar(1) NOT NULL DEFAULT 'N',
  `userID` varchar(15) NOT NULL,
  PRIMARY KEY (`idGroupLM`),
  KEY `idlevel` (`idlevel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ypos_grouplvlmdl`
--

INSERT INTO `ypos_grouplvlmdl` (`idGroupLM`, `idlevel`, `modulID`, `c`, `e`, `d`, `userID`) VALUES
(1, 2, 0, 'Y', 'Y', 'Y', 'yuda'),
(2, 2, 1, 'Y', 'Y', 'Y', 'yuda'),
(3, 2, 2, 'Y', 'Y', 'Y', 'yuda'),
(4, 2, 3, 'Y', 'Y', 'Y', 'yuda'),
(5, 2, 4, 'Y', 'Y', 'Y', 'yuda'),
(6, 2, 5, 'Y', 'Y', 'Y', 'yuda'),
(7, 2, 6, 'Y', 'Y', 'Y', 'yuda'),
(8, 2, 7, 'Y', 'Y', 'Y', 'yuda'),
(9, 2, 8, 'Y', 'Y', 'Y', 'yuda'),
(10, 2, 15, 'Y', 'Y', 'Y', 'yuda'),
(12, 1, 1, 'Y', 'Y', 'Y', 'system'),
(13, 1, 2, 'Y', 'Y', 'Y', 'system'),
(14, 1, 3, 'Y', 'Y', 'Y', 'system'),
(15, 1, 5, 'Y', 'Y', 'Y', 'system'),
(16, 1, 6, 'Y', 'Y', 'Y', 'system'),
(17, 1, 7, 'Y', 'Y', 'Y', 'system'),
(18, 1, 8, 'Y', 'Y', 'Y', 'system'),
(19, 1, 9, 'Y', 'Y', 'Y', 'system'),
(20, 1, 10, 'Y', 'Y', 'Y', 'system');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_kategori`
--

CREATE TABLE IF NOT EXISTS `ypos_kategori` (
  `idkat` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ids` tinyint(1) unsigned NOT NULL,
  `nama_kat` varchar(50) NOT NULL,
  PRIMARY KEY (`idkat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ypos_kategori`
--

INSERT INTO `ypos_kategori` (`idkat`, `ids`, `nama_kat`) VALUES
(1, 1, 'Test'),
(2, 1, 'Aksesoris HP'),
(3, 1, 'Jasa'),
(4, 1, 'Jewellery'),
(5, 1, 'Voucher'),
(6, 1, 'Food'),
(7, 1, 'Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_level`
--

CREATE TABLE IF NOT EXISTS `ypos_level` (
  `idlevel` tinyint(2) NOT NULL AUTO_INCREMENT,
  `lvl` varchar(35) NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `CreatedBy` varchar(15) NOT NULL,
  PRIMARY KEY (`idlevel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ypos_level`
--

INSERT INTO `ypos_level` (`idlevel`, `lvl`, `aktif`, `CreatedBy`) VALUES
(1, 'Administrator', '', 'yuda'),
(2, 'staff', 'Y', 'system');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_lgnhistories`
--

CREATE TABLE IF NOT EXISTS `ypos_lgnhistories` (
  `idLgn` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `jam` datetime DEFAULT NULL,
  `hostname` varchar(100) NOT NULL,
  `browser` varchar(17) NOT NULL,
  `ket` enum('IN','OUT') NOT NULL,
  PRIMARY KEY (`idLgn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `ypos_lgnhistories`
--

INSERT INTO `ypos_lgnhistories` (`idLgn`, `username`, `ip`, `jam`, `hostname`, `browser`, `ket`) VALUES
(1, 'system', '::1', '2015-03-08 23:17:35', 'yLabs', 'Firefox', 'IN'),
(2, 'system', '::1', '2015-03-08 23:20:05', 'yLabs', 'Firefox', 'OUT'),
(3, 'system', '::1', '2015-03-08 23:46:41', 'yLabs', 'Firefox', 'IN'),
(4, 'system', '::1', '2015-03-08 23:47:02', 'yLabs', 'Firefox', 'OUT'),
(5, 'system', '::1', '2015-03-08 23:47:08', 'yLabs', 'Firefox', 'IN'),
(6, 'system', '::1', '2015-03-08 23:47:34', 'yLabs', 'Firefox', 'OUT'),
(7, 'system', '::1', '2015-03-09 11:04:08', 'yLabs', 'Firefox', 'IN'),
(8, 'system', '::1', '2015-03-09 11:26:59', 'yLabs', 'Firefox', 'OUT'),
(9, 'system', '::1', '2015-03-09 12:09:45', 'yLabs', 'Firefox', 'IN'),
(10, 'system', '::1', '2015-03-09 12:13:38', 'yLabs', 'Firefox', 'OUT'),
(11, 'demo', '::1', '2015-03-09 12:13:42', 'yLabs', 'Firefox', 'IN'),
(12, 'demo', '::1', '2015-03-09 12:13:54', 'yLabs', 'Firefox', 'OUT'),
(13, 'system', '::1', '2015-03-12 09:40:52', 'yLabs', 'Firefox', 'IN'),
(14, 'system', '::1', '2015-03-12 11:33:49', 'yLabs', 'Firefox', 'OUT'),
(15, 'demo', '::1', '2015-03-26 13:06:10', 'yLabs', 'Firefox', 'IN'),
(16, 'demo', '::1', '2015-03-26 13:06:27', 'yLabs', 'Firefox', 'OUT'),
(17, 'system', '::1', '2015-03-26 13:06:59', 'yLabs', 'Firefox', 'IN'),
(18, 'system', '::1', '2015-03-26 13:08:00', 'yLabs', 'Firefox', 'OUT'),
(19, 'system', '::1', '2015-03-26 21:13:59', 'yLabs', 'Firefox', 'IN'),
(20, 'system', '::1', '2015-03-26 21:23:12', 'yLabs', 'Firefox', 'OUT'),
(21, 'system', '::1', '2015-03-27 00:58:35', 'yLabs', 'Firefox', 'IN'),
(22, 'system', '::1', '2015-03-27 07:54:00', 'yLabs', 'Firefox', 'OUT'),
(23, 'system', 'fe80::d949:22f:178f:', '2015-03-30 14:55:31', 'SIGMA-N1642W-Y', 'Firefox', 'IN'),
(24, 'system', '::1', '2015-03-30 15:09:28', 'yLabs', 'Firefox', 'IN'),
(25, 'system', 'fe80::d949:22f:178f:', '2015-03-30 16:19:33', 'SIGMA-N1642W-Y', 'Firefox', 'OUT'),
(26, 'system', '::1', '2015-03-30 17:51:10', 'yLabs', 'Firefox', 'OUT'),
(27, 'system', '::1', '2015-03-30 21:31:50', 'yLabs', 'Firefox', 'IN'),
(28, 'system', '::1', '2015-03-30 21:35:32', 'yLabs', 'Firefox', 'OUT'),
(29, 'system', '::1', '2015-04-03 02:05:59', 'yLabs', 'Firefox', 'IN'),
(30, 'system', '::1', '2015-04-04 11:11:01', 'yLabs', 'Firefox', 'OUT'),
(31, 'system', '::1', '2015-04-04 11:27:28', 'yLabs', 'Firefox', 'IN'),
(32, 'system', '::1', '2015-04-04 23:56:41', 'yLabs', 'Firefox', 'OUT'),
(33, 'system', 'fe80::d949:22f:178f:', '2015-04-06 10:00:08', 'SIGMA-N1642W-Y', 'Firefox', 'IN'),
(34, 'system', 'fe80::d949:22f:178f:', '2015-04-06 15:27:52', 'SIGMA-N1642W-Y', 'Firefox', 'OUT'),
(35, 'system', '::1', '2015-04-07 06:44:25', 'yLabs', 'Firefox', 'IN'),
(36, 'system', '::1', '2015-04-07 06:56:54', 'yLabs', 'Firefox', 'OUT'),
(37, 'system', 'fe80::d949:22f:178f:', '2015-04-08 15:03:48', 'SIGMA-N1642W-Y', 'Firefox', 'IN'),
(38, 'system', 'fe80::d949:22f:178f:', '2015-04-08 15:12:45', 'fe80::d949:22f:178f:1372', 'Firefox', 'OUT'),
(39, 'system', '::1', '2015-04-09 17:00:33', 'yLabs', 'Firefox', 'IN'),
(40, 'system', '::1', '2015-04-11 20:20:42', 'yLabs', 'Firefox', 'OUT'),
(41, 'system', '::1', '2015-04-12 19:09:06', 'yLabs', 'Firefox', 'IN'),
(42, 'system', '::1', '2015-04-12 23:31:27', 'yLabs', 'Firefox', 'OUT'),
(43, 'system', '::1', '2015-04-13 07:29:29', 'yLabs', 'Firefox', 'IN'),
(44, 'system', '::1', '2015-04-13 07:45:19', 'yLabs', 'Firefox', 'OUT'),
(45, 'system', '::1', '2015-04-13 07:47:29', 'yLabs', 'Firefox', 'IN'),
(46, 'system', '::1', '2015-04-13 08:06:09', 'yLabs', 'Firefox', 'OUT'),
(47, 'system', '::1', '2015-04-13 12:47:36', 'yLabs', 'Firefox', 'IN'),
(48, 'system', '::1', '2015-04-13 12:48:03', 'yLabs', 'Firefox', 'OUT'),
(49, 'system', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(50, 'system', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(51, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(52, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(53, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(54, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(55, 'demo', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(56, 'demo', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(57, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(58, 'admin', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(59, 'system', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(60, 'system', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(61, 'yuda', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(62, 'demo', '::1', NULL, 'Acer-PC', 'Firefox', 'IN'),
(63, 'demo', '::1', NULL, 'Acer-PC', 'Firefox', 'OUT'),
(64, 'yuda', '::1', NULL, 'Acer-PC', 'Firefox', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_menu`
--

CREATE TABLE IF NOT EXISTS `ypos_menu` (
  `menuID` tinyint(3) NOT NULL AUTO_INCREMENT,
  `menu` varchar(30) NOT NULL,
  `aktif` enum('Y','N') DEFAULT NULL,
  `sort` tinyint(2) NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ypos_menu`
--

INSERT INTO `ypos_menu` (`menuID`, `menu`, `aktif`, `sort`) VALUES
(1, 'Data Master', 'Y', 2),
(2, 'Transaksi', 'Y', 3),
(3, 'Laporan', 'Y', 4),
(5, 'My Account', 'Y', 1),
(6, 'Settings', 'Y', 5),
(7, 'Parameter System', 'Y', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_modul`
--

CREATE TABLE IF NOT EXISTS `ypos_modul` (
  `modulID` tinyint(3) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(30) NOT NULL,
  `modul_folder` varchar(50) DEFAULT NULL,
  `aktif` enum('0','1') DEFAULT NULL,
  `createdBy` varchar(15) NOT NULL,
  `menuID` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`modulID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ypos_modul`
--

INSERT INTO `ypos_modul` (`modulID`, `nama_modul`, `modul_folder`, `aktif`, `createdBy`, `menuID`) VALUES
(1, 'kategori', 'kategori', '1', 'yuda', 1),
(2, 'suplier', 'suplier', '1', 'yuda', 1),
(3, 'barang', 'barang', '1', 'yuda', 1),
(4, 'user', 'user', '1', 'yuda', 1),
(5, 'penjualan', 'trx_penjualan', '1', 'yuda', 2),
(6, 'pembelian', 'trx_pembelian', '1', 'yuda', 2),
(7, 'all reports', 'laporan', '1', 'yuda', 3),
(8, 'profile', 'profile', '1', 'yuda', 5),
(9, 'general', 'settings', '1', 'yuda', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_pembelian`
--

CREATE TABLE IF NOT EXISTS `ypos_pembelian` (
  `kdPembelian` varchar(20) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `total_pembelian` decimal(10,2) NOT NULL,
  `kdsup` smallint(1) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_beli` date NOT NULL,
  `ids` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`kdPembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ypos_pembelian`
--

INSERT INTO `ypos_pembelian` (`kdPembelian`, `no_nota`, `total_pembelian`, `kdsup`, `userID`, `tgl_input`, `tgl_beli`, `ids`) VALUES
('P-NF201604170000001', 'NF-01-000001', '100000.00', 3, 'yuda', '2016-04-17 02:28:01', '2016-04-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_pembeliandtl`
--

CREATE TABLE IF NOT EXISTS `ypos_pembeliandtl` (
  `idDtlPembelian` int(5) NOT NULL AUTO_INCREMENT,
  `kdPembelian` varchar(20) NOT NULL,
  `kd_barang` varchar(5) NOT NULL,
  `qty_beli` smallint(3) NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idDtlPembelian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `ypos_pembeliandtl`
--

INSERT INTO `ypos_pembeliandtl` (`idDtlPembelian`, `kdPembelian`, `kd_barang`, `qty_beli`, `harga_beli`, `total`) VALUES
(1, 'P-HYG201504040000001', 'B0012', 2, '52400.00', '104800.00'),
(2, 'P-HYG201504040000001', 'B0013', 3, '52400.00', '157200.00'),
(3, 'P-HYG201504090000002', 'B0018', 2, '26000.00', '52000.00'),
(4, 'P-HYG201504090000002', 'B0019', 1, '14000.00', '14000.00'),
(5, 'P-HYG201504090000003', 'B0018', 1, '26000.00', '26000.00'),
(6, 'P-HYG201504090000003', 'B0019', 2, '14000.00', '28000.00'),
(7, 'P-HYG201504090000004', 'B0019', 2, '14000.00', '28000.00'),
(8, 'P-HYG201504090000004', 'B0018', 1, '26000.00', '26000.00'),
(9, 'P-HYG201504090000005', 'B0019', 2, '14000.00', '28000.00'),
(10, 'P-HYG201504090000005', 'B0018', 1, '26000.00', '26000.00'),
(11, 'P-HYG201504090000006', 'B0018', 2, '26000.00', '52000.00'),
(12, 'P-HYG201504090000006', 'B0019', 1, '14000.00', '14000.00'),
(13, 'P-NF201604170000001', 'B0002', 1, '100000.00', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_penjualan`
--

CREATE TABLE IF NOT EXISTS `ypos_penjualan` (
  `kd_penjualan` varchar(20) NOT NULL,
  `ids` tinyint(1) unsigned NOT NULL,
  `customer` varchar(25) NOT NULL DEFAULT 'Guest',
  `tgl_input` datetime DEFAULT NULL,
  `tgl_jual` date DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `diskon` decimal(8,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `uang_bayar` decimal(10,2) NOT NULL,
  `uang_kembali` decimal(10,2) NOT NULL,
  `keterangan` text,
  `userID` varchar(15) NOT NULL,
  `date_lastUpdate` datetime DEFAULT NULL,
  `user_lastUpdate` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kd_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ypos_penjualan`
--

INSERT INTO `ypos_penjualan` (`kd_penjualan`, `ids`, `customer`, `tgl_input`, `tgl_jual`, `subtotal`, `diskon`, `grand_total`, `uang_bayar`, `uang_kembali`, `keterangan`, `userID`, `date_lastUpdate`, `user_lastUpdate`) VALUES
('INV-2016041800000001', 1, 'yuda', '2016-04-18 19:32:30', '2016-04-18', '100000.00', '0.00', '0.00', '0.00', '0.00', '', 'yuda', NULL, NULL),
('INV-2016041800000002', 1, '', '2016-04-18 19:40:48', '2016-04-18', '100000.00', '0.00', '0.00', '0.00', '0.00', '', 'yuda', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_penjualandtl`
--

CREATE TABLE IF NOT EXISTS `ypos_penjualandtl` (
  `idDtlPenjualan` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(20) NOT NULL,
  `kd_barang` varchar(5) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `diskon` decimal(10,2) NOT NULL,
  `qty` smallint(3) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `date_lastUpdate` datetime DEFAULT NULL,
  `user_lastUpdate` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idDtlPenjualan`),
  KEY `kd_penjualan` (`kd_penjualan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ypos_penjualandtl`
--

INSERT INTO `ypos_penjualandtl` (`idDtlPenjualan`, `kd_penjualan`, `kd_barang`, `harga_jual`, `diskon`, `qty`, `total_harga`, `userID`, `tgl_input`, `date_lastUpdate`, `user_lastUpdate`) VALUES
(19, 'INV-2016041800000001', 'B0002', '100000.00', '-100000.00', 1, '100000.00', 'yuda', '0000-00-00 00:00:00', '2016-04-18 19:32:30', 'yuda'),
(20, 'INV-2016041800000002', 'B0002', '100000.00', '-100000.00', 1, '100000.00', 'yuda', '0000-00-00 00:00:00', '2016-04-18 19:40:48', 'yuda');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_rptparam`
--

CREATE TABLE IF NOT EXISTS `ypos_rptparam` (
  `idparam` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_report` varchar(50) NOT NULL,
  `report_source` varchar(100) NOT NULL,
  `showDate` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`idparam`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ypos_rptparam`
--

INSERT INTO `ypos_rptparam` (`idparam`, `nama_report`, `report_source`, `showDate`) VALUES
(1, 'Penjualan', 'report/penjualan/rpt_penjualan', 'N'),
(2, 'Pembelian', 'report/pembelian/rpt_pembelian', 'N'),
(3, 'Stok Barang', 'report/stok/rpt_stok', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_settings`
--

CREATE TABLE IF NOT EXISTS `ypos_settings` (
  `ids` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `kdSET` varchar(3) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` text,
  `keckab` varchar(200) DEFAULT NULL,
  `tlp` varchar(20) DEFAULT NULL,
  `url_web` varchar(200) NOT NULL,
  `logo_toko` varchar(100) NOT NULL,
  `last_update` varchar(20) NOT NULL,
  `folder_modul` varchar(20) NOT NULL,
  `limit_page` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`ids`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ypos_settings`
--

INSERT INTO `ypos_settings` (`ids`, `kdSET`, `nama_toko`, `alamat`, `keckab`, `tlp`, `url_web`, `logo_toko`, `last_update`, `folder_modul`, `limit_page`) VALUES
(1, 'NF', 'NF-Market', 'www.remo-xp.com', 'Tegal/ID', '085742971701', 'http://localhost/DONE/yPOS', '', 'admin', 'modul', 15);

-- --------------------------------------------------------

--
-- Table structure for table `ypos_suplier`
--

CREATE TABLE IF NOT EXISTS `ypos_suplier` (
  `kdsup` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `ids` tinyint(1) unsigned NOT NULL,
  `nama_sup` varchar(100) DEFAULT NULL,
  `tlp` varchar(20) NOT NULL,
  `alamat` text,
  `date_create` date DEFAULT NULL,
  PRIMARY KEY (`kdsup`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ypos_suplier`
--

INSERT INTO `ypos_suplier` (`kdsup`, `ids`, `nama_sup`, `tlp`, `alamat`, `date_create`) VALUES
(3, 1, 'Adidas', '-', 'Bandung', '2015-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_users`
--

CREATE TABLE IF NOT EXISTS `ypos_users` (
  `username` varchar(15) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `pass` varchar(35) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `sessionID` varchar(100) NOT NULL DEFAULT '0',
  `online` enum('Y','N') NOT NULL DEFAULT 'N',
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `level` tinyint(2) NOT NULL,
  `ids` tinyint(1) unsigned NOT NULL,
  `last_seen` datetime NOT NULL,
  PRIMARY KEY (`username`),
  KEY `ypos_users_ibfk_1` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ypos_users`
--

INSERT INTO `ypos_users` (`username`, `nama_lengkap`, `pass`, `hp`, `sessionID`, `online`, `aktif`, `level`, `ids`, `last_seen`) VALUES
('demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '123123123', '', 'N', 'Y', 2, 1, '2016-04-18 19:19:58'),
('yuda', 'yuda', '54b53072540eeeb8f8e9343e71f28176', '081311000512', 'vqlavi037aptark9u7fcdh66k6', 'Y', 'Y', 1, 1, '2016-04-18 19:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_vpembeliandtl`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dbypos`.`ypos_vpembeliandtl` AS select `a`.`kdbarang` AS `kdbarang`,`a`.`nama_barang` AS `nama_barang`,`a`.`harga_beli` AS `harga_pokok_beli`,`a`.`harga_jual` AS `harga_pokok_jual`,`dbypos`.`ypos_suplier`.`kdsup` AS `kdsup`,`dbypos`.`ypos_suplier`.`nama_sup` AS `nama_sup`,`b`.`no_nota` AS `no_nota`,`b`.`total_pembelian` AS `total_pembelian`,`b`.`userID` AS `userID`,`b`.`tgl_beli` AS `tgl_beli`,`c`.`idDtlPembelian` AS `idDtlPembelian`,`c`.`kdPembelian` AS `kdPembelian`,`c`.`qty_beli` AS `qty_beli`,`c`.`harga_beli` AS `harga_beli_satBaru`,`c`.`total` AS `total_beli` from (((`dbypos`.`ypos_barang` `a` join `dbypos`.`ypos_suplier`) join `dbypos`.`ypos_pembelian` `b`) join `dbypos`.`ypos_pembeliandtl` `c`) where ((`a`.`kdbarang` = `c`.`kd_barang`) and (`b`.`kdsup` = `dbypos`.`ypos_suplier`.`kdsup`) and (`b`.`kdPembelian` = `c`.`kdPembelian`));

--
-- Dumping data for table `ypos_vpembeliandtl`
--

INSERT INTO `ypos_vpembeliandtl` (`kdbarang`, `nama_barang`, `harga_pokok_beli`, `harga_pokok_jual`, `kdsup`, `nama_sup`, `no_nota`, `total_pembelian`, `userID`, `tgl_beli`, `idDtlPembelian`, `kdPembelian`, `qty_beli`, `harga_beli_satBaru`, `total_beli`) VALUES
('B0002', 'Sepatu', '80000.00', '100000.00', 3, 'Adidas', 'NF-01-000001', '100000.00', 'yuda', '2016-04-17', 13, 'P-NF201604170000001', 1, '100000.00', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `ypos_vpenjualandtl`
--

CREATE TABLE IF NOT EXISTS `ypos_vpenjualandtl` (
  `kdbarang` varchar(5) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jualstd` decimal(10,2) DEFAULT NULL,
  `idDtlPen` int(8) unsigned DEFAULT NULL,
  `kd_penjualan` varchar(20) DEFAULT NULL,
  `th_beli` decimal(37,2) DEFAULT NULL,
  `harga_jualreal` decimal(10,2) DEFAULT NULL,
  `qty` smallint(3) DEFAULT NULL,
  `diskon_produk` decimal(33,2) DEFAULT NULL,
  `pendapatan` decimal(39,2) DEFAULT NULL,
  `th_jual` decimal(10,2) DEFAULT NULL,
  `customer` varchar(25) DEFAULT NULL,
  `tgl_jual` date DEFAULT NULL,
  `diskon_final` decimal(8,2) DEFAULT NULL,
  `userID` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ypos_vpenjualandtl`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
