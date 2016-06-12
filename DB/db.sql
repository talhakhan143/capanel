/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.0.17-MariaDB : Database - ca_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ca_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ca_db`;

/*Table structure for table `tbl_admin_users` */

DROP TABLE IF EXISTS `tbl_admin_users`;

CREATE TABLE `tbl_admin_users` (
  `ausr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ausr_name` varchar(250) NOT NULL,
  `ausr_uname` varchar(250) NOT NULL,
  `ausr_pass` varchar(250) NOT NULL,
  `ausr_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ausr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_admin_users` */

insert  into `tbl_admin_users`(`ausr_id`,`ausr_name`,`ausr_uname`,`ausr_pass`,`ausr_status`) values (1,'Super User','admin','f9d5d2420a7547f3e9d8fdf8422a641d5fc62754661279aac477ed05d87e8efb8c8dd092c7dbaa53a2441820ce67379e440587bd5eccac0f3cfb078e515637fdRnL82q6FH8z3Sxvg0Lrf13gIHId9Wn36RaiGfX3ckQI=',1);

/*Table structure for table `tbl_banners` */

DROP TABLE IF EXISTS `tbl_banners`;

CREATE TABLE `tbl_banners` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_title` varchar(250) NOT NULL,
  `ban_image` varchar(250) NOT NULL,
  `ban_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_banners` */

insert  into `tbl_banners`(`ban_id`,`ban_title`,`ban_image`,`ban_status`) values (1,'Banner 1','0.jpg',1),(2,'title 2','1.jpg',1),(3,'title 2','1.jpg',1),(4,'title 2','1.jpg',1),(5,'sdsd','13263801_1464680700224827_5027918478030252910_n5.jpg',1),(6,'Swat Police :D','13263784_572413979608035_8957227856570776378_n.jpg',1),(7,'Swat Police :D','13263784_572413979608035_8957227856570776378_n1.jpg',1),(8,'asas','13232882_1103348679708828_8957534147950443838_n.jpg',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
