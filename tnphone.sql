-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tnphone
CREATE DATABASE IF NOT EXISTS `tnphone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `tnphone`;

-- Dumping structure for table tnphone.chitietdathang
CREATE TABLE IF NOT EXISTS `chitietdathang` (
  `sp_ma` int(11) NOT NULL,
  `dh_ma` int(11) NOT NULL,
  `ctdh_soluong` int(11) NOT NULL,
  `ctdh_gia` decimal(10,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sp_ma`,`dh_ma`),
  KEY `FK_chitietdathang_donhang` (`dh_ma`),
  CONSTRAINT `FK_chitietdathang_donhang` FOREIGN KEY (`dh_ma`) REFERENCES `donhang` (`dh_ma`),
  CONSTRAINT `FK_chitietdathang_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.donhang
CREATE TABLE IF NOT EXISTS `donhang` (
  `dh_ma` int(11) NOT NULL AUTO_INCREMENT,
  `dh_ngaylap` datetime NOT NULL DEFAULT current_timestamp(),
  `dh_trangthai` tinyint(4) NOT NULL DEFAULT 0,
  `dh_noigiao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `httt_ma` int(11) NOT NULL,
  `kh_tendangnhap` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`dh_ma`),
  KEY `FK_donhang_khachhang` (`kh_tendangnhap`),
  KEY `FK_donhang_hinhthucthanhtoan` (`httt_ma`),
  CONSTRAINT `FK_donhang_hinhthucthanhtoan` FOREIGN KEY (`httt_ma`) REFERENCES `hinhthucthanhtoan` (`httt_ma`),
  CONSTRAINT `FK_donhang_khachhang` FOREIGN KEY (`kh_tendangnhap`) REFERENCES `khachhang` (`kh_tendangnhap`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.hinhsanpham
CREATE TABLE IF NOT EXISTS `hinhsanpham` (
  `hsp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `hsp_tentaptin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_ma` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`hsp_ma`),
  KEY `FK_hinhsanpham_sanpham` (`sp_ma`),
  CONSTRAINT `FK_hinhsanpham_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.hinhthucthanhtoan
CREATE TABLE IF NOT EXISTS `hinhthucthanhtoan` (
  `httt_ma` int(11) NOT NULL AUTO_INCREMENT,
  `httt_ten` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`httt_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.khachhang
CREATE TABLE IF NOT EXISTS `khachhang` (
  `kh_tendangnhap` varchar(50) NOT NULL DEFAULT '',
  `kh_hoten` varchar(100) NOT NULL DEFAULT '',
  `kh_matkhau` varchar(255) NOT NULL DEFAULT '',
  `kh_diachi` varchar(255) DEFAULT '',
  `kh_sdt` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`kh_tendangnhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `km_ma` int(11) NOT NULL AUTO_INCREMENT,
  `km_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `km_noidung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `km_discount` float NOT NULL DEFAULT 0,
  `km_batdau` date NOT NULL,
  `km_ketthuc` date NOT NULL,
  PRIMARY KEY (`km_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.lienhe
CREATE TABLE IF NOT EXISTS `lienhe` (
  `lh_ma` int(11) NOT NULL AUTO_INCREMENT,
  `lh_tieude` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `lh_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lh_noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lh_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.nhasanxuat
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `nsx_ma` int(11) NOT NULL AUTO_INCREMENT,
  `nsx_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`nsx_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table tnphone.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `sp_ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sp_gia` decimal(10,0) NOT NULL DEFAULT 0,
  `sp_giacu` decimal(10,0) NOT NULL DEFAULT 0,
  `sp_soluong` int(11) NOT NULL DEFAULT 0,
  `sp_mota` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_ngaycapnhat` datetime NOT NULL DEFAULT current_timestamp(),
  `sp_hinhdaidien` varchar(100) DEFAULT NULL,
  `nsx_ma` int(11) NOT NULL,
  `km_ma` int(11) DEFAULT NULL,
  PRIMARY KEY (`sp_ma`),
  KEY `FK_sanpham_nhasanxuat` (`nsx_ma`),
  KEY `FK_sanpham_khuyenmai` (`km_ma`),
  CONSTRAINT `FK_sanpham_khuyenmai` FOREIGN KEY (`km_ma`) REFERENCES `khuyenmai` (`km_ma`),
  CONSTRAINT `FK_sanpham_nhasanxuat` FOREIGN KEY (`nsx_ma`) REFERENCES `nhasanxuat` (`nsx_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
