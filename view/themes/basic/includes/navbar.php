<?php
    function displayBlogNavLinks ($id, $cssStyle){
        $peacock = new Peacock;
	    $MaxID = $peacock->getLastPostID();
        echo "<table width='100%'><tr>";
		//Older Post
		for ($oi = $id - 1; $oi > 0; $oi--){
			if ($peacock->checkPostIDExistsNoDrafts($oi) == TRUE){
				echo "<td width='50%'><a class='".$cssStyle."' href='blogPost/".$oi."'>Older Post</a></td>";
				break;
			}
        }

        //Newer Post
		for ($ni = $id + 1; $ni <= $MaxID; $ni++){
			if ($peacock->checkPostIDExistsNoDrafts($ni) == TRUE){
				echo "<td width='50%' align='right'><a class='".$cssStyle."' href='blogPost/".$ni."'>Newer Post</a></td>";
				break;
			}
        }
        echo "</tr></table>";
    }
?>
