<!-- Start Navbar -->
<div class="navbar navbar-default" style="z-index:0 !important;">
  <!-- Fixed  Navbar -->
  <div class="nav-container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" name="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#home"><img src="view/siteImage/logo.png" alt="Loquar Logo"></a>
    </div>
    <div class="navbar-collapse collapse pull-right">
      <ul class="nav navbar-nav">
        <?php
            $peacock->siteLinksFormat = "<li><a href='pageLink'>pageName</a></li>";
            $peacock->getSiteLinks(false);
        ?>
        <li><a href="#home"><i class="glyphicon glyphicon-home"></i> Home</a></li>         
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
<!-- End Navbar -->