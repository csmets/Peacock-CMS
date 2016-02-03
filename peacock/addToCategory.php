<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);
?>

<html>

<head>
    <title>Peacock>Dashboard | Add to Category</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <?php $peacock->removePageMargins(); ?>
    
</head>

<body class="backgroundColor">

    <?php include("includes/header.php"); ?>
    
    <div id="pContentWrapper">
        
        <center>
        <table width='100%'>
            
            <tr>
                <td width='60%' align='left'><p class='ph2'><?php $peacock->peacockVersion() ?></p></td>
                <td align='left'></td>
            </tr>
            <tr>
                <td width='60%' align='left'><br><a href='dashboard.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="folder"></span>&nbsp;
                <a class="ph1">ADD TO CATEGORY</a>
            </div>
            <div class="pContentBoxContent">
                <?php
                	$postID = $_GET['id'];
                    $postName = $_GET['page'];
                    echo "<form action='submission.php' method='post'>";
                    echo "Add post <i>".$postName."</i> to: ";
                    echo "<select name='category'>";
                        $sqlconnect = new Connectdb;
                        $db = $sqlconnect->connectTo();
                        $data = mysqli_query($db,"SELECT * FROM categories");

                        while ($get_data = mysqli_fetch_assoc($data)){
                            echo "<option value='".$get_data['id']."'>".$get_data['category']."</option>";
                        }
                
                
                    echo "</select>";
					echo "<input type='hidden' name='id' value='".$postID."'>";
                    echo "<input type='hidden' name='subType' value='addToCategory'>";
                    echo "<input type='submit' value='Add'>";
                    echo '</form>';
                    $db->close();
                ?>
            </div>
        </div>
        
    </div>
    
</body>



</html>