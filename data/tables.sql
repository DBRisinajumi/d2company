/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.29-MariaDB : Database - p3_02
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`p3_02` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `ccbr_branch` */

DROP TABLE IF EXISTS `ccbr_branch`;

CREATE TABLE `ccbr_branch` (
  `ccbr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ccbr_ccmp_id` int(10) unsigned NOT NULL,
  `ccbr_name` varchar(350) NOT NULL,
  `ccrb_code` varchar(50) DEFAULT NULL,
  `ccbr_notes` text,
  `ccbr_hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ccbr_id`),
  KEY `ccbr_ccmp_id` (`ccbr_ccmp_id`),
  CONSTRAINT `ccbr_branch_ibfk_1` FOREIGN KEY (`ccbr_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ccbr_branch` */

/*Table structure for table `ccgr_group` */

DROP TABLE IF EXISTS `ccgr_group`;

CREATE TABLE `ccgr_group` (
  `ccgr_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ccgr_name` varchar(20) NOT NULL,
  `ccgr_notes` text,
  `ccgr_hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ccgr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `ccgr_group` */

insert  into `ccgr_group`(`ccgr_id`,`ccgr_name`,`ccgr_notes`,`ccgr_hide`) values (1,'SysComapny',NULL,0),(2,'Gas station',NULL,0);

/*Table structure for table `ccmp_company` */

DROP TABLE IF EXISTS `ccmp_company`;

CREATE TABLE `ccmp_company` (
  `ccmp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ccmp_name` varchar(200) NOT NULL,
  `ccmp_ccnt_id` smallint(6) unsigned DEFAULT NULL COMMENT 'contry',
  `ccmp_registrtion_no` varchar(20) DEFAULT NULL,
  `ccmp_vat_registrtion_no` varchar(20) DEFAULT NULL,
  `ccmp_registration_address` varchar(200) DEFAULT NULL,
  `ccmp_official_address` varchar(200) DEFAULT NULL,
  `ccmp_statuss` enum('ACTIVE','CLOSED') DEFAULT 'ACTIVE',
  `ccmp_description` text,
  PRIMARY KEY (`ccmp_id`),
  KEY `ccmp_ccnt_id` (`ccmp_ccnt_id`),
  KEY `ccmp_name` (`ccmp_name`(4)),
  CONSTRAINT `ccmp_company_ibfk_1` FOREIGN KEY (`ccmp_ccnt_id`) REFERENCES `ccnt_country` (`ccnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ccmp_company` */

insert  into `ccmp_company`(`ccmp_id`,`ccmp_name`,`ccmp_ccnt_id`,`ccmp_registrtion_no`,`ccmp_vat_registrtion_no`,`ccmp_registration_address`,`ccmp_official_address`,`ccmp_statuss`,`ccmp_description`) values (1,'Company 1a',1,'4000333333a','LV400033333a','Brīvības 5, Rīgaa','Brīvības 5, Rīgaa','ACTIVE','Company onea'),(2,'Company 2',2,'400022222','LV400022222','Brīības 1, Rīga, LV-1010','Brīības 1, Rīga, LV-1010','ACTIVE','Piezimes'),(3,'Company3',2,'111111','11111101','Visbijas 5, Rīga','Visbijas 5, Rīga','ACTIVE','nav piezīmes');

/*Table structure for table `ccnt_country` */

DROP TABLE IF EXISTS `ccnt_country`;

CREATE TABLE `ccnt_country` (
  `ccnt_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ccnt_name` varchar(200) NOT NULL,
  `ccnt_code` char(3) CHARACTER SET ascii DEFAULT NULL,
  PRIMARY KEY (`ccnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ccnt_country` */

insert  into `ccnt_country`(`ccnt_id`,`ccnt_name`,`ccnt_code`) values (1,'Latvija','LV'),(2,'Lietuva','LT'),(3,'Igaunija','EE');

/*Table structure for table `ccxg_company_x_group` */

DROP TABLE IF EXISTS `ccxg_company_x_group`;

CREATE TABLE `ccxg_company_x_group` (
  `ccxg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ccxg_ccmp_id` int(10) unsigned NOT NULL,
  `ccxg_ccgr_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ccxg_id`),
  KEY `ccxg_ccmp_id` (`ccxg_ccmp_id`),
  KEY `ccxg_ccgr_id` (`ccxg_ccgr_id`),
  CONSTRAINT `ccxg_company_x_group_ibfk_1` FOREIGN KEY (`ccxg_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`),
  CONSTRAINT `ccxg_company_x_group_ibfk_2` FOREIGN KEY (`ccxg_ccgr_id`) REFERENCES `ccgr_group` (`ccgr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `ccxg_company_x_group` */

insert  into `ccxg_company_x_group`(`ccxg_id`,`ccxg_ccmp_id`,`ccxg_ccgr_id`) values (5,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
