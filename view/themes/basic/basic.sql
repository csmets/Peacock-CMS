SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
`id` int(11) NOT NULL,
  `posttitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postcontent` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `draft` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog` (`id`, `posttitle`, `postcontent`, `date`, `draft`, `category`, `views`, `user`, `image`) VALUES
(1, '<p>Oceans Away!</p>\r\n', '<p><img src="/view/image/ArtyFarty_Fotor.jpg" style="width: 100%;" /></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis mattis magna, nec placerat orci congue a. Sed sed blandit turpis, a pretium nulla. Aliquam ipsum massa, feugiat vel orci a, tempor convallis quam. Mauris feugiat augue metus, at ultrices orci consectetur rutrum. Ut sit amet fringilla purus. Maecenas pretium augue ex, ac lobortis nunc suscipit ut. Suspendisse bibendum nunc fermentum, viverra mi id, sollicitudin augue. Fusce neque metus, ultrices nec orci vitae, vehicula laoreet arcu. Curabitur dignissim bibendum bibendum. Curabitur quis fringilla sapien. Nam sit amet posuere eros, eget luctus est. Nullam sed nulla sit amet sem sollicitudin lobortis. Cras volutpat, risus ullamcorper maximus tempor, sem ligula efficitur purus, ac facilisis metus erat nec eros. Etiam gravida erat a tortor elementum tincidunt.</p>\r\n\r\n<blockquote>\r\n<h3>&quot;Ut viverra pellentesque elit quis consequat.&quot;</h3>\r\n</blockquote>\r\n\r\n<p>Nulla nisi nibh, finibus in convallis quis, convallis in eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ante nunc, faucibus a semper non, sodales a justo. Cras et erat convallis,&nbsp;<strong>fermentum arcu quis</strong>, congue sapien. Vivamus maximus cursus magna, et eleifend tellus consectetur eu. Proin eu ipsum non enim placerat elementum quis quis orci. Donec gravida finibus pretium. Nullam sit amet facilisis ipsum. Quisque diam magna, mattis et ipsum eu, lobortis aliquet risus. Sed vulputate facilisis tortor, ac auctor sem tincidunt vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<blockquote>\r\n<div style="background-color: rgb(238, 238, 238); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; background-position: initial initial; background-repeat: initial initial;">Nam varius est in vestibulum eleifend. Maecenas ultricies vitae odio at vehicula. In ut tempus diam. Donec euismod massa in purus placerat, non interdum diam eleifend. Proin ultrices vestibulum turpis eget ultricies. Fusce ornare nisi ut faucibus auctor. Vestibulum posuere tristique ex a feugiat.</div>\r\n</blockquote>\r\n\r\n<p>Maecenas aliquam eleifend diam, ut mattis dolor commodo at. Vivamus ullamcorper congue nisl. Nulla interdum interdum purus a blandit. In consequat pharetra pellentesque. Nulla cursus dictum libero, sed porta sapien volutpat eu. Nullam ligula quam, gravida tempus nunc mollis, vestibulum sagittis neque. Phasellus vel purus odio. Vestibulum ipsum lorem, sagittis eu pretium eget, imperdiet id est. Vestibulum sodales mollis imperdiet. Morbi laoreet, lectus a maximus rhoncus, leo massa vestibulum eros, quis varius magna magna ac nisl.</p>\r\n\r\n<p><cite>&quot;Pellentesque varius dictum pellentesque. Sed aliquam accumsan mi, quis pharetra est rutrum a. Nulla sed eleifend turpis. Aliquam et pellentesque dui, a pellentesque lacus. Praesent sagittis pretium turpis, tempus scelerisque tellus aliquam sit amet. Phasellus vel sem eget felis facilisis sollicitudin eget in leo. Pellentesque vitae leo sit amet urna convallis commodo in non nisi.&quot;</cite></p>\r\n', '2014-12-20 07:25:20', 'no', '1', 0, 'admin', '');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'none',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `categoryOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `category`, `icon`) VALUES
(1, 'none', '');

DROP TABLE IF EXISTS `imageFolders`;
CREATE TABLE IF NOT EXISTS `imageFolders` (
`id` int(11) NOT NULL,
  `folderName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `folderOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imageFolders` (`id`, `folderName`, `folderOrder`) VALUES
(1, 'Uncategorised', 1),
(4, 'new', 2);

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `image` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `imageFolder` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Uncategorised',
  `imagename` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `images` (`id`, `image`, `imageFolder`, `imagename`, `imageOrder`) VALUES
(10, 'ArtyFarty.jpg', 'Uncategorised', '', 0),
(11, 'ArtyFarty_Fotor.jpg', 'Uncategorised', '', 0),
(13, 'test_Fotor.jpg', 'Uncategorised', '', 0),
(15, 'Flowers_Fotor.jpg', 'Uncategorised', '', 0),
(16, 'Chairs.png', 'Uncategorised', '', 0);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `pagename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `bodycontent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `additional` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `additional2` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `additional3` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pagetype` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `draft` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `pageorder` int(10) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `isGrouped` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `groupID` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pages` (`id`, `pagename`, `bodycontent`, `additional`, `additional2`, `additional3`, `pagetype`, `draft`, `date`, `status`, `pageorder`, `views`, `image`, `isGrouped`, `groupID`) VALUES
(1, 'Home', '<div class="Editable-1"><h1><strong><em>Basic Theme for Peacock</em></strong></h1>\r\n\r\n<hr />\r\n<h2><em>Clear.&nbsp;Artistic.&nbsp;Minimal.</em></h2>\r\n\r\n<p style="text-align: center;"><img src="/view/image/ArtyFarty_Fotor.jpg" style="width: 100%;" /></p>\r\n\r\n<p style="text-align: right;"><em>Artwork created by Peacock CMS</em></p>\r\n\r\n<p>&nbsp;</p>\r\n</div>', '', '', '', 'homepage', 'no', '', 'active', 1, 0, '', 'false', 0),
(2, 'Blog', '<p>-DO NOT WRITE CONTENT-</p> <p>&nbsp;</p> <p>Written content will not be visible on website. This page is to only edit the blog name.</p>', '', '', '', 'blog', 'no', '', 'active', 3, 0, '', 'false', 0),
(3, 'Contact', '<p>Please contact me for commission works.</p>', 'Insert Your Email Address', '', '', 'contact', 'no', '', 'active', 4, 0, '', 'false', 0),
(6, 'Gallery', '<h1>Gallery</h1> <p>Below are selected works.</p>', '/Gallery', 'default-EditPage.php?id=6', 'SimpleGallery', 'relink', 'no', '', 'active', 2, 0, '', 'false', 0);

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE IF NOT EXISTS `plugins` (
`id` int(11) NOT NULL,
  `pluginName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pluginLink` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `plugins` (`id`, `pluginName`, `pluginLink`) VALUES
(1, 'SimpleGallery', '');

DROP TABLE IF EXISTS `simpleGallery`;
CREATE TABLE IF NOT EXISTS `simpleGallery` (
`id` int(11) NOT NULL,
  `imageFile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageTitle` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `imageCategory` varchar(100) COLLATE utf8_unicode_ci DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `simpleGallery` (`id`, `imageFile`, `imageTitle`, `hidden`, `imageCategory`) VALUES
(1, 'ArtyFarty.jpg', '', 'no', '1'),
(2, 'ArtyFarty_Fotor.jpg', '', 'no', '1'),
(3, 'test_Fotor.jpg', '', 'no', '1'),
(4, 'Flowers_Fotor.jpg', '', 'no', '1'),
(5, 'Chairs.png', '', 'no', '1');

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
`id` int(11) NOT NULL,
  `sitename` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `useimage` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `tags` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic',
  `allowPageSource` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `site` (`id`, `sitename`, `image`, `useimage`, `tags`, `description`, `theme`, `allowPageSource`) VALUES
(1, 'Basic', 'ArtyFarty.png', 'yes', '', '', 'basic', 'no');

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
`id` int(11) NOT NULL,
  `templateName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `templateContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pageName` tinyint(1) NOT NULL DEFAULT '0',
  `pageImage` tinyint(1) NOT NULL DEFAULT '0',
  `draft` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `templateOrder` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `templates` (`id`, `templateName`, `templateContent`, `pageName`, `pageImage`, `draft`, `templateOrder`) VALUES
(4, 'Basic Page', '<div id="SaveContent" class="Editable">\r\n                    <div class="basicBodyText">\r\n                        Click here to start creating your page!\r\n                    </div>\r\n                </div>', 0, 0, 'no', 0);


ALTER TABLE `blog`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `imageFolders`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `plugins`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `simpleGallery`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `site`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `templates`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `blog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `imageFolders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
ALTER TABLE `plugins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `simpleGallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `site`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `templates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
