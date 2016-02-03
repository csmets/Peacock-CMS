<!-- Top Starts -->
	<div class="top" style="background-image:url(/view/image/<?php echo $peacock->getPageImage($Pageid); ?>);">


		<!-- Header Starts -->

		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="logo">
							<h1>
								<a href="/index">
									<?php
                                        if($peacock->getSiteImage()){
                                            echo "<img src='view/siteImage/"
                                                .$peacock->getSiteImage()."' height='40px' style='margin-right:10px' />";
                                        }
                                        echo $peacock->getSiteName(); ?></a>
							</h1>
						</div>
					</div>
					<div class="navigation pull-right">
						<?php $peacock->getSiteLinks(false); ?>
					</div>
				</div>
			</div>
		</header>

		<!-- Header Ends -->


		<?php

			if ($Pageid != 1){
				echo "<!-- Hero starts -->
			<div class='hero inner-page'>
				<div class='container'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='intro'>
								<h2>".$peacock->getPageName($Pageid)."</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Hero ends -->";
			}
		?>

	</div>
<!-- Top Ends -->
