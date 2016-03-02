<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include("initPeacock.php");
    $username = $_SESSION['username'];
    $peacock  = new Peacock;
    $user = new User($username);
    $user->checkUser();

    @$UploadErrorMessage  = $_GET['message'];
    @$UploadErroriMessage = $_GET['imessage'];
    @$error = $_GET['error'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    // === Load up Theme Config Preferences ===
    $currentTheme = $peacock->getSiteTheme();
    $configDIR = "../view/themes/".$currentTheme."/config/config.php";
    if (file_exists($configDIR)){
        include ($configDIR);
    }
    // ========================================
    if ($blogging == null){
      $blogging = true;
    }
    if ($enablePageImages == null){
      $enablePageImages = false;
    }
    if ($enableBlogCharLimit == null){
      $enableBlogCharLimit = false;
    }
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Peacock | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/peacockStyleSheet.css">
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  </head>

  <body>

    <?php
      $navBar = new NavBar;
      echo $navBar->display($username);
    ?>

    <div class="dialog-overlay"></div>

    <div class="row nopadding controlpanels">

      <div class="col-md-7 nopadding border-right">

        <!-- Pages Panel Start -->
        <div class="panel-header" id="pagesHeader">
          <i class="fa fa-file-text-o"></i>
          <h1>Pages</h1>
          <span class="open" id="pagesOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="pagesClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="pagesContent">
          <div class="row pages">

          <?php
              $pages = $peacock->fetchPagesArray();
              foreach($pages as $page){

                $editable = true;
                if(gettype($disableEditOnPages) == 'array'){
                  foreach($disableEditOnPages as $disableEditOnPage){
                    if ($disableEditOnPage == $page['pagename']){
                      $editable = false;
                    }
                  }
                }else{
                  if ($disableEditOnPages != null){
                    die('$disableEditOnPages is not ARRAY type in theme config');
                  }
                }

                $originalEnablePageImagesSetting = $enablePageImages;

                if ($enablePageImages == false || $enablePageImages == null){
                  if(gettype($enablePageImagesTo) == 'array'){
                    foreach($enablePageImagesTo as $enablePageImage){
                      if ($enablePageImage == $page['pagename']){
                        $enablePageImages = true;
                      }
                    }
                  }
                }elseif ($enablePageImages == true){
                  if(gettype($disablePageImagesTo) == 'array'){
                    foreach($disablePageImagesTo as $disablePageImage){
                      if ($disablePageImage == $page['pagename']){
                        $enablePageImages = false;
                      }
                    }
                  }
                }

                if (!isset($usePageGroups)){
                  $usePageGroups = false;
                }

                if ($page['isGrouped'] == 'false'){
                  if ($blogging == false && $page['type'] == 'blog'){

                  }else{
                    echo '<div class="col-xs-12 page">';

                    if ($page['status'] == 'active' && $page['type'] != 'subpage'){
                      echo '<a class="visible" href="changePageStatus.php?id=' . $page['id'] . '&status=hidden"><i class="fa fa-eye"></i></a>';
                    }
                    if ($page['status'] == 'hidden' && $page['type'] != 'subpage'){
                      echo '<a class="notVisible" href="changePageStatus.php?id=' . $page['id'] . '&status=active"><i class="fa fa-eye-slash"></i></a>';
                    }

                    if ($page['type'] == 'homepage'){
                      echo '<span>'.$page['pagename'].'</span>';
                      echo '<span class="type">homepage</span>';
                      if ($page['status'] == 'draft'){
                        echo '<span class="type">[draft]</span>';
                      }
                      echo '<span class="options">';
                      if ($editable == true){
                        echo '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                      }
                      if ($page['draft'] == 'yes' && $page['status'] != 'draft'){
                        echo '<a href="../EditPage/'.$page['id'].'/draft">open draft</a>';
                      }
                      if ($enablePageImages == true){
                        if ($page['image'] != null){
                            echo "<a href='setPageImage.php?id="
                                . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                        }else{
                            echo "<a href='setPageImage.php?id="
                                . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                        }
                      }
                      if ($peacock->isPageSourceEditingAllow() == true){
                          echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                  . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
                      }
                      echo '</span>';
                    }
                    if ($page['type'] == 'blog'){
                      echo '<span>'.$page['pagename'].'</span>';
                      echo '<span class="type">blog</span>';
                      echo '<span class="options">';
                        if ($editable == true){
                          echo '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                        }
                        if ($enablePageImages == true){
                          if ($page['image'] != null){
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                          }else{
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                          }
                        }
                        if ($peacock->isPageSourceEditingAllow() == true){
                            echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                    . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
                        }
                      echo '</span>';
                    }
                    if ($page['type'] == 'contact'){
                      echo '<span>'.$page['pagename'].'</span>';
                      echo '<span class="type">contact</span>';
                      echo '<span class="options">';
                      if ($editable == true){
                        echo '<a href="editContactPage.php?id='.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                      }
                        if ($enablePageImages == true){
                          if ($page['image'] != null){
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                          }else{
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                          }
                        }
                      echo '</span>';
                    }
                    if ($page['type'] == 'relink'){
                      echo '<span>'.$page['pagename'].'</span>';
                      echo '<span class="type">custom</span>';
                      echo '<span class="options">';
                      $editlink = $page['additional2'];
                      if ($editlink != null || $editlink != ""){
                        echo '<a href="/'.$editlink.'/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                      }
                      echo '<a href="editCustomPage.php?id=' . $page['id'] . '&page='.
                      $page['pagename'].'&url='.$page['additional'].'&edit='.
                      $editlink.'"><i class="fa fa-link"></i></a>';
                      echo '<a class="delete" href="deletePageConfirmation.php?id=' . $page['id'] .'&page='.$page['pagename'].'"><i class="fa fa-trash-o"></i></a>';
                      echo "</span>";
                    }
                    if ($page['type'] == 'normal'){
                      echo '<span>'.$page['pagename'].'</span>';
                      if ($page['status'] == 'draft'){
                        echo '<span class="type">[draft]</span>';
                      }
                      echo '<span class="options">';
                        if ($editable == true){
                          echo '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                        }
                        if ($page['draft'] == 'yes' && $page['status'] != 'draft'){
                          echo '<a href="../EditPage/'.$page['id'].'/draft">open draft</a>';
                        }
                        if ($enablePageImages == true){
                          if ($page['image'] != null){
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                          }else{
                              echo "<a href='setPageImage.php?id="
                                  . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                          }
                        }
                        if ($peacock->isPageSourceEditingAllow() == true){
                            echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                    . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
                        }
                        echo '<a class="delete" href="deletePageConfirmation.php?id=' . $page['id'] .'&page='.strip_tags($page['pagename']).'"><i class="fa fa-trash-o"></i></a>';
                      echo '</span>';
                    }
                    if ($page['type'] == 'group' && $usePageGroups == true){
                      echo "<a href='editPageGroup.php?grpID=".$page['id']."'>".$page['pagename']."</a>";
                      echo '<span class="options">';
                      echo "<a href='setGroupPageLink.php?grp=".$page['id']."'><i class='fa fa-link'></i></a>";
                      echo '</span>';
                    }
                    echo '</div>';
                  }
                }
                $enablePageImages = $originalEnablePageImagesSetting;
              }
          ?>
          </div>
          <div class="linkbar">
            <ul>
              <li id="createPageBtn"><i class="fa fa-pencil-square-o"></i> Create</li>
              <li id="customPageBtn"><i class="fa fa-link"></i> Custom</li>
              <li id="arrangePagesBtn"><i class="fa fa-random"></i> Arrange</li>
              <?php

                if ($usePageGroups == true){
                  echo '<li id="CreateGroupBtn"><i class="fa fa-object-group"></i> Create Group</li>';
                }

               ?>
            </ul>
          </div>
        </div>
        <!-- Pages Panel END -->


        <!-- SubPages Panel START -->
        <div class="panel-header" id="subPagesHeader">
          <i class="fa fa-file-text-o"></i>
          <h1>Sub Pages</h1>
          <span class="open" id="subPagesOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="subPagesClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="subPagesContent">
          <div class="row pages">
          <?php
              $pages = $peacock->fetchPagesArray();
              foreach($pages as $page){
                if ($page['isGrouped'] == 'false' && $page['type'] == 'subpage'){
                  echo '<div class="col-xs-12 page">';

                  if ($page['status'] == 'active'){
                    echo '<a class="visible" href="changePageStatus.php?id=' . $page['id'] . '&status=hidden"><i class="fa fa-eye"></i></a>';
                  }
                  if ($page['status'] == 'hidden'){
                    echo '<a class="notVisible" href="changePageStatus.php?id=' . $page['id'] . '&status=active"><i class="fa fa-eye-slash"></i></a>';
                  }

                  echo '<span>'.$page['pagename'].'</span>';
                  if ($page['status'] == 'draft'){
                    echo '<span class="type">[draft]</span>';
                  }
                  echo '<span class="options">';
                    echo '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                    if ($page['draft'] == 'yes' && $page['status'] != 'draft'){
                      echo '<a href="../EditPage/'.$page['id'].'/draft">open draft</a>';
                    }
                    if ($enablePageImages == true){
                      if ($page['image'] != null){
                          echo "<a href='setPageImage.php?id="
                              . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                      }else{
                          echo "<a href='setPageImage.php?id="
                              . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                      }
                    }
                    if ($peacock->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $page['id'] . "'>Edit Source</a>";
                    }
                    echo '<a class="delete" href="deletePageConfirmation.php?id=' . $page['id'] .'&page='.strip_tags($page['pagename']).'"><i class="fa fa-trash-o"></i></a>';
                  echo '</span>';
                  echo '</div>';
                }
              }
          ?>
          </div>
          <div class="linkbar">
            <ul>
              <li id="createSubPageBtn"><i class="fa fa-pencil-square-o"></i> Create</li>
            </ul>
          </div>
        </div>
        <!-- SubPages Panel END -->


        <!-- Blog Panel START -->
        <div class="panel-header" id="blogHeader">
          <i class="fa fa-pencil"></i>
          <h1>Blog Posts</h1>
          <span class="open" id="blogOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="blogClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="blogContent">
          <div class="row pages">
            <?php
              $posts = $peacock->fetchBlogPostsArray($username);
              $categories = $peacock->fetchCategories();
              foreach($categories as $category){
                echo '<div class="col-xs-12 page voffset3">';
                echo "<div class='categoryBG'>".$category['name']." <span class='options'><a href='editCategory.php?id=".$category['id']."&category=".$category['name']."'><i class='fa fa-cog'></i> edit category</a></span>";
                echo '</div>';
                echo '</div>';
                $count = 0;
                foreach($posts as $post){
                  if ($post['category'] == $category['id']){
                    echo '<div class="col-xs-12 page">';
                      if ($post['status'] == 'active'){
                        echo '<a class="visible" href="changePostStatus.php?id='
                        . $post['id'] . '&status=hidden"><i class="fa fa-eye"></i></a>';
                      }
                      if ($post['status'] == 'hidden'){
                        echo '<a class="notVisible" href="changePostStatus.php?id='
                        . $post['id'] . '&status=active"><i class="fa fa-eye-slash"></i></a>';
                      }
                      echo '<span>'.$post['title'].'</span>';
                      if($post['draft'] == 'yes' && $post['status'] == 'draft'){
                        echo '<span class="type">[draft]</span>';
                      }
                      echo '<span class="options">';
                        if($post['draft'] == 'yes' && $post['status'] != 'draft'){
                          if (file_exists('drafts/posts/postDraft-'.$post['id'].'.json')){
                              echo "<a href='../EditPost/".$post['id']."/yes'>Open Draft</a>";
                          }
                        }
                        echo '<a href="../EditPost/'.$post['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                        echo '<a href="addToCategory.php?post='.$post['id'].'" id="addToCategoryBtn"><i class="fa fa-book"></i></a>';
                        if ($enableBlogCharLimit == true){
                          echo '<a href="postCharLimit.php?post='.$post['id'].'"><i class="fa fa-hand-scissors-o"></i></a>';
                        }
                        echo '<a class="delete" href="deletePostConfirmation.php?id='
                        . $post['id'] .'&post='.strip_tags($post['title']).'"><i class="fa fa-trash-o"></i></a>';
                      echo '</span>';
                    echo '</div>';
                    $count++;
                  }
                }
                if ($count < 1){
                  echo '<div class="col-xs-12 page">';
                  echo "No pages.";
                  echo '</div>';
                }
              }
            ?>
          </div>
          <div class="linkbar">
            <ul>
              <li id="createPostBtn"><a href="/CreatePost"><i class="fa fa-pencil-square-o"></i> Create Post</a></li>
              <li id="categoriesBtn"><i class="fa fa-list-alt"></i> Categories</li>
            </ul>
          </div>
        </div>
        <!-- Blog Panel END -->

        <!-- Load Plugins -->
      <?php $peacock->loadPlugins(); ?>

      </div>


      <div class="col-md-5 nopadding border-left">

        <!-- Site Panel START -->
        <div class="panel-header" id="siteHeader">
          <i class="fa fa-star-o"></i>
          <h1>Site</h1>
          <span class="open" id="siteOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="siteClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="siteContent">
          <div class="row pages">
            <div class="col-md-4">
              Website Name:
            </div>
            <div class="col-md-8">
              <input type="text" name="sitename" id="sitename"
              value="<?php echo $peacock->getSiteName(); ?>">
            </div>
            <br><br>
            <div class="col-md-4">
              Meta Tags:
            </div>
            <div class="col-md-8">
              <input type='text' name="tags"
              id = "siteTags" value="<?php echo $peacock->getSiteTags(); ?>">
            </div>
            <br><br>
            <div class="col-xs-12">
              Meta Description:
            </div>
            <div class="col-xs-12">
              <textarea class='ptextbox' name="description" id="siteDescription"><?php echo $peacock->getSiteDescription(); ?></textarea>
            </div>
          </div>
          <div class="linkbar">
            <?php
                if ($peacock->checkSiteImageStatus() == 'yes'){
                    echo "<input type='checkbox' name='useSiteImage' id='UseSiteImage' checked/> <label for='UseSiteImage'>Use Website Image</label>";
                }else{
                    echo "<input type='checkbox' name='useSiteImage' id='UseSiteImage' /> <label for='UseSiteImage'>Use Website Image</label>";
                }
            ?>
          </div>
          <div class="linkbar" id="siteImage">
            <div class="siteImage">
              <?php

                  if ($peacock->getSiteImage(true) == null){
                      echo "<span>No Image</span>";
                  }else{
                      echo "<img src='../view/siteImage/".$peacock->getSiteImage(true)."'>";
                  }
              ?>
            </div>
            <form action="siteImageUpload.php" enctype="multipart/form-data" method="post">
              <input type="file" class="inputFile" id="file" name="file"/><label for="file"><span>Select Image</span></label><input type="submit" value="Upload" class="submitBtn"/>
            </form>
          </div>
        </div>
        <!-- Site Panel END -->


        <!-- Theme Panel START -->
        <div class="panel-header" id="themeHeader">
          <i class="fa fa-paint-brush"></i>
          <h1>Theme</h1>
          <span class="open" id="themeOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="themeClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="themeContent">
          <div class="row pages">
            <form action="submission.php" method="post">
              <div class="col-md-4">
                Website Theme:
              </div>
              <div class="col-md-8 text-right">
                <select name='sitetheme' class='ptextbox'>
                  <?php
                          foreach ($themes as $theme){
                              if ($theme == $currentTheme){
                                  echo "<option value='$theme' selected>$theme</option>";
                              }else{
                                  echo "<option value='$theme'>$theme</option>";
                              }
                          }
                      ?>
                </select><input type='submit' class='submitBtn' value='Change'>
                <input type="hidden" name="subType" value="siteTheme">
              </div>
              <div class="col-xs-12 text-right">
                <input type="checkbox" name="importThemeContents" for="importTheme" />
                <label for="importTheme">Import Theme Page Styles* (if applicable)</label>
                <br>*<b>CAUTION</b>: If checked this action will deleted all page content!
              </div>
            </form>
          </div>
          <div class="linkbar">
            <ul>
            <?php

                if (HEADER_FILE != null){
                    $headerFile = "../view/themes/".$currentTheme."/".HEADER_FILE;
                    if (file_exists($headerFile)){
                        echo "<li><a href='editFile.php?type=HTML&file=$headerFile'><i class='fa fa-file-code-o'></i> Edit Header Code</a></li>";
                    }
                }

                if (FOOTER_FILE != null){
                    $footerFile = "../view/themes/".$currentTheme."/".FOOTER_FILE;
                    if (file_exists($footerFile)){
                        echo "<li><a href='editFile.php?type=HTML&file=$footerFile'><i class='fa fa-file-code-o'></i> Edit Footer Code</a></li>";
                    }
                }


                if (CSS_EDITOR_FILE != null){
                    $cssFile = "../view/themes/".$currentTheme."/".CSS_EDITOR_FILE;
                    if (file_exists($cssFile)){
                        echo "<li><a href='editFile.php?type=CSS&file=$cssFile'><i class='fa fa-css3'></i> Edit CSS Code</a></li>";
                    }
                }

            ?>
            </ul>
          </div>
        </div>
        <!-- Theme Panel END -->


        <!-- Image Panel START -->
        <div class="panel-header" id="imagesHeader">
          <i class="fa fa-picture-o"></i>
          <h1>Images</h1>
          <span class="open" id="imagesOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="imagesClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="imagesContent">
          <div class="row pages">
            <div class="col-xs-12 text-center">
              <a href="viewImageFolders.php" class="submitBtn">GO TO IMAGE MANAGER</a>
            </div>
          </div>
          <div class="row pages">
            <div class="col-xs-12">5 most recent images uploaded<br><br></div>
            <?php
              $images = $peacock->fetchImagesArray(5,'newest');
              foreach($images as $image){
                $name = $image['name'];
                if ($name == null){
                  $name = $image['image'];
                }
                $file = $image['image'];
                echo '<div class="row images">';
                echo '<div class="col-xs-3 vcenter"><img class="shadow" src="../view/image/'.$file.'" width="100%"/></div>';
                echo '<div class="col-xs-6 text-center vcenter">'.$name.'</div>';
                echo '<div class="col-xs-3 vcenter">
                  <a href="RenameImage.php?id='.$image['id'].'&file='.$file.'"><i class="fa fa-cog"></i></a>
                  <a class="delete" href="deleteImage.php?id='.$image['id'].'&file='.$image['image'].'"><i class="fa fa-trash-o"></i></a>
                </div>';
                echo '</div>';
              }
            ?>
          </div>
          <div class="linkbar">
            <form action="multiUploader.php" enctype="multipart/form-data" method="post">
              <input type="file" class="inputFile" id="image" data-multiple-caption="{count} images selected" name='files[]' multiple="multiple" min="1" max="9999"/><label for="image"><span>Select Images</span></label><input type="submit" value="Upload" class="submitBtn"/>
            </form>
          </div>
        </div>
        <!-- Image Panel END -->

        <!-- Plugins Panel START -->
        <div class="panel-header" id="pluginsHeader">
          <i class="fa fa-puzzle-piece"></i>
          <h1>Plugins</h1>
          <span class="open" id="pluginsOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="pluginsClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="pluginsContent">
          <div class="row pages">
            <div class="col-xs-12">
              <h1>List of installed plugins</h1>
              <?php
                $pluginsInstalled = $peacock->fetchPluginsList();
                foreach($pluginsInstalled as $plugin){
                  echo '<span>'.$plugin['plugin'].' <a class="delete" href="RemovePlugin.php?id=' .$plugin['id'] .'"><i class="fa fa-trash-o"></i></a></span><br>';
                }
               ?>
               <br><br>
            </div>
            <div class="col-xs-12 text-right">
              <form method="post" action="submission.php">
                <select name='pluginList'>
                  <?php
                      foreach ($plugins as $plugin){
                          if ($peacock->checkPluginExist($plugin) == false){
                              echo "<option value='$plugin'>$plugin</option>";
                          }
                      }
                  ?>
                </select><input type='submit' class='submitBtn' value='Install Plugin'>
                <input type='hidden' name='subType' value='addPlugin'>
              </form>
            </div>
          </div>
        </div>
        <!-- Plugins Panel END -->

        <!-- Options Panel START -->
        <div class="panel-header" id="optionsHeader">
          <i class="fa fa-wrench"></i>
          <h1>Options</h1>
          <span class="open" id="optionsOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="optionsClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="optionsContent">
          <div class="row pages">
            <div class="col-xs-6">Page source editing</div>
            <div class="col-xs-6">
              <select id="PageSourceEditing">
              <?php
                  $pageSourceEditing = $peacock->isPageSourceEditingAllow();
                  if ($pageSourceEditing == true){
                      echo '<option value="yes" selected>Enabled</option>';
                      echo '<option value="no">Disable</option>';
                  }else{
                      echo '<option value="no" selected>Disabled</option>';
                      echo '<option value="yes">Enable</option>';
                  }
              ?>
              </select>
            </div>
          </div>
          <div class="row pages">
            <h2>Backup Website</h2>
            <p>Click the button below to generate a backup of your site.</p>
            <span class="text-center">
                <a href="genSiteBackup.php"><div class="submitBtn">Back Up Website</div></a>
            </span>
            <p>To revert to and older version of your site use the select box to select a backup you wish to revert to and click 'revert' to make the changes.
              <br>CAUTION: All data will get deleted and reverted to your last backup. User account information will get lost if it was not backed up.</p>
            <form method="POST" action="loadSiteBackup.php">
                <select name='backupfile' class='ptextbox'>
                    <?php
                        $BackupLines = file("backups/backupList.txt");
                        foreach ($BackupLines as $line){

                            $line = preg_replace('/\s+/', '', $line);

                            if ($line == $theme){
                                echo "<option value='$line' selected>$line</option>";
                            }else{
                                echo "<option value='$line'>$line</option>";
                            }
                        }
                        //fclose($BackupLines);
                    ?>
                </select><input type="submit" class="submitBtn" value="Revert"/>
            </form>
          </div>
        </div>
        <!-- Options Panel END -->

        <!-- Users Panel START -->
        <div class="panel-header" id="usersHeader">
          <i class="fa fa-user"></i>
          <h1>users</h1>
          <span class="open" id="usersOpen"><i class="fa fa-plus"></i></span>
          <span class="minus" id="usersClose"><i class="fa fa-minus"></i></span>
        </div>
        <div class="panel-body" id="usersContent">
          <div class="row pages">
            <h1>List of Peacock CMS Users</h1>
            <?php
              $users = $peacock->fetchUsers($username);
              foreach($users as $user){
                echo '<div class="col-xs-12">';
                  echo '<span>'.$user['user'];
                  if ($user['admin'] == true){
                    echo '<span class="type">administrator</span>';
                  }
                  echo '</span>';
                  if ($user['editable'] == true){
                    echo '<a href="editUserDetails.php?id=' .$user['user'] .'"><i class="fa fa-cog"></i></a>';
                  }
                  if ($user['deletable'] == true){
                    echo '<a class="delete" href="deleteUser.php?id=' .$user['user'] .'"><i class="fa fa-trash-o"></i></a>';
                  }
                echo '</div>';
              }
            ?>
          </div>
          <div class="linkbar">
            <?php
              if ($peacock->checkPrivileges($username)){
                echo '<ul>
                  <li id="NewUserBtn"><i class="fa fa-user-plus"></i> Create New User</li>
                </ul>';
              }
            ?>
          </div>
        </div>
        <!-- Users Panel END -->

      </div>

    </div>

    <?php
      $footer = new Footer;
      echo $footer->display();
    ?>

    <!-- Dialog Boxes Start -->

    <!-- Create Page Dialog Box START -->
    <div class="dialogBox" id="createPage">
      <div class="dialogBoxHeader" style="width:500px">Choose Template</div>
      <div class="dialogBoxBody">
        <?php $peacock->fetchListOfTemplates('normal') ?>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="/CreatePage/normal/NewTemplate">
              <i class="fa fa-pencil-square-o"></i> Create New Template
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Create Page Dialog Box END -->

    <!-- Custom Page Dialog Box START -->
    <div class="dialogBox" id="customPage">
      <div class="dialogBoxHeader" style="width:600px">Custom Page Link</div>
      <div class="dialogBoxBody">
        <div class="row">
          <div class="col-md-4">Custom Page Name:</div>
          <div class="col-md-8">
            <input size="40" type="text" id='CustomPageName' class="ptextbox"
            placeholder="Insert Page Name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Custom Page Link:</div>
          <div class="col-md-8">
            <input size="40" type='text' id='CustomPageLink' class="ptextbox"
            placeholder="ie http://www.url-name.com">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Edit Custom Page Link:</div>
          <div class="col-md-8">
            <input size="40" type='text' id='CustomEditPageLink' class="ptextbox"
            placeholder="Not Required Advanced Users Only">
          </div>
        </div>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="#" id="CustomPageSubmit" class="pDialogBoxButton">Create Custom Page</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Custom Page Dialog Box END -->

    <!-- Arrange Pages Dialog Box START -->
    <div class="dialogBox" id="arrangePages" style="width:500px">
      <div class="dialogBoxHeader">Arrange Pages</div>
      <div class="dialogBoxBody">
        <p>Drag the items up and down to sort.</p>
        <ul class='MoveableBox' id='pMoveablePageBox'>
        <?php
          foreach ($pages as $page){
            if ($page['isGrouped'] == 'false'){
              if ($blogging == false && $page['type'] == 'blog'){
                //don't display blog
              }else{
                echo "<li id='item_".$page['id']."'>".strip_tags($page['pagename'])."</li>";
              }
            }
          }
        ?>
        </ul>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="/CreatePage/normal/NewTemplate">
              <a href="#" id="ArrangePagesSubmit" class="pDialogBoxButton">Save</a>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Arrange Pages Dialog Box END -->


    <!--  Create Group -->
    <div id="CreateGroup" class="dialogBox" style="width:500px">
    	<div class="dialogBoxHeader">
    		Create Group
    	</div>

      <div class="dialogBoxBody">
        <div class="row">
          <div class="col-md-3">Group Name:</div>
          <div class="col-md-9"><input type="text" id='GroupName' placeholder="Insert Group Name"/></div>
        </div>
      </div>
      <div class="linkbar">
        <ul>
          <li>
              <a href="#" id="CreateGroupSubmit">Create Group</a>
          </li>
        </ul>
      </div>
    </div>



    <!-- Create Sub Page Dialog Box START -->
    <div class="dialogBox" id="createSubPage">
      <div class="dialogBoxHeader" style="width:500px">Choose Template</div>
      <div class="dialogBoxBody">
        <?php $peacock->fetchListOfTemplates('subpage') ?>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="/CreatePage/normal/NewTemplate">
              <i class="fa fa-pencil-square-o"></i> Create New Template
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Create Sub Page Dialog Box END -->


    <!-- Categories Dialog Box START -->
    <div class="dialogBox" id="createSubPage">
      <div class="dialogBoxHeader" style="width:500px">Choose Template</div>
      <div class="dialogBoxBody">
        <?php $peacock->fetchListOfTemplates('subpage') ?>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="/CreatePage/normal/NewTemplate">
              <i class="fa fa-pencil-square-o"></i> Create New Template
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Categories Dialog Box END -->

    <!-- Categories Dialog Box START -->
    <div class="dialogBox" id="categoriesMenu">
      <div class="dialogBoxHeader" style="width:500px">Choose what you want to do</div>
      <div class="dialogBoxBody">
        <div class="row">
          <div class="col-md-6">
            <a id="categoryAddBtn" class="btn-full-width"><i class="fa fa-plus"></i> Add Category</a>
          </div>
          <div class="col-md-6">
            <a id="categoryRemoveBtn" class="btn-full-width"><i class="fa fa-times"></i> Remove Category</a>
          </div>
        </div>
        <div class='row'>
          <div class="col-md-6 voffset3">
            <a id="categoryArrangeBtn" class="btn-full-width"><i class="fa fa-random"></i> Arrange Category</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories Dialog Box END -->

    <!-- Add Category Dialog Box START -->
    <div class="dialogBox" id="categoryAdd">
      <div class="dialogBoxHeader" style="width:500px">Add Category</div>
      <div class="dialogBoxBody">
        <form action="submission.php" method="post">
        <div class="row">
          <div class="col-md-5">
            Category name:
          </div>
          <div class="col-md-7">
            <input type="text" name="categoryname" />
            <input type="hidden" name="subType" value="addCategory"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            Select category icon:
            <div class='displayImage' style="width:100px"></div>
          </div>
        </div>
        <div class='row'>
          <div class="col-md-3">Folder</div>
          <div class="col-md-9"><select class='imageFolders'></select></div>
        </div>
        <div class='row'>
          <div class="col-xs-3">Image</div>
          <div class="col-xs-9"><select name='image' class='imageSelect'></select></div>
        </div>
        <div class="row voffset3 text-right">
          <div class="col-md-12">
            <input class="submitBtn" type="submit" value="Add"/>
          </div>
        </div>
        </form>
      </div>
    </div>
    <!-- Add Category Dialog Box END -->

    <!-- Remove Category Dialog Box START -->
    <div class="dialogBox" id="categoryRemove">
      <div class="dialogBoxHeader" style="width:500px">Remove Categories</div>
      <div class="dialogBoxBody">
        <?php

          $categories = $peacock->fetchCategories();
          if ($categories != null){
            foreach($categories as $category){
              if ($category['id'] != 1){
                echo "
                  <div class='row' id='cat-row-".$category['id']."'>
                    <div class='col-md-8'>
                      ".$category['name']."<br><br>
                    </div>
                    <div class='col-md-4'>
                      <input type='hidden' id='cat-remove-".$category['id']."' value='".$category['id']."'/>
                      <span class='submitBtn' id='remove-btn-".$category['id']."'><i class='fa fa-trash-o'></i> Remove</span>
                    </div>
                  </div>

                  <script>
                    $(document).ready(function(){
                      $('#remove-btn-".$category['id']."').click(function(){
                        var id = $('#cat-remove-".$category['id']."').val();
                        $.post('deleteCategorySubmit.php',{id : id})
                          .done(function(data){
                            if(data === 'success'){
                              $('#cat-row-".$category['id']."').fadeOut();
                            }
                          });
                      });
                    });
                  </script>
                ";
              }else{
                echo "empty!";
              }

            }
          }else{
            echo "empty!";
          }

         ?>
      </div>
    </div>
    <!-- Remove Category Dialog Box END -->



    <!-- Arrange Category Dialog Box START -->
    <div class="dialogBox" id="categoryArrange" style="width:500px">
      <div class="dialogBoxHeader">Arrange Categories</div>
      <div class="dialogBoxBody">
        <p>Drag the items up and down to sort.</p>
        <ul class='MoveableBox' id='pMoveableCategoriesBox'>
        <?php
          $categories = $peacock->fetchCategories();
          foreach ($categories as $category){
            echo "<li id='item_".$category['id']."'>".$category['name']."</li>";
          }
        ?>
        </ul>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a href="#" id="ArrangeCategoriesSubmit">Save</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Arrange Category Dialog Box END -->


    <!-- Create New User Dialog Box START -->
    <div class="dialogBox" id="NewUser">
      <div class="dialogBoxHeader" style="width:500px"><i class="fa fa-user-plus"></i> Create New User</div>
      <div class="dialogBoxBody">
        <div class="row pages">
          <div class="col-md-4">Avatar</div>
          <div class="col-md-8">
            <select name='avatar' id='avatar'>
              <option value='none'>none</option>
              <?php
                $data = mysqli_query($db,"SELECT * FROM images");
                    while ($get_data = mysqli_fetch_assoc($data)){
                      if ($get_data['imagename'] == null){
                        echo "<option value='".$get_data['image']."'>".$get_data['image']."</option>";
                      }else{
                        echo "<option value='".$get_data['image']."'>".$get_data['imagename']."</option>";
                      }
                    }
              ?>
            </select>
          </div>
        </div>
        Username: <input type='text' name='newusername' id='newusername' class="ptextbox"><br><br>
        First Name: <input type='text' name='firstname' id='firstname' class="ptextbox"><br><br>
        Last Name: <input type='text' name='lastname' id='lastname' class="ptextbox"><br><br>
        Email: <input type='text' name='email' id='email' class="ptextbox"><br><br>
        Password: <input type='password' name='password' id='password' class="ptextbox"><br><br>
        Retype Password: <input type='password' name='retypepassword' id='retypepassword' class="ptextbox"><br><br>
        Account Type: <select name='accounttype' id='accounttype' class="ptextbox">

                            <option value='administrator'>Administrator</option>
                            <option value='developer'>Developer</option>
                            <option value='blogger'>Blogger</option>

                        </select>
      </div>
      <div class="linkbar">
        <ul>
          <li>
            <a id="NewUserSubmit">
              <i class="fa fa-user-plus"></i> Create New User
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Create New User Dialog Box END -->

    <!-- Dialog Boxes END -->
    <script src='js/peacock-image-list.js'></script>
    <script src="js/peacockUI.js" charset="utf-8"></script>
  </body>

</html>
