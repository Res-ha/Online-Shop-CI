/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.28-MariaDB : Database - db_olshop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_olshop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_olshop`;

/*Table structure for table `tbl_barang` */

DROP TABLE IF EXISTS `tbl_barang`;

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `berat` int(11) NOT NULL,
  `ketersediaan` enum('habis','tersedia') DEFAULT 'tersedia',
  `kode_barang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_barang` */

insert  into `tbl_barang`(`id_barang`,`nama_barang`,`id_kategori`,`harga`,`deskripsi`,`gambar`,`berat`,`ketersediaan`,`kode_barang`) values 
(9,'Serum',15,87000,'-','WhatsApp_Image_2024-05-12_at_22_14_53.jpeg',150,'tersedia',NULL),
(11,'Toner & Micellar Water',14,90000,'Yang diperkaya dengan kandungan Ekstrak Centella Asiatica dan Vitamin E berfungsi untuk:\r\n1.	Mengangkat kotoran dan Make Up secara maksimal\r\n2.	Mencerahkan dan melembabkan wajah\r\n3.	Meredakan iritasi dan kemerahan pada wajah\r\n4.	Sebagai Anti-Aging membuat wajah kenyal & Kencang\r\n5.	Menutrisi wajah dan sebagai Anti-Bakteri\r\n6.	Menghaluskan dan melembutkan wajah\r\n7.	Membuat wajah menjadi sehat dan nampak glowing','WhatsApp_Image_2024-05-12_at_22_14_20.jpeg',250,'tersedia',NULL),
(16,'Facial Wash',14,85000,'Yang diperkaya dengan kandungan Niacinamide, Ekstrak daun Centella Asiatica, dan Vitamin E berfungsi untuk:\r\n1.	Membersihkan wajah dari kotoran sel-sel kulit mati\r\n2.	Menjaga kelembapan Kulit Wajah\r\n3.	Mencerahkan Kulit dengan maksimal\r\n4.	Menutrisi kulit dengan maksimal\r\n5.	Sebagai Anti-Aging membuat wajah kencal & kencang\r\n6.	Sebagai Anti-Bakteri dan Inflamasi\r\n7.	Menghaluskan dan melembutkan wajah','WhatsApp_Image_2024-05-12_at_22_13_35.jpeg',90,'tersedia',NULL),
(17,'Night Cream',14,85000,'123','WhatsApp_Image_2024-05-12_at_22_13_03.jpeg',90,'tersedia',NULL),
(18,'Rebiome',15,100000,'-','WhatsApp_Image_2024-05-12_at_22_15_34.jpeg',50,'tersedia','BR-5'),
(19,'Sheet Mask',14,25000,'-','WhatsApp_Image_2024-05-12_at_22_16_14.jpeg',25,'tersedia','BR-4'),
(20,'Hydrating Toner',14,96000,'-','WhatsApp_Image_2024-05-12_at_22_16_44_(1).jpeg',350,'tersedia','BR-3'),
(21,'Facial Foam',14,96000,'-','WhatsApp_Image_2024-05-12_at_22_17_03.jpeg',350,'tersedia','BR-2'),
(22,'lipstik',17,90000,'','Screenshot_73.png',10,'tersedia','BR-1');

/*Table structure for table `tbl_gambar` */

DROP TABLE IF EXISTS `tbl_gambar`;

CREATE TABLE `tbl_gambar` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id_gambar`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_gambar` */

insert  into `tbl_gambar`(`id_gambar`,`id_barang`,`ket`,`gambar`) values 
(26,12,'Gambar 2','1488a5310ccfa3d1c64ca447b94ea72b.jpg'),
(27,12,'Gambar 3','9aa26a7c318f842481877e2bbb47aac8.jpg'),
(30,16,'12345678','geografi.jfif'),
(31,21,'-','WhatsApp_Image_2024-05-12_at_22_16_44_(1).jpeg'),
(32,22,'','Screenshot_74.png');

/*Table structure for table `tbl_kategori` */

DROP TABLE IF EXISTS `tbl_kategori`;

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_kategori` */

insert  into `tbl_kategori`(`id_kategori`,`nama_kategori`) values 
(14,'Skincare Wanita'),
(15,'Skincare Pria'),
(17,'kosmetik');

/*Table structure for table `tbl_pelanggan` */

DROP TABLE IF EXISTS `tbl_pelanggan`;

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `kode_pelanggan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_pelanggan` */

insert  into `tbl_pelanggan`(`id_pelanggan`,`nama_pelanggan`,`email`,`password`,`bank`,`no_rek`,`provinsi`,`kota`,`alamat`,`kode_pos`,`no_hp`,`kode_pelanggan`) values 
(2,'Maman','maman@gmail.com','1234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,'jbing','jbing@gmail.com','widia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,'Budi','budi@gmail.com','1234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,'Badu','badu@gmail.com','1234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,'Samuel','samueltbl@gmail.com','123456','BCA','8600764351','Kalimantan Tengah','Palangka Raya','Jl. Haruan No. 10B','73112','0878119140',NULL),
(7,'123456','12345@gmail.com','123456','BCA','8600764351','kALNTEG','Palangka Raya','Jl. Ranying Suring No. 2','73112','087811914076',NULL),
(8,'1234','Niko123@gmail.com','Niko123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_rekening` */

DROP TABLE IF EXISTS `tbl_rekening`;

CREATE TABLE `tbl_rekening` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_rekening`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_rekening` */

insert  into `tbl_rekening`(`id_rekening`,`nama_bank`,`no_rek`,`atas_nama`) values 
(1,'BRI','5434-4382-3434-4345','Nicholas'),
(2,'BNI','8600-7643-3250','Samuel');

/*Table structure for table `tbl_rinci_transaksi` */

DROP TABLE IF EXISTS `tbl_rinci_transaksi`;

CREATE TABLE `tbl_rinci_transaksi` (
  `id_rinci` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(25) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rinci`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_rinci_transaksi` */

insert  into `tbl_rinci_transaksi`(`id_rinci`,`no_order`,`id_barang`,`qty`,`nama_barang`) values 
(88,'202405165267996A',21,1,'Facial Foam'),
(87,'202405164EDA9A83',16,2,'Facial Wash'),
(86,'20240516A65C459F',16,1,'Facial Wash'),
(85,'202405155A261C49',20,5,'Hydrating Toner'),
(84,'202405155A261C49',21,1,'Facial Foam'),
(83,'202405138EDA5DF9',19,1,'Sheet Mask'),
(82,'202405138EDA5DF9',20,1,'Hydrating Toner'),
(80,'202405133BDDD6E9',19,1,'Sheet Mask'),
(81,'202405138EDA5DF9',21,1,'Facial Foam'),
(79,'202405133BDDD6E9',20,1,'Hydrating Toner'),
(77,'20240512F3D3F9C3',19,1,'Sheet Mask'),
(78,'202405133BDDD6E9',21,1,'Facial Foam'),
(75,'20240512F3D3F9C3',21,1,'Facial Foam'),
(76,'20240512F3D3F9C3',20,1,'Hydrating Toner');

/*Table structure for table `tbl_setting` */

DROP TABLE IF EXISTS `tbl_setting`;

CREATE TABLE `tbl_setting` (
  `id` int(1) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telpon` varchar(15) DEFAULT NULL,
  `provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_setting` */

insert  into `tbl_setting`(`id`,`nama_toko`,`kabupaten`,`alamat_toko`,`no_telpon`,`provinsi`,`id_kabupaten`) values 
(1,'Pawon Wighi','Tarakan','Gang Damai','085156563147123',16,467);

/*Table structure for table `tbl_transaksi` */

DROP TABLE IF EXISTS `tbl_transaksi`;

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(25) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(25) DEFAULT NULL,
  `hp_penerima` varchar(20) DEFAULT NULL,
  `provinsi` varchar(25) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(8) DEFAULT NULL,
  `expedisi` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_transaksi` */

insert  into `tbl_transaksi`(`id_transaksi`,`id_pelanggan`,`no_order`,`tgl_order`,`nama_penerima`,`hp_penerima`,`provinsi`,`kota`,`alamat`,`kode_pos`,`expedisi`,`paket`,`estimasi`,`ongkir`,`berat`,`grand_total`,`total_bayar`,`status_bayar`,`bukti_bayar`,`atas_nama`,`nama_bank`,`no_rek`,`status_order`,`no_resi`) values 
(73,6,'20240516A65C459F','2024-05-16','NIcholas','081350701892','14','326','Jl. Ranying Suring No. 2','73111','JNE','67000','1-2 Hari',67000,90,85000,152000,1,'1715827529_35301a5c02a2c09529d8.png','Samuel','BCA','8600764351',3,'09809809i'),
(74,6,'202405164EDA9A83','2024-05-16','NIcholas','081350701892','14','326','Jl. Ranying Suring No. 2','73111','JNE','57000','',0,180,170000,0,1,'1715827862_b74ad02c7676db2de64e.png','Samuel','BCA','8600764351',3,'JNE2023912390'),
(75,6,'202405165267996A','2024-05-16','NIcholas','081350701892','14','326','Jl. Ranying Suring No. 2','73111','JNE','57000','',0,350,96000,0,1,'1715828316_f3f03e7bbeac53f820ca.png','Samuel','BCA','8600764351',0,NULL),
(72,7,'202405155A261C49','2024-05-15','Samuel','081223419878','14','167','JL. HARUAN NO. 10B','73112','JNE','68000','3-4 Hari',68000,2100,576000,644000,1,'1715781776_d7c583eca9bef644129a.png','Samuel','BCA','8600764351',3,'JNE2023912390'),
(71,6,'202405138EDA5DF9','2024-05-13','Samuel','081223419878','12','195','JL. HARUAN NO. 10B','73112','JNE','93000','2-3 Hari',93000,725,217000,310000,1,'1715828034_3a1cc44e5020f65a04dd.png','Samuel','BCA','8600764351',3,'JNE2023912390'),
(70,6,'202405133BDDD6E9','2024-05-13','Samuel','081223419878','14','326','JL. HARUAN NO. 10B','73112','JNE','67000','1-2 Hari',67000,725,217000,284000,1,'1715566019_afe44a530dadc0a29c85.jpeg','Samuel','BCA','8600764351',3,'JNE2023912390');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`nama_user`,`username`,`password`) values 
(1,'Nicholas','admin','admin'),
(2,'admin','admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
