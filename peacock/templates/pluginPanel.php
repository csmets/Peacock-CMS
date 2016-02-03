<div class="panel-header" id="{{panel-toggle-header}}">
  <div id="title">title here</div>
  <span class="open" id="{{panel-name}}Open"><i class="fa fa-plus"></i></span>
  <span class="minus" id="{{panel-name}}Close"><i class="fa fa-minus"></i></span>
</div>
<div class="panel-body" id="{{panel-toggle-content}}">
  <div id="content-body"></div>
</div>

<script>

$(document).ready(function(){

  var {{panel-name}}RanOnce = false;

  if ($.cookie('{{panel-name}}cookie') === null){
      $.cookie('{{panel-name}}cookie','open');
  }

  if (($.cookie('{{panel-name}}cookie') == 'open') && ({{panel-name}}RanOnce === false)){
      $("#{{panel-toggle-content}}").show();
      $("#{{panel-name}}Open").hide();
      $("#{{panel-name}}Close").show();
      pagesRanOnce = true;
  }
  if (($.cookie('{{panel-name}}cookie') == 'close') && ({{panel-name}}RanOnce === false)){
      $("#{{panel-toggle-content}}").hide();
      $("#{{panel-name}}Open").show();
      $("#{{panel-name}}Close").hide();
      pagesRanOnce = true;
  }

  $("#{{panel-toggle-header}}").click(function(){
    if ($.cookie('{{panel-name}}cookie') == 'close'){
      $("#{{panel-toggle-content}}").slideDown();
      $("#{{panel-name}}Open").hide();
      $("#{{panel-name}}Close").show();
      $.cookie('{{panel-name}}cookie','open');
    }else{
      $("#{{panel-toggle-content}}").slideUp();
      $("#{{panel-name}}Open").show();
      $("#{{panel-name}}Close").hide();
      $.cookie('{{panel-name}}cookie','close');
    }
  });


});

</script>
