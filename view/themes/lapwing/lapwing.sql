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
(2, '<h4>First Flight!</h4>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo felis, viverra ut lectus mollis, vestibulum egestas erat. Sed in dui nisl. Maecenas ut nisi id enim dapibus sagittis. Morbi accumsan neque sed ipsum ultricies, at consectetur turpis dignissim. Ut dapibus libero nisl, nec rutrum mi faucibus posuere. Nullam nec tortor id justo fermentum elementum ut eu massa. In ornare lectus sem, at hendrerit neque viverra nec. Nam vehicula, nisi sit amet bibendum convallis, purus dolor lobortis arcu, nec semper arcu dolor eu turpis. Vestibulum molestie fermentum eros, vitae laoreet urna suscipit nec. Donec condimentum augue non dui convallis faucibus. Praesent sodales vehicula sapien nec maximus. Curabitur pharetra, diam at mollis venenatis, eros lacus cursus felis, ut vehicula justo risus eget ipsum. Integer pharetra dolor purus, vel fermentum libero laoreet non. Curabitur quis nisi quis lacus mattis vehicula a non nibh.</p>\r\n\r\n<blockquote>\r\n<h3>Duis aliquam, turpis vitae ultricies aliquam, purus nibh congue lacus, vitae egestas mauris sem vel est. Mauris diam mi, tincidunt ut euismod eu, pellentesque a magna. Nulla non velit lacus.</h3>\r\n</blockquote>\r\n\r\n<p>Duis purus ante, porttitor congue mollis sit amet, hendrerit vitae odio. Pellentesque in magna non nulla accumsan congue ut eget augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam quis egestas orci. In eu mauris maximus, gravida nibh a, pretium ante. Vivamus vulputate fermentum ante id efficitur. Curabitur ornare, arcu a tempor eleifend, nibh velit volutpat ex, vehicula venenatis lacus sem ut urna.</p>\r\n\r\n<p>Phasellus efficitur vestibulum purus id tristique. Suspendisse in neque sem. Ut sit amet dolor rhoncus, porta quam at, facilisis est. Donec eu pellentesque ipsum. Aliquam erat volutpat. Maecenas ut odio at ante cursus hendrerit. Nulla eros odio, vestibulum quis venenatis non, dignissim vitae nisi. Maecenas et laoreet nisl. Praesent a felis at urna pharetra finibus nec nec ipsum. Aenean rutrum eros ac laoreet tincidunt. Fusce non tincidunt neque, in pretium sem. Maecenas eleifend arcu scelerisque, pharetra metus eget, finibus enim. Sed sodales libero in aliquam aliquam. Nam sit amet egestas nisl. Ut varius quis augue in mollis. Nulla facilisi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src="/view/image/lapwingBGimg.jpg" style="width: 100%;" /></p>\r\n\r\n<div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">Sed congue quam ac nunc condimentum accumsan. Donec non est imperdiet, pulvinar nunc ut, bibendum diam. Phasellus non hendrerit risus.</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Vestibulum enim orci, fermentum nec mollis quis, laoreet congue turpis. Etiam vitae tellus et lorem placerat viverra rhoncus sit amet leo. Mauris vel risus a augue porta finibus et ut ligula. Sed magna ipsum, luctus vel ultricies sed, lacinia ac erat. Donec varius eleifend porttitor. Sed nec tortor quis lectus egestas fermentum. Fusce convallis nisi ut turpis consequat pulvinar. Aliquam nisi velit, lobortis eget suscipit at, euismod sit amet ex.</p>\r\n', '2014-12-23 23:49:37', 'no', 'active', '1', 24, 'admin', '');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'none',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `categoryOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `category`, `icon`, `categoryOrder`) VALUES
(1, 'none', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `gallery` (`id`, `imageFile`, `imageTitle`, `imageDesc`, `lightBox`, `hidden`, `imageFolder`, `imageOrder`) VALUES
(1, 'EagleHome.jpg', '', '', 'no', 'no', 'Nature', 1),
(3, 'volcanoes.jpeg', NULL, NULL, 'no', 'no', 'Nature', 2),
(5, 'islandroad.jpg', NULL, NULL, 'no', 'no', 'Nature', 4),
(6, 'mountains.JPG', NULL, NULL, 'no', 'no', 'Nature', 6),
(8, 'newyork.jpg', 'New York', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.', 'no', 'no', 'Urban', 2),
(9, 'buildings.jpg', 'buildings', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere at nulla nec efficitur. Integer viverra ex ut nulla ullamcorper interdum. Etiam ut eros eu nulla luctus malesuada. Duis condimentum eget augue eu porttitor. Nullam pellentesque fringilla scelerisque.', 'no', 'no', 'Urban', 1),
(10, 'hotsprings.jpeg', NULL, NULL, 'no', 'no', 'Nature', 0),
(13, 'ocean.JPG', 'Ocean', 'Nice blue Ocean!', 'no', 'no', 'Nature', 0),
(16, 'pinetrees.jpg', 'Pine trees', '', 'no', 'no', 'Nature', 0);

DROP TABLE IF EXISTS `GalleryFolders`;
CREATE TABLE IF NOT EXISTS `GalleryFolders` (
`id` int(11) NOT NULL,
  `FolderName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderImage` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FolderOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `GalleryFolders` (`id`, `FolderName`, `FolderImage`, `FolderOrder`) VALUES
(1, 'Nature', NULL, 1),
(2, 'Urban', NULL, 2);

DROP TABLE IF EXISTS `imageFolders`;
CREATE TABLE IF NOT EXISTS `imageFolders` (
`id` int(11) NOT NULL,
  `folderName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `folderOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imageFolders` (`id`, `folderName`, `folderOrder`) VALUES
(1, 'Uncategorised', 1),
(4, 'Lapwing', 2);

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `image` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `imageFolder` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Uncategorised',
  `imagename` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `imageOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `images` (`id`, `image`, `imageFolder`, `imagename`, `imageOrder`) VALUES
(20, 'lapwing.png', 'Lapwing', '', 0),
(21, 'lapwingBGimg.jpg', 'Lapwing', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pages` (`id`, `pagename`, `bodycontent`, `additional`, `additional2`, `additional3`, `pagetype`, `draft`, `date`, `status`, `pageorder`, `views`, `image`, `isGrouped`, `groupID`) VALUES
(1, 'Home', '<div class="hero" style="background:#555 no-repeat;background-image:url(/view/image/lapwingBGimg.jpg); background-size:cover; background-position:center center;">\n	<div class="container">\n		<div class="row">\n			<div class="col-md-5">\n				<div class="intro">\n					<div class="Editable-1">\n						<h2>Simple.<br>\n						 Minimal.<br>\n						 AWESOME!</h2>\n						<p>\n							Create a awesome looking website using the Lapwing theme.\n						</p>\n					</div>\n				</div>\n			</div>\n			<div class="col-md-7">\n				<div class="shot">\n					<div class="Editable-2">\n						<img alt="image" class="img-responsive" src="/view/image/lapwing.png" style="width: 100%;">\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>\n<div class="features block">\n	<div class="container">\n		<div class="Editable-3">\n			<div class="row">\n				<div class="col-md-12">\n					<div class="page-title text-center">\n						<h3>Features</h3>\n						<p>\n							Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.\n						</p>\n					</div>\n				</div>\n			</div>\n			<hr>\n			<div class="row">\n				<div class="col-md-3 col-xs-6">\n					<div class="feat">\n						<h4>Column 1</h4>\n						<p>\n							Aliquam id nulla ac risus condimentum ornare.Lorem ipsum dolor sit amet.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-xs-6">\n					<div class="feat">\n						<h4>Column 2</h4>\n						<p>\n							Suspendisse vitae mauris aliquet, blandit quam ut, sodales odio amet.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-xs-6">\n					<div class="feat">\n						<h4>Column 3</h4>\n						<p>\n							Mauris lobortis tortor vitae elit tincidunt, et hendrerit ante consectetur.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-xs-6">\n					<div class="feat">\n						<h4>Column 4</h4>\n						<p>\n							Proin venenatis eget risus ac hendrerit.Lorem ipsum dolor sit amet.\n						</p>\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>\n<!-- Features Ends -->\n<!-- Shots starts -->\n<div class="shots block">\n	<div class="container">\n		<!-- shot1-->\n		<div class="Editable-4">\n			<div class="row">\n				<div class="col-md-4">\n					<div class="screenshot">\n						&nbsp;\n					</div>\n					<div class="screenshot">\n						&nbsp;\n					</div>\n					<div class="screenshot">\n						&nbsp;\n					</div>\n					<div class="screenshot">\n						<img alt="image" class="img-responsive" src="/view/themes/lapwing/img/insertImage.png">\n					</div>\n					<div class="screenshot">\n						&nbsp;\n					</div>\n				</div>\n				<div class="col-md-8">\n					<div class="shotcontent">\n						<h3>Showcase Article&nbsp;<span class="text-muted"> Sub Heading</span></h3>\n						<p class="shot-para">\n							Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat.\n						</p>\n						<hr>\n						<div class="row">\n							<div class="col-md-6 col-xs-6">\n								<div class="shot-content-body">\n									<h4>Column 1</h4>\n									<p>\n										Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo.\n									</p>\n								</div>\n							</div>\n							<div class="col-md-6 col-xs-6">\n								<div class="shot-content-body">\n									<h4>Column 2</h4>\n									<p>\n										Praesent tincidunt tellus augue, a tempor massa iaculis non. Phasellus et mi ante.\n									</p>\n								</div>\n							</div>\n						</div>\n						<hr>\n					</div>\n				</div>\n			</div>\n			<hr>\n			<!-- shot1 ends -->\n			<!-- shot2 -->\n			<div class="row">\n				<div class="col-md-8">\n					<div class="shotcontent second">\n						<h3>Showcase Article 2&nbsp;<span class="text-muted">Sub Heading 2</span></h3>\n						<p class="shot-para">\n							Dapibus vitae velit. Pellentesque vel venenatis leo, vel egestas velit.In ullamcorper dolor ut odio facilisis tempus. Duis id erat erat.\n						</p>\n						<hr>\n						<div class="row">\n							<div class="col-md-8">\n								<div class="shot-content-body">\n									<h4>Envelope</h4>\n									<p>\n										Cras tincidunt ligula orci, ac sodales urna tincidunt eu. Nullam lacinia placerat justo.\n									</p>\n								</div>\n							</div>\n						</div>\n						<hr>\n						<a class="download" href="#">Download</a>\n					</div>\n				</div>\n				<div class="col-md-4">\n					<img alt="image" class="img-responsive" src="/view/themes/lapwing/img/insertImage.png">\n				</div>\n			</div>\n		</div>\n		<hr>\n		<!-- shot2 ends -->\n	</div>\n</div>\n<!-- Shots Ends -->\n<!-- Service Starts -->\n<div class="service block">\n	<!-- Container -->\n	<div class="container">\n		<!-- Page Title -->\n		<div class="Editable-5">\n			<div class="page-title text-center">\n				<!-- Heading -->\n				<h3>Service</h3>\n				<!-- Paragraph -->\n				<p>\n					Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.\n				</p>\n			</div>\n			<div class="row">\n				<div class="col-md-3 col-sm-6">\n					<!-- Service Item -->\n					<div class="service-item">\n						<!-- Icon -->\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/service/apple.png"></a>\n						<!-- Heading -->\n						<h4>Exercitat</h4>\n						<!-- Paragraph -->\n						<p>\n							Nemo enim ipsam quia voluptas aspernatur.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-sm-6">\n					<div class="service-item">\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/service/responsive.png"></a>\n						<h4>Necessita</h4>\n						<p>\n							Nemo enim ipsam quia voluptas aspernatur.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-sm-6">\n					<div class="service-item">\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/service/heart.png"></a>\n						<h4>Repudiandae</h4>\n						<p>\n							Nemo enim ipsam quia voluptas aspernatur.\n						</p>\n					</div>\n				</div>\n				<div class="col-md-3 col-sm-6">\n					<div class="service-item">\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/service/roadblock.png"></a>\n						<h4>Laboriosam</h4>\n						<p>\n							Nemo enim ipsam quia voluptas aspernatur.\n						</p>\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>\n<!-- Service Ends -->\n<!-- Pricing Starts -->\n<div class="pricing block">\n	<!-- Container -->\n	<div class="container">\n		<div class="Editable-6">\n			<!-- Page Title -->\n			<div class="page-title text-center">\n				<!-- Heading -->\n				<h3>Pricing</h3>\n				<!-- Paragraph -->\n				<p>\n					Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.\n				</p>\n			</div>\n			<div class="row">\n				<div class="col-md-4 col-sm-4">\n					<!-- Pricing Item -->\n					<div class="pricing-item">\n						<!-- Pricing Content -->\n						<div class="pricing-content">\n							<!-- Heading -->\n							<h4>Basic</h4>\n							<span>$5</span>\n							<h6>per month</h6>\n							<!-- Order List -->\n							<ul class="list-unstyled">\n								<!-- List -->\n								<li>Disk Space - 5 GB</li>\n								<li>No Support</li>\n								<li><del>Speed - 8 Mbps</del></li>\n								<li>Bandwidth - 4</li>\n								<li><del>Databasse - 6</del></li>\n							</ul>\n							<!-- Button -->\n							<a class="btn btn-danger btn-xs" href="#">Buy Now</a>\n						</div>\n					</div>\n				</div>\n				<div class="col-md-4 col-sm-4">\n					<!-- Pricing Item -->\n					<div class="pricing-item">\n						<div class="pricing-content">\n							<h4>Medium</h4>\n							<span>$10</span>\n							<h6>per month</h6>\n							<ul class="list-unstyled">\n								<li>Disk space - 10 GB</li>\n								<li><del>Medium Support</del></li>\n								<li><del>Speed - 10 Mbps</del></li>\n								<li>Bandwidth - 8</li>\n								<li>Database - 10</li>\n							</ul>\n							<a class="btn btn-danger btn-xs" href="#">Buy Now</a>\n						</div>\n					</div>\n				</div>\n				<div class="col-md-4 col-sm-4">\n					<!-- Pricing Item -->\n					<div class="pricing-item">\n						<div class="pricing-content">\n							<h4>Premium</h4>\n							<span>$15</span>\n							<h6>per month</h6>\n							<ul class="list-unstyled">\n								<li>Disk Space - 15 GB</li>\n								<li>Full Support</li>\n								<li><del>Speed - 12 Mbps</del></li>\n								<li><del>Bandwidth - 10</del></li>\n								<li><del>Database - 12</del></li>\n							</ul>\n							<a class="btn btn-danger btn-xs" href="#">Buy Now</a>\n						</div>\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>\n<!-- Pricing Ends -->\n<!-- Team Starts -->\n<div class="team block">\n	<!-- Container -->\n	<div class="container">\n		<div class="Editable-7">\n			<!-- Page Title -->\n			<div class="page-title text-center">\n				<!-- Heading -->\n				<h3>Our Team</h3>\n				<!-- Paragraph -->\n				<p>\n					Nullam sed sagittis ligula, sit amet luctus nisl. Pellentesque ultricies, nulla et congue ullamcorper, sem lorem luctus elit, ac faucibus erat libero nec justo.\n				</p>\n			</div>\n			<div class="row">\n				<div class="col-md-4">\n					<!-- Team Item -->\n					<div class="team-item">\n						<!-- Image -->\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/portrait.png" style="width: 150px; height: 150px;"></a>\n						<!-- Name -->\n						<h3>Thomas Helon</h3>\n						<!-- Position -->\n						<h5>CEO</h5>\n						<!-- Paragraph -->\n						<p>\n							Temporibus autem quibusdam et aut officiis debitis aut rerum.\n						</p>\n						<!-- Social -->\n						<div class="social">\n							<!-- Social Media Icons -->\n						</div>\n					</div>\n				</div>\n				<div class="col-md-4">\n					<!-- Team Item -->\n					<div class="team-item">\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/portrait.png" style="width: 150px; height: 150px;"></a>\n						<h3>Joho Peter</h3>\n						<h5>Project Manager</h5>\n						<p>\n							Temporibus autem quibusdam et aut officiis debitis aut rerum.\n						</p>\n						<div class="social">\n							&nbsp;\n						</div>\n					</div>\n				</div>\n				<div class="col-md-4">\n					<!-- Team Item -->\n					<div class="team-item">\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/portrait.png" style="width: 150px; height: 150px;"></a>\n						<h3>Helon Mark</h3>\n						<h5>Project Leader</h5>\n						<p>\n							Temporibus autem quibusdam et aut officiis debitis aut rerum.\n						</p>\n						<div class="social">\n							&nbsp;\n						</div>\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>', '', '', '', 'homepage', 'no', '', 'active', 1, 24, '', 'false', 0),
(2, 'Blog', '<p>-DO NOT WRITE CONTENT-</p> <p>&nbsp;</p> <p>Written content will not be visible on website. This page is to only edit the blog name.</p>', '', '', '', 'blog', 'no', '', 'active', 3, 14, 'lapwingBGimg.jpg', 'false', 0),
(3, 'Contact', '<legend>Address</legend> <address><strong>My Company Name</strong><br /> 123 Adelaide Street, Level 8<br /> Brisbane, AU 4000<br /> <abbr title="Phone">P:</abbr> (123) 456-7890</address> <address><strong>Full Name</strong><br /> <a href="mailto:#">first.last@gmail.com</a></address>', 'Insert Your Email Address', '', '', 'contact', 'no', '', 'active', 4, 6, 'lapwingBGimg.jpg', 'false', 0),
(8, '<h2>Page</h2>\r\n', '<div class="container">\n	<div class="Editable-1">\n		<h1>Heading 1</h1>\n		<p>\n			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.\n		</p>\n		<p>\n			&nbsp;\n		</p>\n		<h2>Heading 2</h2>\n		<p>\n			Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.\n		</p>\n		<p>\n			&nbsp;\n		</p>\n		<h3>Heading 3</h3>\n		<p>\n			Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.\n		</p>\n		<p>\n			&nbsp;\n		</p>\n		<h4>Heading 4</h4>\n		<p>\n			Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.\n		</p>\n	</div>\n	<div class="about-us block">\n		<!-- Container -->\n		<div class="container">\n			<!-- About One -->\n			<div class="about-one">\n				<!-- About One Item -->\n				<div class="about-one-item">\n					<!-- About One Image -->\n					<div class="about-one-img">\n						<!-- Image -->\n						<a href="#"><img alt="" class="img-responsive" src="/view/themes/lapwing/img/about-us/1.png"></a>\n					</div>\n				</div>\n				<!-- About One Item -->\n				<div class="about-one-item">\n					<!-- About One Content -->\n					<div class="about-one-content">\n						<!-- Header -->\n						<h3>Container Style</h3>\n						<!-- Paragraph -->\n						<p>\n							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.\n						</p>\n					</div>\n				</div>\n				<div class="clearfix">\n					&nbsp;\n				</div>\n			</div>\n			<!-- About Two -->\n			<div class="about-two">\n				<div class="row">\n					<div class="col-md-3 col-sm-3">\n						<!-- About Two Item -->\n						<div class="about-two-item">\n							<p class="bg-blue">\n								<span>852</span>\n							</p>\n							<!-- Header -->\n							<h5>Standard</h5>\n							<!-- Paragraph -->\n							<p>\n								Ut enim at minim veniam.\n							</p>\n						</div>\n					</div>\n					<div class="col-md-3 col-sm-3">\n						<div class="about-two-item">\n							<p class="bg-green">\n								<span>4563</span>\n							</p>\n							<h5>Laudantium</h5>\n							<p>\n								Galley type of scrambled.\n							</p>\n						</div>\n					</div>\n					<div class="col-md-3 col-sm-3">\n						<div class="about-two-item">\n							<p class="bg-purple">\n								<span>339</span>\n							</p>\n							<h5>Denouncing</h5>\n							<p>\n								Aut reiciendis maiores.\n							</p>\n						</div>\n					</div>\n					<div class="col-md-3 col-sm-3">\n						<div class="about-two-item">\n							<p class="bg-lblue">\n								<span>889</span>\n							</p>\n							<h5>Extremely</h5>\n							<p>\n								Every pleasure welcomed.\n							</p>\n						</div>\n					</div>\n				</div>\n			</div>\n		</div>\n	</div>\n</div>', '', '', '', 'normal', 'no', '2014-10-28 02:39:46', 'active', 2, 33, 'lapwingBGimg.jpg', 'false', 0);

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE IF NOT EXISTS `plugins` (
`id` int(11) NOT NULL,
  `pluginName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pluginLink` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'Lapwing', 'lapwingIcon.png', 'no', '', '', 'lapwing', 'yes');

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
`id` int(11) NOT NULL,
  `templateName` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `templateContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pageName` tinyint(1) NOT NULL DEFAULT '0',
  `pageImage` tinyint(1) NOT NULL DEFAULT '0',
  `draft` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `templateOrder` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `templates` (`id`, `templateName`, `templateContent`, `pageName`, `pageImage`, `draft`, `templateOrder`) VALUES
(5, 'Standard Page', '<div class="container"><div class="Editable-1">\r\n<h1>Heading 1</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Heading 2</h2>\r\n\r\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Heading 3</h3>\r\n\r\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>Heading 4</h4>\r\n\r\n<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n</div>\r\n\r\n<div class="about-us block"><!-- Container -->\r\n<div class="container"><!-- About One -->\r\n<div class="about-one"><!-- About One Item -->\r\n<div class="about-one-item"><!-- About One Image -->\r\n<div class="about-one-img"><!-- Image --><a href="#"><img alt="" class="img-responsive" src="view/themes/lapwing/img/about-us/1.png"></a></div>\r\n</div>\r\n<!-- About One Item -->\r\n\r\n<div class="about-one-item"><!-- About One Content -->\r\n<div class="about-one-content"><!-- Header -->\r\n<div class="Editable-2">\r\n<h3>Container Style</h3>\r\n<!-- Paragraph -->\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ea commodo consequat duis aute irure dolor in apprehender in voluptate velit esse cillum dolore.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<!-- About Two -->\r\n\r\n<div class="about-two">\r\n<div class="Editable-3">\r\n<div class="row">\r\n<div class="col-md-3 col-sm-3"><!-- About Two Item -->\r\n<div class="about-two-item">\r\n<p class="bg-blue"><span>852</span></p>\r\n<!-- Header -->\r\n\r\n<h5>Standard</h5>\r\n<!-- Paragraph -->\r\n\r\n<p>Ut enim at minim veniam.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-3 col-sm-3">\r\n<div class="about-two-item">\r\n<p class="bg-green"><span>4563</span></p>\r\n\r\n<h5>Laudantium</h5>\r\n\r\n<p>Galley type of scrambled.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-3 col-sm-3">\r\n<div class="about-two-item">\r\n<p class="bg-purple"><span>339</span></p>\r\n\r\n<h5>Denouncing</h5>\r\n\r\n<p>Aut reiciendis maiores.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-3 col-sm-3">\r\n<div class="about-two-item">\r\n<p class="bg-lblue"><span>889</span></p>\r\n\r\n<h5>Extremely</h5>\r\n\r\n<p>Every pleasure welcomed.</p>\r\n\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div></div></div>', 0, 0, 'no', 0);


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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
ALTER TABLE `GalleryFolders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `imageFolders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
ALTER TABLE `plugins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `site`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `templates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
