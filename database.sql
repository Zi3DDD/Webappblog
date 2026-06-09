SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `reactie`;
DROP TABLE IF EXISTS `blog`;
DROP TABLE IF EXISTS `gebruiker`;
DROP TABLE IF EXISTS `group_media`;
DROP TABLE IF EXISTS `image`;
DROP TABLE IF EXISTS `permissies`;
DROP TABLE IF EXISTS `rollen`;
DROP TABLE IF EXISTS `subscriber`;

CREATE TABLE `rollen` (
  `role_id` bigint NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `gebruiker` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` bigint DEFAULT NULL,
  `user_nickname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `gebruiker_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `rollen` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `image` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `group_media` (
  `group_id` int NOT NULL,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `group_media_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `user_id` int DEFAULT NULL,
  `header_image_id` int DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `header_image_id` (`header_image_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `gebruiker` (`user_id`),
  CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`header_image_id`) REFERENCES `image` (`image_id`),
  CONSTRAINT `blog_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group_media` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reactie` (
  `reactie_id` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_nickname` varchar(255) DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  PRIMARY KEY (`reactie_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `reactie_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissies` (
  `perm_id` int NOT NULL AUTO_INCREMENT,
  `perm_mod` varchar(5) DEFAULT NULL,
  `perm_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `subscriber` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `subscription_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;


INSERT INTO rollen (role_name) VALUES
('bezoeker'),
('redacteur'),
('beheerder');