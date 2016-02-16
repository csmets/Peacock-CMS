$(document).ready(function(){

  $.get("pImageFolders.php",function(data){
     $(".imageFolders").html(data);
  },"html");


  $.get("pEditorImages.php",{folder : "Uncategorised"},function(data){
    var existingImage = $(".existingImage").val();
    if (existingImage !== null && existingImage === "" && existingImage === undefined){
      var append = "<option value='"+existingImage+"'>"+existingImage+"</option>";
      $(".imageSelect").html(append+data);
    }else{
      $(".imageSelect").html(data);
    }

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
