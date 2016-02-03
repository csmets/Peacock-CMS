<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    require('initPeacock.php');
    $peacock = new Peacock;
    $theme = $peacock->getSiteTheme();
    include('../view/themes/'.$theme.'/config/config.php');

    class EditPageGroup extends PeacockUI{

      public function title(){
        $peacock = new Peacock;
        $groupID = $_GET['grpID'];
        $groupName = $peacock->getGroupName($groupID);
        return "Edit Page Group | $groupName";
      }


      public $enablePageImages;
      public $enablePageImagesTo;
      public $disablePageImagesTo;
      public $disableEditOnPages;

      public function content(){
        $peacock = new Peacock;
        $groupID = $_GET['grpID'];
        $groupName = $peacock->getGroupName($groupID);

        $groupedPages = "";

        $pages = $peacock->fetchPagesArray();

        foreach($pages as $page){
          if ($page['isGrouped'] == 'true'){
            $editable = true;
            if($this->disableEditOnPages !== null){
              foreach($this->disableEditOnPages as $disableEditOnPage){
                if ($disableEditOnPage == $page['pagename']){
                  $editable = false;
                }
              }
            }

            $originalEnablePageImagesSetting = $this->enablePageImages;

            if ($this->enablePageImages == false || $this->enablePageImages == null){
              if($this->enablePageImagesTo !== null){
                foreach($this->enablePageImagesTo as $enablePageImage){
                  if ($enablePageImage == $page['pagename']){
                    $enablePageImages = true;
                  }
                }
              }
            }elseif ($this->enablePageImages == true){
              if($disablePageImagesTo == 'array'){
                foreach($disablePageImagesTo as $disablePageImage){
                  if ($disablePageImage == $page['pagename']){
                    $enablePageImages = false;
                  }
                }
              }
            }

            $groupedPages .= '<div class="col-xs-12 page">';

            if ($page['status'] == 'active' && $page['type'] != 'subpage'){
              $groupedPages .= '<a class="visible" href="changePageStatus.php?id=' . $page['id'] . '&status=hidden"><i class="fa fa-eye"></i></a>';
            }
            if ($page['status'] == 'hidden' && $page['type'] != 'subpage'){
              $groupedPages .= '<a class="notVisible" href="changePageStatus.php?id=' . $page['id'] . '&status=active"><i class="fa fa-eye-slash"></i></a>';
            }

            if ($page['type'] == 'homepage'){
              $groupedPages .= '<span>'.$page['pagename'].'</span>';
              $groupedPages .= '<span class="type">homepage</span>';
              if ($page['status'] == 'draft'){
                $groupedPages .= '<span class="type">[draft]</span>';
              }
              $groupedPages .= '<span class="options">';
              if ($editable == true){
                $groupedPages .= '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
              }
              if ($page['draft'] == 'yes' && $page['status'] != 'draft'){
                $groupedPages .= '<a href="../EditPage/'.$page['id'].'/draft">open draft</a>';
              }
              if ($enablePageImages == true){
                if ($page['image'] != null){
                    $groupedPages .= "<a href='setPageImage.php?id="
                        . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                }else{
                    $groupedPages .= "<a href='setPageImage.php?id="
                        . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                }
              }
              if ($peacock->isPageSourceEditingAllow() == true){
                  $groupedPages .= "<a class='pEditLinkButton' href='editPageSource.php?id="
                          . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
              }
              $groupedPages .= '</span>';
            }
            if ($page['type'] == 'blog'){
              $groupedPages .= '<span>'.$page['pagename'].'</span>';
              $groupedPages .= '<span class="type">blog</span>';
              $groupedPages .= '<span class="options">';
                if ($editable == true){
                  $groupedPages .= '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                }
                if ($enablePageImages == true){
                  if ($page['image'] != null){
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                  }else{
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                  }
                }
                if ($peacock->isPageSourceEditingAllow() == true){
                    $groupedPages .= "<a class='pEditLinkButton' href='editPageSource.php?id="
                            . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
                }
              $groupedPages .= '</span>';
            }
            if ($page['type'] == 'contact'){
              $groupedPages .= '<span>'.$page['pagename'].'</span>';
              $groupedPages .= '<span class="type">contact</span>';
              $groupedPages .= '<span class="options">';
              if ($editable == true){
                $groupedPages .= '<a href="editContactPage.php?id='.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
              }
                if ($enablePageImages == true){
                  if ($page['image'] != null){
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                  }else{
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                  }
                }
              $groupedPages .= '</span>';
            }
            if ($page['type'] == 'relink'){
              $groupedPages .= '<span>'.$page['pagename'].'</span>';
              $groupedPages .= '<span class="type">custom</span>';
              $groupedPages .= '<span class="options">';
              $editlink = $page['additional2'];
              if ($editlink != null || $editlink != ""){
                $groupedPages .= '<a href="/'.$editlink.'/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
              }
              $groupedPages .= '<a href="editCustomPage.php?id=' . $page['id'] . '&page='.
              $page['pagename'].'&url='.$page['additional'].'&edit='.
              $editlink.'"><i class="fa fa-link"></i></a>';
              $groupedPages .= '<a class="delete" href="deletePageConfirmation.php?id=' . $page['id'] .'&page='.$page['pagename'].'"><i class="fa fa-trash-o"></i></a>';
              $groupedPages .= "</span>";
            }
            if ($page['type'] == 'normal'){
              $groupedPages .= '<span>'.$page['pagename'].'</span>';
              if ($page['status'] == 'draft'){
                $groupedPages .= '<span class="type">[draft]</span>';
              }
              $groupedPages .= '<span class="options">';
                if ($editable == true){
                  $groupedPages .= '<a href="../EditPage/'.$page['id'].'"><i class="fa fa-pencil-square-o"></i></a>';
                }
                if ($page['draft'] == 'yes' && $page['status'] != 'draft'){
                  $groupedPages .= '<a href="../EditPage/'.$page['id'].'/draft">open draft</a>';
                }
                if ($enablePageImages == true){
                  if ($page['image'] != null){
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "&img=".$page['image']."'><i class='fa fa-file-image-o'></i></a>";
                  }else{
                      $groupedPages .= "<a href='setPageImage.php?id="
                          . $page['id'] . "'><i class='fa fa-file-image-o'></i></a>";
                  }
                }
                if ($peacock->isPageSourceEditingAllow() == true){
                    $groupedPages .= "<a class='pEditLinkButton' href='editPageSource.php?id="
                            . $page['id'] . "'><i class='fa fa-file-code-o'></i></a>";
                }
                $groupedPages .= '<a class="delete" href="deletePageConfirmation.php?id=' . $page['id'] .'&page='.$page['pagename'].'"><i class="fa fa-trash-o"></i></a>';
              $groupedPages .= '</span>';
            }
            if ($page['type'] == 'group' && $usePageGroups == true){
              $groupedPages .= "<a href='editPageGroup.php?grpID=".$page['id']."'>".$page['pagename']."</a>";
              $groupedPages .= '<span class="options">';
              $groupedPages .= "<a href='setGroupPageLink.php?grp=".$page['id']."'><i class='fa fa-link'></i></a>";
              $groupedPages .= '</span>';
            }
            $groupedPages .= '</div>';


            $enablePageImages = $originalEnablePageImagesSetting;
          }

        }
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Page Group: $groupName";

        $array['content-body'] = "
          <div class='linkbar'>
            <ul>
              <li id='DeleteGroupBtn'><i class='fa fa-trash-o'></i> Delete Group</li>
              <li id='ArrangePagesBtn'><i class='fa fa-random'></i> Arrange Group</li>
              <li id='AddPageBtn'><i class='fa fa-random'></i> Add Page</li>
            </ul>
          </div>

          <div class='pages groupPages'>
          $groupedPages
          </div>

        ";

        return $array;
      }
    }

    $EditPageGroup = new EditPageGroup;
    if (!isset($enablePageImages)){
      $enablePageImages = false;
    }
    if (isset($enablePageImagesTo)){
      if (gettype($enablePageImagesTo) !== 'array'){
        die('Variable $enablePageImagesTo in theme config.php is not ARRAY type.');
      }else{
        $EditPageGroup->enablePageImagesTo = $enablePageImagesTo;
      }
    }

    if (isset($disableEditOnPages)){
      if (gettype($disableEditOnPages) !== 'array'){
        die('Variable $disableEditOnPages in theme config.php is not ARRAY type.');
      }else{
        $EditPageGroup->disableEditOnPages = $disableEditOnPages;
      }
    }

    if (isset($disablePageImagesTo)){
      if (gettype($disablePageImagesTo) !== 'array'){
        die('Variable $disablePageImagesTo in theme config.php is not ARRAY type.');
      }else{
        $EditPageGroup->disablePageImagesTo = $disablePageImagesTo;
      }
    }

    $EditPageGroup->enablePageImages = $enablePageImages;

    echo $EditPageGroup->build();

    $groupID = $_GET['grpID'];
    $peacock = new Peacock;
    $pages = $peacock->fetchPagesArray();
?>

  <div class="dialog-overlay"></div>



    <!-- Arrange Pages -->
    <div id="ArrangePages" class="dialogBox" style="width:500px">
    	<div class="dialogBoxHeader">
    		Arrange Pages
    	</div>
    	<div class="dialogBoxBody">
    		<p>Drag the items up and down to sort.</p>
            <ul class='MoveableBox' id='pMoveablePageBox'>
            <?php
                $pageOrder = 0;
                foreach($pages as $page){
                  if ($page['type'] != 'subpage' && $page['groupID'] == $groupID){
                    $pageOrder++;
                    echo "<li id='item_".$page['id']."'>".strip_tags($page['pagename'])."</li>";
                  }
                }
            ?>
            </ul>
    	</div>
      <div class='linkbar'>
        <ul>
          <li id='ArrangePagesSubmit'>Save</li>
        </ul>
      </div>
    </div>



    <div id="AddPage" class="dialogBox" style="width:500px">
    	<div class="dialogBoxHeader">
    		Add Page
    	</div>

        <div class="dialogBoxBody">
            <p>Select a Page you wish to add to the group.</p>
            <br>
        	  Add Page:
            <select name='addPage' id='addPageSelect'>
            <?php
                foreach($pages as $page){
                  if ($page['type'] != 'subpage' && $page['groupID'] != $groupID && $page['id'] != $groupID){
                    if ($page['type'] == 'group'){
                      echo "<option value='".$page['id']."'>".$page['pagename']." (Group)</option>";
                    }else{
                      echo "<option value='".$page['id']."'>".$page['pagename']."</option>";
                    }
                  }
                }
            ?>
            </select>
            <input type="hidden" value="<?php echo $groupID; ?>" id="groupID" />
        </div>
        <div class='linkbar'>
          <ul>
            <li id="addPageSubmit">Add Page</li>
          </ul>
        </div>
    </div>





    <div id="DeleteGroup" class="dialogBox" style="width:500px;">
    	<div class="dialogBoxHeader">
    	   Delete Group
    	</div>

        <div class="dialogBoxBody">
          <div class="row">
            <div class="col-xs-12">Are you sure you wish to delete this group?</div>
          </div>
          <div class="row voffset3 text-center">
            <div class="col-xs-6"><button id="DeleteAllGroupSubmit" class="submitBtn">Delete Groups and Pages</button>
            <input type="hidden" value="<?php echo $groupID; ?>" id="DeleteGroupID" /></div>
            <div class="col-xs-6"><button id="DeleteGroupSubmit" class="submitBtn">Delete Group Only</button></div>
          </div>
        </div>
    </div>





    <script>
    $(document).ready(function()  {

    	//Dialog Box Actions

    	$(".dialog-overlay, #ArrangePages, #CustomPage, #AddPage, #DeleteGroup").hide();

        $("#ArrangePagesBtn").click(function(){
        	$(".dialog-overlay, #ArrangePages").fadeIn("slow")
        });

        $("#CustomPageBtn").click(function(){
        	$(".dialog-overlay, #CustomPage").fadeIn("slow")
        });

        $("#AddPageBtn").click(function(){
        	$(".dialog-overlay, #AddPage").fadeIn("slow")
        });

        $("#DeleteGroupBtn").click(function(){
        	$(".dialog-overlay, #DeleteGroup").fadeIn("slow")
        });



        $( "#pMoveablePageBox" ).sortable();
			$('#ArrangePagesSubmit').click(function(){
				var data = $('#pMoveablePageBox').sortable('serialize');
				var subType = "arrangePages";
				$.post('submission.php',{"data":data, "subType":subType}, function(){
					location.reload();
				});
		});



        $("#CustomPageSubmit").click(function(){
        	var PageName = $("#CustomPageName").val();
        	var PageLink = $("#CustomPageLink").val();
        	var EditPageLink = $("#CustomEditPageLink").val();
        	var subType = "customPage";
        	$.post('submission.php',{
        		"PageName" : PageName,
        		"PageLink" : PageLink,
        		"EditPageLink" : EditPageLink,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });

        $("#addPageSubmit").click(function(){
        	var PageID = $("#addPageSelect").val();
            var groupID = $("#groupID").val();
        	var subType = "addPageToGroup";
        	$.post('submission.php',{
        		"PageID" : PageID,
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });


        $("#DeleteGroupSubmit").click(function(){
            var groupID = $("#DeleteGroupID").val();
        	var subType = "DeleteGroup";
        	$.post('submission.php',{
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });

        $("#DeleteAllGroupSubmit").click(function(){
            var groupID = $("#DeleteGroupID").val();
        	var subType = "DeleteGroupAll";
        	$.post('submission.php',{
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });

       	$(".dialog-overlay").click(function () {
       		$(".dialog-overlay, #ArrangePages, #CustomPage, #AddPage, #DeleteGroup").fadeOut("fast");
       		return false;
       	});

    });

    </script>
