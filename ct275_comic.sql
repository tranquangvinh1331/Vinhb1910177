

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `comic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tacgia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `id_comic` int(11) NOT NULL,
  `name_chapter` int(250) COLLATE utf8_unicode_ci NOT NULL,
  `chapter` float NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 INSERT INTO `chapters` (`id`, `id_comic`, `name_chapter`, `chapter`, `create_time`, `update_time`) VALUES 
 (1, 12, '12', 1, '2018-03-10 00:00:00', NULL);
 -- --------------------------------------------------------




CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

  ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_chapter` (`id_chapter`);



ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comic` (`id_comic`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`),