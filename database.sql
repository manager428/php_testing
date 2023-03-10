/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.22-MariaDB : Database - database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`database` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `database`;

/*Table structure for table `userdata` */

DROP TABLE IF EXISTS `userdata`;

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filed1` varchar(255) NOT NULL,
  `filed2` varchar(255) NOT NULL,
  `filed3` varchar(255) NOT NULL,
  `filed4` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `userdata` */

insert  into `userdata`(`id`,`filed1`,`filed2`,`filed3`,`filed4`) values 
(1,'1','2','3','4'),
(2,'11','22','33','44'),
(3,'111','2222','333','444'),
(4,'1','23','23','23'),
(5,'234','234','34','5467'),
(6,'34','345','45','879'),
(7,'34','234','54','97');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
