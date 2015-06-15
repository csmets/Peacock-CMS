<html>
<head>
    <title>Access Violation</title>
    <?php include('../peacockCMS.php'); $peacock = new Peacock; $peacock->removePageMargins(); ?>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />  
</head>
<body>   
        <div id="pContentBox">
            <div class="vertAlign" id="pErrorBoxHeader" name="pagesheader">
                <p class="ph1">&nbsp;&nbsp;ACCESS VIOLATION!</p>
            </div>
            <div id="pContentBoxContent" class="pbodyTxt" name="pagescontent">
                <p class="pbodyTxt">Attemped access to a page without permission! Credentials are required.</p>
                <br>
                <a href='../index.php' class="plinkTxt">Click here to return to main page</a>
                </div>
        </div>
</body>
</html>