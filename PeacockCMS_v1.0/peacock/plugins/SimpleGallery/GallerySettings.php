<?php
$sqlconnect = new Connectdb;
$db = $sqlconnect->connectTo();

//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE RESULTS
if(@$_GET["page"]){
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 20; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM

//FOR RESULTS OF THE PAGE
$q = mysqli_query($db,"SELECT * FROM simpleGallery ORDER BY id LIMIT $offset, $rowsperpage");

$total_q = mysqli_query($db,"SELECT * FROM simpleGallery"); //FOR ALL RESULTS
$total_nums = mysqli_num_rows($total_q); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES
?>