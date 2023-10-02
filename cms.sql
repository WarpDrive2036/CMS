-- -------------------------------------------------------------
-- TablePlus 5.4.0(504)
--
-- https://tableplus.com/
--
-- Database: cms
-- Generation Time: 2023-10-02 15:40:51.7970
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `added_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment_post_id` int NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `comment_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_post_id` (`comment_post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_category_id` int NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_comment_count` int NOT NULL DEFAULT '0',
  `post_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'draft',
  `post_comments` varchar(255) DEFAULT NULL,
  `post_user_id` int NOT NULL,
  `post_views_count` int NOT NULL DEFAULT '0',
  `reg_post_views_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_category_id` (`post_category_id`),
  KEY `post_user_id` (`post_user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_image` text NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `randSalt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE `users_online` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session` varchar(255) DEFAULT NULL,
  `time` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categories` (`id`, `cat_title`, `added_by`) VALUES
(87, 'HTML 10', 8),
(90, 'C', 8),
(91, 'HTML ', 8),
(96, 'Java 8', 8),
(98, 'Bootstrap ', 8),
(105, 'OOP PHP', 9),
(121, 'PHP 8', 9),
(127, 'Apple Products', 9),
(129, 'Econmincs ', 23);

INSERT INTO `comments` (`id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(40, 158, 'Ahmed AbdelRazek', 'ahmed@email.com', 'Sir Sherlock HOLMES!!!', 'Approved', '2023-06-15'),
(41, 158, 'Ahmed AbdelRazek', 'ahmed@email.com', 'SHEEEEEESH!', 'Approved', '2023-06-15'),
(42, 158, 'Ahmed AbdelRazek', 'ahmed@email.com', 'jhgjhghjhgjg', 'Approved', '2023-06-15'),
(43, 158, 'John Doe', 'JohnDoe@example.com', 'TIME TRAVEL!!', 'Approved', '2023-06-15'),
(44, 178, 'Nada Ali', 'nada@email.com', 'Halalaaa', 'Unapproved', '2023-06-19'),
(45, 173, 'Amr Samy', 'amrs@email.com', 'NESSCAFE', 'Unapproved', '2023-06-19'),
(46, 178, 'Nada Ali', 'nada@email.com', 'IQQQQQ', 'Unapproved', '2023-06-19'),
(47, 170, 'Amr Samy', 'amrs@email.com', 'TESTTt', 'Approved', '2023-06-30');

INSERT INTO `posts` (`id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_comments`, `post_user_id`, `post_views_count`, `reg_post_views_count`) VALUES
(158, 87, 'asdad', 'Ahmed Samy', '2023-06-11', 'Benedict Cumberbatch.jpeg', 'BLALALLAALLALLAA', 'Dummmmmy', 4, 'Draft', NULL, 17, 51, 44),
(159, 127, 'Tesla', 'Elon Musk', '2023-06-05', 'Elon Musk.jpeg', 'Elon Musk The legend!', 'Elon Musk,Tesla,SpaceX,OpenAI,Twitter', 0, 'Draft', NULL, 17, 6, 4),
(162, 127, 'Tesla', 'Elon Musk', '2023-06-05', 'Elon Musk.jpeg', 'Elon Musk The legend!', 'Elon Musk,Tesla,SpaceX,OpenAI,Twitter', 0, 'Publish', NULL, 17, 4, 2),
(164, 87, 'Turkey', 'Ahmet ', '2023-06-11', 'Atatürk.jpeg', '<font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">ANKARA AS THE NEW Capital</font>', 'Turkey,Modern Turket,Attaurk', 0, 'Publish', NULL, 17, 1, 0),
(166, 127, 'Tesla', 'Elon Musk', '2023-06-05', 'Elon Musk.jpeg', 'Elon Musk The legend!', 'Elon Musk,Tesla,SpaceX,OpenAI,Twitter', 0, 'Publish', NULL, 17, 3, 1),
(167, 87, 'Turkey', 'Ahmet ', '2023-06-11', 'Atatürk.jpeg', '<font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">ANKARA AS THE NEW Capital</font>', 'Turkey,Modern Turket,Attaurk', 0, 'Publish', NULL, 17, 1, 1),
(168, 87, 'asdad', 'Ahmed Samy', '2023-06-11', 'Benedict Cumberbatch.jpeg', 'BLALALLAALLALLAA', 'Dummmmmy', 0, 'Draft', NULL, 17, 0, 0),
(169, 127, 'Tesla', 'Elon Musk', '2023-06-05', 'Elon Musk.jpeg', 'Elon Musk The legend!', 'Elon Musk,Tesla,SpaceX,OpenAI,Twitter', 0, 'Publish', NULL, 17, 0, 0),
(170, 87, 'HollyWood', 'Edited by ADMIN: Ahmed AbdelRazek', '2023-06-30', 'Bradley Cooper.jpeg', 'Helllloooo World!!!', 'TESTTT', 1, 'Publish', NULL, 8, 7, 7),
(171, 98, 'George Clooney', 'Edited by ADMIN: Ahmed AbdelRazek', '2023-06-15', 'George Clooney.jpeg', 'TETTEETET', 'SHEEEESH', 0, 'Draft', NULL, 8, 3, 3),
(172, 87, 'sdfsdf', 'sdfdf', '2023-06-14', 'Bradley Cooper.jpeg', 'asdasd', 'TESTTT', 0, 'Draft', NULL, 8, 0, 0),
(173, 98, 'TEEEST', 'Edited by ADMIN: Ahmed AbdelRazek', '2023-06-18', 'George Clooney.jpeg', 'TETTEETET', 'SHEEEESH', 1, 'Publish', NULL, 8, 5, 5),
(174, 87, 'sdfsdf', 'sdfdf', '2023-06-14', 'Bradley Cooper.jpeg', 'asdasd', 'TESTTT', 0, 'Draft', NULL, 8, 0, 0),
(175, 98, 'Clooney', 'Edited by ADMIN: Ahmed AbdelRazek', '2023-06-18', 'George Clooney.jpeg', 'TETTEETET', 'SHEEEESH', 0, 'Draft', NULL, 8, 1, 1),
(176, 87, 'sdfsdf', 'sdfdf', '2023-06-14', 'Bradley Cooper.jpeg', 'asdasd', 'TESTTT', 0, 'Publish', NULL, 8, 0, 0),
(177, 98, 'sasdd', 'John Titor', '2023-06-14', 'George Clooney.jpeg', 'TETTEETET', 'SHEEEESH', 0, 'Draft', NULL, 8, 0, 0),
(178, 105, 'Einstein', 'Nada ', '2023-06-14', 'Albert Einstein.jpeg', 'TIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSION', 'Einstein,Genius,Relativity ', 2, 'Publish', NULL, 9, 14, 13),
(179, 105, 'Einstein', 'Nada ', '2023-06-14', 'Albert Einstein.jpeg', 'TIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSION', 'Einstein,Genius,Relativity ', 0, 'Publish', NULL, 9, 0, 0),
(180, 105, 'Einstein', 'Nada ', '2023-06-14', 'Albert Einstein.jpeg', 'TIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSION', 'Einstein,Genius,Relativity ', 0, 'Draft', NULL, 9, 1, 1),
(181, 105, 'Einstein', 'Nada ', '2023-06-14', 'Albert Einstein.jpeg', 'TIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSIONTIME IS AN ILLUSION', 'Einstein,Genius,Relativity ', 0, 'Draft', NULL, 9, 0, 0),
(183, 127, 'The Interesting Life of Jackie Chan', 'Ahmed AbdelRazek', '2023-06-15', 'Jackie Chan.jpeg', 'OBAAAAAAA', 'Jackie Chan,Action,Rush Hour,Chinese,Actor', 0, 'Publish', NULL, 17, 2, 1),
(184, 91, 'Mo Salag', 'Amr Samy', '2023-06-18', 'Mohammed Salah.jpeg', 'GOALLLLL!', 'Mo Salah,LiverPool,Fotball,UK', 0, 'Publish', NULL, 8, 2, 2),
(185, 87, 'HollyWood', 'Amr Samy', '2023-06-18', 'Bradley Cooper.jpeg', 'asdasd', 'TESTTT', 0, 'Publish', NULL, 8, 0, 0),
(186, 91, 'Mo Salag', 'Amr Samy', '2023-06-18', 'Mohammed Salah.jpeg', 'GOALLLLL!', 'Mo Salah,LiverPool,Fotball,UK', 0, 'Publish', NULL, 8, 2, 2),
(187, 129, 'US Dollar', 'Yehya Islam', '2023-06-30', 'Chris Evans.jpeg', 'Recession&nbsp;', 'Dollar,US,Currency,Money', 0, 'Publish', NULL, 23, 1, 1);

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `user_image`, `role`, `randSalt`) VALUES
(8, 'amrsamy3', '$2y$10$6/zIQqqfKMxDULwLVqtB6OY/UcjEoOll.ZVqQiknTQkyqc9Scl/f6', 'Amr', 'Samy', 'amrs@email.com', 'Arnold Schwarzenegger.jpeg', 'subscriber', NULL),
(9, 'Nada_Cat_MOM', '$2y$10$rfPLzdV5C1DRzgN8QXJFm.uctroqeIPmsHigsFubHL.W9etIQdjz.', 'Nada', 'Ali', 'nada@email.com', 'Emilia Clarke.jpeg', 'subscriber', NULL),
(17, 'EpicHaxer2000', '$2y$10$rhuMzIzrZQQbE.GuGGvia.d5Dn.NfyvigqO7rA/AbH3mJ/w1NW0rq', 'Ahmed', 'AbdelRazek', 'ahmed@email.com', 'Chris Evans.jpeg', 'admin', NULL),
(23, 'yohana', '$2y$10$115k/jLCtgwBqDyRzgCuEube7adfhgS/GwDQi8kPumpR.UyDD5aaS', 'Yehya', 'Islam', 'yehya@email.com', 'Bill Gates.jpeg', 'subscriber', NULL);

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(221, 'adh13ql8khnmfutabb0udn9613', 1686850963),
(222, '795i5r8do1pqk80m75nh8p3kf7', 1686854934),
(223, '4ivqg8m1dvuhcg9g0huft6lqfv', 1686851280),
(224, 'dohjpcsfdbhr9mgesnck098ll4', 1686851096),
(225, '4dlv5ta9fsd6kpra62kg6pqa3n', 1686854974),
(226, 'mqf5bksam0jo3ncs2fumiavlt1', 1686856832),
(227, 'fb6s78dnruo71531q29jdqv988', 1686857062),
(228, 'qic0u1ajt4drsrvsfmq01bjv30', 1687108779),
(229, 'ml86tp7f6n15u4f5hahagghv2g', 1687109848),
(230, '8mdthmusgfduuddi5gto8erfi0', 1687110017),
(231, 'a51094ptoti7pdefa674ot2r2f', 1687110093),
(232, 'pokkjbpg7iruah52rbrrr8211j', 1687114653),
(233, 'f2c5nc85rulchkfmv35m32p1bn', 1687124739),
(234, '4r7ur32gumelj6qo5deijr6e24', 1687124909),
(235, '5qkmcbeaud6nls1tvqagu0hfdo', 1687127265),
(236, 'bf5bkqs7349d7frkckthf724c4', 1687131647),
(237, 's0l2pemlmtii6g7qj6atdlar9n', 1687131647),
(238, 'dutrc84he2tc3034vku4gq75l0', 1687135551),
(239, 'onfb8b312jaff3pd93goiddloo', 1687137992),
(240, '3f99dqsj2ni9hp2jucek8kgr7q', 1687138169),
(241, 'euuvih4i2k2jakjscn8pr4pnp7', 1687138224),
(242, '521omedhnnblh1urtd19cg3u8n', 1687138272),
(243, '9g5dg57pj5vquj6but2os429tl', 1687139736),
(244, 'gom8sdsk4s669ougjves8se7ic', 1687140061),
(245, 'esk4al5lantndsbohs0dg28vm8', 1687140963),
(246, '6dtqasns6fm1h4vhkt55018kmq', 1687141111),
(247, 'rocacc900og504ri1l4e9ibnkk', 1687141307),
(248, 'mi4jt8dmt3n8fe8hdua3q908di', 1687217805),
(249, 'pvimju0jbl85d0obs0mhd7ed2t', 1687217839),
(250, 'q85sj6lb4f2vvjjvirs4i10seq', 1687217981),
(251, '6grb66a6mrc25gq9sqac8n680n', 1687218053),
(252, 'f7cab2kesr6esaor196l44or32', 1687218211),
(253, '7h8abd6jaktkf0ah6i75ml5m51', 1687218175),
(254, '2a8uquvub0sg0sl6cg5uka18i3', 1687218420),
(255, '5g96ekoqjktgtf93rm2sjvimt5', 1687472407),
(256, 'snnsl0mfss8uadvjm48h32mr87', 1687472435),
(257, 'gcfjg7u823fofjnjb5kppc2jhf', 1688151992),
(258, 'd2goiftk4hs2em5a4lm6pkf2co', 1688152037),
(259, 'jnj7n1753442gp1849is7d8iid', 1688152140),
(260, 'im8u46isg2dpgg6pbct8mcep00', 1688160250),
(261, '8q9rfq944uev98e1vvhsanl8cv', 1688161596),
(262, 'cv9rcarrpsgp8nac6q64n2j1ad', 1688161764),
(263, 'bsqc21k721ars5lhvhbc0eur6n', 1693251845);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;