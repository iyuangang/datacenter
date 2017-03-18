-- SQL Dump

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shop72hour`
--

-- --------------------------------------------------------

--
-- 表的结构 `shop_cat`
--

CREATE TABLE IF NOT EXISTS `shop_cat` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `catname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catname` (`catname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `shop_content`
--

CREATE TABLE IF NOT EXISTS `shop_content` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `cat` int(8) NOT NULL,
  `date` date NOT NULL,
  `picture` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat` (`cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- 表的结构 `shop_user`
--

CREATE TABLE IF NOT EXISTS `shop_user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 限制导出的表
--

--
-- 限制表 `shop_content`
--
ALTER TABLE `shop_content`
  ADD CONSTRAINT `shop_content_ibfk_1` FOREIGN KEY (`cat`) REFERENCES `shop_cat` (`id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
