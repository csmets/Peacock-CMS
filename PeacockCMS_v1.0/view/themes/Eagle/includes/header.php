<!-- Start Navbar -->
<div class="navbar navbar-default navbar-fixed-top">
  <!-- Fixed  Navbar -->
  <div class="nav-container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" name="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?php
        if ($peacock->getSiteImage() != null){
            echo '<img src="view/siteImage/'.$peacock->getSiteImage().'" alt="Logo" height="30px">';
        }
        ?> <?php echo $peacock->getSiteName(); ?></a>
    </div>
    <div class="navbar-collapse collapse pull-right">
      <ul class="nav navbar-nav">
        <?php
            $peacock->siteLinksFormat = "<li><a href='pageLink'>pageName</a></li>";
            $peacock->getSiteLinks(true);
        ?>       
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
<!-- End Navbar -->