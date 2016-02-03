$(document).ready(function(){

  $.get("pImageFolders.php",function(data){
     $(".imageFolders").html(data);
  },"html");


  $.get("pEditorImages.php",{folder : "Uncategorised"},function(data){
     $(".imageSelect").html(data);
  },"html");

  $(".imageFolders").change(function(){
      var folder = $(this).val();
      $.get("pEditorImages.php",{folder : folder},function(data){
         $(".imageSelect").html(data);
      },"html");
  });
  $(".imageSelect").change(function(){
      var value = $(this).val();
      if (value == "none"){
          $(".displayImage").html("");
      }else{
          var image = "<img src='../view/image/"+value+"' width='200px' />";
          $(".displayImage").html(image);
      }
  });
});
