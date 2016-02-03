<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include("initPeacock.php");
	include_once("plugins/OnlineStore/CLASS_OnlineStore.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);
	
	$onlineStore = new OnlineStore;
	
?>

<html>

<head>
    <title>Peacock | Add Product</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />  
    <?php $peacock->removePageMargins(); ?>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <script src="js/jquery-1.11.0.min.js"></script>
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
                <td width='60%' align='left'><br><a href='dashboard.php' class='plinkTxt'>Go Back</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp; &nbsp;<span class="oi" data-glyph="cart"></span>&nbsp;
                <a class="ph1">ADD NEW PRODUCT</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Fill out the form to add a new product.</p>
                <form id="productForm" action="plugins/OnlineStore/submitNewProduct.php" method="post">
                    
                    <div class="row">
                        <div class="col-md-2">
                            Name:
                        </div>
                        <div class="col-md-10">
                            <div id="nameError" style="text-transform:uppercase;color:red"></div>
                            <input type="text" id="name" name="name" class='ptextbox' size='80' />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            Image:
                        </div>
                        <div class="col-md-10">
                            <div id="displayImage">
                            
                            </div>
                            <select id="imageSelect" name="image">
                                <option value="none">none</option>
                                <?php
                                    $images = $peacock->getImages();
                                    foreach ($images as $image){
                                        echo "<option value='".$peacock->getImageFilename($image)."'>".$peacock->getImageName($image)."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            Description:
                        </div>
                        <div class="col-md-10">
                            <div id="descError" style="text-transform:uppercase;color:red"></div>
                            <textarea name="desc" id="desc" class='ptextbox' rows='6' style="width:100%"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            Price:
                        </div>
                        <div class="col-md-10">
                            $<input type="input" id="edit1" name="dollars" class='ptextbox' value="0" size="10" maxlength="10" />
                            .<input type="input" id="edit1" name="cents" class='ptextbox' value="00" size="2" maxlength="2" />
                        </div>
                    </div>
                    <br>
                    
                    <span class='pSubmitButton' id="submit">Submit</span>
                    
                </form>
            </div>
        </div>
        
    </div>
    
    <script>
    
        $(document).ready(function(){
            $("#imageSelect").change(function(){
                var value = $(this).val();
                if (value == "none"){
                    $("#displayImage").html("");
                }else{
                    var image = "<img src='../view/image/"+value+"' width='200px' />";
                    $("#displayImage").html(image);
                }
            });
            
            $('[id^=edit]').keypress(validateNumber);
            
            $("#submit").click(function(){
                var name = $("#name").val();
                var desc = $("#desc").val();
                if (name == ""){
                    $("#nameError").text("Name Required!");   
                }else{
                    $("#nameError").text(""); 
                }
                if (desc == ""){
                    $("#descError").text("Description Required!");   
                }else{
                    $("#descError").text(""); 
                }
                if (name != "" && desc != ""){
                   $("#productForm").submit(); 
                }
            });
        });
        
        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;

            if (event.keyCode == 8 || event.keyCode == 46
             || event.keyCode == 37 || event.keyCode == 39) {
                return true;
            }
            else if ( key < 48 || key > 57 ) {
                return false;
            }
            else return true;
        };
    
    </script>
    
</body>


</html>