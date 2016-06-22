/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.9-MariaDB : Database - ca_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
  `ban_link` varchar(250) DEFAULT NULL,
  `ban_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_banners` */

insert  into `tbl_banners`(`ban_id`,`ban_title`,`ban_image`,`ban_link`,`ban_status`) values (7,'Banner 2','2a734753a6f4b6a26fee2b6bd284d1dc.jpg','',0);
insert  into `tbl_banners`(`ban_id`,`ban_title`,`ban_image`,`ban_link`,`ban_status`) values (9,'Banner 3','730dfbbd3d0b905d48c01171e8db7dba.png','',0);

/*Table structure for table `tbl_port_categories` */

DROP TABLE IF EXISTS `tbl_port_categories`;

CREATE TABLE `tbl_port_categories` (
  `pcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcat_title` varchar(250) NOT NULL,
  `pcat_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`pcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_port_categories` */

insert  into `tbl_port_categories`(`pcat_id`,`pcat_title`,`pcat_status`) values (1,'Web',1);
insert  into `tbl_port_categories`(`pcat_id`,`pcat_title`,`pcat_status`) values (2,'Graphics',1);
insert  into `tbl_port_categories`(`pcat_id`,`pcat_title`,`pcat_status`) values (3,'Apps',1);

/*Table structure for table `tbl_portfolio` */

DROP TABLE IF EXISTS `tbl_portfolio`;

CREATE TABLE `tbl_portfolio` (
  `port_id` int(11) NOT NULL AUTO_INCREMENT,
  `port_cat` int(11) NOT NULL,
  `port_title` varchar(250) NOT NULL,
  `port_image` varchar(250) NOT NULL,
  `port_link` varchar(250) DEFAULT NULL,
  `port_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`port_id`),
  KEY `port_cat` (`port_cat`),
  CONSTRAINT `tbl_portfolio_ibfk_1` FOREIGN KEY (`port_cat`) REFERENCES `tbl_port_categories` (`pcat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_portfolio` */

insert  into `tbl_portfolio`(`port_id`,`port_cat`,`port_title`,`port_image`,`port_link`,`port_status`) values (1,1,'Cyber Avanza','06c631353aaf0b52ef18b120606a2d5e.jpg','http://cyberavanza.com',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
