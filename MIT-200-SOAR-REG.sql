/*
SQLyog Community v12.09 (64 bit)
MySQL - 10.4.27-MariaDB : Database - student_registration
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`student_registration` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `student_registration`;

/*Table structure for table `contact_information` */

DROP TABLE IF EXISTS `contact_information`;

CREATE TABLE `contact_information` (
  `contact_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`contact_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contact_information` */

insert  into `contact_information`(`contact_info_id`,`student_id`,`mobile_number`,`telephone`,`email`) values (1,1,'09690254259','0','johnartdg@gmail.com');

/*Table structure for table `educational_information` */

DROP TABLE IF EXISTS `educational_information`;

CREATE TABLE `educational_information` (
  `education_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `academic_level` enum('Basic Education','Tertiary','Graduate School') DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `period` varchar(20) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`education_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `educational_information` */

insert  into `educational_information`(`education_info_id`,`student_id`,`academic_level`,`year_level`,`period`,`academic_year`,`course`) values (1,1,'Graduate School',1,'1st Trimester','2024-2025','MIT');

/*Table structure for table `family_information` */

DROP TABLE IF EXISTS `family_information`;

CREATE TABLE `family_information` (
  `family_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_contact_number` varchar(15) DEFAULT NULL,
  `father_contact_number` varchar(15) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`family_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `family_information` */

insert  into `family_information`(`family_info_id`,`student_id`,`mother_name`,`father_name`,`mother_contact_number`,`father_contact_number`,`mother_occupation`,`father_occupation`) values (1,1,'Iluminada Antolin','Joel-Jonathan De Guzman','09690254259','09299619902','Housewife','Call Center Agent');

/*Table structure for table `personal_information` */

DROP TABLE IF EXISTS `personal_information`;

CREATE TABLE `personal_information` (
  `personal_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`personal_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personal_information` */

insert  into `personal_information`(`personal_info_id`,`student_id`,`first_name`,`last_name`,`middle_name`,`suffix`,`gender`,`birthday`,`age`,`birthplace`) values (1,1,'John Artemson','De Guzman','Antolin','','Male','2000-09-05',24,'Bulacan');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Registered','Admitted','Assessed','Enrolled') DEFAULT 'Registered',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `students` */

insert  into `students`(`student_id`,`status`,`created_at`,`updated_at`) values (1,'Enrolled','2024-10-15 08:41:42','2024-10-15 09:21:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
