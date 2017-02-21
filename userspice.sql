-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 21. úno 2017, 17:43
-- Verze serveru: 5.7.9
-- Verze PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `userspice`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(100) NOT NULL,
  `smtp_server` varchar(100) NOT NULL,
  `smtp_port` int(10) NOT NULL,
  `email_login` varchar(150) NOT NULL,
  `email_pass` varchar(100) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(150) NOT NULL,
  `transport` varchar(255) NOT NULL,
  `verify_url` varchar(255) NOT NULL,
  `email_act` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `email`
--

INSERT INTO `email` (`id`, `website_name`, `smtp_server`, `smtp_port`, `email_login`, `email_pass`, `from_name`, `from_email`, `transport`, `verify_url`, `email_act`) VALUES
(1, 'Talented', 'mail.userspice.com', 587, 'noreply@userspice.com', 'password', 'Your Name', 'noreply@userspice.com', 'tls', 'http://localhost/us4/', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `keys`
--

DROP TABLE IF EXISTS `keys`;
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stripe_ts` varchar(255) NOT NULL,
  `stripe_tp` varchar(255) NOT NULL,
  `stripe_ls` varchar(255) NOT NULL,
  `stripe_lp` varchar(255) NOT NULL,
  `recap_pub` varchar(100) NOT NULL,
  `recap_pri` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) NOT NULL,
  `private` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `pages`
--

INSERT INTO `pages` (`id`, `page`, `private`) VALUES
(1, 'index.php', 0),
(2, 'z_us_root.php', 0),
(3, 'users/account.php', 1),
(4, 'users/admin.php', 1),
(5, 'users/admin_page.php', 1),
(6, 'users/admin_pages.php', 1),
(7, 'users/admin_permission.php', 1),
(8, 'users/admin_permissions.php', 1),
(9, 'users/admin_user.php', 1),
(10, 'users/admin_users.php', 1),
(11, 'users/edit_profile.php', 1),
(12, 'users/email_settings.php', 1),
(13, 'users/email_test.php', 1),
(14, 'users/forgot_password.php', 0),
(15, 'users/forgot_password_reset.php', 0),
(16, 'users/index.php', 0),
(17, 'users/init.php', 0),
(18, 'users/join.php', 0),
(19, 'users/joinThankYou.php', 0),
(20, 'users/login.php', 0),
(21, 'users/logout.php', 0),
(22, 'users/profile.php', 1),
(23, 'users/times.php', 0),
(24, 'users/user_settings.php', 1),
(25, 'users/verify.php', 0),
(26, 'users/verify_resend.php', 0),
(27, 'users/view_all_users.php', 1),
(28, 'usersc/empty.php', 0),
(29, 'usersc/join.php', 0),
(30, 'usersc/user_settings.php', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Struktura tabulky `permission_page_matches`
--

DROP TABLE IF EXISTS `permission_page_matches`;
CREATE TABLE IF NOT EXISTS `permission_page_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(15) NOT NULL,
  `page_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `permission_page_matches`
--

INSERT INTO `permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
(2, 2, 27),
(3, 1, 24),
(4, 1, 22),
(5, 2, 13),
(6, 2, 12),
(7, 1, 11),
(8, 2, 10),
(9, 2, 9),
(10, 2, 8),
(11, 2, 7),
(12, 2, 6),
(13, 2, 5),
(14, 2, 4),
(15, 1, 3),
(16, 1, 30),
(17, 2, 30);

-- --------------------------------------------------------

--
-- Struktura tabulky `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `bio`) VALUES
(1, 1, '<h1>This is the Admin''s bio.</h1>');

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `recaptcha` int(1) NOT NULL DEFAULT '0',
  `force_ssl` int(1) NOT NULL,
  `login_type` varchar(20) NOT NULL,
  `css_sample` int(1) NOT NULL,
  `us_css1` varchar(255) NOT NULL,
  `us_css2` varchar(255) NOT NULL,
  `us_css3` varchar(255) NOT NULL,
  `css1` varchar(255) NOT NULL,
  `css2` varchar(255) NOT NULL,
  `css3` varchar(255) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `language` varchar(255) NOT NULL,
  `track_guest` int(1) NOT NULL,
  `site_offline` int(1) NOT NULL,
  `force_pr` int(1) NOT NULL,
  `reserved1` varchar(100) NOT NULL,
  `reserverd2` varchar(100) NOT NULL,
  `custom1` varchar(100) NOT NULL,
  `custom2` varchar(100) NOT NULL,
  `custom3` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `settings`
--

INSERT INTO `settings` (`id`, `recaptcha`, `force_ssl`, `login_type`, `css_sample`, `us_css1`, `us_css2`, `us_css3`, `css1`, `css2`, `css3`, `site_name`, `language`, `track_guest`, `site_offline`, `force_pr`, `reserved1`, `reserverd2`, `custom1`, `custom2`, `custom3`) VALUES
(1, 0, 0, '', 0, '../users/css/color_schemes/standard.css', '../users/css/sb-admin.css', '../users/css/custom.css', '', '', '', 'Talented', 'cs', 1, 0, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `permissions` int(11) NOT NULL,
  `logins` int(100) NOT NULL,
  `account_owner` tinyint(4) NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL DEFAULT '0',
  `join_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `vericode` varchar(15) NOT NULL,
  `active` int(1) NOT NULL,
  `city` text,
  `school` text,
  `focus` text,
  `activity` text,
  `language` text,
  `certificate` text,
  `edu_opinion` text,
  `born_date` date DEFAULT NULL,
  `avatar_path` text,
  PRIMARY KEY (`id`),
  KEY `EMAIL` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `permissions`, `logins`, `account_owner`, `account_id`, `join_date`, `last_login`, `email_verified`, `vericode`, `active`, `city`, `school`, `focus`, `activity`, `language`, `certificate`, `edu_opinion`, `born_date`, `avatar_path`) VALUES
(1, 'tomasfaikl@seznam.cz', '$2y$12$DQ.9DSISMa6ZsomkxvmofOhRg0ZIZjpdmx/tl.2fu5zhCi51KPoKC', 'Tom&aacute;&scaron;', 'Faikl', 1, 8, 1, 0, '2016-01-01 00:00:00', '2017-02-20 16:31:39', 1, '322418', 1, 'Pardubice', 'Gymn&aacute;zium, Pardubice, Da&scaron;ick&aacute; 1083', 'matematika, fyzika, programov&aacute;n&iacute;, neform&aacute;ln&iacute; vzdÄ›l&aacute;v&aacute;n&iacute;', 'Talented;SOÄŒ;programov&aacute;n&iacute; (web, aplikace pro mobiln&iacute; zaÅ™&iacute;zen&iacute;, fyzik&aacute;ln&iacute; v&yacute;poÄty);organiz&aacute;tor Expedice Mars;', 'angliÄtina_B2;', NULL, NULL, '1998-12-25', 'http://localhost/talented/img/avatars/av_1.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `users_online`
--

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE IF NOT EXISTS `users_online` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `timestamp` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `session` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `users_online`
--

INSERT INTO `users_online` (`id`, `ip`, `timestamp`, `username`, `session`) VALUES
(1, '::1', '1487698967', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `users_session`
--

DROP TABLE IF EXISTS `users_session`;
CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `uagent` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`, `uagent`) VALUES
(38, 1, 'e5c284103ce354831561e3b447d1758976c799922d7e20743e9f8c290dfe078f', 'Mozilla (Windows NT 6.1; Win64; x64) AppleWebKit (KHTML, like Gecko) Chrome Safari'),
(39, 1, 'a4d40d9d2c1dd25a9c524235571673e917e013bd93ee3f1a5125b4a7a461c523', 'Mozilla (Windows NT 6.3; WOW64) AppleWebKit (KHTML, like Gecko) Chrome Safari');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_permission_matches`
--

DROP TABLE IF EXISTS `user_permission_matches`;
CREATE TABLE IF NOT EXISTS `user_permission_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `user_permission_matches`
--

INSERT INTO `user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
(100, 1, 1),
(101, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
