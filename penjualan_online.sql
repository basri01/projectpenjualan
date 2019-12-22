-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2019 at 02:45 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `penjualan_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `kode_bank` varchar(15) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`kode_bank`, `nama_bank`) VALUES
('BNK001', 'BRI'),
('BNK002', 'Mandiri'),
('BNK003', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `gambar` text NOT NULL,
  `jumlah_barang` varchar(15) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `nama_supplier` varchar(150) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`, `gambar`, `jumlah_barang`, `harga`, `nama_supplier`, `tgl_kadaluarsa`) VALUES
('BRG1900005', 'Color Correcting Palette', '11530558-3604512504464811.jpg', '15', '180000', 'NYX', '2019-11-30'),
('BRG1900006', 'Metallic Glitter', 'metallicglitter_main.jpg', '15', '90000', 'NYX', '2019-12-27'),
('BRG1900021', 'Liquid Lip Color Lipstick Red Babydoll', 'Make Over Liquid Lip Color Lipstick - Red Babydoll.jpg', '15', '90000', 'MakeOver ', '0000-00-00'),
('BRG1900003', 'Multifix Matte Blusher L1', 'MAKE_OVER_Riche_Glow_Face_Highlighter_L_1.jpg', '15', '80000', 'MakeOver ', '0000-00-00'),
('BRG1900001', 'Highlight & Contour Palette L1', 'Make_Over_Highlight_and_Contout_Palette_L_1.jpg', '23', '40000', 'MakeOver', '2019-11-30'),
('BRG1900002', ' Multifix Matte Blusher L1', 'MAKE_OVER_Riche_Glow_Face_Highlighter_L_1.jpg', '15', '60000', 'MakeOver', '2020-01-11'),
('BRG1900007', 'Rouge Cream Blush L1', 'NYX_Cosmetics_Rouge_Cream_Blush_L_1.jpg', '15', '16000', 'NYX ', '0000-00-00'),
('BRG1900008', ' SuperStay Matte Ink Liquid Lipstick Lover', 'Maybelline NY Superstay Matte Ink.jpg', '15', '80000', 'Maybelline', '0000-00-00'),
('BRG1900009', 'Super Cushion Ultra Cover Cushion', '45270487_53b57dbf-f91e-4196-86e1-b47bdfaab539_700_700.jpg', '15', '75000', 'Maybelline ', '0000-00-00'),
('BRG1900010', 'The Hype Volumizing Mascara', '800897140250_worththehypevolumizingmascara_main.jpg', '15', '65000', 'NYX ', '0000-00-00'),
('BRG1900011', ' Concealer Wand', 'concealerwand_main.jpg', '15', '90000', 'NYX', '0000-00-00'),
('BRG1900012', 'Hypercurl Mascara Waterproof', 'Maybelline NY Hypercurl Mascara Waterproof.jpg', '15', '70000', 'Maybelline', '0000-00-00'),
('BRG1900017', ' Fashion Brow Duo Shaper', 'MB Fashion Brow Duo Shaper.jpg', '15', '65000', 'Maybelline', '0000-00-00'),
('BRG1900014', 'Eyebrow Brown to Earth', 'MK Eyebrow brown to earth.jpeg', '15', '60000', 'MakeOver', '0000-00-00'),
('BRG1900015', 'Ultimate Lash Mascara', 'MK Ultimate Lash Mascara.jpg', '15', '80000', 'MakeOver', '0000-00-00'),
('BRG1900016', 'Soft Matte Lip Cream', 'soft matte lip cream.jpg', '15', '85000', 'NYX', '0000-00-00'),
('BRG1900018', 'Wonder Stick', 'wonder stick.jpg', '15', '60000', 'NYX', '0000-00-00'),
('BRG1900019', 'Kit Correcteur Teint Color Correcting Concealer', 'original.jpeg', '15', '85000', 'Maybelline', '0000-00-00'),
('BRG1900020', 'Powerstay Demi Matte Cover Cushion', 'MAKE_OVER_Powerstay_Demi_Matte_Cover_Cushion_L_1.jpg', '15', '200000', 'MakeOver', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `tbl_barang_masuk` (
  `kode_bm` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_bm` varchar(15) NOT NULL,
  `harga_beli` varchar(15) NOT NULL,
  `total` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_bm`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE IF NOT EXISTS `tbl_kecamatan` (
  `id_kecamatan` int(15) NOT NULL AUTO_INCREMENT,
  `kode_kecamatan` varchar(50) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `kode_kecamatan`, `nama_kecamatan`) VALUES
(1, 'br01', 'Biringkanayya'),
(2, 'bt02', 'Bontoala'),
(3, 'mk03', 'Makassar'),
(4, 'mm04', 'Mamajang'),
(5, 'mg05', 'Manggala'),
(6, 'mr06', 'Mariso'),
(7, 'pk07', 'Panakukkang'),
(8, 'rp08', 'Rappocini'),
(9, 'tl09', 'Tallo'),
(10, 'tm010', 'Tamalanrea'),
(11, 'ta011', 'Tamalate'),
(12, 'up012', 'Ujung Pandang'),
(13, 'ut013', 'Ujung Tanah'),
(14, 'wj014', 'Wajo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelurahan`
--

CREATE TABLE IF NOT EXISTS `tbl_kelurahan` (
  `id_kelurahan` int(15) NOT NULL AUTO_INCREMENT,
  `kode_kelurahan` varchar(15) NOT NULL,
  `nama_kelurahan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelurahan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `tbl_kelurahan`
--

INSERT INTO `tbl_kelurahan` (`id_kelurahan`, `kode_kelurahan`, `nama_kelurahan`) VALUES
(1, 'bl01', 'Bulurokeng'),
(2, 'dya01', 'Daya'),
(3, 'pcc01', 'Paccerakkang'),
(4, 'sda01', 'Sudiang'),
(5, 'sry01', 'Sudiang Raya'),
(6, 'uti01', 'Untia'),
(7, 'br02', 'Baraya'),
(8, 'btl02', 'Bontoala'),
(9, 'bp02', 'Bontoala Parang'),
(10, 'bt02', 'Bontoala Tua'),
(11, 'be02', 'Bunga Ejaya'),
(16, 'gdd02', 'Gaddong'),
(21, 'tmpb02', 'Tompo Balang'),
(22, 'wjb02', 'Wajo Baru'),
(23, 'bbr03', 'Bara Baraya'),
(24, 'bbs03', 'Bara Baraya Selatan'),
(25, 'bbm03', 'Bara Baraya Timur'),
(26, 'bbu03', 'Bara Baraya Utara'),
(27, 'bra03', 'Barana'),
(28, 'lba03', 'Lariang Bangi'),
(29, 'mcci03', 'Maccini');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
  `kode_member` varchar(15) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(350) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  PRIMARY KEY (`kode_member`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`kode_member`, `no_ktp`, `nama`, `jenis_kelamin`, `alamat`, `kode_pos`, `username`, `password`, `no_hp`) VALUES
('M0001', '12345678910', 'Amanda Nicole', 'Wanita', 'Jalan Bagus No. 11', '90222', 'Member', 'aa08769cdcb26674c6706093503ff0a3', '085298519898');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_member` varchar(15) NOT NULL,
  `kode_kecamatan` varchar(15) NOT NULL,
  `kode_kelurahan` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `kodepos` varchar(5) NOT NULL,
  `kode_bank` varchar(15) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `total_pembayaran` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`kode_transaksi`, `tanggal`, `kode_member`, `kode_kecamatan`, `kode_kelurahan`, `alamat`, `no_tlp`, `kodepos`, `kode_bank`, `norek`, `total_pembayaran`) VALUES
('T0001', '2019-10-03', 'M0001', 'mk03', 'bbr03', 'Jalan A', '4325', '3', 'BNK001', '12345678', '250000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi_detail` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_member` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` varchar(15) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `status` enum('Bayar','Belum') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`id`, `kode_transaksi`, `kode_member`, `kode_barang`, `jumlah`, `harga`, `tanggal_beli`, `status`) VALUES
(329, 'T0001', 'M0001', 'BRG1900001', '8', '30000', '2019-10-03', 'Bayar'),
(332, 'T0002', 'M0001', 'BRG1900001', '1', '75000', '2019-11-22', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `kode_user` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `status` enum('Admin','Kasir') NOT NULL,
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`kode_user`, `nama`, `username`, `password`, `status`) VALUES
(' ', 'Admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
