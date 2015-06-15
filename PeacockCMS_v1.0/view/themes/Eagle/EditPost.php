<?php
    $EditId = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPostName($EditId, true); ?></title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            $peacock->removePageMargins();
        ?>  
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600' 
              rel='stylesheet' type='text/css' />
        <link href="view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="view/css/bootstrap.css">
        <link rel="stylesheet" href="view/css/animate.css">
        <script type="text/javascript" src="view/js/jquery-1.11.0.min.js"></script>
        <script src="view/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>
        
        <?php $peacock->editorBar(false, $EditId, 'blogPost'); ?>
        

        <!-- Blog Starts -->
		<div class="blog block" style="padding-top:80px;">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<!-- Blog Content -->
							<div class="blog-content">
								<!-- Heading -->
								<div id="SaveTitleContent" class="Editable">
									<?php echo $peacock->getPostName($EditId); ?>
								</div>
								<!-- Blog Meta -->
								<div class="blog-meta">
									<!-- Meta Icons -->
									<i class="glyphicon glyphicon-calendar"></i> <?php echo substr($peacock->getPostDate($EditId, true), 0, 10); ?>&nbsp;&nbsp;
									<i class="glyphicon glyphicon-user"></i> <?php echo $peacock->getPostAuthorName($peacock->getPostAuthor($EditId,true)) ?>&nbsp;&nbsp;
									<i class="glyphicon glyphicon-tag"></i> <?php echo $peacock->getPostCategory($EditId, true); ?>&nbsp;&nbsp;
								</div>
								
								<div id="SaveContent" class="Editable-1">	
									<?php echo $peacock->getPostContent($EditId, true); ?>
								</div>

								<hr>
							</div>
							<!-- Blog Content -->

						</div>
					</div>
					<div class="col-md-4">
						<!-- Sidebar -->
						<div class="sidebar">
							<!-- Widgets -->
							<div class="widgets">
								<!-- Heading -->
								<h4>Search</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<!-- Input Group -->
										<input type="text" name='query' class="searchTextBox searchIcon" placeholder="Search for Posts">
										<input type="submit" class='searchButton' value="Search"/>
								</div>
							</div>
							<!-- Widgets -->
							<div class="widgets">
								<h4>Categories</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<ul class="list-inline">
										<?php $peacock->blogCategoryLinks('',false); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        

        <?php include("includes/footer.php"); ?>
        
    </body>
</html>