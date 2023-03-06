/*
SQLyog Community Edition- MySQL GUI v6.16
MySQL - 5.5.5-10.4.21-MariaDB : Database - leave_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `leave_system`;

USE `leave_system`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`full_name`,`role`) values (1,'admin','admin','admin1','admin');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_no` varchar(150) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `department` varchar(200) NOT NULL,
  `date_hired` varchar(100) NOT NULL,
  `remaining_leave` varchar(150) NOT NULL DEFAULT '24',
  `salary` varchar(150) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'No Leave',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `employee` */

insert  into `employee`(`id`,`id_no`,`full_name`,`department`,`date_hired`,`remaining_leave`,`salary`,`status`) values (1,'111','John Doe','IT','2022-03-16','24','40000','On Leave(Whole)'),(2,'222','Jane Doe','Accounting','2022-04-16','24','50000','No Leave');

/*Table structure for table `whole_day` */

DROP TABLE IF EXISTS `whole_day`;

CREATE TABLE `whole_day` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_no` varbinary(150) DEFAULT NULL,
  `full_name` varbinary(255) DEFAULT NULL,
  `datefrom` varbinary(100) DEFAULT NULL,
  `dateto` varbinary(100) DEFAULT NULL,
  `reason` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `whole_day` */

insert  into `whole_day`(`id`,`id_no`,`full_name`,`datefrom`,`dateto`,`reason`) values (1,'111','John Doe','2023-03-07','2023-03-14','reason');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
