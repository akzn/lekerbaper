/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.1.38-MariaDB : Database - lekerbaper
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_detail_order` */

DROP TABLE IF EXISTS `tb_detail_order`;

CREATE TABLE `tb_detail_order` (
  `kd_detail` varchar(7) NOT NULL,
  `order_kd` varchar(7) NOT NULL,
  `user_kd` varchar(7) NOT NULL,
  `menu_kd` varchar(7) NOT NULL,
  `transaksi_kd` varchar(7) NOT NULL,
  `total` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status_keterangan` enum('T','S','N') DEFAULT NULL,
  `balasan_keterangan` text NOT NULL,
  `status_detail` enum('pending','dimasak','siap','diambil') DEFAULT 'pending',
  PRIMARY KEY (`kd_detail`),
  KEY `order_kd` (`order_kd`),
  KEY `menu_kd` (`menu_kd`),
  KEY `transaksi_kd` (`transaksi_kd`),
  KEY `user_kd` (`user_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_order` */

insert  into `tb_detail_order`(`kd_detail`,`order_kd`,`user_kd`,`menu_kd`,`transaksi_kd`,`total`,`sub_total`,`keterangan`,`status_keterangan`,`balasan_keterangan`,`status_detail`) values 
('DM001','TR001','US012','MN005','TA001',1,20000,'','S','','pending'),
('DM002','TR001','US012','MN008','TA001',2,20000,'','S','','pending'),
('DM003','TR005','US016','MN015','TA002',2,10000,'','','','diambil'),
('DM004','','','MN015','',2,10000,'','','','pending'),
('DM005','TR006','US017','MN011','TA003',2,10000,'','','','pending'),
('DM006','TR007','US018','MN001','TA004',2,60000,'','','','dimasak'),
('DM007','','','MN001','',1,30000,'','','','pending'),
('DM008','TR011','US022','MN001','TA005',1,30000,'','','','pending'),
('DM009','','','MN001','',1,30000,'','','',''),
('DM010','','','','',0,0,'','','','pending'),
('DM011','TR038','','','',0,0,'','','',''),
('DM012','TR039','','','',0,0,'','','',''),
('DM013','TR040','','MN001','',1,30000,'','','',''),
('DM014','TR041','','MN001','',1,30000,'','','',''),
('DM015','TR042','','MN001','',1,30000,'','','',''),
('DM016','TR043','','MN004','TA008',1,15000,'','','',''),
('DM017','TR044','','MN011','TA009',1,5000,'','','',''),
('DM018','TR045','','MN011','TA006',1,5000,'','','',''),
('DM019','TR046','','MN001','TA006',1,30000,'','','','siap'),
('DM020','TR046','','MN010','TA006',1,20000,'','','','diambil'),
('DM021','TR047','','MN001','TA007',2,60000,'','','','diambil'),
('DM022','TR047','','MN007','TA007',1,10000,'','','',''),
('DM023','TR048','','MN011','',1,5000,'','','',''),
('DM024','TR048','','MN010','',1,20000,'','','',''),
('DM025','TR049','','MN010','',1,20000,'','','',''),
('DM026','TR049','','MN007','',1,10000,'','','',''),
('DM027','TR050','','MN016','',1,19000,'','','',''),
('DM028','TR050','','MN015','',1,5000,'','','',''),
('DM031','TR051','','MN001','',5,150000,'','','','dimasak'),
('DM032','TR051','','MN002','',2,50000,'','','',''),
('DM033','TR052','','MN001','TA010',1,30000,'','','',''),
('DM034','TR053','','MN001','TA011',2,60000,'','','','');

/*Table structure for table `tb_detail_order_temporary` */

DROP TABLE IF EXISTS `tb_detail_order_temporary`;

CREATE TABLE `tb_detail_order_temporary` (
  `kd_detail` varchar(7) NOT NULL,
  `order_kd` varchar(7) NOT NULL,
  `user_kd` varchar(7) NOT NULL,
  `menu_kd` varchar(7) NOT NULL,
  `transaksi_kd` varchar(7) NOT NULL,
  `total` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status_keterangan` enum('T','S','N') DEFAULT NULL,
  `balasan_keterangan` text NOT NULL,
  `status_detail` enum('pending','dimasak','siap','diambil') DEFAULT NULL,
  PRIMARY KEY (`kd_detail`),
  KEY `order_kd` (`order_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_order_temporary` */

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `kd_kategori` varchar(7) NOT NULL,
  `name_kategori` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`kd_kategori`,`name_kategori`,`description`,`photo`) values 
('KT001','Ayam','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','155434461764.png'),
('KT002','Nasi','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','1554344643755.jpg'),
('KT003','Sayuran','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','1554344669506.jpg'),
('KT004','Coffe and Soft Drink','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','1554344693692.jpg'),
('KT005','Juice','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','1554344709288.jpg'),
('KT006','Sup &amp; Soto','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','1554344447964.jpg'),
('KT007','Drink','Minuman','1595415557344.jpg'),
('KT008','mie','mimian','1596002337485.jpg'),
('KT009','Leker Manis','Leker Manis','1598506421463.jpg');

/*Table structure for table `tb_level` */

DROP TABLE IF EXISTS `tb_level`;

CREATE TABLE `tb_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_level` */

insert  into `tb_level`(`id`,`name`) values 
(1,'Admin'),
(2,'Waiter'),
(3,'Kasir'),
(4,'Owner'),
(6,'Koki');

/*Table structure for table `tb_meja` */

DROP TABLE IF EXISTS `tb_meja`;

CREATE TABLE `tb_meja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_meja` int(3) NOT NULL,
  `user_kd` varchar(7) NOT NULL,
  `status` enum('active','non-active') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `tb_meja` */

insert  into `tb_meja`(`id`,`no_meja`,`user_kd`,`status`) values 
(1,1,'US013','active'),
(2,2,'US014','active'),
(3,3,'US015','active'),
(4,4,'US015','active'),
(5,5,'US015','active'),
(6,6,'US017','active'),
(7,7,'US017','active'),
(8,8,'US019','active'),
(9,9,'US019','active'),
(10,10,'US019','active'),
(11,11,'US019','active'),
(12,12,'','active'),
(13,13,'US020','active'),
(14,14,'US020','active'),
(15,15,'US020','active'),
(16,16,'US020','active'),
(17,17,'US021','active'),
(18,18,'US022','active'),
(19,19,'US022','active'),
(20,20,'US022','active'),
(21,21,'US022','active'),
(22,22,'','active'),
(23,23,'US023','active'),
(24,24,'US023','active'),
(25,25,'US023','active'),
(26,26,'US023','active'),
(27,27,'','active'),
(28,28,'','active'),
(29,29,'','active'),
(30,30,'','non-active'),
(31,31,'','non-active'),
(32,32,'','non-active'),
(33,33,'','non-active'),
(34,34,'','non-active'),
(35,35,'','non-active'),
(36,36,'','non-active'),
(37,37,'','non-active'),
(38,38,'','non-active'),
(39,39,'','non-active'),
(40,40,'','non-active'),
(41,41,'','non-active'),
(42,42,'','non-active'),
(43,43,'','non-active'),
(44,44,'','non-active'),
(45,45,'','non-active'),
(46,46,'','non-active'),
(47,47,'','non-active'),
(48,48,'','non-active'),
(49,49,'','non-active'),
(50,50,'','non-active'),
(53,51,'','non-active'),
(54,52,'','non-active'),
(55,53,'','non-active'),
(56,54,'','non-active'),
(57,55,'','non-active');

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `kd_menu` varchar(7) NOT NULL,
  `name_menu` varchar(50) NOT NULL,
  `kategori_id` varchar(7) NOT NULL,
  `harga` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_menu`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`kd_menu`,`name_menu`,`kategori_id`,`harga`,`description`,`status`,`photo`) values 
('MN001','Ayam Serundeng','KT001',30000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350315287.jpg'),
('MN002','Ayam geprek','KT001',25000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350448179.jpg'),
('MN003','Opor Ayam','KT001',30000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350471862.jpg'),
('MN004','Nasi Kuning','KT002',15000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350514500.jpg'),
('MN005','Nasi Pecel','KT002',20000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350547631.jpg'),
('MN006','Nasi Goreng Ayam','KT002',15000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350588507.jpg'),
('MN007','Jus Alpukat','KT005',10000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','155435061848.jpg'),
('MN008','Jus Anggur','KT005',10000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350648687.jpg'),
('MN009','Jus Jeruk','KT005',10000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554350665679.jpg'),
('MN010','Sop sapi','KT006',20000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554369912639.jpg'),
('MN011','Es teh manis','KT004',5000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554369938443.jpg'),
('MN012','Jahe','KT004',5000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554369966769.jpg'),
('MN013','Nasi Goreng Telur','KT002',15000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554370011485.jpg'),
('MN014','Jus Tomat','KT005',10000,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua','tersedia','1554370061484.jpg'),
('MN015','Es teh','KT007',5000,'Esteh','tersedia','159541557964.jpg'),
('MN016','Green Tea Pisang','KT009',19000,'Leker manis yang dipadu dengan aroma green tea dan rasa pisang yang unik','tersedia','159850664421.jpg');

/*Table structure for table `tb_order` */

DROP TABLE IF EXISTS `tb_order`;

CREATE TABLE `tb_order` (
  `kd_order` varchar(7) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_user` varchar(50) NOT NULL,
  `user_kd` varchar(7) DEFAULT NULL,
  `keterangan` text,
  `status_order` enum('selesai_pembayaran','belum_bayar','belum_beli') NOT NULL DEFAULT 'belum_beli',
  `tanggal` date NOT NULL,
  `kd_pelanggan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kd_order`),
  KEY `user_kd` (`user_kd`),
  KEY `no_meja` (`no_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_order` */

insert  into `tb_order`(`kd_order`,`no_meja`,`waktu`,`nama_user`,`user_kd`,`keterangan`,`status_order`,`tanggal`,`kd_pelanggan`) values 
('TR001',1,'2019-04-04 15:40:01','Subeki Mahmudin','US012','','selesai_pembayaran','2019-04-04',NULL),
('TR002',1,'2019-04-04 16:21:17','Hira Maulana','US013','','belum_beli','2019-04-04',NULL),
('TR003',2,'2020-07-13 00:14:25','aasda asd ','US014','','belum_bayar','2020-07-12',NULL),
('TR004',5,'2020-07-22 18:08:58','Andika','US015','','belum_bayar','2020-07-22',NULL),
('TR005',6,'2020-07-22 18:15:17','andika1','US016','','selesai_pembayaran','2020-07-22',NULL),
('TR006',8,'2020-07-22 22:53:47','testbug1','US017','','selesai_pembayaran','2020-07-22',NULL),
('TR007',9,'2020-07-22 22:59:06','testbug2','US018','','selesai_pembayaran','2020-07-22',NULL),
('TR008',11,'2020-07-23 00:09:00','dddasd','US019','','belum_beli','2020-07-22',NULL),
('TR009',16,'2020-07-23 00:16:42','testbug3','US020','','belum_beli','2020-07-22',NULL),
('TR010',17,'2020-07-23 00:17:00','testbug4','US021','','belum_beli','2020-07-22',NULL),
('TR011',22,'2020-07-23 00:21:08','33','US022','','selesai_pembayaran','2020-07-22',NULL),
('TR012',26,'2020-07-24 12:59:54','1','US023','','belum_beli','2020-07-24',NULL),
('TR013',1,'2020-07-28 17:26:37','tes','tes','','','2020-07-28',NULL),
('TR014',1,'2020-07-28 17:30:56','tes','tes','','belum_beli','2020-07-28',NULL),
('TR015',1,'2020-07-28 20:43:49','tes','tes','','belum_beli','2020-07-28',NULL),
('TR016',1,'2020-07-28 20:43:53','tes','tes','','belum_beli','2020-07-28',NULL),
('TR017',1,'2020-07-28 20:44:04','tes','tes','','belum_beli','2020-07-28',NULL),
('TR018',1,'2020-07-28 20:46:00','tes','tes','','belum_beli','2020-07-28',NULL),
('TR019',1,'2020-07-28 20:46:57',' asd','tes','','belum_beli','2020-07-28',NULL),
('TR020',1,'2020-07-28 20:48:05','asd','','','belum_beli','2020-07-28',NULL),
('TR021',1,'2020-07-28 20:48:59','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR022',1,'2020-07-28 20:56:13','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR023',1,'2020-07-28 20:56:17','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR024',1,'2020-07-28 20:56:36','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR025',1,'2020-07-28 20:58:38','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR026',1,'2020-07-28 20:59:17','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR027',1,'2020-07-28 21:57:46','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR028',1,'2020-07-28 22:00:47','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR029',1,'2020-07-28 22:01:00','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR030',1,'2020-07-28 22:01:47','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR031',1,'2020-07-28 22:02:24','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR032',1,'2020-07-28 22:02:51','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR033',1,'2020-07-28 22:03:36','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR034',1,'2020-07-28 22:03:44','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR035',1,'2020-07-28 22:07:54','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR036',12,'2020-07-29 02:49:46','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR037',12,'2020-07-29 02:50:24','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR038',12,'2020-07-29 02:51:17','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR039',12,'2020-07-29 02:54:37','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR040',12,'2020-07-29 03:00:04','asd',NULL,'','belum_beli','2020-07-28',NULL),
('TR041',12,'2020-07-29 03:03:23','asd',NULL,'','belum_bayar','2020-07-28',NULL),
('TR042',12,'2020-07-29 04:21:42','asd',NULL,'','belum_bayar','2020-07-28',NULL),
('TR043',12,'2020-07-29 04:23:31','asd',NULL,'','selesai_pembayaran','2020-07-28',NULL),
('TR044',12,'2020-07-29 04:26:46','asd',NULL,'','selesai_pembayaran','2020-07-28',NULL),
('TR045',12,'2020-07-29 04:27:18','asd',NULL,'','selesai_pembayaran','2020-07-28',NULL),
('TR046',22,'2020-07-29 04:58:59','asd',NULL,'','selesai_pembayaran','2020-07-28',NULL),
('TR047',12,'2020-07-29 13:08:57','deni',NULL,'','selesai_pembayaran','2020-07-29',NULL),
('TR048',12,'2020-08-17 10:05:45','Deni',NULL,'','belum_beli','2020-08-17',NULL),
('TR049',12,'2020-08-17 10:10:54','Deni',NULL,'','belum_bayar','2020-08-17',NULL),
('TR050',22,'2020-08-27 12:40:07','Ardian',NULL,'','belum_bayar','2020-08-27',NULL),
('TR051',29,'2020-08-31 13:54:44','Test Plelanggan',NULL,'','belum_bayar','2020-08-31','CU001'),
('TR052',30,'2020-08-31 14:45:03','asd asd',NULL,'','selesai_pembayaran','2020-08-31','CU002'),
('TR053',30,'2020-09-01 01:59:58','test 1',NULL,'','selesai_pembayaran','2020-08-31','');

/*Table structure for table `tb_pelanggan` */

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `kd_pelanggan` varchar(7) NOT NULL,
  `name_pelanggan` varchar(100) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text,
  `email` varchar(50) DEFAULT NULL,
  `aktif` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`kd_pelanggan`,`name_pelanggan`,`no_meja`,`username`,`password`,`email`,`aktif`) values 
('CU001','Test Plelanggan',0,'asdasd','YXNk','asd@a.com',NULL),
('CU002','asd asd',0,'asdaasdasd','YXNk','asd@a.com',NULL);

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `order_kd` varchar(7) NOT NULL,
  `user_kd` varchar(7) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kd_transaksi`),
  KEY `user_kd` (`user_kd`),
  KEY `order_kd` (`order_kd`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`order_kd`) REFERENCES `tb_order` (`kd_order`),
  CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`user_kd`) REFERENCES `tb_user` (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`kd_transaksi`,`order_kd`,`user_kd`,`total_harga`,`tanggal`,`waktu`) values 
('TA001','TR001','US012',40000,'2019-04-04','2019-04-04 15:41:31'),
('TA002','TR005','US016',10000,'2020-07-22','2020-07-22 20:17:42'),
('TA003','TR006','US017',10000,'2020-07-22','2020-07-22 23:04:13'),
('TA004','TR007','US018',60000,'2020-07-22','2020-07-22 23:18:28'),
('TA005','TR011','US022',30000,'2020-07-22','2020-07-23 00:22:27'),
('TA006','TR045','US005',5000,'2020-07-29','2020-07-29 05:30:47'),
('TA007','TR047','US005',70000,'2020-07-29','2020-07-29 13:13:44'),
('TA008','TR043','US005',15000,'2020-07-29','2020-07-29 13:14:26'),
('TA009','TR044','US005',5000,'2020-07-29','2020-07-30 03:42:49'),
('TA010','TR052','US005',30000,'2020-08-31','2020-09-01 01:50:58'),
('TA011','TR053','US005',60000,'2020-08-31','2020-09-01 02:04:37');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `kd_user` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('Admin','Waiter','Kasir','Owner','Pelanggan','Koki') NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`kd_user`,`name`,`email`,`username`,`password`,`level`) values 
('US001','Fajar Subeki','fajarsub06@gmail.com','admin','YWRtaW4xMjM=','Admin'),
('US003','Dodi Mulyadi -ed','dodi@gmail.com','koki','YWRtaW4xMjM=','Koki'),
('US005','Dinda Aulia','dinda@gmail.com','kasir','YWRtaW4xMjM=','Kasir'),
('US007','Putay','putay@gmail.com','waiter','YWRtaW4xMjM=','Waiter'),
('US011','Danu Wijaya','danu@gmail.com','owner','YWRtaW4xMjM=','Owner'),
('US012','Subeki Mahmudin','pelanggan@gmail.com','subeki','YWRtaW4xMjM=','Pelanggan'),
('US013','Hira Maulana','pelanggan@gmail.com','hira maulana','MQ==','Pelanggan'),
('US014','asd','pelanggan@gmail.com','aasda asd ','Mg==','Pelanggan'),
('US015','Andika','pelanggan@gmail.com','andika','NQ==','Pelanggan'),
('US016','andika1','pelanggan@gmail.com','andika1','Ng==','Pelanggan'),
('US017','testbug1','pelanggan@gmail.com','testbug1','OA==','Pelanggan'),
('US018','testbug2','pelanggan@gmail.com','testbug2','OQ==','Pelanggan'),
('US019','dddasd','pelanggan@gmail.com','dddasd','MTE=','Pelanggan'),
('US020','testbug3','pelanggan@gmail.com','testbug3','MTY=','Pelanggan'),
('US021','testbug4','pelanggan@gmail.com','testbug4','MTc=','Pelanggan'),
('US022','33','pelanggan@gmail.com','33','MjI=','Pelanggan'),
('US023','1','pelanggan@gmail.com','1','MjY=','Pelanggan'),
('US024','admin2','a@a.com','admin2','YWRtaW4xMjM=','Admin');

/*Table structure for table `detail_order` */

DROP TABLE IF EXISTS `detail_order`;

/*!50001 DROP VIEW IF EXISTS `detail_order` */;
/*!50001 DROP TABLE IF EXISTS `detail_order` */;

/*!50001 CREATE TABLE  `detail_order`(
 `kd_detail` varchar(7) ,
 `order_kd` varchar(7) ,
 `user_kd` varchar(7) ,
 `menu_kd` varchar(7) ,
 `transaksi_kd` varchar(7) ,
 `total` int(11) ,
 `sub_total` int(11) ,
 `keterangan` text ,
 `status_keterangan` enum('T','S','N') ,
 `balasan_keterangan` text ,
 `status_detail` enum('pending','dimasak','siap','diambil') ,
 `kd_menu` varchar(7) ,
 `name_menu` varchar(50) ,
 `harga` int(11) ,
 `status` enum('tersedia','tidak_tersedia') ,
 `name` varchar(50) ,
 `level` enum('Admin','Waiter','Kasir','Owner','Pelanggan','Koki') ,
 `no_meja` int(11) ,
 `tanggal` date ,
 `nama_user` varchar(50) ,
 `status_order` enum('selesai_pembayaran','belum_bayar','belum_beli') 
)*/;

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

/*!50001 DROP VIEW IF EXISTS `transaksi` */;
/*!50001 DROP TABLE IF EXISTS `transaksi` */;

/*!50001 CREATE TABLE  `transaksi`(
 `kd_transaksi` varchar(7) ,
 `total_harga` int(11) ,
 `waktu` timestamp ,
 `tanggal` date ,
 `name` varchar(50) 
)*/;

/*View structure for view detail_order */

/*!50001 DROP TABLE IF EXISTS `detail_order` */;
/*!50001 DROP VIEW IF EXISTS `detail_order` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_order` AS select `tb_detail_order`.`kd_detail` AS `kd_detail`,`tb_detail_order`.`order_kd` AS `order_kd`,`tb_detail_order`.`user_kd` AS `user_kd`,`tb_detail_order`.`menu_kd` AS `menu_kd`,`tb_detail_order`.`transaksi_kd` AS `transaksi_kd`,`tb_detail_order`.`total` AS `total`,`tb_detail_order`.`sub_total` AS `sub_total`,`tb_detail_order`.`keterangan` AS `keterangan`,`tb_detail_order`.`status_keterangan` AS `status_keterangan`,`tb_detail_order`.`balasan_keterangan` AS `balasan_keterangan`,`tb_detail_order`.`status_detail` AS `status_detail`,`tb_menu`.`kd_menu` AS `kd_menu`,`tb_menu`.`name_menu` AS `name_menu`,`tb_menu`.`harga` AS `harga`,`tb_menu`.`status` AS `status`,`tb_user`.`name` AS `name`,`tb_user`.`level` AS `level`,`tb_order`.`no_meja` AS `no_meja`,`tb_order`.`tanggal` AS `tanggal`,`tb_order`.`nama_user` AS `nama_user`,`tb_order`.`status_order` AS `status_order` from (((`tb_detail_order` join `tb_menu` on((`tb_detail_order`.`menu_kd` = `tb_menu`.`kd_menu`))) join `tb_user` on((`tb_detail_order`.`user_kd` = `tb_user`.`kd_user`))) join `tb_order` on((`tb_detail_order`.`order_kd` = `tb_order`.`kd_order`))) */;

/*View structure for view transaksi */

/*!50001 DROP TABLE IF EXISTS `transaksi` */;
/*!50001 DROP VIEW IF EXISTS `transaksi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi` AS select `tb_transaksi`.`kd_transaksi` AS `kd_transaksi`,`tb_transaksi`.`total_harga` AS `total_harga`,`tb_transaksi`.`waktu` AS `waktu`,`tb_transaksi`.`tanggal` AS `tanggal`,`tb_user`.`name` AS `name` from (`tb_transaksi` join `tb_user` on((`tb_user`.`kd_user` = `tb_transaksi`.`user_kd`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
