-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2017 at 09:15 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `hashed`, `created`) VALUES
(1, 'kike@izarmedia.es', '$2y$10$7y4ASp76EwhRET6kqbcVkedbtgymuWP9fp9wpEy130lkh1OaemWW.', '2017-11-03 09:10:54'),
(2, 'sergio@izarmedia.es', '$2y$10$ikjO70DkMAeSw4gkLduJbesmT4mHeNDEVRAlxKm82kQ0B8fSiYuH2', '2017-11-03 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `categoryname` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryname`, `created`) VALUES
(1, 'Compras', '2017-11-03 09:10:53'),
(2, 'Viajes', '2017-11-03 09:10:53'),
(3, 'Salud', '2017-11-03 09:10:53'),
(4, 'Economia', '2017-11-03 09:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171102100722, 'Sprint1', '2017-11-03 08:10:43', '2017-11-03 08:10:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) UNSIGNED NOT NULL,
  `categories_id` int(11) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `todo` varchar(255) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `categories_id`, `accounts_id`, `todo`, `done`, `created`) VALUES
(1, 4, 2, 'Quasi occaecati et mollitia debitis officia et. Velit ratione repudiandae a quis ut sit sit et.', 1, '2017-11-03 09:10:54'),
(2, 4, 2, 'Et dolore ut id. Est esse vero atque officia nisi. Eligendi cum nemo ex modi.', 0, '2017-11-03 09:10:54'),
(3, 1, 1, 'Ad veniam dolore enim magnam. Inventore consequatur id qui quia qui facilis.', 0, '2017-11-03 09:10:54'),
(4, 1, 2, 'Eum pariatur doloremque magni rerum. Ut omnis minus vero eum deleniti quisquam ut.', 1, '2017-11-03 09:10:54'),
(5, 4, 2, 'Sapiente tempora aut qui. Est soluta odit a. Ipsam id perferendis quia.', 1, '2017-11-03 09:10:54'),
(6, 2, 1, 'Eos et quo aut doloremque. Aliquam aut occaecati minima quaerat.', 1, '2017-11-03 09:10:54'),
(7, 3, 2, 'Qui sunt dolorem quia et et. Vel omnis est et suscipit at. Sit nemo expedita et odit et.', 0, '2017-11-03 09:10:54'),
(8, 1, 1, 'Excepturi sed error excepturi possimus eum vitae. Error ab at vitae nemo vitae autem neque.', 0, '2017-11-03 09:10:54'),
(9, 3, 2, 'Non minima similique corporis et. Sit et ea sed deserunt commodi mollitia voluptatibus.', 1, '2017-11-03 09:10:54'),
(10, 2, 1, 'Qui quia tempora laboriosam. Eaque quos ut eum ad magni. Sint sit fuga iusto quo quas sit.', 0, '2017-11-03 09:10:54'),
(11, 3, 2, 'Dolores labore distinctio consectetur et. Quis ad voluptatibus molestiae recusandae eum.', 1, '2017-11-03 09:10:54'),
(12, 1, 2, 'At illo totam quasi veritatis nesciunt explicabo repellat. Repellendus sit harum libero qui alias.', 0, '2017-11-03 09:10:54'),
(13, 2, 1, 'Nisi omnis laudantium voluptas molestiae numquam nisi. Vel ut ea aut et quas.', 0, '2017-11-03 09:10:54'),
(14, 1, 2, 'Magnam tempore beatae illo voluptatem minus ab aperiam. Aperiam quasi ab praesentium et aut.', 0, '2017-11-03 09:10:54'),
(15, 4, 2, 'Corporis placeat eligendi earum tempore sequi quod. Dolor repellendus quaerat odio tempore.', 0, '2017-11-03 09:10:54'),
(16, 4, 1, 'Iste fugit rem esse dolores autem soluta. Sed illum dolore iure quia architecto.', 0, '2017-11-03 09:10:54'),
(17, 4, 2, 'Enim aut ut fugit sed unde eligendi. Aspernatur sunt laborum numquam.', 0, '2017-11-03 09:10:54'),
(18, 4, 2, 'Ipsa natus ut commodi dolore esse aut. Eius quia tenetur ullam laudantium dicta est.', 0, '2017-11-03 09:10:54'),
(19, 4, 2, 'Id praesentium aliquam voluptatem autem. Et veniam nihil dolor minus error cumque.', 1, '2017-11-03 09:10:54'),
(20, 2, 1, 'Et minima fugit quia alias architecto. Quae omnis nemo suscipit.', 1, '2017-11-03 09:10:54'),
(21, 1, 2, 'Laborum omnis omnis quaerat laborum et soluta quo. Et quia et ut cum quos. Soluta soluta rem sed.', 1, '2017-11-03 09:10:54'),
(22, 2, 2, 'Ut veritatis eius impedit et deleniti fugit. Repellat sint harum accusamus vel sapiente quo.', 1, '2017-11-03 09:10:54'),
(23, 3, 2, 'Dolores pariatur ut non veniam possimus rerum voluptatum. Sed soluta nulla ad necessitatibus in et.', 1, '2017-11-03 09:10:54'),
(24, 3, 1, 'Sint eum et natus aut sit. Non quidem atque quis odio porro voluptatem cumque.', 1, '2017-11-03 09:10:54'),
(25, 4, 1, 'Et ut quod cumque. Fugit fuga ab in quisquam. Et omnis voluptatem qui suscipit quisquam numquam.', 1, '2017-11-03 09:10:54'),
(26, 3, 1, 'Velit dolores adipisci autem doloribus aut. In fuga minus quaerat et et.', 1, '2017-11-03 09:10:54'),
(27, 3, 1, 'Est doloremque quibusdam consectetur. Nihil dolorum error consequatur fugiat corrupti soluta.', 1, '2017-11-03 09:10:54'),
(28, 4, 2, 'Explicabo enim nesciunt vitae qui. Ut ea voluptas consectetur velit. Illum error nulla magni dicta.', 1, '2017-11-03 09:10:54'),
(29, 1, 1, 'Dolorem iure perferendis non ut dolorum totam. Ut aspernatur aut aut ea.', 1, '2017-11-03 09:10:54'),
(30, 4, 2, 'Voluptatibus qui qui maiores sapiente animi. Odit quasi eligendi possimus architecto commodi.', 1, '2017-11-03 09:10:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`hashed`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
