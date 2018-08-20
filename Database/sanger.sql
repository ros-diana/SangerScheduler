/*
SQLyog Community v12.2.0 (64 bit)
MySQL - 10.1.21-MariaDB : Database - sanger
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sanger` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sanger`;

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1532768690),
('m130524_201442_init',1532768704);

/*Table structure for table `tb_akun` */

DROP TABLE IF EXISTS `tb_akun`;

CREATE TABLE `tb_akun` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `idx_akun` (`email`),
  KEY `email` (`email`),
  KEY `fk_role` (`role_id`),
  CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_akun` */

insert  into `tb_akun`(`email`,`password`,`role_id`) values 
('admin@gmail.com','admin123',1),
('arif@gmail.com','arif',3),
('sarah123@gmail.com','sarah123',1),
('susi123@gmail.com','susi123',3);

/*Table structure for table `tb_hari` */

DROP TABLE IF EXISTS `tb_hari`;

CREATE TABLE `tb_hari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_waktu` (`waktu_id`),
  CONSTRAINT `fk_waktu` FOREIGN KEY (`waktu_id`) REFERENCES `tb_waktu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_hari` */

insert  into `tb_hari`(`id`,`nama`,`waktu_id`) values 
(1,'Senin',1);

/*Table structure for table `tb_jadwal` */

DROP TABLE IF EXISTS `tb_jadwal`;

CREATE TABLE `tb_jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `hari_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_hari` (`hari_id`),
  KEY `fk_mapel` (`mapel_id`),
  KEY `fk_ruangan` (`ruangan_id`),
  CONSTRAINT `fk_hari` FOREIGN KEY (`hari_id`) REFERENCES `tb_hari` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_mapel` FOREIGN KEY (`mapel_id`) REFERENCES `tb_mata_pelajaran` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `tb_ruangan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jadwal` */

insert  into `tb_jadwal`(`id`,`keterangan`,`hari_id`,`ruangan_id`,`mapel_id`) values 
(2,'Ini adalah jadwal hingga seminggu ke depan\r\n',1,1,2);

/*Table structure for table `tb_jenis_kelas` */

DROP TABLE IF EXISTS `tb_jenis_kelas`;

CREATE TABLE `tb_jenis_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_kelas` */

insert  into `tb_jenis_kelas`(`id`,`jenis`) values 
(1,'Reguler');

/*Table structure for table `tb_mata_pelajaran` */

DROP TABLE IF EXISTS `tb_mata_pelajaran`;

CREATE TABLE `tb_mata_pelajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_jenis` (`jenis_id`),
  KEY `fk_pengajar` (`pengajar_id`),
  CONSTRAINT `fk_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `tb_jenis_kelas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_pengajar` FOREIGN KEY (`pengajar_id`) REFERENCES `tb_pengajar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_mata_pelajaran` */

insert  into `tb_mata_pelajaran`(`id`,`nama`,`jenis_id`,`pengajar_id`) values 
(2,'Web Progrramming',1,1);

/*Table structure for table `tb_pendaftaran` */

DROP TABLE IF EXISTS `tb_pendaftaran`;

CREATE TABLE `tb_pendaftaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_pendaftaran` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_status` (`status_id`),
  KEY `fk_mapel1` (`mapel_id`),
  CONSTRAINT `fk_mapel1` FOREIGN KEY (`mapel_id`) REFERENCES `tb_mata_pelajaran` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_status` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pendaftaran` */

insert  into `tb_pendaftaran`(`id`,`waktu_pendaftaran`,`status_id`,`mapel_id`) values 
(3,'2018-08-11 10:46:15',1,2);

/*Table structure for table `tb_pengajar` */

DROP TABLE IF EXISTS `tb_pengajar`;

CREATE TABLE `tb_pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `email_akun` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_email` (`email_akun`),
  CONSTRAINT `fk_email` FOREIGN KEY (`email_akun`) REFERENCES `tb_akun` (`email`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajar` */

insert  into `tb_pengajar`(`id`,`nama`,`alamat`,`nomor_hp`,`email_akun`) values 
(1,'Arif','Medan','087688472637','arif@gmail.com');

/*Table structure for table `tb_role` */

DROP TABLE IF EXISTS `tb_role`;

CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_role` */

insert  into `tb_role`(`id`,`nama`) values 
(1,'Admin'),
(2,'Pengajar'),
(3,'Siswa'),
(4,'Guest');

/*Table structure for table `tb_ruangan` */

DROP TABLE IF EXISTS `tb_ruangan`;

CREATE TABLE `tb_ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ruangan` */

insert  into `tb_ruangan`(`id`,`nama`,`kapasitas`) values 
(1,'Ruangan A',5),
(2,'Ruangan B',4),
(3,'Ruangan C',4);

/*Table structure for table `tb_siswa` */

DROP TABLE IF EXISTS `tb_siswa`;

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `email_akun` varchar(255) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_email1` (`email_akun`),
  KEY `fk_pendaftaran` (`pendaftaran_id`),
  KEY `fk_jadwal` (`jadwal_id`),
  CONSTRAINT `fk_email1` FOREIGN KEY (`email_akun`) REFERENCES `tb_akun` (`email`) ON UPDATE CASCADE,
  CONSTRAINT `fk_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `tb_jadwal` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tb_pendaftaran` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_siswa` */

insert  into `tb_siswa`(`id`,`nama`,`alamat`,`nomor_hp`,`email_akun`,`pendaftaran_id`,`jadwal_id`) values 
(1,'Sarah Rosdiana','Balige','083734769324','sarah123@gmail.com',3,2);

/*Table structure for table `tb_status` */

DROP TABLE IF EXISTS `tb_status`;

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_status` */

insert  into `tb_status`(`id`,`nama`) values 
(1,'Request'),
(2,'Confirmed'),
(3,'Rejected');

/*Table structure for table `tb_waktu` */

DROP TABLE IF EXISTS `tb_waktu`;

CREATE TABLE `tb_waktu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wkt_mulai` time NOT NULL,
  `wkt_berakhir` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_waktu` */

insert  into `tb_waktu`(`id`,`wkt_mulai`,`wkt_berakhir`) values 
(1,'10:00:00','12:00:00');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(1,'sarah','q_FClx3Jd4oznjrr8g1bz1b7iFChE3Zi','$2y$13$VvRQa4KUOJxrCQRMaU9ak.m6XuX2pMH8.Xg63FZbmtvD7lFrkIHrO',NULL,'sarah@gmail.com',10,1533352103,1533352103),
(2,'test','rw7-tvtrZ2OhcOByA_73_3FbG-TOvfj8','$2y$13$2O4C2xiUELjvtC8WL1tXbO7Z0xHXf8Dl3qu77xLHorI0lP2Yh72dO',NULL,'test@gmail.com',10,1533885579,1533885579),
(3,'coba','Xi0u7p4s3pAAP2wW6tzAEVpBdTlZ_50Z','$2y$13$wDTlD9L6ZB0EyI51TwDOwOiFj32B4vdJnRGLiVVeE84czZE1NKrkW',NULL,'coba@gmail.com',10,1533890187,1533890187);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
