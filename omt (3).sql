-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- 主機: 127.4.23.130:3306
-- 建立日期: 2015 年 10 月 25 日 07:01
-- 伺服器版本: 5.5.45
-- PHP 版本: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `omt`
--

-- --------------------------------------------------------

--
-- 資料表結構 `omt_discount`
--

CREATE TABLE IF NOT EXISTS `omt_discount` (
  `c_id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `enable` tinyint(4) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `omt_food`
--

CREATE TABLE IF NOT EXISTS `omt_food` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `food` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `omt_food`
--

INSERT INTO `omt_food` (`f_id`, `food`, `type`, `price`, `size`) VALUES
(1, '紅茶', '0', 25, 'L'),
(2, '紅茶', '0', 30, 'M'),
(3, '奶茶', '0', 30, 'M'),
(4, '奶茶', '0', 35, 'L'),
(5, '薯條', '1', 25, 'M'),
(6, '薯條', '1', 30, 'L');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- 資料表的匯出資料 `omt_member`
--

INSERT INTO `omt_member` (`email`, `password`, `name`, `birthday`, `phone`, `cash`, `m_id`, `build_date`, `uid`) VALUES
('admin@aa.bb', '123456', '1231', '0000-00-00', '123', 100, 1, '0000-00-00', ''),
('admin@a.a', '123456', '張阿俊', '0000-00-00', '0123456', 400, 2, '0000-00-00', ''),
('admin@a.aa', '123456', '張阿俊', '0000-00-00', '0123456', 0, 3, '0000-00-00', ''),
('admin@a.aaa', '123456', '張阿俊', '0000-00-00', '0123456', 0, 4, '0000-00-00', ''),
('admin@a.aaaaa', '1231231', '123123', '0000-00-00', '1231', 0, 5, '0000-00-00', ''),
('Martin@aa.bb', '123132', '123123', '0000-00-00', '123132', 0, 6, '0000-00-00', ''),
('admin@a.asd', 'd123123', '121231', '0000-00-00', '12313', 0, 7, '0000-00-00', ''),
('admin@a.aaaaaa', '123456', '123', '0000-00-00', '123', 0, 8, '0000-00-00', ''),
('admin@a.abb', '123456', '123456', '0000-00-00', '123', 0, 9, '0000-00-00', ''),
('tttest@abc.com123', '123456', '123', '0000-00-00', '123', 0, 10, '0000-00-00', ''),
('admin@a.aaasasdsa', '123456', '123', '0000-00-00', '123', 0, 11, '0000-00-00', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 資料表的匯出資料 `omt_movie`
--

INSERT INTO `omt_movie` (`mo_id`, `movie_name`, `movie_type`, `synopsis`, `video`, `film_length`, `start_date`, `end_date`, `grade`, `film_type`) VALUES
(1, '多拉A夢', '動畫', '故事描述一位住在日本東京郊外，無論讀書、體育、藝術，各方面都比別人差的少年 - 野比大雄。有一天，大雄的子孫 世修 和 哆啦A夢 從二十二世紀一同搭乘時光機到來...', 'https://www.youtube.com/embed/Syzb9-NDBh4', 95, '2015-10-03', '2015-10-31', 0, 1),
(2, '火影忍者', '動畫', '在即將舉辦冬季慶典的木葉忍者村中，雛田悄悄織了一條滿是自己心意的圍巾，卻苦無機會讓對方知道她的心意，不由自主得開始討厭起這樣的自己...', 'https://www.youtube.com/embed/yIIqFjs3ooE', 112, '2015-10-01', '2015-10-25', 0, 1),
(3, '復仇者聯盟', '動作', '美國隊長自冰獄中甦醒，而邪惡勢力也悄悄集結，力量龐大到極為驚人的地步，已非單一超級英雄就能解決。為了保護地球的安危...', 'https://www.youtube.com/watch?v=k1cbhqBcL-E', 142, '2015-10-10', '2015-11-04', 0, 1),
(4, '侏儸紀公園', '冒險、劇情', '你可以想像恐龍的長相、動作和叫聲，而不想到《侏羅紀公園》嗎？它不只是一部電影，更是我們所有人共同的記憶...', 'https://www.youtube.com/watch?v=NVoIIT6MC9o', 125, '2015-10-15', '2015-11-10', 0, 1),
(5, '忍者龜', '喜劇、冒險', '犯罪、暴力及恐懼，已經失控，新的英雄即將崛起。\r\n在曼哈頓的下水道住著四隻接受嚴格訓練的忍者龜，分別是達文西、拉斐爾、米開朗基羅和多納太羅以及他們的師父史林特，將聯手對抗邪惡勢力...', 'https://www.youtube.com/watch?v=-qUmWQY5Zk0', 101, '2015-10-05', '2015-10-31', 0, 1);

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
-- 資料表結構 `omt_orderticket`
--

CREATE TABLE IF NOT EXISTS `omt_orderticket` (
  `ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `mo_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `seat` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `m_id` int(11) NOT NULL,
  `spending` int(11) NOT NULL,
  PRIMARY KEY (`ot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 資料表的匯出資料 `omt_orderticket`
--

INSERT INTO `omt_orderticket` (`ot_id`, `mo_id`, `s_id`, `seat`, `quantity`, `enable`, `m_id`, `spending`) VALUES
(1, 2, 43, 'I4-I3', 2, 1, 0, 0),
(2, 1, 28, 'I3-I2', 2, 1, 2, 360);

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
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 資料表的匯出資料 `omt_session`
--

INSERT INTO `omt_session` (`s_id`, `t_id`, `time`, `mo_id`, `date`) VALUES
(1, 1, '10:20:00', 1, '2015-10-19'),
(2, 1, '15:10:00', 1, '2015-10-19'),
(3, 1, '19:00:00', 1, '2015-10-19'),
(4, 1, '10:30:00', 2, '2015-10-19'),
(5, 1, '15:00:00', 2, '2015-10-19'),
(6, 1, '18:50:00', 2, '2015-10-19'),
(7, 1, '11:00:00', 3, '2015-10-19'),
(8, 1, '15:30:00', 3, '2015-10-19'),
(9, 1, '19:20:00', 3, '2015-10-19'),
(10, 2, '10:00:00', 1, '2015-10-19'),
(11, 2, '15:30:00', 1, '2015-10-19'),
(12, 2, '19:00:00', 1, '2015-10-19'),
(13, 2, '10:30:00', 2, '2015-10-19'),
(14, 2, '15:00:00', 2, '2015-10-19'),
(15, 2, '18:30:00', 2, '2015-10-19'),
(16, 2, '11:00:00', 4, '2015-10-19'),
(17, 2, '15:30:00', 4, '2015-10-19'),
(18, 2, '19:00:00', 4, '2015-10-19'),
(19, 3, '11:00:00', 2, '2015-10-19'),
(20, 3, '15:20:00', 2, '2015-10-19'),
(21, 3, '10:30:00', 3, '2015-10-19'),
(22, 3, '15:00:00', 3, '2015-10-19'),
(23, 3, '18:30:00', 3, '2015-10-19'),
(24, 3, '11:00:00', 4, '2015-10-19'),
(25, 3, '15:30:00', 4, '2015-10-19'),
(26, 3, '19:30:00', 4, '2015-10-19'),
(27, 1, '10:20:00', 1, '2015-10-19'),
(28, 1, '15:10:00', 1, '2015-10-19'),
(29, 1, '19:00:00', 1, '2015-10-19'),
(30, 1, '10:30:00', 2, '2015-10-19'),
(31, 1, '15:00:00', 2, '2015-10-19'),
(32, 1, '18:50:00', 2, '2015-10-19'),
(33, 1, '11:00:00', 3, '2015-10-19'),
(34, 1, '19:20:00', 3, '2015-10-19'),
(35, 2, '10:00:00', 1, '2015-10-19'),
(36, 2, '15:30:00', 1, '2015-10-19'),
(37, 2, '10:30:00', 2, '2015-10-19'),
(38, 2, '15:00:00', 2, '2015-10-19'),
(39, 2, '18:30:00', 2, '2015-10-19'),
(40, 2, '11:00:00', 4, '2015-10-19'),
(41, 2, '15:30:00', 4, '2015-10-19'),
(42, 2, '19:00:00', 4, '2015-10-19'),
(43, 3, '10:00:00', 2, '2015-10-19'),
(44, 3, '15:30:00', 2, '2015-10-19'),
(45, 3, '19:00:00', 2, '2015-10-19'),
(46, 3, '10:30:00', 3, '2015-10-19'),
(47, 3, '15:00:00', 3, '2015-10-19'),
(48, 3, '18:50:00', 3, '2015-10-19'),
(49, 3, '11:00:00', 4, '2015-10-19'),
(50, 3, '15:30:00', 4, '2015-10-19');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_theater`
--

CREATE TABLE IF NOT EXISTS `omt_theater` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_name` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `theater_img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `omt_theater`
--

INSERT INTO `omt_theater` (`t_id`, `theater_name`, `address`, `theater_img`, `description`) VALUES
(1, '台中大遠百威秀影城', '台中市西屯區台中港路二段105號13樓', '', '威秀影城團隊在台中大遠百威秀影城，斥資重金打造數位IMAX影廳，將帶給影迷們最無以倫比的觀影體驗，讓台中市的影迷感受國際級一流電影品質，絕對能滿足每一位對視聽品質超堅持的發燒友！ \n\n台中大遠百威秀數位IMAX影廳，邀您親自感受身歷其境般的震撼效果！'),
(2, '台中新時代威秀影城', '台中市東區復興路四段186號4-5樓', '', '台中新時代威秀影城內設有輕食吧，提供觀影民眾美味便利的美式食物與飲品；結合精心設計的室內規劃及造景，讓來到台中新時代威秀影城的觀眾猶如置身於電影世界中，充分放鬆、盡情享受美式休閒娛樂的精髓。'),
(3, '台中新光影城', '台中市西屯區台灣大道三段301號13樓', '', '台中新光影城位於臺灣大道旁新光三越台中中港店之頂部樓層13至14樓，售票亭設於百貨正門右側與13樓影城大廳。\n台中新光影城採用杜比SRD.DTS.及SONY最新穎的SDDS8聲道音響，另有JBL戲院專用三音路揚聲器及QSC數位擴大機。');

-- --------------------------------------------------------

--
-- 資料表結構 `omt_ticketprice`
--

CREATE TABLE IF NOT EXISTS `omt_ticketprice` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`tp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `omt_ticketprice`
--

INSERT INTO `omt_ticketprice` (`tp_id`, `t_id`, `type`, `price`) VALUES
(1, 1, 1, 180),
(2, 2, 1, 200),
(3, 3, 1, 230);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `ordertickerview`
--
CREATE TABLE IF NOT EXISTS `ordertickerview` (
`movie_name` varchar(20)
,`movie_type` varchar(20)
,`synopsis` varchar(255)
,`video` varchar(255)
,`film_length` int(11)
,`start_date` date
,`end_date` date
,`grade` int(11)
,`film_type` int(11)
,`ot_id` int(11)
,`mo_id` int(11)
,`s_id` int(11)
,`seat` varchar(100)
,`quantity` int(11)
,`enable` tinyint(4)
,`m_id` int(11)
,`spending` int(11)
,`time` time
,`date` date
,`t_id` int(11)
,`theater_name` varchar(20)
,`address` varchar(255)
,`theater_img` varchar(255)
,`description` varchar(255)
);
-- --------------------------------------------------------

--
-- 檢視表結構 `ordertickerview`
--
DROP TABLE IF EXISTS `ordertickerview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ordertickerview` AS select `omt_movie`.`movie_name` AS `movie_name`,`omt_movie`.`movie_type` AS `movie_type`,`omt_movie`.`synopsis` AS `synopsis`,`omt_movie`.`video` AS `video`,`omt_movie`.`film_length` AS `film_length`,`omt_movie`.`start_date` AS `start_date`,`omt_movie`.`end_date` AS `end_date`,`omt_movie`.`grade` AS `grade`,`omt_movie`.`film_type` AS `film_type`,`omt_orderticket`.`ot_id` AS `ot_id`,`omt_orderticket`.`mo_id` AS `mo_id`,`omt_orderticket`.`s_id` AS `s_id`,`omt_orderticket`.`seat` AS `seat`,`omt_orderticket`.`quantity` AS `quantity`,`omt_orderticket`.`enable` AS `enable`,`omt_orderticket`.`m_id` AS `m_id`,`omt_orderticket`.`spending` AS `spending`,`omt_session`.`time` AS `time`,`omt_session`.`date` AS `date`,`omt_theater`.`t_id` AS `t_id`,`omt_theater`.`theater_name` AS `theater_name`,`omt_theater`.`address` AS `address`,`omt_theater`.`theater_img` AS `theater_img`,`omt_theater`.`description` AS `description` from (((`omt_orderticket` join `omt_movie` on((`omt_movie`.`mo_id` = `omt_orderticket`.`mo_id`))) join `omt_session` on((`omt_session`.`s_id` = `omt_orderticket`.`s_id`))) join `omt_theater` on((`omt_session`.`t_id` = `omt_theater`.`t_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
