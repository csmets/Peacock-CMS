<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include('initPeacock.php');


    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $PageID = $_GET['id'];
    $PageImage = $_GET['img'];
?>

<html>

<head>
    <title>Peacock>Dashboard | Set Page Image</title>
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
                <td width='60%' align='left'><br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Content Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="image"></span>&nbsp;
                <a class="ph1">Set Page Image</a>
            </div>
            <div class="pContentBoxContent">
                <form action="submission.php" method='post'>
                    <?php
			
                        $PageImg = $peacock->getPageImage($PageID);
                        echo "Page Image: <select name='pageimage'>";

                        if ($PageImg != null || $PageImg != ''){
                            echo "<option value='$PageImg' selected>$PageImg</option>";
                        }

                        echo "<option value='none'>none</option>";
                            $sqlconnect = new Connectdb;
                            $db = $sqlconnect->connectTo();

                            $data = mysqli_query($db,"SELECT * FROM images");
                            while ($get_data = mysqli_fetch_assoc($data)){
                                if ($get_data['imagename'] == null){
                                    echo "<option value='".$get_data['image']."'>".$get_data['image']."</option>";
                                }else{
                                    echo "<option value='".$get_data['image']."'>".$get_data['imagename']."</option>";
                                }
                            }
                            $db->close();
                        echo "</select>";
                    ?>
                    <input type='hidden' name='id' value='<?php echo $PageID; ?>'>
                    <input type='hidden' name='subType' value='setPageImage'>
                    <input type='submit' value='Set Image'>
                </form>
            </div>
        </div>
        
    </div>
    
</body>



</html>