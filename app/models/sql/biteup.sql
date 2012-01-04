-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2012 年 1 月 04 日 10:22
-- サーバのバージョン: 5.5.9
-- PHP のバージョン: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `biteup`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `feeds`
--

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `job_id` int(11) NOT NULL COMMENT '仕事予定ID',
  `message` varchar(255) DEFAULT NULL COMMENT 'メッセージ',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `feeds`
--

INSERT INTO `feeds` VALUES(1, 5, 1, 'ä»•äº‹ãŒãŠã‚ã£ãŸã€‚ã¤ã‹ã‚ŒãŸã€œ', '2012-01-03 23:55:05', '2012-01-03 23:56:48');
INSERT INTO `feeds` VALUES(2, 8, 2, 'ä»•äº‹çµ‚ã‚ã£ãŸã‹ã‚‰é£²ã¿ã«è¡Œã“ã†ï¼', '2012-01-03 23:55:25', '2012-01-03 23:57:03');

-- --------------------------------------------------------

--
-- テーブルの構造 `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `friend_id` int(11) NOT NULL COMMENT 'フレンドID',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `friends`
--

INSERT INTO `friends` VALUES(3, 5, 8, '2012-01-03 21:12:53', '2012-01-03 21:12:53');
INSERT INTO `friends` VALUES(4, 5, 6, '2012-01-03 21:16:53', '2012-01-03 21:16:53');

-- --------------------------------------------------------

--
-- テーブルの構造 `jobkinds`
--

CREATE TABLE `jobkinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) NOT NULL COMMENT '名前',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータをダンプしています `jobkinds`
--

INSERT INTO `jobkinds` VALUES(1, 'åŠ›ä»•äº‹', '2011-12-28 17:00:20', '2011-12-28 17:00:20');
INSERT INTO `jobkinds` VALUES(2, 'é ­è„³åŠ´åƒ', '2011-12-28 17:00:43', '2011-12-28 17:00:43');
INSERT INTO `jobkinds` VALUES(3, 'ã‚„ã£ã¤ã‘ä»•äº‹', '2011-12-28 17:00:50', '2011-12-28 17:00:50');

-- --------------------------------------------------------

--
-- テーブルの構造 `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(100) NOT NULL COMMENT '予定名',
  `startdate` date NOT NULL COMMENT '予定日',
  `starttime` time NOT NULL COMMENT '予定開始時間',
  `jobtime` int(11) NOT NULL COMMENT '就業時間',
  `jobkind_id` int(11) NOT NULL COMMENT '業種ID',
  `checkin` datetime DEFAULT NULL COMMENT 'チェックイン日時',
  `checkout` datetime DEFAULT NULL,
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `jobs`
--

INSERT INTO `jobs` VALUES(1, 5, 'ã‚³ãƒ³ãƒ“ãƒ‹ã®ãƒã‚¤ãƒˆ', '2011-12-28', '17:31:00', 4, 2, '2012-01-04 00:14:23', '2012-01-04 00:15:52', '2011-12-28 17:41:24', '2012-01-04 00:25:21');
INSERT INTO `jobs` VALUES(2, 5, 'ãƒ–ãƒ­ãƒƒã‚¯é‹ã³', '2012-01-05', '10:00:00', 7, 1, NULL, NULL, '2011-12-28 17:42:45', '2012-01-04 00:25:29');
INSERT INTO `jobs` VALUES(3, 5, 'ãƒãƒŠãƒŠã®ãŸãŸãå£²ã‚Š', '2012-01-04', '00:19:00', 6, 3, NULL, NULL, '2012-01-04 00:20:18', '2012-01-04 00:20:18');
INSERT INTO `jobs` VALUES(4, 5, 'é“è·¯ã®èˆ—è£…', '2012-01-06', '00:19:00', 8, 1, NULL, NULL, '2012-01-04 00:24:51', '2012-01-04 00:26:37');

-- --------------------------------------------------------

--
-- テーブルの構造 `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID',
  `level` int(11) NOT NULL COMMENT 'レベル',
  `name` varchar(50) NOT NULL COMMENT '名前',
  `limit` int(11) NOT NULL COMMENT 'しきい値',
  `avator` varchar(50) NOT NULL,
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='共通レベル';

--
-- テーブルのデータをダンプしています `levels`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `friend_id` int(11) NOT NULL COMMENT 'フレンドID',
  `job_id` int(11) NOT NULL COMMENT '仕事予定ID',
  `jobkind_id` int(11) NOT NULL COMMENT '業種ID',
  `feed_id` int(11) NOT NULL COMMENT 'フィードID',
  `point` int(11) NOT NULL COMMENT 'ポイント',
  `message` varchar(255) DEFAULT NULL COMMENT 'メッセージ',
  `from` varchar(50) DEFAULT NULL COMMENT '投稿元',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `likes`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) NOT NULL COMMENT 'ユーザー名',
  `password` varchar(100) NOT NULL COMMENT 'パスワード',
  `email` varchar(100) NOT NULL COMMENT 'Eメール',
  `point` int(11) NOT NULL COMMENT 'ポイントの合計',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- テーブルのデータをダンプしています `users`
--

INSERT INTO `users` VALUES(5, 'test', '6804996f2bea2c2ecf8a51692234cce8754e8c7a', 'muraoka@bathtimefish.com', 0, '2012-01-03 15:39:20', '2012-01-03 15:39:20');
INSERT INTO `users` VALUES(6, 'hogehoge', '000cdc7f9f5d8cec146544805024347320742ea5', 'hoge@hoge.com', 0, '2012-01-03 17:08:09', '2012-01-03 17:08:09');
INSERT INTO `users` VALUES(7, 'fugafuga', 'fe05183229c4bcea432cdcdc7476fea2022cb3ce', 'fuga@fuga.com', 0, '2012-01-03 17:08:31', '2012-01-03 17:08:31');
INSERT INTO `users` VALUES(8, 'aaaa', '7aaab682d4bc1324b4295a180401b5891552d4e7', 'aaaa@aaaa.com', 0, '2012-01-03 21:10:05', '2012-01-03 21:10:05');
