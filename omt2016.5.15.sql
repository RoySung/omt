-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016 �?05 ??15 ??10:36
-- 伺服器版本: 5.6.17
-- PHP 版本： 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `omt`
--

-- --------------------------------------------------------

--
-- 資料表結構 `omt_admin`
--

CREATE TABLE IF NOT EXISTS `omt_admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 資料表的匯出資料 `omt_admin`
--

INSERT INTO `omt_admin` (`a_id`, `account`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_discount`
--

CREATE TABLE IF NOT EXISTS `omt_discount` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(10) NOT NULL,
  `type_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `enable` tinyint(4) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `omt_discount`
--

INSERT INTO `omt_discount` (`d_id`, `type`, `type_name`, `discount`, `m_id`, `start_date`, `end_date`, `enable`) VALUES
(1, 1, '飲料', 10, 12, '2015-10-20', '2015-10-30', 1),
(2, 1, '飲料', 10, 12, '2015-10-20', '2015-10-30', 1),
(3, 1, '飲料', 10, 12, '2015-10-20', '2015-10-30', 1),
(4, 1, '飲料', 5, 1, '2016-04-18', '2016-04-30', 0);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_discountview`
--
CREATE TABLE IF NOT EXISTS `omt_discountview` (
`start_date` date
,`end_date` date
,`discount` int(11)
,`email` varchar(20)
,`password` varchar(20)
,`name` varchar(10)
,`birthday` date
,`phone` varchar(20)
,`cash` int(5)
,`build_date` date
,`uid` varchar(255)
,`m_id` int(11)
,`d_id` int(11)
,`enable` tinyint(4)
,`type_name` varchar(10)
);
-- --------------------------------------------------------

--
-- 資料表結構 `omt_food`
--

CREATE TABLE IF NOT EXISTS `omt_food` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `food` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 資料表的匯出資料 `omt_food`
--

INSERT INTO `omt_food` (`f_id`, `food`, `type`, `type_name`, `price`, `size`) VALUES
(1, '紅茶', 1, '飲料', 30, 'L'),
(2, '紅茶', 1, '飲料', 20, 'M'),
(3, '可樂', 1, '飲料', 40, 'L'),
(4, '可樂', 1, '飲料', 30, 'M'),
(5, '咖啡', 1, '飲料', 45, 'L'),
(6, '咖啡', 1, '飲料', 35, 'M'),
(7, '米花', 2, '食物', 60, 'L'),
(8, '米花', 2, '食物', 50, 'M'),
(9, '薯條', 2, '食物', 50, 'L'),
(10, '薯條', 2, '食物', 40, 'M'),
(11, '薯條+可樂', 3, '套餐', 70, 'L'),
(12, '米花+紅茶', 3, '套餐', 70, 'L');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_member`
--

CREATE TABLE IF NOT EXISTS `omt_member` (
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cash` int(5) NOT NULL,
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `build_date` date NOT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- 資料表的匯出資料 `omt_member`
--

INSERT INTO `omt_member` (`email`, `password`, `name`, `birthday`, `phone`, `cash`, `m_id`, `build_date`, `uid`) VALUES
('admin@aa.bb', '123456', '羅于菌', '1993-10-01', '0984512657', 3920, 1, '2015-10-31', '03315CBD'),
('admin@a.a', '123456', '張阿俊', '1993-12-28', '0123456', 4420, 2, '2016-03-22', '9E6BD9F6'),
('user@aa.bb', '1234567', '謝仁堡', '1994-10-20', '091234567', 49460, 12, '2015-10-31', '0CB64345');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_movie`
--

CREATE TABLE IF NOT EXISTS `omt_movie` (
  `mo_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(20) NOT NULL,
  `movie_type` varchar(20) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `film_length` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `grade` int(11) NOT NULL,
  `film_type` int(11) NOT NULL,
  PRIMARY KEY (`mo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 資料表的匯出資料 `omt_movie`
--

INSERT INTO `omt_movie` (`mo_id`, `movie_name`, `movie_type`, `synopsis`, `video`, `film_length`, `start_date`, `end_date`, `grade`, `film_type`) VALUES
(1, '多拉A夢', '動畫', '故事描述一位住在日本東京郊外，無論讀書、體育、藝術，各方面都比別人差的少年 - 野比大雄。有一天，大雄的子孫 世修 和 哆啦A夢 從二十二世紀一同搭乘時光機到來...', 'https://www.youtube.com/embed/Syzb9-NDBh4', 95, '2016-03-30', '2016-04-05', 5, 1),
(2, '火影忍者', '動畫', '在即將舉辦冬季慶典的木葉忍者村中，雛田悄悄織了一條滿是自己心意的圍巾，卻苦無機會讓對方知道她的心意，不由自主得開始討厭起這樣的自己...', 'https://www.youtube.com/embed/yIIqFjs3ooE', 112, '2016-03-30', '2016-04-09', 18, 1),
(3, '復仇者聯盟', '動作', '美國隊長自冰獄中甦醒，而邪惡勢力也悄悄集結，力量龐大到極為驚人的地步，已非單一超級英雄就能解決。為了保護地球的安危...', 'https://www.youtube.com/embed/k1cbhqBcL-E', 142, '2016-03-29', '2016-04-22', 0, 1),
(4, '侏儸紀公園', '冒險、劇情', '你可以想像恐龍的長相、動作和叫聲，而不想到《侏羅紀公園》嗎？它不只是一部電影，更是我們所有人共同的記憶...', 'https://www.youtube.com/embed/NVoIIT6MC9o', 125, '2016-03-28', '2016-04-08', 0, 1),
(5, '露西', '動作、劇情', '描述一名住在台灣的年輕女子露西，被迫幫黑幫王老大工作，成為運毒工具。但她某次無意中吸入大量的實驗藥物，反而強化了她的腦部功能，讓她擁有超乎常人的感知力。', 'https://www.youtube.com/embed/IhmMFyuInq4', 90, '2016-03-18', '2016-04-07', 4, 1),
(6, '忍者龜', '喜劇、冒險', '犯罪、暴力及恐懼，已經失控，新的英雄即將崛起。\r\n在曼哈頓的下水道住著四隻接受嚴格訓練的忍者龜，分別是達文西、拉斐爾、米開朗基羅和多納太羅以及他們的師父史林特，將聯手對抗邪惡勢力...', 'https://www.youtube.com/embed/-qUmWQY5Zk0', 101, '2016-04-22', '2016-05-11', 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `omt_moviegrade`
--

CREATE TABLE IF NOT EXISTS `omt_moviegrade` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `mo_id` int(11) NOT NULL,
  `grade` int(100) DEFAULT NULL,
  `grade_date` date NOT NULL,
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 資料表的匯出資料 `omt_moviegrade`
--

INSERT INTO `omt_moviegrade` (`mg_id`, `m_id`, `mo_id`, `grade`, `grade_date`) VALUES
(0, 1, 1, 0, '2016-05-10'),
(1, 1, 2, 1, '2016-05-10'),
(2, 1, 3, 5, '2016-05-10'),
(3, 1, 4, 4, '2016-05-10'),
(4, 1, 5, 5, '2016-05-10'),
(5, 1, 6, NULL, '0000-00-00'),
(6, 2, 1, 1, '2016-05-10'),
(7, 2, 2, 5, '2016-05-10'),
(8, 2, 3, 1, '2016-05-10'),
(9, 2, 4, NULL, '0000-00-00'),
(10, 2, 5, 2, '2016-05-10'),
(11, 2, 6, NULL, '0000-00-00'),
(12, 12, 1, 1, '2016-05-10'),
(13, 12, 2, NULL, '0000-00-00'),
(14, 12, 3, NULL, '0000-00-00'),
(15, 12, 4, NULL, '0000-00-00'),
(16, 12, 5, 2, '2016-05-10'),
(17, 12, 6, NULL, '0000-00-00'),
(22, 2, 2, 0, '2016-05-14'),
(23, 3, 7, 0, '2016-05-15'),
(24, 1, 7, 3, '2016-05-15'),
(25, 3, 5, 5, '2016-05-15');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_moviegradeview`
--
CREATE TABLE IF NOT EXISTS `omt_moviegradeview` (
`mg_id` int(11)
,`m_id` int(11)
,`mo_id` int(11)
,`grade` int(100)
,`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`film_type` int(11)
,`email` varchar(20)
,`password` varchar(20)
,`name` varchar(10)
,`birthday` date
,`phone` varchar(20)
,`cash` int(5)
,`build_date` date
,`uid` varchar(255)
,`grade_date` date
);
-- --------------------------------------------------------

--
-- 資料表結構 `omt_news`
--

CREATE TABLE IF NOT EXISTS `omt_news` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- 資料表的匯出資料 `omt_news`
--

INSERT INTO `omt_news` (`n_id`, `title`, `content`, `date`) VALUES
(0, ' 103-2暑期多益英語證照班密集訓練課程', 'http://www.nutc.edu.tw/bin/index.php?Plugin=o_nutc', '2015-06-06'),
(1, '維護公告(已開啟)6/3(三)10:00~13:00全伺服器例行維護公告20', 'http://www.nutc.edu.tw/bin/index.php?Plugin=o_nutc', '2015-06-02'),
(2, '103學年度日間部應屆畢業生領取學位證書時程表', 'http://www.nutc.edu.tw/bin/index.php?Plugin=o_nutc', '2015-06-03'),
(3, '103學年度日間部應屆畢業生領取學位證書時程表', 'http://www.nutc.edu.tw/bin/index.php?Plugin=o_nutc', '2015-06-04'),
(4, '[HD] No Game No Life - Opening [ Full ]', 'https://www.youtube.com/watch?v=6lQF5JlZOno', '2015-06-07'),
(5, '罪惡王冠', 'https://www.youtube.com/watch?v=wUqDGkpRVkM', '2015-06-06'),
(6, '維護公告(已開啟)6/3(三)10:00~13:00全伺服器例行維護公告2015-06-02 維護公告(已開啟)5/29(五)10:10-11:10全伺服器臨時維護公告2015-05-29 維護公告(', 'http://www.nutc.edu.tw/bin/home.php', '2015-06-01'),
(7, 'Destroy a PHP Session', 'http://www.w3schools.com/php/php_sessions.asp', '2015-06-07'),
(8, '巴哈姆特', 'http://www.gamer.com.tw/', '2015-06-08');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_orderfood`
--

CREATE TABLE IF NOT EXISTS `omt_orderfood` (
  `of_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(100) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `food_cost` int(11) NOT NULL,
  `food_orderdate` date NOT NULL,
  `food_size` varchar(11) NOT NULL,
  `ot_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `discount_money` int(5) NOT NULL,
  PRIMARY KEY (`of_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 資料表的匯出資料 `omt_orderfood`
--

INSERT INTO `omt_orderfood` (`of_id`, `food_name`, `food_quantity`, `food_cost`, `food_orderdate`, `food_size`, `ot_id`, `f_id`, `discount_money`) VALUES
(2, '米花', 10, 100, '2016-03-31', 'L', 9, 7, 0),
(8, '米花', 1, 60, '2016-04-13', 'L', 8, 7, 0),
(9, '米花', 1, 60, '2016-04-13', 'L', 8, 7, 0),
(10, '米花', 1, 60, '2016-04-13', 'L', 8, 7, 0),
(12, '紅茶', 1, 20, '2016-04-19', 'M', 8, 2, 0),
(13, '紅茶', 2, 40, '2016-04-19', 'M', 10, 2, 0),
(14, '薯條+可樂', 2, 140, '2016-05-10', 'L', 10, 11, 0),
(15, '薯條+可樂', 2, 140, '2016-04-26', 'L', 8, 11, 0),
(16, '紅茶', 2, 60, '2016-04-26', 'L', 25, 1, 0),
(17, '米花', 2, 120, '2016-04-26', 'L', 24, 7, 0),
(18, '紅茶', 3, 40, '2016-04-26', 'M', 24, 2, 0),
(19, '', 1, 1, '2016-05-11', '', 24, 2, 0),
(20, '', 2, 40, '0000-00-00', '', 24, 2, 0),
(21, '', 1, 1, '0000-00-00', '', 24, 1, 0),
(22, '', 1, 1, '2016-05-14', '', 24, 1, 0),
(23, '', 2, 0, '2016-05-14', '', 2, 2, 0),
(24, '', 2, 0, '2016-05-14', '', 24, 2, 0),
(25, '', 22, 2, '2016-05-14', '', 24, 2, 0),
(26, '', 2, 2, '2016-05-14', '', 24, 2, 0),
(27, '', 2, 2, '2016-05-14', '', 24, 2, 0),
(28, '', 2, 2, '2016-05-14', '', 24, 2, 0);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_orderfoodview`
--
CREATE TABLE IF NOT EXISTS `omt_orderfoodview` (
`of_id` int(11)
,`food_name` varchar(100)
,`food_quantity` int(11)
,`food_cost` int(11)
,`food_orderdate` date
,`food_size` varchar(11)
,`ot_id` int(11)
,`s_id` int(11)
,`seat` varchar(100)
,`quantity` int(11)
,`enable` tinyint(4)
,`m_id` int(11)
,`cost` int(11)
,`order_date` date
,`email` varchar(20)
,`password` varchar(20)
,`name` varchar(10)
,`birthday` date
,`phone` varchar(20)
,`cash` int(5)
,`build_date` date
,`uid` varchar(255)
,`t_id` int(11)
,`time` time
,`mo_id` int(11)
,`date` date
,`hall` varchar(20)
,`theater_name` varchar(20)
,`address` varchar(255)
,`description` varchar(255)
,`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`grade` int(11)
,`film_type` int(11)
,`f_id` int(11)
,`food` varchar(20)
,`type` int(11)
,`price` int(11)
,`size` varchar(10)
,`type_name` varchar(100)
);
-- --------------------------------------------------------

--
-- 資料表結構 `omt_orderticket`
--

CREATE TABLE IF NOT EXISTS `omt_orderticket` (
  `ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `seat` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `m_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`ot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 資料表的匯出資料 `omt_orderticket`
--

INSERT INTO `omt_orderticket` (`ot_id`, `s_id`, `seat`, `quantity`, `enable`, `m_id`, `cost`, `order_date`) VALUES
(9, 3, 'I5-I6-I7', 3, 1, 2, 540, '2016-03-30'),
(10, 6, 'F5-F6', 2, 1, 1, 360, '2016-03-30'),
(23, 0, '2', 2, 2, 0, 2, '0000-00-00'),
(24, 2, 'H3-H4', 2, 1, 12, 360, '2016-04-26'),
(25, 11, 'D4-D5-D6-D3', 4, 1, 1, 800, '2016-04-26'),
(26, 3, 'A5-B5-C5', 3, 1, 1, 540, '2016-04-29'),
(27, 1, 'A', 2, 1, 1, 200, '2016-05-05'),
(28, 20, 'A5', 2, 1, 12, 0, '2016-01-14'),
(29, 20, 'A2', 1, 1, 12, 0, '2016-01-01'),
(30, 25, 'BB', 1, 1, 2, 0, '2016-01-14'),
(31, 1, '1', 0, 1, 1, 1, '0000-00-00'),
(32, 1, 'A1-A2-A3', 4, 1, 1, 720, '0000-00-00'),
(34, 1, 'A1-A2', 2, 2, 2, 0, '0000-00-00'),
(35, 1, 'A1-A2', 2, 1, 2, 360, '2016-05-15'),
(36, 2, 'B1-B2', 2, 1, 2, 360, '2016-05-15');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_orderticketview`
--
CREATE TABLE IF NOT EXISTS `omt_orderticketview` (
`seat` varchar(100)
,`quantity` int(11)
,`enable` tinyint(4)
,`cost` int(11)
,`order_date` date
,`name` varchar(10)
,`birthday` date
,`phone` varchar(20)
,`ot_id` int(11)
,`email` varchar(20)
,`time` time
,`mo_id` int(11)
,`date` date
,`hall` varchar(20)
,`s_id` int(11)
,`m_id` int(11)
,`t_id` int(11)
,`theater_name` varchar(20)
,`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`grade` int(11)
,`film_type` int(11)
,`price` int(11)
);
-- --------------------------------------------------------

--
-- 資料表結構 `omt_session`
--

CREATE TABLE IF NOT EXISTS `omt_session` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `mo_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hall` varchar(20) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- 資料表的匯出資料 `omt_session`
--

INSERT INTO `omt_session` (`s_id`, `t_id`, `time`, `mo_id`, `date`, `hall`) VALUES
(1, 1, '10:20:00', 1, '2016-03-30', 'A'),
(2, 1, '15:10:00', 1, '2016-03-30', 'A'),
(3, 1, '19:00:00', 1, '2016-03-30', 'A'),
(4, 1, '10:30:00', 2, '2016-03-30', 'A'),
(5, 1, '15:00:00', 2, '2016-03-30', 'A'),
(6, 1, '18:50:00', 2, '2016-03-30', 'A'),
(7, 1, '11:00:00', 3, '2016-03-30', 'A'),
(8, 1, '15:30:00', 3, '2016-03-30', 'A'),
(9, 1, '19:20:00', 3, '2016-03-30', 'A'),
(10, 2, '10:00:00', 1, '2016-03-30', 'A'),
(11, 2, '15:30:00', 1, '2016-03-30', 'A'),
(12, 2, '19:00:00', 1, '2016-03-30', 'A'),
(13, 2, '10:30:00', 2, '2016-03-30', 'A'),
(14, 2, '15:00:00', 2, '2016-03-30', 'A'),
(15, 2, '18:30:00', 2, '2016-03-30', 'A'),
(16, 2, '11:00:00', 4, '2016-03-30', 'A'),
(17, 2, '15:30:00', 4, '2016-03-30', 'A'),
(18, 2, '19:00:00', 4, '2016-03-30', 'A'),
(19, 3, '11:00:00', 2, '2016-03-30', 'A'),
(20, 3, '15:20:00', 2, '2016-03-30', 'A'),
(21, 3, '10:30:00', 3, '2016-03-30', 'A'),
(22, 3, '15:00:00', 3, '2016-03-30', 'A'),
(23, 3, '18:30:00', 3, '2016-03-30', 'A'),
(24, 3, '11:00:00', 4, '2016-03-30', 'A'),
(25, 3, '15:30:00', 4, '2016-03-30', 'A'),
(26, 3, '19:30:00', 4, '2015-11-01', 'A'),
(27, 1, '10:20:00', 1, '2015-11-01', 'A'),
(28, 1, '15:10:00', 1, '2015-11-01', 'A'),
(29, 1, '19:00:00', 1, '2015-11-01', 'A'),
(30, 1, '10:30:00', 2, '2015-11-01', 'A'),
(31, 1, '15:00:00', 2, '2015-11-01', 'A'),
(32, 1, '18:50:00', 2, '2015-11-01', 'A'),
(33, 1, '11:00:00', 3, '2015-11-01', 'A'),
(34, 1, '19:20:00', 3, '2015-11-01', 'A'),
(35, 2, '10:00:00', 1, '2015-11-01', 'A'),
(36, 2, '15:30:00', 1, '2015-11-01', 'A'),
(37, 2, '10:30:00', 2, '2015-11-01', 'A'),
(38, 2, '15:00:00', 2, '2015-11-01', 'A'),
(39, 2, '18:30:00', 2, '2015-11-01', 'A'),
(40, 2, '11:00:00', 4, '2015-11-01', 'A'),
(41, 2, '15:30:00', 4, '2015-11-01', 'A'),
(42, 2, '19:00:00', 4, '2015-11-01', 'A'),
(43, 3, '10:00:00', 2, '2015-11-01', 'A'),
(44, 3, '15:30:00', 2, '2015-11-01', 'A'),
(45, 3, '19:00:00', 2, '2015-11-01', 'A'),
(46, 3, '10:30:00', 3, '2015-11-01', 'A'),
(47, 3, '15:00:00', 3, '2015-11-01', 'A'),
(48, 3, '18:50:00', 3, '2015-11-01', 'A'),
(49, 3, '11:00:00', 4, '2015-11-01', 'A'),
(50, 3, '15:30:00', 4, '2015-11-01', 'A'),
(51, 0, '00:00:00', 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_sessionview`
--
CREATE TABLE IF NOT EXISTS `omt_sessionview` (
`t_id` int(11)
,`time` time
,`mo_id` int(11)
,`date` date
,`hall` varchar(20)
,`s_id` int(11)
,`theater_name` varchar(20)
,`address` varchar(255)
,`description` varchar(255)
,`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`grade` int(11)
,`film_type` int(11)
,`price` int(11)
);
-- --------------------------------------------------------

--
-- 資料表結構 `omt_theater`
--

CREATE TABLE IF NOT EXISTS `omt_theater` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_name` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `omt_theater`
--

INSERT INTO `omt_theater` (`t_id`, `theater_name`, `address`, `description`) VALUES
(1, '台中大遠百威秀影城', '台中市西屯區台中港路二段105號13樓', '威秀影城團隊在台中大遠百威秀影城，斥資重金打造數位IMAX影廳，將帶給影迷們最無以倫比的觀影體驗，讓台中市的影迷感受國際級一流電影品質，絕對能滿足每一位對視聽品質超堅持的發燒友！ 台中大遠百威秀數位IMAX影廳，邀您親自感受身歷其境般的震撼效果！'),
(2, '台中新時代威秀影城', '台中市東區復興路四段186號4-5樓', '台中新時代威秀影城內設有輕食吧，提供觀影民眾美味便利的美式食物與飲品；結合精心設計的室內規劃及造景，讓來到台中新時代威秀影城的觀眾猶如置身於電影世界中，充分放鬆、盡情享受美式休閒娛樂的精髓。'),
(3, '台中新光影城', '台中市西屯區台灣大道三段301號13樓', '台中新光影城位於臺灣大道旁新光三越台中中港店之頂部樓層13至14樓，售票亭設於百貨正門右側與13樓影城大廳。\n台中新光影城採用杜比SRD.DTS.及SONY最新穎的SDDS8聲道音響，另有JBL戲院專用三音路揚聲器及QSC數位擴大機。');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_ticketprice`
--

CREATE TABLE IF NOT EXISTS `omt_ticketprice` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `mo_id` int(11) NOT NULL,
  PRIMARY KEY (`tp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 資料表的匯出資料 `omt_ticketprice`
--

INSERT INTO `omt_ticketprice` (`tp_id`, `t_id`, `type`, `price`, `mo_id`) VALUES
(1, 1, 1, 180, 1),
(2, 1, 1, 180, 2),
(3, 1, 1, 180, 3),
(4, 2, 1, 200, 1),
(5, 2, 1, 200, 2),
(6, 2, 1, 200, 4),
(7, 3, 1, 230, 2),
(8, 3, 1, 230, 4),
(9, 3, 1, 230, 3);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `omt_ticketpriceview`
--
CREATE TABLE IF NOT EXISTS `omt_ticketpriceview` (
`t_id` int(11)
,`type` int(11)
,`price` int(11)
,`mo_id` int(11)
,`theater_name` varchar(20)
,`address` varchar(255)
,`description` varchar(255)
,`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`grade` int(11)
,`film_type` int(11)
,`tp_id` int(11)
);
-- --------------------------------------------------------

--
-- 檢視表結構 `omt_discountview`
--
DROP TABLE IF EXISTS `omt_discountview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_discountview` AS select `omt_discount`.`start_date` AS `start_date`,`omt_discount`.`end_date` AS `end_date`,`omt_discount`.`discount` AS `discount`,`omt_member`.`email` AS `email`,`omt_member`.`password` AS `password`,`omt_member`.`name` AS `name`,`omt_member`.`birthday` AS `birthday`,`omt_member`.`phone` AS `phone`,`omt_member`.`cash` AS `cash`,`omt_member`.`build_date` AS `build_date`,`omt_member`.`uid` AS `uid`,`omt_discount`.`m_id` AS `m_id`,`omt_discount`.`d_id` AS `d_id`,`omt_discount`.`enable` AS `enable`,`omt_discount`.`type_name` AS `type_name` from (`omt_discount` join `omt_member` on((`omt_discount`.`m_id` = `omt_member`.`m_id`)));

-- --------------------------------------------------------

--
-- 檢視表結構 `omt_moviegradeview`
--
DROP TABLE IF EXISTS `omt_moviegradeview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_moviegradeview` AS select `omt_moviegrade`.`mg_id` AS `mg_id`,`omt_moviegrade`.`m_id` AS `m_id`,`omt_moviegrade`.`mo_id` AS `mo_id`,`omt_moviegrade`.`grade` AS `grade`,`omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`film_type` AS `film_type`,`omt_member`.`email` AS `email`,`omt_member`.`password` AS `password`,`omt_member`.`name` AS `name`,`omt_member`.`birthday` AS `birthday`,`omt_member`.`phone` AS `phone`,`omt_member`.`cash` AS `cash`,`omt_member`.`build_date` AS `build_date`,`omt_member`.`uid` AS `uid`,`omt_moviegrade`.`grade_date` AS `grade_date` from ((`omt_moviegrade` join `omt_movie` on((`omt_moviegrade`.`mo_id` = `omt_movie`.`mo_id`))) join `omt_member` on((`omt_moviegrade`.`m_id` = `omt_member`.`m_id`)));

-- --------------------------------------------------------

--
-- 檢視表結構 `omt_orderfoodview`
--
DROP TABLE IF EXISTS `omt_orderfoodview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_orderfoodview` AS select `omt_orderfood`.`of_id` AS `of_id`,`omt_orderfood`.`food_name` AS `food_name`,`omt_orderfood`.`food_quantity` AS `food_quantity`,`omt_orderfood`.`food_cost` AS `food_cost`,`omt_orderfood`.`food_orderdate` AS `food_orderdate`,`omt_orderfood`.`food_size` AS `food_size`,`omt_orderfood`.`ot_id` AS `ot_id`,`omt_orderticket`.`s_id` AS `s_id`,`omt_orderticket`.`seat` AS `seat`,`omt_orderticket`.`quantity` AS `quantity`,`omt_orderticket`.`enable` AS `enable`,`omt_orderticket`.`m_id` AS `m_id`,`omt_orderticket`.`cost` AS `cost`,`omt_orderticket`.`order_date` AS `order_date`,`omt_member`.`email` AS `email`,`omt_member`.`password` AS `password`,`omt_member`.`name` AS `name`,`omt_member`.`birthday` AS `birthday`,`omt_member`.`phone` AS `phone`,`omt_member`.`cash` AS `cash`,`omt_member`.`build_date` AS `build_date`,`omt_member`.`uid` AS `uid`,`omt_session`.`t_id` AS `t_id`,`omt_session`.`time` AS `time`,`omt_session`.`mo_id` AS `mo_id`,`omt_session`.`date` AS `date`,`omt_session`.`hall` AS `hall`,`omt_theater`.`theater_name` AS `theater_name`,`omt_theater`.`address` AS `address`,`omt_theater`.`description` AS `description`,`omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`grade` AS `grade`,`omt_movie`.`film_type` AS `film_type`,`omt_orderfood`.`f_id` AS `f_id`,`omt_food`.`food` AS `food`,`omt_food`.`type` AS `type`,`omt_food`.`price` AS `price`,`omt_food`.`size` AS `size`,`omt_food`.`type_name` AS `type_name` from ((((((`omt_orderfood` join `omt_orderticket` on((`omt_orderfood`.`ot_id` = `omt_orderticket`.`ot_id`))) join `omt_member` on((`omt_orderticket`.`m_id` = `omt_member`.`m_id`))) join `omt_session` on((`omt_orderticket`.`s_id` = `omt_session`.`s_id`))) join `omt_theater` on((`omt_session`.`t_id` = `omt_theater`.`t_id`))) join `omt_movie` on((`omt_session`.`mo_id` = `omt_movie`.`mo_id`))) join `omt_food` on((`omt_orderfood`.`f_id` = `omt_food`.`f_id`)));

-- --------------------------------------------------------

--
-- 檢視表結構 `omt_orderticketview`
--
DROP TABLE IF EXISTS `omt_orderticketview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_orderticketview` AS select `omt_orderticket`.`seat` AS `seat`,`omt_orderticket`.`quantity` AS `quantity`,`omt_orderticket`.`enable` AS `enable`,`omt_orderticket`.`cost` AS `cost`,`omt_orderticket`.`order_date` AS `order_date`,`omt_member`.`name` AS `name`,`omt_member`.`birthday` AS `birthday`,`omt_member`.`phone` AS `phone`,`omt_orderticket`.`ot_id` AS `ot_id`,`omt_member`.`email` AS `email`,`omt_session`.`time` AS `time`,`omt_session`.`mo_id` AS `mo_id`,`omt_session`.`date` AS `date`,`omt_session`.`hall` AS `hall`,`omt_orderticket`.`s_id` AS `s_id`,`omt_orderticket`.`m_id` AS `m_id`,`omt_session`.`t_id` AS `t_id`,`omt_theater`.`theater_name` AS `theater_name`,`omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`grade` AS `grade`,`omt_movie`.`film_type` AS `film_type`,`omt_ticketprice`.`price` AS `price` from (((((`omt_orderticket` join `omt_member` on((`omt_orderticket`.`m_id` = `omt_member`.`m_id`))) join `omt_session` on((`omt_orderticket`.`s_id` = `omt_session`.`s_id`))) join `omt_theater` on((`omt_session`.`t_id` = `omt_theater`.`t_id`))) join `omt_movie` on((`omt_session`.`mo_id` = `omt_movie`.`mo_id`))) join `omt_ticketprice` on(((`omt_theater`.`t_id` = `omt_ticketprice`.`t_id`) and (`omt_session`.`mo_id` = `omt_ticketprice`.`mo_id`))));

-- --------------------------------------------------------

--
-- 檢視表結構 `omt_sessionview`
--
DROP TABLE IF EXISTS `omt_sessionview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_sessionview` AS select `omt_session`.`t_id` AS `t_id`,`omt_session`.`time` AS `time`,`omt_session`.`mo_id` AS `mo_id`,`omt_session`.`date` AS `date`,`omt_session`.`hall` AS `hall`,`omt_session`.`s_id` AS `s_id`,`omt_theater`.`theater_name` AS `theater_name`,`omt_theater`.`address` AS `address`,`omt_theater`.`description` AS `description`,`omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`grade` AS `grade`,`omt_movie`.`film_type` AS `film_type`,`omt_ticketprice`.`price` AS `price` from (((`omt_session` join `omt_theater` on((`omt_session`.`t_id` = `omt_theater`.`t_id`))) join `omt_movie` on((`omt_session`.`mo_id` = `omt_movie`.`mo_id`))) join `omt_ticketprice` on(((`omt_session`.`t_id` = `omt_ticketprice`.`t_id`) and (`omt_session`.`mo_id` = `omt_ticketprice`.`mo_id`))));

-- --------------------------------------------------------

--
-- 檢視表結構 `omt_ticketpriceview`
--
DROP TABLE IF EXISTS `omt_ticketpriceview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omt_ticketpriceview` AS select `omt_ticketprice`.`t_id` AS `t_id`,`omt_ticketprice`.`type` AS `type`,`omt_ticketprice`.`price` AS `price`,`omt_ticketprice`.`mo_id` AS `mo_id`,`omt_theater`.`theater_name` AS `theater_name`,`omt_theater`.`address` AS `address`,`omt_theater`.`description` AS `description`,`omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`grade` AS `grade`,`omt_movie`.`film_type` AS `film_type`,`omt_ticketprice`.`tp_id` AS `tp_id` from ((`omt_ticketprice` join `omt_theater` on((`omt_ticketprice`.`t_id` = `omt_theater`.`t_id`))) join `omt_movie` on((`omt_ticketprice`.`mo_id` = `omt_movie`.`mo_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
