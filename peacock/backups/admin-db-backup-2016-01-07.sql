DROP TABLE GalleryFolders;

CREATE TABLE `GalleryFolders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FolderName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderImage` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderOrder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO GalleryFolders VALUES("1","Nature","","2");
INSERT INTO GalleryFolders VALUES("2","Urban","","1");



DROP TABLE blog;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posttitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postcontent` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `draft` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO blog VALUES("1","<p>Oceans Away!</p>","<p><img src=\"view/image/ArtyFarty_Fotor.jpg\" style=\"width: 100%;\" /></p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis mattis magna, nec placerat orci congue a. Sed sed blandit turpis, a pretium nulla. Aliquam ipsum massa, feugiat vel orci a, tempor convallis quam. Mauris feugiat augue metus, at ultrices orci consectetur rutrum. Ut sit amet fringilla purus. Maecenas pretium augue ex, ac lobortis nunc suscipit ut. Suspendisse bibendum nunc fermentum, viverra mi id, sollicitudin augue. Fusce neque metus, ultrices nec orci vitae, vehicula laoreet arcu. Curabitur dignissim bibendum bibendum. Curabitur quis fringilla sapien. Nam sit amet posuere eros, eget luctus est. Nullam sed nulla sit amet sem sollicitudin lobortis. Cras volutpat, risus ullamcorper maximus tempor, sem ligula efficitur purus, ac facilisis metus erat nec eros. Etiam gravida erat a tortor elementum tincidunt.</p> <blockquote> <h3>&quot;Ut viverra pellentesque elit quis consequat.&quot;</h3> </blockquote> <p>Nulla nisi nibh, finibus in convallis quis, convallis in eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ante nunc, faucibus a semper non, sodales a justo. Cras et erat convallis,&nbsp;<strong>fermentum arcu quis</strong>, congue sapien. Vivamus maximus cursus magna, et eleifend tellus consectetur eu. Proin eu ipsum non enim placerat elementum quis quis orci. Donec gravida finibus pretium. Nullam sit amet facilisis ipsum. Quisque diam magna, mattis et ipsum eu, lobortis aliquet risus. Sed vulputate facilisis tortor, ac auctor sem tincidunt vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <blockquote> <div style=\"background-color: rgb(238, 238, 238); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; background-position: initial initial; background-repeat: initial initial;\">Nam varius est in vestibulum eleifend. Maecenas ultricies vitae odio at vehicula. In ut tempus diam. Donec euismod massa in purus placerat, non interdum diam eleifend. Proin ultrices vestibulum turpis eget ultricies. Fusce ornare nisi ut faucibus auctor. Vestibulum posuere tristique ex a feugiat.</div> </blockquote> <p>Maecenas aliquam eleifend diam, ut mattis dolor commodo at. Vivamus ullamcorper congue nisl. Nulla interdum interdum purus a blandit. In consequat pharetra pellentesque. Nulla cursus dictum libero, sed porta sapien volutpat eu. Nullam ligula quam, gravida tempus nunc mollis, vestibulum sagittis neque. Phasellus vel purus odio. Vestibulum ipsum lorem, sagittis eu pretium eget, imperdiet id est. Vestibulum sodales mollis imperdiet. Morbi laoreet, lectus a maximus rhoncus, leo massa vestibulum eros, quis varius magna magna ac nisl.</p> <p><cite>&quot;Pellentesque varius dictum pellentesque. Sed aliquam accumsan mi, quis pharetra est rutrum a. Nulla sed eleifend turpis. Aliquam et pellentesque dui, a pellentesque lacus. Praesent sagittis pretium turpis, tempus scelerisque tellus aliquam sit amet. Phasellus vel sem eget felis facilisis sollicitudin eget in leo. Pellentesque vitae leo sit amet urna convallis commodo in non nisi.&quot;</cite></p>","2014-12-20 07:25:20","no","1","0","admin","");



DROP TABLE categories;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'none',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO categories VALUES("1","none","");



DROP TABLE favouritePosts;

CREATE TABLE `favouritePosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(100) DEFAULT NULL,
  `postOrder` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE gallery;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imageFile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageTitle` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageDesc` longtext COLLATE utf8_unicode_ci,
  `lightBox` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `hidden` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `imageFolder` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'none',
  `imageOrder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO gallery VALUES("1","EagleHome.jpg","","","no","no","Nature","0");
INSERT INTO gallery VALUES("2","pinetrees.jpg","","","no","no","Nature","0");
INSERT INTO gallery VALUES("3","volcanoes.jpeg","","","no","no","Nature","0");
INSERT INTO gallery VALUES("4","ocean.JPG","","","no","no","Nature","0");
INSERT INTO gallery VALUES("5","islandroad.jpg","","","no","no","Nature","0");
INSERT INTO gallery VALUES("6","mountains.JPG","","","no","no","Nature","0");
INSERT INTO gallery VALUES("7","hotsprings.jpeg","","","no","no","Nature","0");
INSERT INTO gallery VALUES("8","newyork.jpg","New York","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.","no","no","Urban","2");
INSERT INTO gallery VALUES("9","buildings.jpg","City Roof","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.","no","no","Urban","1");



DROP TABLE imageFolders;

CREATE TABLE `imageFolders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folderName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `folderOrder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO imageFolders VALUES("1","Uncategorised","1");
INSERT INTO imageFolders VALUES("4","new","2");



DROP TABLE images;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `imageFolder` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Uncategorised',
  `imagename` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO images VALUES("10","ArtyFarty.jpg","Uncategorised","","0");
INSERT INTO images VALUES("11","ArtyFarty_Fotor.jpg","Uncategorised","","0");
INSERT INTO images VALUES("13","test_Fotor.jpg","Uncategorised","","0");
INSERT INTO images VALUES("15","Flowers_Fotor.jpg","Uncategorised","","0");
INSERT INTO images VALUES("16","Chairs.png","Uncategorised","","0");



DROP TABLE onlineStore;

CREATE TABLE `onlineStore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productDesc` longtext COLLATE utf8_unicode_ci,
  `productImage` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productPrice` double DEFAULT NULL,
  `productOrder` int(10) DEFAULT '0',
  `productVisible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO onlineStore VALUES("1","iPod","The classic iPod","EagleHome.jpg","100.5","2","1");
INSERT INTO onlineStore VALUES("2","iMac","The amazing large 5k iMac","islandroad.jpg","2000","1","1");



DROP TABLE onlineStoreAccount;

CREATE TABLE `onlineStoreAccount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paypalID` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `devMode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE pages;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `groupID` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO pages VALUES("1","Home","<h1><strong><em>Basic Theme for Peacock</em></strong></h1> <hr /> <h2><em>Clear.&nbsp;Artistic.&nbsp;Minimal.</em></h2> <p style=\"text-align: center;\"><img src=\"view/image/ArtyFarty_Fotor.jpg\" style=\"width: 100%;\" /></p> <p style=\"text-align: right;\"><em>Artwork created by Peacock CMS</em></p> <p>&nbsp;</p>","","","","homepage","no","","active","1","0","","false","0");
INSERT INTO pages VALUES("2","Blog","<p>-DO NOT WRITE CONTENT-</p> <p>&nbsp;</p> <p>Written content will not be visible on website. This page is to only edit the blog name.</p>","","","","blog","no","","active","3","0","","false","0");
INSERT INTO pages VALUES("3","Contact","<p>Please contact me for commission works.</p>","Insert Your Email Address","","","contact","no","","active","4","0","","false","0");
INSERT INTO pages VALUES("6","Gallery","<h1>Gallery</h1> <p>Below are selected works.</p>","Gallery.php","default-EditPage.php?id=6","SimpleGallery","relink","no","","active","2","0","","false","0");



DROP TABLE plugins;

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pluginName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pluginLink` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO plugins VALUES("1","SimpleGallery","");
INSERT INTO plugins VALUES("2","FavouritePosts","");



DROP TABLE simpleGallery;

CREATE TABLE `simpleGallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imageFile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageTitle` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'no',
  `imageCategory` varchar(100) COLLATE utf8_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO simpleGallery VALUES("1","ArtyFarty.jpg","","no","1");
INSERT INTO simpleGallery VALUES("2","ArtyFarty_Fotor.jpg","","no","1");
INSERT INTO simpleGallery VALUES("3","test_Fotor.jpg","","no","1");
INSERT INTO simpleGallery VALUES("4","Flowers_Fotor.jpg","","no","1");
INSERT INTO simpleGallery VALUES("5","Chairs.png","","no","1");



DROP TABLE site;

CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `useimage` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `tags` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic',
  `allowPageSource` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO site VALUES("1","Basic","ArtyFarty.png","yes","","","basic","no");



DROP TABLE templates;

CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templateName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `templateContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pageName` tinyint(1) NOT NULL DEFAULT '0',
  `pageImage` tinyint(1) NOT NULL DEFAULT '0',
  `draft` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `templateOrder` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO templates VALUES("4","Basic Page","<div id=\"SaveContent\" class=\"Editable\"> <div class=\"basicBodyText\"> Click here to start creating your page! </div> </div>","0","0","no","0");



DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `editortype` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'standard',
  `acctype` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'administrator',
  `profileimg` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("1","admin","f94cf96c79103c3ccad10d308c02a1db73b986e2c48962e96ecd305e0b80ef1b","Admin","Administrator","email@insertHere.com","advance","administrator","test_Fotor.jpg");



