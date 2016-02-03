<?php
include("../../../config/config.php");
include('../../../src/CLASS_Connectdb.php');

include_once ("GallerySettings.php");

//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES...
if($pagenum>=1&&$pagenum<=$total_pages)
{
    echo "<ul>";
    //THE RESULTS WILL APPEAR
    while($r=mysqli_fetch_assoc($q))
    {
        echo "<li><a href='view/image/".$r['imageFile']."' data-lightbox='gallery'><img src='view/image/".$r['imageFile']."'></a></li>";
    }
	echo "</ul>";
} else {
    //OTHERWISE, THE PAGE WILL REDIRECT TO THE FIRST PAGE OF RESULTS
    header("Location: ImageResults.php");
}

?>
