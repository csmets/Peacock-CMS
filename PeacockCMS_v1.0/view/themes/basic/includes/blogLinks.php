<div class="basicLinksbar">
    <?php
        echo "<center>";
        if($peacock->getSiteImage() != null){
            echo "<a href='index.php'><img src='view/siteImage/".$peacock->getSiteImage()."' width='100px'></a>";
        }
        echo "<h2>".$peacock->getSiteName()."</h2></center>";
    ?>
	<img src="view/themes/basic/Images/BasicPageColorsBW.png" height="3px" width="200px">
    <br><br>
    <?php
         $peacock->displayPageLinks("blog", "basicPageBtn", "basicSubLinkBtn");
    ?>
	<br>
</div>


<div class="mobileLinksBar">
    <?php
        if($peacock->getSiteImage() != null){
            echo "<img src='view/siteImage/".$peacock->getSiteImage()."' style='width:auto;height:40px;vertical-align:middle;margin-right:10px'>";
        }
        echo "<span>".$peacock->getSiteName()." MENU</span>";
    ?>
</div>

<div class="mobileLinksBarDropDown">
    <?php
        $peacock->siteLinksFormat = "<li><a href='pageLink'>pageName</a></li>";
        echo $peacock->getSiteLinks();
    ?>
</div>

<script type="text/javascript" src="view/js/jquery-1.11.0.min.js"></script>

<script>
    $(document).ready(function(){  
        var ActiveMenu = false;       
        $(".mobileLinksBar").click(function(){
            if (ActiveMenu == false){
                $(".mobileLinksBarDropDown").css('display','block');
                ActiveMenu = true;
            }else{
                $(".mobileLinksBarDropDown").css('display','none');
                ActiveMenu = false;
            }
        });        
    });
</script>