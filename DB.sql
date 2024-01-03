SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `DB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `DB`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(250) AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `phone_number`) VALUES
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 'Văn', 'vanldhe176194@fpt.edu.vn', 865732358);
COMMIT;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT(250) AUTO_INCREMENT PRIMARY KEY,
    `post_title` VARCHAR(255) NOT NULL,
    `post_content` TEXT NOT NULL
);