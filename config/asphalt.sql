-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 07:05 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asphalt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`) VALUES
(1, 'asphalt', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adverts`
--

CREATE TABLE IF NOT EXISTS `tbl_adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_adverts`
--

INSERT INTO `tbl_adverts` (`id`, `image`) VALUES
(2, 'adverts/9535bfe4af.jpg'),
(3, 'adverts/1fbf4d7c96.jpg'),
(4, 'adverts/34cf08cc91.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(70) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `catId`, `title`, `author`, `body`, `image`, `date`, `views`) VALUES
(1, 1, 'Step By Step Approach To Programming For Starters', 'Asifat Kazeem', '&lt;p&gt;Programming is a skill, and it''s incredibly difficult to master. Don''t expect to become proficient overnight. In programming, a little knowledge can go a long way.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;As a novice developer starting now. For example, a web developer,&amp;nbsp; there''s a lot more you need to know before you can publish a website. You need a much broader understanding of programming concepts before you can do anything useful.&lt;/p&gt;\r\n&lt;p&gt;Read carefully the following steps to help you become a good programmer.&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;span class=&quot;example1&quot;&gt;&lt;strong&gt;One Step At A Time&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;Programming concepts build on top of each other. For the most part, you need to learn the earlier concepts before you can move to the next one. If you try to move too fast, you will get needlessly confused and make it more difficult for yourself.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;When you''re starting out, you will end up writing a lot of code, trying to fit it into what you''ve done before and gradually build a monster and you won''t really understand what the code is doing. It will become unworkable and you will get fraustrated, and when this happens, take a step back and try to solve the problem in a different way.&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Know The Difference Between Syntax And Concept&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;When you''re learning programming or a particular language, try to understand the concept rather than focusing on the syntax because syntax can be looked up again later when needed but the understanding the underlying concepts is more difficult.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;For example, if you lay much emphasis on the syntax and do not get the concept. You won''t even know how to create a simple arithmetic calculator that deals only with addition, subtraction, multiplication, and division.&lt;/p&gt;\r\n&lt;p&gt;Once you understand the concept of a language and can code proficiently in it, you can get to a reasonable standarf in another language within a few days as the concepts in a language applies to almost any other language. Sure, there are some differences but the fundamental concepts are the same.&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Possible Errors Beginners Make&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;Omitting Semi-colons, commas, full-stop, etc where it is needed. eg &lt;span style=&quot;color: #ff0000;&quot;&gt;Error 1&lt;/span&gt;: $query = &quot;INSERT INTO tbl_sample (name, username, email) VALUES (''$name'', $usr'', ''$email'') - &lt;span style=&quot;color: #ff0000;&quot;&gt;Error 2&lt;/span&gt;:&amp;nbsp;$query = &quot;INSERT INTO tbl_blog (name, username, email) VALUES (''$name'' ''$usr'', ''$email'')&quot; -&lt;span style=&quot;color: #008000;&quot;&gt; Correct Syntax:&lt;/span&gt;&amp;nbsp;&lt;span style=&quot;color: #008000;&quot;&gt;$query = &quot;INSERT INTO tbl_sample (name, username, email) VALUES (''$name'', ''$usr'', ''$email'')&quot;;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;span style=&quot;color: #000000;&quot;&gt;Using single equal to sign &quot;&lt;strong&gt;=&lt;/strong&gt;&quot; instead of double &quot;&lt;strong&gt;==&lt;/strong&gt;&quot; when using comparison operator. Eg: &lt;span style=&quot;color: #ff0000;&quot;&gt;if ($number = 4) {echo &quot;Number is 4&quot;; } wrong&amp;nbsp;&lt;span style=&quot;color: #008080;&quot;&gt;if ($number == 4) {echo &quot;Number is 4&quot;; } Correct!!!&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ol&gt;', 'blog-images/2.jpgwatermarked.jpg', '2018-07-18 12:46:38', 45);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category`) VALUES
(1, 'Programming'),
(2, 'Games'),
(3, '3D Animation'),
(4, 'Science Innovations'),
(5, 'Sci-fi Movies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(256) NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `blog_id`, `name`, `email`, `address`, `body`, `date`) VALUES
(1, 1, 'daniel', 'davidkayode92@gmail.com', '', 'lorem ipsum dolor sit amet fel kkajol.', '2018-08-28 02:42:12'),
(2, 1, 'daniel', 'davidkayode92@gmail.com', '', 'lorem ipsum dolor sit amet fel kkajol.', '2018-08-28 02:45:10'),
(3, 1, 'ja', 'ja@gmail.com', 'Unable to get your current location at the moment', 'jaja', '2018-08-28 04:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folio`
--

CREATE TABLE IF NOT EXISTS `tbl_folio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(70) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_folio`
--

INSERT INTO `tbl_folio` (`id`, `image`, `title`, `link`) VALUES
(1, 'portfolio/8e601c69cc.png', 'Multipurpose Website', 'www.site-demos.000webhostapp.com/demos/multipurpose/index.html'),
(3, 'portfolio/10e2d7a561.png', 'Photography Website', 'www.site-demos.000webhostapp.com/demos/photography/index.html'),
(4, 'portfolio/95e20f9779.png', 'Portfolio Website', 'www.site-demos.000webhostapp.com/demos/cake/index.html'),
(5, 'portfolio/160b13d68b.png', 'Beautiful Animated Login Interface', 'www.site-demos.000webhostapp.com/login/index.html'),
(6, 'portfolio/bb6b92bef8.png', 'E-Commerce Website', 'www.ellegantshop.000webhostapp.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sliderone`
--

CREATE TABLE IF NOT EXISTS `tbl_sliderone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_sliderone`
--

INSERT INTO `tbl_sliderone` (`id`, `image`) VALUES
(2, 'sliders/3590f2a3e8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sliderthree`
--

CREATE TABLE IF NOT EXISTS `tbl_sliderthree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_sliderthree`
--

INSERT INTO `tbl_sliderthree` (`id`, `image`) VALUES
(2, 'sliders/6776b4ae1f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slidertwo`
--

CREATE TABLE IF NOT EXISTS `tbl_slidertwo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_slidertwo`
--

INSERT INTO `tbl_slidertwo` (`id`, `image`) VALUES
(3, 'sliders/66039f64bf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE IF NOT EXISTS `tbl_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`id`, `facebook`, `twitter`, `google`) VALUES
(1, 'facebook.com/Achieverswebdesign', 'twitter.com/Achievers', 'googleplus.com/Achievers');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theme`
--

CREATE TABLE IF NOT EXISTS `tbl_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_theme`
--

INSERT INTO `tbl_theme` (`id`, `theme`) VALUES
(1, 'blue');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
