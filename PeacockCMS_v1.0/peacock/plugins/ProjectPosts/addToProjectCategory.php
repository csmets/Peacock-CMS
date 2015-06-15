<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
	include_once ("../../../src/CLASS_Connectdb.php");
	include_once ("../../../src/CLASS_peacock.php");
    require("ProjectFunctions.php");
    $peacock = new Peacock;
    $projects = new Projects;
?>

<html>

<head>
    <title>Peacock>Dashboard</title>
    <link href="../../css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="../../font/css/open-iconic.css" rel="stylesheet">
    <?php $peacock->removePageMargins(); ?>
    
</head>

<body class="backgroundColor">

    <div>
<ul id="pHeaderElements">
    	
    <li class="pHeaderTxtWrapper">
        <image valign='middle' src="../../Images/Icons/PeacockCMS_Logo_Icon.png" height="40">&nbsp;PEACOCK CMS
    </li>

    <li class="pLogoutWrapper">
        <a href='logout.php'>    
            <span class="oi" data-glyph="power-standby"></span>&nbsp;&nbsp;LOG OUT
        </a>
    </li>

    <li class='pVisitLinkButton'><a href='../../../index.php' target="_blank">visit site</a></li>

    <li class="pHeaderUsername">
        <span class="oi" data-glyph="person"></span>&nbsp;&nbsp;<?php echo $username;?>
    </li>

</ul>
</div>
    
    <div id="pContentWrapper">
        
        <center>
        <table width='100%'>
            
            <tr>
                <td width='60%' align='left'><p class='ph2'><?php $peacock->peacockVersion() ?></p></td>
                <td align='left'></td>
            </tr>
            <tr>
                <td width='60%' align='left'><br><a href='../../controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="folder"></span>&nbsp;
                <a class="ph1">ADD TO PROJECT CATEGORY</a>
            </div>
            <div class="pContentBoxContent">
                <?php
                    $PostName = $_GET['page'];
					$PostID = $_GET['id'];
                    echo "<form action='ProjectCategorySubmit.php?id=".$PostID."' method='post'>";
                    echo "Add post <i>".$PostName."</i> to: ";
                    echo "<select name='category'>";
                        $sqlconnect = new Connectdb;
                        $db = $sqlconnect->connectTo();
                        $data = mysqli_query($db,"SELECT * FROM categories");

                        while ($get_data = mysqli_fetch_assoc($data)){
                            echo "<option value='".$get_data['id']."'>".$get_data['category']."</option>";
                        }
                
                
                    echo "</select>";
                    echo "<input type='submit' value='Add'>";
                    echo '</form>';
                    $db->close();

                    echo "<br><br>";
                    echo "<h3>Categories Project is attached to:</h3>";
                    $projects->fetchProjectsListOfCategories($PostID);
                ?>
            </div>
        </div>
        
    </div>
    
</body>



</html>