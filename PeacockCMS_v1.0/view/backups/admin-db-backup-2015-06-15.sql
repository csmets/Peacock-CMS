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
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO blog VALUES("2","<h4>First Flight!</h4>","<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo felis, viverra ut lectus mollis, vestibulum egestas erat. Sed in dui nisl. Maecenas ut nisi id enim dapibus sagittis. Morbi accumsan neque sed ipsum ultricies, at consectetur turpis dignissim. Ut dapibus libero nisl, nec rutrum mi faucibus posuere. Nullam nec tortor id justo fermentum elementum ut eu massa. In ornare lectus sem, at hendrerit neque viverra nec. Nam vehicula, nisi sit amet bibendum convallis, purus dolor lobortis arcu, nec semper arcu dolor eu turpis. Vestibulum molestie fermentum eros, vitae laoreet urna suscipit nec. Donec condimentum augue non dui convallis faucibus. Praesent sodales vehicula sapien nec maximus. Curabitur pharetra, diam at mollis venenatis, eros lacus cursus felis, ut vehicula justo risus eget ipsum. Integer pharetra dolor purus, vel fermentum libero laoreet non. Curabitur quis nisi quis lacus mattis vehicula a non nibh.</p> <blockquote> <h3>Duis aliquam, turpis vitae ultricies aliquam, purus nibh congue lacus, vitae egestas mauris sem vel est. Mauris diam mi, tincidunt ut euismod eu, pellentesque a magna. Nulla non velit lacus.</h3> </blockquote> <p>Duis purus ante, porttitor congue mollis sit amet, hendrerit vitae odio. Pellentesque in magna non nulla accumsan congue ut eget augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam quis egestas orci. In eu mauris maximus, gravida nibh a, pretium ante. Vivamus vulputate fermentum ante id efficitur. Curabitur ornare, arcu a tempor eleifend, nibh velit volutpat ex, vehicula venenatis lacus sem ut urna.</p> <p>Phasellus efficitur vestibulum purus id tristique. Suspendisse in neque sem. Ut sit amet dolor rhoncus, porta quam at, facilisis est. Donec eu pellentesque ipsum. Aliquam erat volutpat. Maecenas ut odio at ante cursus hendrerit. Nulla eros odio, vestibulum quis venenatis non, dignissim vitae nisi. Maecenas et laoreet nisl. Praesent a felis at urna pharetra finibus nec nec ipsum. Aenean rutrum eros ac laoreet tincidunt. Fusce non tincidunt neque, in pretium sem. Maecenas eleifend arcu scelerisque, pharetra metus eget, finibus enim. Sed sodales libero in aliquam aliquam. Nam sit amet egestas nisl. Ut varius quis augue in mollis. Nulla facilisi.</p> <p>&nbsp;</p> <p><img src=\"view/themes/lapwing/img/lapwingBGimg.jpg\" style=\"width: 100%;\" /></p> <div style=\"background:#eee;border:1px solid #ccc;padding:5px 10px;\">Sed congue quam ac nunc condimentum accumsan. Donec non est imperdiet, pulvinar nunc ut, bibendum diam. Phasellus non hendrerit risus.</div> <p>&nbsp;</p> <p>Vestibulum enim orci, fermentum nec mollis quis, laoreet congue turpis. Etiam vitae tellus et lorem placerat viverra rhoncus sit amet leo. Mauris vel risus a augue porta finibus et ut ligula. Sed magna ipsum, luctus vel ultricies sed, lacinia ac erat. Donec varius eleifend porttitor. Sed nec tortor quis lectus egestas fermentum. Fusce convallis nisi ut turpis consequat pulvinar. Aliquam nisi velit, lobortis eget suscipit at, euismod sit amet ex.</p>","2014-12-23 23:49:37","no","active","1","0","admin","");



DROP TABLE categories;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'none',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO categories VALUES("1","none","");



DROP TABLE favouritePosts;

CREATE TABLE `favouritePosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(100) DEFAULT NULL,
  `postOrder` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO favouritePosts VALUES("2","2","1");



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
INSERT INTO imageFolders VALUES("4","Gallery Images","2");



DROP TABLE images;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `imageFolder` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Uncategorised',
  `imagename` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO images VALUES("20","lapwing.png","Lapwing","","0");
INSERT INTO images VALUES("21","lapwingBGimg.jpg","Lapwing","","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO pages VALUES("1","Home","<div class=\"hero\" style=\"background:#555 no-repeat;background-image:url(view/image/lapwingBGimg.jpg); background-size:cover; background-position:center center;\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-5\"> <div class=\"intro\"><div class=\"Editable-1\"> <h2>Simple.<br /> Minimal.<br /> AWESOME!</h2> <p>Create a awesome looking website using the Lapwing theme.</p> </div></div> </div> <div class=\"col-md-7\"> <div class=\"shot\"><div class=\"Editable-2\"><img alt=\"image\" class=\"img-responsive\" src=\"view/image/lapwing.png\" style=\"width: 100%;\" /></div></div> </div> </div> </div> </div> <div class=\"features block\"><div class=\"container\"><div class=\"Editable-3\"> <div class=\"row\"> <div class=\"col-md-12\"> <div class=\"page-title text-center\"> <h3>Features</h3> <p>Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.</p> </div> </div> </div> <hr /> <div class=\"row\"> <div class=\"col-md-3 col-xs-6\"> <div class=\"feat\"> <h4>Column 1</h4> <p>Aliquam id nulla ac risus condimentum ornare.Lorem ipsum dolor sit amet.</p> </div> </div> <div class=\"col-md-3 col-xs-6\"> <div class=\"feat\"> <h4>Column 2</h4> <p>Suspendisse vitae mauris aliquet, blandit quam ut, sodales odio amet.</p> </div> </div> <div class=\"col-md-3 col-xs-6\"> <div class=\"feat\"> <h4>Column 3</h4> <p>Mauris lobortis tortor vitae elit tincidunt, et hendrerit ante consectetur.</p> </div> </div> <div class=\"col-md-3 col-xs-6\"> <div class=\"feat\"> <h4>Column 4</h4> <p>Proin venenatis eget risus ac hendrerit.Lorem ipsum dolor sit amet.</p> </div> </div> </div> </div> </div></div> <!-- Features Ends --><!-- Shots starts --> <div class=\"shots block\"> <div class=\"container\"><!-- shot1--><div class=\"Editable-4\"> <div class=\"row\"> <div class=\"col-md-4\"> <div class=\"screenshot\">&nbsp;</div> <div class=\"screenshot\">&nbsp;</div> <div class=\"screenshot\">&nbsp;</div> <div class=\"screenshot\"><img alt=\"image\" class=\"img-responsive\" src=\"view/themes/lapwing/img/insertImage.png\" /></div> <div class=\"screenshot\">&nbsp;</div> </div> <div class=\"col-md-8\"> <div class=\"shotcontent\"> <h3>Showcase Article&nbsp;<span class=\"text-muted\"> Sub Heading</span></h3> <p class=\"shot-para\">Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat.</p> <hr /> <div class=\"row\"> <div class=\"col-md-6 col-xs-6\"> <div class=\"shot-content-body\"> <h4>Column 1</h4> <p>Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo.</p> </div> </div> <div class=\"col-md-6 col-xs-6\"> <div class=\"shot-content-body\"> <h4>Column 2</h4> <p>Praesent tincidunt tellus augue, a tempor massa iaculis non. Phasellus et mi ante.</p> </div> </div> </div> <hr /></div> </div> </div> <hr /><!-- shot1 ends --><!-- shot2 --> <div class=\"row\"> <div class=\"col-md-8\"> <div class=\"shotcontent second\"> <h3>Showcase Article 2&nbsp;<span class=\"text-muted\">Sub Heading 2</span></h3> <p class=\"shot-para\">Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat.</p> <hr /> <div class=\"row\"> <div class=\"col-md-8\"> <div class=\"shot-content-body\"> <h4>Envelope</h4> <p>Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo.</p> </div> </div> </div> <hr /><a class=\"download\" href=\"#\">Download</a></div> </div> <div class=\"col-md-4\"> <img alt=\"image\" class=\"img-responsive\" src=\"view/themes/lapwing/img/insertImage.png\" /> </div></div> </div> <hr /><!-- shot2 ends --></div> </div> <!-- Shots Ends --><!-- Service Starts --> <div class=\"service block\"><!-- Container --> <div class=\"container\"><!-- Page Title --><div class=\"Editable-5\"> <div class=\"page-title text-center\"><!-- Heading --> <h3>Service</h3> <!-- Paragraph --> <p>Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.</p> </div> <div class=\"row\"> <div class=\"col-md-3 col-sm-6\"><!-- Service Item --> <div class=\"service-item\"><!-- Icon --><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/service/apple.png\" /> </a> <!-- Heading --> <h4>Exercitat</h4> <!-- Paragraph --> <p>Nemo enim ipsam quia voluptas aspernatur.</p> </div> </div> <div class=\"col-md-3 col-sm-6\"> <div class=\"service-item\"><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/service/responsive.png\" /> </a> <h4>Necessita</h4> <p>Nemo enim ipsam quia voluptas aspernatur.</p> </div> </div> <div class=\"col-md-3 col-sm-6\"> <div class=\"service-item\"><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/service/heart.png\" /> </a> <h4>Repudiandae</h4> <p>Nemo enim ipsam quia voluptas aspernatur.</p> </div> </div> <div class=\"col-md-3 col-sm-6\"> <div class=\"service-item\"><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/service/roadblock.png\" /> </a> <h4>Laboriosam</h4> <p>Nemo enim ipsam quia voluptas aspernatur.</p> </div> </div> </div> </div> </div></div> <!-- Service Ends --><!-- Pricing Starts --> <div class=\"pricing block\"><!-- Container --> <div class=\"container\"><div class=\"Editable-6\"><!-- Page Title --> <div class=\"page-title text-center\"><!-- Heading --> <h3>Pricing</h3> <!-- Paragraph --> <p>Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.</p> </div> <div class=\"row\"> <div class=\"col-md-4 col-sm-4\"><!-- Pricing Item --> <div class=\"pricing-item\"><!-- Pricing Content --> <div class=\"pricing-content\"><!-- Heading --> <h4>Basic</h4> <span>$5</span> <h6>per month</h6> <!-- Order List --> <ul class=\"list-unstyled\"><!-- List --> <li>Disk Space - 5 GB</li> <li>No Support</li> <li><del>Speed - 8 Mbps</del></li> <li>Bandwidth - 4</li> <li><del>Databasse - 6</del></li> </ul> <!-- Button --> <a class=\"btn btn-danger btn-xs\" href=\"#\">Buy Now</a></div> </div> </div> <div class=\"col-md-4 col-sm-4\"><!-- Pricing Item --> <div class=\"pricing-item\"> <div class=\"pricing-content\"> <h4>Medium</h4> <span>$10</span> <h6>per month</h6> <ul class=\"list-unstyled\"> <li>Disk space - 10 GB</li> <li><del>Medium Support</del></li> <li><del>Speed - 10 Mbps</del></li> <li>Bandwidth - 8</li> <li>Database - 10</li> </ul> <a class=\"btn btn-danger btn-xs\" href=\"#\">Buy Now</a></div> </div> </div> <div class=\"col-md-4 col-sm-4\"><!-- Pricing Item --> <div class=\"pricing-item\"> <div class=\"pricing-content\"> <h4>Premium</h4> <span>$15</span> <h6>per month</h6> <ul class=\"list-unstyled\"> <li>Disk Space - 15 GB</li> <li>Full Support</li> <li><del>Speed - 12 Mbps</del></li> <li><del>Bandwidth - 10</del></li> <li><del>Database - 12</del></li> </ul> <a class=\"btn btn-danger btn-xs\" href=\"#\">Buy Now</a></div> </div> </div> </div> </div> </div></div> <!-- Pricing Ends --><!-- Team Starts --> <div class=\"team block\"><!-- Container --> <div class=\"container\"><div class=\"Editable-7\"><!-- Page Title --> <div class=\"page-title text-center\"><!-- Heading --> <h3>Our Team</h3> <!-- Paragraph --> <p>Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.</p> </div> <div class=\"row\"> <div class=\"col-md-4\"><!-- Team Item --> <div class=\"team-item\"><!-- Image --><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/portrait.png\" style=\"width: 150px; height: 150px;\" /></a> <!-- Name --> <h3>Thomas Helon</h3> <!-- Position --> <h5>CEO</h5> <!-- Paragraph --> <p>Temporibus autem quibusdam et aut officiis debitis aut rerum.</p> <!-- Social --> <div class=\"social\"><!-- Social Media Icons --></div> </div> </div> <div class=\"col-md-4\"><!-- Team Item --> <div class=\"team-item\"><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/portrait.png\" style=\"width: 150px; height: 150px;\" /></a> <h3>Joho Peter</h3> <h5>Project Manager</h5> <p>Temporibus autem quibusdam et aut officiis debitis aut rerum.</p> <div class=\"social\">&nbsp;</div> </div> </div> <div class=\"col-md-4\"><!-- Team Item --> <div class=\"team-item\"><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/portrait.png\" style=\"width: 150px; height: 150px;\" /></a> <h3>Helon Mark</h3> <h5>Project Leader</h5> <p>Temporibus autem quibusdam et aut officiis debitis aut rerum.</p> <div class=\"social\">&nbsp;</div> </div> </div> </div> </div> </div> </div>","","","","homepage","no","","active","1","26","","false","0");
INSERT INTO pages VALUES("2","Blog","<p>-DO NOT WRITE CONTENT-</p> <p>&nbsp;</p> <p>Written content will not be visible on website. This page is to only edit the blog name.</p>","","","","blog","no","","active","3","4","lapwingBGimg.jpg","false","0");
INSERT INTO pages VALUES("3","Contact","<legend>Address</legend> <address><strong>My Company Name</strong><br /> 123 Adelaide Street, Level 8<br /> Brisbane, AU 4000<br /> <abbr title=\"Phone\">P:</abbr> (123) 456-7890</address> <address><strong>Full Name</strong><br /> <a href=\"mailto:#\">first.last@gmail.com</a></address>","Insert Your Email Address","","","contact","no","","active","4","2","lapwingBGimg.jpg","false","0");
INSERT INTO pages VALUES("8","<h2>Page</h2>","<div class=\"container\"><div class=\"Editable-1\"> <h1>Heading 1</h1> <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p> <p>&nbsp;</p> <h2>Heading 2</h2> <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p> <p>&nbsp;</p> <h3>Heading 3</h3> <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p> <p>&nbsp;</p> <h4>Heading 4</h4> <p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p> </div> <div class=\"about-us block\"><!-- Container --> <div class=\"container\"><!-- About One --> <div class=\"about-one\"><!-- About One Item --> <div class=\"about-one-item\"><!-- About One Image --> <div class=\"about-one-img\"><!-- Image --><a href=\"#\"><img alt=\"\" class=\"img-responsive\" src=\"view/themes/lapwing/img/about-us/1.png\" /></a></div> </div> <!-- About One Item --> <div class=\"about-one-item\"><!-- About One Content --> <div class=\"about-one-content\"><!-- Header --> <h3>Container Style</h3> <!-- Paragraph --> <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p> </div> </div> <div class=\"clearfix\">&nbsp;</div> </div> <!-- About Two --> <div class=\"about-two\"> <div class=\"row\"> <div class=\"col-md-3 col-sm-3\"><!-- About Two Item --> <div class=\"about-two-item\"> <p class=\"bg-blue\"><span>852</span></p> <!-- Header --> <h5>Standard</h5> <!-- Paragraph --> <p>Ut enim at minim veniam.</p> </div> </div> <div class=\"col-md-3 col-sm-3\"> <div class=\"about-two-item\"> <p class=\"bg-green\"><span>4563</span></p> <h5>Laudantium</h5> <p>Galley type of scrambled.</p> </div> </div> <div class=\"col-md-3 col-sm-3\"> <div class=\"about-two-item\"> <p class=\"bg-purple\"><span>339</span></p> <h5>Denouncing</h5> <p>Aut reiciendis maiores.</p> </div> </div> <div class=\"col-md-3 col-sm-3\"> <div class=\"about-two-item\"> <p class=\"bg-lblue\"><span>889</span></p> <h5>Extremely</h5> <p>Every pleasure welcomed.</p> </div> </div> </div> </div> </div> </div> </div>","","","","normal","no","2014-10-28 02:39:46","active","2","2","lapwingBGimg.jpg","false","0");
INSERT INTO pages VALUES("9","<h1>My Name</h1>","<div class=\"Editable-1\"> This is my name page!!!!</div>","","","","normal","no","2015-06-15 06:15:40","active","0","8","","false","0");



DROP TABLE plugins;

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pluginName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pluginLink` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO plugins VALUES("3","Gallery","");



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

INSERT INTO site VALUES("1","Lapwing","lapwingIcon.png","no","","","lapwing","no");



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

INSERT INTO templates VALUES("4","First Template","<div class=\"Editable-1\"> Some written content in here. </div>","0","0","no","0");



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

INSERT INTO users VALUES("1","admin","f94cf96c79103c3ccad10d308c02a1db73b986e2c48962e96ecd305e0b80ef1b","Admin","Administrator","email@insertHere.com","advance","administrator","");



