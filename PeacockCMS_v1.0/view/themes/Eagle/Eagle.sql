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
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog` (`id`, `posttitle`, `postcontent`, `date`, `draft`, `status`, `category`, `views`, `user`, `image`) VALUES
(1, '<h4>Flying High</h4>\r\n', '<p><img src="view/image/volcanoes.jpeg" width="100%" /></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis mattis magna, nec placerat orci congue a. Sed sed blandit turpis, a pretium nulla. Aliquam ipsum massa, feugiat vel orci a, tempor convallis quam. Mauris feugiat augue metus, at ultrices orci consectetur rutrum. Ut sit amet fringilla purus. Maecenas pretium augue ex, ac lobortis nunc suscipit ut. Suspendisse bibendum nunc fermentum, viverra mi id, sollicitudin augue. Fusce neque metus, ultrices nec orci vitae, vehicula laoreet arcu. Curabitur dignissim bibendum bibendum. Curabitur quis fringilla sapien. Nam sit amet posuere eros, eget luctus est. Nullam sed nulla sit amet sem sollicitudin lobortis. Cras volutpat, risus ullamcorper maximus tempor, sem ligula efficitur purus, ac facilisis metus erat nec eros. Etiam gravida erat a tortor elementum tincidunt.</p>\r\n\r\n<blockquote>\r\n<h3>&quot;Ut viverra pellentesque elit quis consequat.&quot;</h3>\r\n</blockquote>\r\n\r\n<p>Nulla nisi nibh, finibus in convallis quis, convallis in eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ante nunc, faucibus a semper non, sodales a justo. Cras et erat convallis,&nbsp;<strong>fermentum arcu quis</strong>, congue sapien. Vivamus maximus cursus magna, et eleifend tellus consectetur eu. Proin eu ipsum non enim placerat elementum quis quis orci. Donec gravida finibus pretium. Nullam sit amet facilisis ipsum. Quisque diam magna, mattis et ipsum eu, lobortis aliquet risus. Sed vulputate facilisis tortor, ac auctor sem tincidunt vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<blockquote>\r\n<p><em>&quot;Maecenas aliquam eleifend diam, ut mattis dolor commodo at. Vivamus ullamcorper congue nisl. Nulla interdum interdum purus a blandit. In consequat pharetra pellentesque. Nulla cursus dictum libero, sed porta sapien volutpat eu. Nullam ligula quam, gravida tempus nunc mollis, vestibulum sagittis neque. Phasellus vel purus odio. Vestibulum ipsum lorem, sagittis eu pretium eget, imperdiet id est. Vestibulum sodales mollis imperdiet. Morbi laoreet, lectus a maximus rhoncus, leo massa vestibulum eros, quis varius magna magna ac nisl.&quot;</em></p>\r\n</blockquote>\r\n\r\n<p><cite>&quot;Pellentesque varius dictum pellentesque. Sed aliquam accumsan mi, quis pharetra est rutrum a. Nulla sed eleifend turpis. Aliquam et pellentesque dui, a pellentesque lacus. Praesent sagittis pretium turpis, tempus scelerisque tellus aliquam sit amet. Phasellus vel sem eget felis facilisis sollicitudin eget in leo. Pellentesque vitae leo sit amet urna convallis commodo in non nisi.&quot;</cite></p>\r\n', '2014-12-04 06:05:25', 'no', 'active', '2', 0, 'admin', ''),
(2, '<h4>Landscape lust</h4>\r\n', '<p><img src="view/image/mountains.JPG" width="100%" /></p>\r\n\r\n<blockquote>\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis mattis magna, nec placerat orci congue a. Sed sed blandit turpis, a pretium nulla. Aliquam ipsum massa, feugiat vel orci a, tempor convallis quam. Mauris feugiat augue metus, at ultrices orci consectetur rutrum.</strong></p>\r\n</blockquote>\r\n\r\n<p>Ut sit amet fringilla purus. Maecenas pretium augue ex, ac lobortis nunc suscipit ut. Suspendisse bibendum nunc fermentum, viverra mi id, sollicitudin augue. Fusce neque metus, ultrices nec orci vitae, vehicula laoreet arcu. Curabitur dignissim bibendum bibendum. Curabitur quis fringilla sapien. Nam sit amet posuere eros, eget luctus est. Nullam sed nulla sit amet sem sollicitudin lobortis. Cras volutpat, risus ullamcorper maximus tempor, sem ligula efficitur purus, ac facilisis metus erat nec eros. Etiam gravida erat a tortor elementum tincidunt.</p>\r\n\r\n<h3>Nulla nisi nibh, finibus in convallis quis, convallis in eros!</h3>\r\n\r\n<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ante nunc, faucibus a semper non, sodales a justo. Cras et erat convallis,&nbsp;fermentum arcu quis, congue sapien. Vivamus maximus cursus magna, et eleifend tellus consectetur eu. Proin eu ipsum non enim placerat elementum quis quis orci. Donec gravida finibus pretium. Nullam sit amet facilisis ipsum. Quisque diam magna, mattis et ipsum eu, lobortis aliquet risus. Sed vulputate facilisis tortor, ac auctor sem tincidunt vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n', '2014-12-04 06:07:15', 'no', 'active', '3', 0, 'admin', '');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'none',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `category`, `icon`) VALUES
(1, 'none', ''),
(2, 'news', ''),
(3, 'stories', '');

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
`id` int(11) NOT NULL,
  `imageFile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageTitle` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageDesc` longtext COLLATE utf8_unicode_ci,
  `lightBox` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `hidden` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `imageFolder` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'none',
  `imageOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `gallery` (`id`, `imageFile`, `imageTitle`, `imageDesc`, `lightBox`, `hidden`, `imageFolder`, `imageOrder`) VALUES
(1, 'EagleHome.jpg', '', '', 'no', 'no', 'Nature', 0),
(2, 'pinetrees.jpg', NULL, NULL, 'no', 'no', 'Nature', 0),
(3, 'volcanoes.jpeg', NULL, NULL, 'no', 'no', 'Nature', 0),
(4, 'ocean.JPG', NULL, NULL, 'no', 'no', 'Nature', 0),
(5, 'islandroad.jpg', NULL, NULL, 'no', 'no', 'Nature', 0),
(6, 'mountains.JPG', NULL, NULL, 'no', 'no', 'Nature', 0),
(7, 'hotsprings.jpeg', NULL, NULL, 'no', 'no', 'Nature', 0),
(8, 'newyork.jpg', 'New York', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.', 'no', 'no', 'Urban', 2),
(9, 'buildings.jpg', 'City Roof', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.', 'no', 'no', 'Urban', 1);

DROP TABLE IF EXISTS `GalleryFolders`;
CREATE TABLE IF NOT EXISTS `GalleryFolders` (
`id` int(11) NOT NULL,
  `FolderName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderImage` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `GalleryFolders` (`id`, `FolderName`, `FolderImage`, `FolderOrder`) VALUES
(1, 'Nature', NULL, 2),
(2, 'Urban', NULL, 1);

DROP TABLE IF EXISTS `imageFolders`;
CREATE TABLE IF NOT EXISTS `imageFolders` (
`id` int(11) NOT NULL,
  `folderName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `folderOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imageFolders` (`id`, `folderName`, `folderOrder`) VALUES
(1, 'Uncategorised', 1),
(4, 'Gallery Images', 2);

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `image` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `imageFolder` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Uncategorised',
  `imagename` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `images` (`id`, `image`, `imageFolder`, `imagename`, `imageOrder`) VALUES
(22, 'EagleHome.jpg', 'Gallery Images', '', 0),
(23, 'photographer.jpg', 'Uncategorised', '', 0),
(24, 'events-icon.png', 'Uncategorised', '', 0),
(25, 'commissions-icon.png', 'Uncategorised', '', 0),
(26, 'prints-icon.png', 'Uncategorised', '', 0),
(28, 'pinetrees.jpg', 'Gallery Images', '', 0),
(29, 'volcanoes.jpeg', 'Gallery Images', '', 0),
(30, 'newyork.jpg', 'Gallery Images', '', 0),
(31, 'ocean.JPG', 'Gallery Images', '', 0),
(32, 'islandroad.jpg', 'Gallery Images', '', 0),
(33, 'mountains.JPG', 'Gallery Images', '', 0),
(34, 'buildings.jpg', 'Gallery Images', '', 0),
(35, 'hotsprings.jpeg', 'Gallery Images', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pages` (`id`, `pagename`, `bodycontent`, `additional`, `additional2`, `additional3`, `pagetype`, `draft`, `date`, `status`, `pageorder`, `views`, `image`, `isGrouped`, `groupID`) VALUES
(1, 'Home', '<div class="BG-Image" style="background-image:url(view/image/Eagle_Background.jpg)">&nbsp;</div>\n<!-- Start Home -->\n\n<div id="home">&nbsp;</div>\n\n<div class="frontImg" style="background-image:url(view/image/EagleHome.jpg)">\n<div class="title"><div class="Editable-1">\n<h3 style="color:#fff">John Doe</h3>\n\n<h1 style="color:#fff">Landscape Photographer</h1>\n<br />\n<br />\n<a class="LargeBtn" href="#contact">Get In Touch <span class="glyphicon glyphicon-circle-arrow-down"> </span></a></div></div>\n</div>\n<!-- End Home -->\n\n<div class="HomePage">\n<div style="background-color:rgba(0, 0, 0,0.4);">\n<div class="container"><div class="Editable-2">\n<h1>LATEST WORKS</h1>\n</div>\n<div class="hr">&nbsp;</div>\n<div class="Editable-3">\n<p class="page-title"><a class="imagelink" data-lightbox=" imageset" data-title="" href="view/image/pinetrees.jpg"><img class="imagefile" height="200" src="view/image/pinetrees.jpg" width="" /></a>&nbsp;<a class="imagelink" data-lightbox=" imageset" data-title="" href="view/image/ocean.JPG"><img class="imagefile" height="200" src="view/image/ocean.JPG" width="" /></a>&nbsp;<a class="imagelink" data-lightbox=" imageset" data-title="" href="view/image/buildings.jpg"><img class="imagefile" height="200" src="view/image/buildings.jpg" width="" /></a></p></div>\n</div>\n\n<div id="about">&nbsp;</div>\n</div>\n<!-- Start About -->\n\n<div class="container"><div class="Editable-4">\n<h1>About</h1>\n\n<h3>I TAKE PICTURES</h3>\n</div>\n<div class="hr">&nbsp;</div>\n<div class="Editable-5">\n<p class="page-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec mattis magna. Mauris sed neque vitae enim porttitor tincidunt sed bibendum libero. Praesent fringilla, metus sit amet cursus fringilla, elit diam suscipit nulla, et pellentesque mauris nisl ut tellus. Cras magna nulla, eleifend dictum massa a, suscipit pellentesque ligula. Aliquam ipsum magna, volutpat nec feugiat sit amet, hendrerit vel nibh. Suspendisse vel molestie diam. Aenean tempus urna condimentum diam varius dictum. Cras at vehicula libero.</p>\n\n<p class="page-title"><img src="view/image/photographer.jpg" style="width: 50%;" /></p>\n<br />\n<a class="LargeBtn" href="#contact">Get In Touch <span class="glyphicon glyphicon-circle-arrow-down"> </span></a><br />\n<br />\n&nbsp;</div></div>\n<!-- End About --><!-- Start Services -->\n\n<div id="service">&nbsp;</div>\n\n<div style="background-color:rgba(211, 84, 0,0.2);">\n<div class="container"><div class="Editable-6"><h1>Services</h1>\n\n<h3>What We CAN DO FOR YOU</h3>\n</div>\n<div class="hr">&nbsp;</div>\n<div class="Editable-7">\n<p class="page-title">Cras luctus facilisis odio, non semper arcu convallis eu. Nulla tristique tempus neque, eu commodo leo hendrerit et. Maecenas varius purus vitae sem varius, in blandit lacus egestas. In tempor, augue a porta euismod, mauris sapien vulputate nulla, aliquet lacinia leo massa sit amet nisi.</p>\n\n<p class="page-title">&nbsp;</p>\n\n<div class="row">\n<div class="col-md-4">\n<div class="service-box-bg">&nbsp;</div>\n\n<div class="service-box-bg"><img src="view/themes/Eagle/images/events-icon.png" style="width: 150px;" /></div>\n\n<h3>event photography</h3>\n</div>\n\n<div class="col-md-4">\n<div class="service-box-bg"><img src="view/themes/Eagle/images/commissions-icon.png" style="width: 150px;" /></div>\n\n<h3>commissions</h3>\n</div>\n\n<div class="col-md-4">\n<div class="service-box-bg"><img src="view/themes/Eagle/images/prints-icon.png" style="width: 150px;" /></div>\n\n<h3>prints</h3>\n</div>\n</div>\n</div></div>\n</div>\n<!-- End Services -->\n\n<div id="contact">&nbsp;</div>\n<!-- Start Contact -->\n\n<div class="container"><div class="Editable-8">\n<h1>Contact</h1></div>\n<!-- Contact Form -->\n\n<div class="row">\n<div class="col-lg-12">\n<form action="indexsendcontact.php" class="contact-form" id="contact-form" method="post">\n<div class="form-group row" id="price">\n<div class="col-lg-6"><input class="form-control" id="name" name="username" placeholder="Name *" type="text" /></div>\n\n<div class="col-lg-6"><input class="form-control" id="email" name="email" placeholder="E-mail *" type="text" /></div>\n</div>\n\n<div class="form-group row">\n<div class="col-lg-12"><textarea class="form-control" cols="5" id="message" name="msg" placeholder="Message *" rows="5"></textarea></div>\n</div>\n\n<div class="form-group row">\n<div class="col-lg-12"><input id="human" name="human" type="hidden" value="true" /><button class="LargeBtn" style="width:100%" type="submit">SEND <span class="glyphicon glyphicon-send">&zwnj;</span></button></div>\n</div>\n</form>\n\n<div class="alert alert-success" id="contactMessage">&nbsp;</div>\n</div>\n</div>\n\n<p>&nbsp;</p>\n\n<div class="row contact-details">\n<div class="col-lg-4 col-sm-4"><div class="Editable-9"><span class="glyphicon glyphicon-home icon-circle-border">&zwnj;</span>\n\n<h3>Visit us</h3>\n&nbsp;\n\n<blockquote>Eagle Theme, 123 Eagle St<br />\nEagle Valley, Sydney 1234</blockquote></div>\n</div>\n\n<div class="col-lg-4 col-sm-4"><div class="Editable-10"><span class="glyphicon glyphicon-send icon-circle-border">&zwnj;</span>\n\n<h3>Mail us</h3>\n&nbsp;\n\n<blockquote><a href="mailto:info@email.com.au">e</a>mail@address.com</blockquote>\n</div></div>\n\n<div class="col-lg-4 col-sm-4"><div class="Editable-11"><span class="glyphicon glyphicon-phone-alt icon-circle-border">&zwnj;</span>\n\n<h3>Call us</h3>\n&nbsp;\n\n<blockquote>61-123-456-789</blockquote></div>\n</div>\n</div>\n</div>\n</div>\n', '', '', '', 'homepage', 'no', '', 'active', 1, 0, '', 'false', 0),
(2, 'Blog', '<p>-DO NOT WRITE CONTENT-</p> <p>&nbsp;</p> <p>Written content will not be visible on website. This page is to only edit the blog name.</p>', '', '', '', 'blog', 'no', '', 'active', 3, 0, '', 'false', 0),
(3, 'Contact', '<h3>Address</h3>\r\n\r\n<p><strong>My Company Name</strong><br />\r\n123 Adelaide Street, Level 8<br />\r\nBrisbane, AU 4000<br />\r\n<abbr title="Phone">P:</abbr> (123) 456-7890</p>\r\n\r\n<p><strong>Full Name</strong><br />\r\n<a href="mailto:#">first.last@gmail.com</a></p>\r\n', 'Insert Your Email Address', '', '', 'contact', 'no', '', 'active', 5, 0, '', 'false', 0),
(9, 'Sample Page', '<div class="PageContainer"><div class="Editable">\n<h1>HEADING 1</h1>\n\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\n\n<p>&nbsp;</p>\n\n<h2>HEADING 3</h2>\n\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\n\n<p>&nbsp;</p>\n\n<h3>HEADING 4</h3>\n\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\n\n<p>&nbsp;</p>\n\n<h4>HEADING 4</h4>\n\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\n\n<p>&nbsp;</p>\n\n<div class="row">\n<div class="col-md-6"><img src="view/image/pinetrees.jpg" style="width: 100%;" /></div>\n\n<h2 class="col-md-6">SAMPLE</h2>\n\n<div class="col-md-6">\n<p>Morbi aliquam vulputate lectus ut varius. Aliquam fermentum nisi et finibus dignissim. Nam volutpat velit augue, a rhoncus lacus luctus quis. In hendrerit ipsum et nibh venenatis, quis maximus sem consectetur.</p>\n\n<blockquote>\n<p><em>&quot;Proin vel orci est. Integer at diam vitae libero posuere condimentum. Sed posuere augue accumsan metus volutpat facilisis. Aenean quis neque risus. Curabitur gravida, arcu ac faucibus consectetur, velit arcu consequat velit, eget vestibulum metus arcu tristique mauris. Curabitur volutpat dolor at tincidunt cursus.&quot;</em></p>\n</blockquote>\n\n<p>Nam mattis viverra placerat. Etiam condimentum urna id mi dapibus volutpat. Morbi consectetur libero vitae molestie sollicitudin. Maecenas tempor, ipsum non volutpat fermentum, mi est congue purus, in luctus lectus erat in leo.&nbsp;</p>\n</div>\n</div>\n\n<p>&nbsp;</p>\n\n<p>Suspendisse vitae dictum augue. Morbi eu nibh vel lectus pharetra commodo. Suspendisse finibus quam in tristique tincidunt. Nam non mi interdum, elementum dui sit amet, imperdiet ipsum. Vestibulum finibus consectetur ex, in placerat enim. Vestibulum sed commodo ligula. Donec vitae scelerisque tellus. Vivamus placerat urna nec magna consectetur, vel tincidunt ante congue. Nulla porttitor sit amet elit ac vulputate.</p>\n\n<p>Morbi dignissim lobortis ante, non sagittis risus pretium et. Maecenas nunc tortor, fermentum id condimentum at, faucibus in lacus. Nulla massa tellus, fermentum eu elit ut, maximus finibus elit. Ut quis felis sed odio consequat sagittis eget at ex. Nam in ullamcorper felis. Curabitur in imperdiet ligula, at feugiat risus. Nam laoreet finibus tellus at imperdiet. Donec nisi felis, condimentum a lectus eu, tristique fermentum metus. Etiam pretium orci non urna egestas, eget fermentum ex placerat. Nulla facilisi. Etiam vestibulum lacinia lacus, sit amet mollis sapien volutpat vitae.</p>\n</div>\n</div>', '', '', '', 'normal', 'no', '2014-12-04 05:22:10', 'active', 4, 0, '', 'false', 0),
(14, 'Gallery', '<h1 style="text-align: center;">Gallery</h1>\r\n', 'Gallery.php', 'default-EditPage.php?id=14', 'Gallery', 'relink', 'no', '', 'active', 2, 0, '', 'false', 0);

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE IF NOT EXISTS `plugins` (
`id` int(11) NOT NULL,
  `pluginName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pluginLink` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `plugins` (`id`, `pluginName`, `pluginLink`) VALUES
(3, 'Gallery', '');

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
(1, 'Eagle Theme Sample', 'Camera.png', 'yes', '', '', 'Eagle', 'no');

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
(4, 'Standard Page', '\r\n            <div class="Editable">\r\n        \r\n            <div class="PageContainer">\r\n                <h1>HEADING 1</h1>\r\n\r\n                <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n                <p>&nbsp;</p>\r\n\r\n                <h2>HEADING 2</h2>\r\n\r\n                <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n                <p>&nbsp;</p>\r\n\r\n                <h3>HEADING 3</h3>\r\n\r\n                <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n                <p>&nbsp;</p>\r\n\r\n                <h4>HEADING 4</h4>\r\n\r\n                <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n                <p>&nbsp;</p>\r\n\r\n                <div class="row">\r\n                <div class="col-md-6"><img src="view/image/pinetrees.jpg" style="width: 100%;"></div>\r\n\r\n                <h2 class="col-md-6">SAMPLE</h2>\r\n\r\n                <div class="col-md-6">\r\n                <p>Morbi aliquam vulputate lectus ut varius. Aliquam fermentum nisi et finibus dignissim. Nam volutpat velit augue, a rhoncus lacus luctus quis. In hendrerit ipsum et nibh venenatis, quis maximus sem consectetur.</p>\r\n\r\n                <blockquote>\r\n                <p><em>"Proin vel orci est. Integer at diam vitae libero posuere condimentum. Sed posuere augue accumsan metus volutpat facilisis. Aenean quis neque risus. Curabitur gravida, arcu ac faucibus consectetur, velit arcu consequat velit, eget vestibulum metus arcu tristique mauris. Curabitur volutpat dolor at tincidunt cursus."</em></p>\r\n                </blockquote>\r\n\r\n                <p>Nam mattis viverra placerat. Etiam condimentum urna id mi dapibus volutpat. Morbi consectetur libero vitae molestie sollicitudin. Maecenas tempor, ipsum non volutpat fermentum, mi est congue purus, in luctus lectus erat in leo.&nbsp;</p>\r\n                </div>\r\n                </div>\r\n\r\n                <p>&nbsp;</p>\r\n\r\n                <p>Suspendisse vitae dictum augue. Morbi eu nibh vel lectus pharetra commodo. Suspendisse finibus quam in tristique tincidunt. Nam non mi interdum, elementum dui sit amet, imperdiet ipsum. Vestibulum finibus consectetur ex, in placerat enim. Vestibulum sed commodo ligula. Donec vitae scelerisque tellus. Vivamus placerat urna nec magna consectetur, vel tincidunt ante congue. Nulla porttitor sit amet elit ac vulputate.</p>\r\n\r\n                <p>Morbi dignissim lobortis ante, non sagittis risus pretium et. Maecenas nunc tortor, fermentum id condimentum at, faucibus in lacus. Nulla massa tellus, fermentum eu elit ut, maximus finibus elit. Ut quis felis sed odio consequat sagittis eget at ex. Nam in ullamcorper felis. Curabitur in imperdiet ligula, at feugiat risus. Nam laoreet finibus tellus at imperdiet. Donec nisi felis, condimentum a lectus eu, tristique fermentum metus. Etiam pretium orci non urna egestas, eget fermentum ex placerat. Nulla facilisi. Etiam vestibulum lacinia lacus, sit amet mollis sapien volutpat vitae.</p>\r\n            </div>\r\n            \r\n        </div>        ', 0, 0, 'no', 0);


ALTER TABLE `blog`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `GalleryFolders`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `imageFolders`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `plugins`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `site`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `templates`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `blog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
ALTER TABLE `GalleryFolders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `imageFolders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
ALTER TABLE `plugins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `site`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `templates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
