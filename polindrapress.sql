/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_polindrapress
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_polindrapress` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_polindrapress`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `notlp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_user_id_foreign` (`user_id`),
  CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`user_id`,`name`,`foto`,`job`,`alamat`,`notlp`,`created_at`,`updated_at`) values 
(1,1,'admin','uploads/profil/admin/2024-07-22/1/admin12024-07-22.jpg','Petugas Polindra Press','Politeknik Negeri Indramayu','admin@gmail.com','2024-07-22 03:04:06','2024-07-22 03:05:47');

/*Table structure for table `bukus` */

DROP TABLE IF EXISTS `bukus`;

CREATE TABLE `bukus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penulis_id` bigint(20) unsigned NOT NULL,
  `pengaju_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jumlahHalaman` varchar(255) NOT NULL,
  `daftarPustaka` text NOT NULL,
  `resensi` text NOT NULL,
  `suratKeaslian` varchar(255) NOT NULL,
  `coverBuku` varchar(255) NOT NULL,
  `coverBukuBelakang` varchar(255) NOT NULL,
  `draftBuku` varchar(255) NOT NULL,
  `tahunTerbit` varchar(255) NOT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `noProduk` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `status` enum('pending','accept','revisi','tolak') NOT NULL DEFAULT 'pending',
  `statusUpload` enum('belum upload','sudah upload') NOT NULL DEFAULT 'belum upload',
  `publish` enum('is_publish','non_publish') NOT NULL DEFAULT 'non_publish',
  `adminComment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukus_penulis_id_foreign` (`penulis_id`),
  KEY `bukus_pengaju_id_foreign` (`pengaju_id`),
  CONSTRAINT `bukus_pengaju_id_foreign` FOREIGN KEY (`pengaju_id`) REFERENCES `pengajus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bukus_penulis_id_foreign` FOREIGN KEY (`penulis_id`) REFERENCES `penulis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bukus` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2024_05_12_024706_create_pengajus_table',1),
(6,'2024_05_13_071229_create_penulis_table',1),
(7,'2024_05_13_072519_create_bukus_table',1),
(8,'2024_05_15_024505_create_admins_table',1),
(9,'2024_07_18_064601_modify_daftar_pustaka_column_in_bukus_table',1),
(10,'2024_08_10_134817_create_super_admins_table',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pengajus` */

DROP TABLE IF EXISTS `pengajus`;

CREATE TABLE `pengajus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `notlp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajus_user_id_foreign` (`user_id`),
  CONSTRAINT `pengajus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengajus` */

insert  into `pengajus`(`id`,`user_id`,`name`,`foto`,`job`,`alamat`,`notlp`,`created_at`,`updated_at`) values 
(1,2,'pengaju','uploads/profil/pengaju/2024-07-22/2/pengaju22024-07-22.jpg','Petugas Polindra Press','Politeknik Negeri Indramayu','085923152893','2024-07-22 03:04:06','2024-07-22 03:06:52'),
(2,3,'pengaju',NULL,NULL,NULL,NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(3,4,'pengaju',NULL,NULL,NULL,NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(5,6,'Zulfa Choirunnisa',NULL,NULL,NULL,NULL,'2024-07-22 04:53:59','2024-07-22 04:53:59'),
(6,7,'Rendy','uploads/profil/pengaju/2024-07-22/7/pengaju72024-07-22.jpg','dosen IT','Politeknik Negeri Indramayu','0858923152893','2024-07-22 04:57:38','2024-07-22 05:02:00');

/*Table structure for table `penulis` */

DROP TABLE IF EXISTS `penulis`;

CREATE TABLE `penulis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `noTelepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penulis` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `super_admins` */

DROP TABLE IF EXISTS `super_admins`;

CREATE TABLE `super_admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `notlp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `super_admins_user_id_foreign` (`user_id`),
  CONSTRAINT `super_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `super_admins` */

insert  into `super_admins`(`id`,`user_id`,`name`,`foto`,`job`,`alamat`,`notlp`,`created_at`,`updated_at`) values 
(1,8,'Super Admin','uploads/profil/superadmin/2024-08-10/8/superadmin82024-08-10.jpg','Super Admin','Politeknik Negeri Indramayu','Politeknik Negeri Indramayu','2024-08-10 20:53:35','2024-08-10 14:20:37');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','admin@gmail.com','$2y$10$5FeGljbqEaQRA8yTLF5/eejmZBWC/fgwhnLbkEJvOXVORwmQyYpF.','admin',NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(2,'pengaju','pengaju@gmail.com','$2y$10$.VoMLYZ2iqAk2nGt3ytGYOhpoGUY4CX7/FDjQ371UKogg5EOmxZ7a','pengaju',NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(3,'adisuheryadi','adusuheryadi@gmail.com','$2y$10$jx9tWJomcWgLS1oRv6wn2.2N1OqS0K86F.MzS3MnYjaeHcByEWz1a','pengaju',NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(4,'rahmatullah','rahmatullah@gmail.com','$2y$10$o.M1kDpTXG.KXE4427dA4e89VL8CMevWj.zXbNyPfHVrNFWTh7.Mq','pengaju',NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06'),
(6,'zcnnisa','zidniibu@gmail.com','$2y$10$k/JU7JJrF9UcX6/i3g/VGOoqQua5KOFOr4P1vSs/YTk4epthXEP32','pengaju',NULL,'2024-07-22 04:53:59','2024-07-22 04:53:59'),
(7,'rendy','rendy@polindra.ac.id','$2y$10$DwrCnz2jXJoylA5ov35utuxJ1xy2xrQmo0MAAA.5DdK15e74zl1bS','pengaju',NULL,'2024-07-22 04:57:38','2024-07-22 04:57:38'),
(8,'sa','sa@gmail.com','$2y$10$5FeGljbqEaQRA8yTLF5/eejmZBWC/fgwhnLbkEJvOXVORwmQyYpF.','superadmin',NULL,'2024-07-22 03:04:06','2024-07-22 03:04:06');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
