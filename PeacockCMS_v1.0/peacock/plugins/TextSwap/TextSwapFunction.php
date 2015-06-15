<?php

class TextSwap{
    
    public function fetchList(){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();   
        $sql = "SELECT * FROM textswap";
        $query = mysqli_query($db,$sql);
        while($get_data = mysqli_fetch_assoc($query)){
            if ($get_data['usetext'] == 'yes'){
                echo substr($get_data['content'],0,80)." {IN USE} <a href='plugins/TextSwap/TextSwapUnUseSubmit.php?id=".$get_data['id']."' class='pEditLinkButton'>Don't Use</a> <a href='plugins/TextSwap/TextSwapDeleteSubmit.php?id=".$get_data['id']."' class='pDeleteLinkButton'>Delete</a>";
            }else{
                echo substr($get_data['content'],0,80)." <a href='plugins/TextSwap/TextSwapUseSubmit.php?id=".$get_data['id']."' class='pEditLinkButton'>Use</a> <a href='plugins/TextSwap/TextSwapDeleteSubmit.php?id=".$get_data['id']."' class='pDeleteLinkButton'>Delete</a>";
            }
            echo "<br><br>";
        }
    }
    
    public function getTextSwap(){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();   
        $sql = "SELECT * FROM textswap";
        $query = mysqli_query($db,$sql);
        while($get_data = mysqli_fetch_assoc($query)){
            if ($get_data['usetext'] == 'yes'){
                return $get_data['content'];
            }
        }  
    }
    
}

?>