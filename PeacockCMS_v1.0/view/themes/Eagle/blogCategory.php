<?php
    $Pageid = 2;
	$Category = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid,true) . " | " . $peacock->getCategory($Category); ?></title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            $peacock->removePageMargins();
        ?>  
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600' 
              rel='stylesheet' type='text/css' />
        <link href="view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="view/css/bootstrap.css">
        <script src="view/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>
        
        <?php include("includes/header.php"); ?>
        
        <!-- Blog Starts -->	
		<div class="blog block" style="padding-top:40px;">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<div class="searchResults">

								<h2>Category - <?php echo "'".$peacock->getCategory($Category)."'"; ?> Results:</h2>

                            <?php					
								@$ID = $_GET['pID'];							
								if (!$ID){
									$ID = $peacock->getLastPostID();
								}
								$MaxDisplayPosts = 15;
								$PostCount = 1;				
								while ($PostCount <= $MaxDisplayPosts){
									if (($peacock->checkPostIDExistsNoDrafts($ID) == TRUE) && ($peacock->getPostCategory($ID) == $peacock->getCategory($Category))){
                                        echo "<a href='blogPost.php?postID=$ID'><h3 style='color:#3498db'>".$peacock->getPostName($ID,true)."</h3></a>";
										echo $peacock->limitText($peacock->getPostContent($ID, FALSE),150,true)."...";
										$ID = $ID - 1;
									}
									else{
										$ID = $ID - 1;
									}
									$PostCount = $PostCount + 1;
								}

                                if ($ID > 0 && $peacock->checkPostIDExistsNoDrafts($ID) == TRUE){
                                    echo "<center><a class='BlogNavBtn' href='blogCategory.php?id=$Category&pID=$ID'>More Entries</a></center>";
                                }
							?>

							</div>
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
									<form action="Search.php" method="POST">
										<input type="text" name='query'
                                               class="searchTextBox searchIcon" placeholder="Search for Posts">
										<input type="submit" class='searchButton' value="Search"/>
									</form>
								</div>
							</div>
							<!-- Widgets -->
							<div class="widgets">
								<h4>Categories</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<ul class="list-inline">
										<!-- List -->
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