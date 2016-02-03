<?php

/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */


/* Class will replace existing editable divs with new - this will allow for non editable regions to not get affected by js changes */


class  AddEditables {

    //function returns string
    public function sortEditPageContentRegions($id,$content,$numOfEditables = 100,$classname = "Editable"){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $fetchData = mysqli_fetch_assoc($query);
        $originalContent = $fetchData['bodycontent'];

        $doc = new simple_html_dom();
        $doc->load($originalContent);

        $newDoc = new simple_html_dom();
        $newDoc->load($content);

        for ($i = 0; $i <= $numOfEditables; $i++){

            if ($i > 0){
                $class = $classname."-".$i;
            }else{
                $class = $classname;
            }

            foreach ($newDoc->find('div[class='.$class.']') as $node){

                $doc->find('div[class='.$class.']',0)->innertext = $node->innertext;

            }
        }

        return $doc;

    }

    public function sortPageContentRegions($templateID, $content, $numOfEditables = 100, $classname = "Editable"){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = mysqli_query($db,"SELECT * FROM templates WHERE id='$templateID'");
        $fetchData = mysqli_fetch_assoc($query);
        $templateContent = $fetchData['templateContent'];

        $doc = new simple_html_dom();
        $doc->load($templateContent);

        $newDoc = new simple_html_dom();
        $newDoc->load($content);

        for ($i = 0; $i <= $numOfEditables; $i++){

            if ($i > 0){
                $class = $classname."-".$i;
            }else{
                $class = $classname;
            }

            foreach ($newDoc->find('div[class='.$class.']') as $node){

                $doc->find('div[class='.$class.']',0)->innertext = $node->innertext;

            }
        }

        return $doc;
    }


}

?>
