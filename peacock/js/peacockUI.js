$(document).ready(function(){

  $(".dialog-overlay").click(function(){
    $(".dialog-overlay,#createPage,#customPage,#arrangePages,#createSubPage,#NewUser,#categoriesMenu,#categoryAdd,#categoryRemove,#categoryArrange,#CreateGroup").fadeOut("fast");
  });


  // Pages Panel START ========================================================
  var pagesRanOnce = false;

  if ($.cookie('pagescookie') === null){
      $.cookie('pagescookie','open');
  }

  if (($.cookie('pagescookie') == 'open') && (pagesRanOnce === false)){
      $("pagesContent").show();
      $("#pagesOpen").hide();
      $("#pagesClose").show();
      pagesRanOnce = true;
  }
  if (($.cookie('pagescookie') == 'close') && (pagesRanOnce === false)){
      $("#pagesContent").hide();
      $("#pagesOpen").show();
      $("#pagesClose").hide();
      pagesRanOnce = true;
  }

  $("#pagesHeader").click(function(){
    if ($.cookie('pagescookie') == 'close'){
      $("#pagesContent").slideDown();
      $("#pagesOpen").hide();
      $("#pagesClose").show();
      $.cookie('pagescookie','open');
    }else{
      $("#pagesContent").slideUp();
      $("#pagesOpen").show();
      $("#pagesClose").hide();
      $.cookie('pagescookie','close');
    }
  });

  $("#createPageBtn").click(function(){
    $(".dialog-overlay").fadeIn("slow");
    $("#createPage").fadeIn("slow");
  });

  $("#customPageBtn").click(function(){
    $(".dialog-overlay").fadeIn("slow");
    $("#customPage").fadeIn("slow");
  });

  $("#CustomPageSubmit").click(function(){
    var PageName = $("#CustomPageName").val();
    var PageLink = $("#CustomPageLink").val();
    var EditPageLink = $("#CustomEditPageLink").val();
    var subType = "customPage";
    $.post('submission.php',{
      "PageName" : PageName,
      "PageLink" : PageLink,
      "EditPageLink" : EditPageLink,
      "subType" : subType
    }, function(){
      location.reload();
    });
  });

  $("#arrangePagesBtn").click(function(){
    $(".dialog-overlay").fadeIn("slow");
    $("#arrangePages").fadeIn("slow");
  });

  $( "#pMoveablePageBox" ).sortable();
    $('#ArrangePagesSubmit').click(function(){
      var data = $('#pMoveablePageBox').sortable('serialize');
      var subType = "arrangePages";
      $.post('submission.php',{"data":data, "subType":subType}, function(){
        location.reload();
      });
  });

  $("#CreateGroupBtn").click(function(){
    $(".dialog-overlay, #CreateGroup").fadeIn("slow");
  });


  $("#CreateGroupSubmit").click(function(){
    var GroupName = $("#GroupName").val();
    var subType = "createGroup";
    $.post('submission.php',{
      "GroupName" : GroupName,
      "subType" : subType
    }, function(){
      location.reload();
    });
  });



  // Pages Panel END ==========================================================

  // Sub Pages Panel START ====================================================
  var subPagesRanOnce = false;

  if ($.cookie('subPagescookie') === null){
      $.cookie('subPagescookie','close');
  }

  if (($.cookie('subPagescookie') == 'open') && (subPagesRanOnce === false)){
      $("subPagesContent").show();
      $("#subPagesOpen").hide();
      $("#subPagesClose").show();
      subPagesRanOnce = true;
  }
  if (($.cookie('subPagescookie') == 'close') && (subPagesRanOnce === false)){
      $("#subPagesContent").hide();
      $("#subPagesOpen").show();
      $("#subPagesClose").hide();
      subPagesRanOnce = true;
  }

  $("#subPagesHeader").click(function(){
    if ($.cookie('subPagescookie') == 'close'){
      $("#subPagesContent").slideDown();
      $("#subPagesOpen").hide();
      $("#subPagesClose").show();
      $.cookie('subPagescookie','open');
    }else{
      $("#subPagesContent").slideUp();
      $("#subPagesOpen").show();
      $("#subPagesClose").hide();
      $.cookie('subPagescookie','close');
    }
  });

  $("#createSubPageBtn").click(function(){
    $(".dialog-overlay").fadeIn("slow");
    $("#createSubPage").fadeIn("slow");
  });
  // Sub Pages Panel END ====================================================


  // Blog Panel START ====================================================
  var blogRanOnce = false;

  if ($.cookie('blogCookie') === null){
      $.cookie('blogCookie','open');
  }

  if (($.cookie('blogCookie') == 'open') && (blogRanOnce === false)){
      $("blogContent").show();
      $("#blogOpen").hide();
      $("#blogClose").show();
      blogRanOnce = true;
  }
  if (($.cookie('blogCookie') == 'close') && (blogRanOnce === false)){
      $("#blogContent").hide();
      $("#blogOpen").show();
      $("#blogClose").hide();
      blogRanOnce = true;
  }
  $("#blogHeader").click(function(){
    if ($.cookie('blogCookie') == 'close'){
      $("#blogContent").slideDown();
      $("#blogOpen").hide();
      $("#blogClose").show();
      $.cookie('blogCookie','open');
    }else{
      $("#blogContent").slideUp();
      $("#blogOpen").show();
      $("#blogClose").hide();
      $.cookie('blogCookie','close');
    }
  });

  $("#categoriesBtn").click(function(){
    $(".dialog-overlay").fadeIn("slow");
    $("#categoriesMenu").fadeIn("slow");
  });

  $("#categoryAddBtn").click(function(){
    $("#categoriesMenu").fadeOut("fast");
    $("#categoryAdd").fadeIn("slow");
  });

  $("#categoryRemoveBtn").click(function(){
    $("#categoriesMenu").fadeOut("fast");
    $("#categoryRemove").fadeIn("slow");
  });

  $("#categoryArrangeBtn").click(function(){
    $("#categoriesMenu").fadeOut("fast");
    $("#categoryArrange").fadeIn("slow");
  });

  $( "#pMoveableCategoriesBox" ).sortable();
    $('#ArrangeCategoriesSubmit').click(function(){
      var data = $('#pMoveableCategoriesBox').sortable('serialize');
      var subType = "arrangeCategories";
      $.post('submission.php',{"data":data, "subType":subType}, function(){
        location.reload();
      });
  });

  // Blog Panel END ====================================================

  // Site Panel START ====================================================
  var siteRanOnce = false;

  if ($.cookie('siteCookie') === null){
      $.cookie('siteCookie','open');
  }

  if (($.cookie('siteCookie') == 'open') && (siteRanOnce === false)){
      $("siteContent").show();
      $("#siteOpen").hide();
      $("#siteClose").show();
      siteRanOnce = true;
  }
  if (($.cookie('siteCookie') == 'close') && (siteRanOnce === false)){
      $("#siteContent").hide();
      $("#siteOpen").show();
      $("#siteClose").hide();
      siteRanOnce = true;
  }
  $("#siteHeader").click(function(){
    if ($.cookie('siteCookie') == 'close'){
      $("#siteContent").slideDown();
      $("#siteOpen").hide();
      $("#siteClose").show();
      $.cookie('siteCookie','open');
    }else{
      $("#siteContent").slideUp();
      $("#siteOpen").show();
      $("#siteClose").hide();
      $.cookie('siteCookie','close');
    }
  });
  if($("#UseSiteImage").is(":checked")){
    $("#siteImage").show();
  }else{
    $("#siteImage").hide();
  }
  $("#UseSiteImage").change(function(){
      if ($(this).is(":checked")){
          $.post("submission.php",{
              subType : "showHideSiteImage",
              useImage : "yes"
          });
          $("#siteImage").slideDown("slow");
      }else{
          $.post("submission.php",{
              subType : "showHideSiteImage",
              useImage : "no"
          });
          $("#siteImage").slideUp("fast");
      }
  });
  $("#sitename").change(function(){
      var Name = $(this).val();
      $.post("submission.php",{
          subType : "siteName",
          sitename : Name
      });
  });

  $("#siteTags").change(function(){
      var siteTags = $(this).val();
      $.post("submission.php",{
          subType : "siteTags",
          tags : siteTags
      });
  });

  $("#siteDescription").change(function(){
      var siteDesc = $(this).val();
      $.post("submission.php",{
          subType : "siteDescription",
          description : siteDesc
      });
  });
  // Site Panel END ====================================================

  // Theme Panel START ====================================================
  var themeRanOnce = false;

  if ($.cookie('themeCookie') === null){
      $.cookie('themeCookie','close');
  }

  if (($.cookie('themeCookie') == 'open') && (themeRanOnce === false)){
      $("themeContent").show();
      $("#themeOpen").hide();
      $("#themeClose").show();
      themeRanOnce = true;
  }
  if (($.cookie('themeCookie') == 'close') && (themeRanOnce === false)){
      $("#themeContent").hide();
      $("#themeOpen").show();
      $("#themeClose").hide();
      themeRanOnce = true;
  }
  $("#themeHeader").click(function(){
    if ($.cookie('themeCookie') == 'close'){
      $("#themeContent").slideDown();
      $("#themeOpen").hide();
      $("#themeClose").show();
      $.cookie('themeCookie','open');
    }else{
      $("#themeContent").slideUp();
      $("#themeOpen").show();
      $("#themeClose").hide();
      $.cookie('themeCookie','close');
    }
  });
  // Theme Panel END ====================================================

  // Images Panel START ====================================================
  var imagesRanOnce = false;

  if ($.cookie('imagesCookie') === null){
      $.cookie('imagesCookie','close');
  }

  if (($.cookie('imagesCookie') == 'open') && (imagesRanOnce === false)){
      $("imagesContent").show();
      $("#imagesOpen").hide();
      $("#imagesClose").show();
      imagesRanOnce = true;
  }
  if (($.cookie('imagesCookie') == 'close') && (imagesRanOnce === false)){
      $("#imagesContent").hide();
      $("#imagesOpen").show();
      $("#imagesClose").hide();
      imagesRanOnce = true;
  }
  $("#imagesHeader").click(function(){
    if ($.cookie('imagesCookie') == 'close'){
      $("#imagesContent").slideDown();
      $("#imagesOpen").hide();
      $("#imagesClose").show();
      $.cookie('imagesCookie','open');
    }else{
      $("#imagesContent").slideUp();
      $("#imagesOpen").show();
      $("#imagesClose").hide();
      $.cookie('imagesCookie','close');
    }
  });
  // Images Panel END ====================================================

  // Plugins Panel START ====================================================
  var pluginsRanOnce = false;

  if ($.cookie('pluginsCookie') === null){
      $.cookie('pluginsCookie','close');
  }

  if (($.cookie('pluginsCookie') == 'open') && (pluginsRanOnce === false)){
      $("pluginsContent").show();
      $("#pluginsOpen").hide();
      $("#pluginsClose").show();
      pluginsRanOnce = true;
  }
  if (($.cookie('pluginsCookie') == 'close') && (pluginsRanOnce === false)){
      $("#pluginsContent").hide();
      $("#pluginsOpen").show();
      $("#pluginsClose").hide();
      pluginsRanOnce = true;
  }
  $("#pluginsHeader").click(function(){
    if ($.cookie('pluginsCookie') == 'close'){
      $("#pluginsContent").slideDown();
      $("#pluginsOpen").hide();
      $("#pluginsClose").show();
      $.cookie('pluginsCookie','open');
    }else{
      $("#pluginsContent").slideUp();
      $("#pluginsOpen").show();
      $("#pluginsClose").hide();
      $.cookie('pluginsCookie','close');
    }
  });

  $("#AddPluginSubmit").click(function(){
    var PluginName = $("#PluginName").val();
    var PluginLink = $("#PluginLink").val();
    $.post('AddPlugin.php',{
      "PluginName" : PluginName,
      "PluginLink" : PluginLink
    }, function(){
      location.reload();
    });
  });
  // Plugins Panel END ====================================================

  // Options Panel START ====================================================
  var optionsRanOnce = false;

  if ($.cookie('optionsCookie') === null){
      $.cookie('optionsCookie','close');
  }

  if (($.cookie('optionsCookie') == 'open') && (optionsRanOnce === false)){
      $("optionsContent").show();
      $("#optionsOpen").hide();
      $("#optionsClose").show();
      optionsRanOnce = true;
  }
  if (($.cookie('optionsCookie') == 'close') && (optionsRanOnce === false)){
      $("#optionsContent").hide();
      $("#optionsOpen").show();
      $("#optionsClose").hide();
      optionsRanOnce = true;
  }
  $("#optionsHeader").click(function(){
    if ($.cookie('optionsCookie') == 'close'){
      $("#optionsContent").slideDown();
      $("#optionsOpen").hide();
      $("#optionsClose").show();
      $.cookie('optionsCookie','open');
    }else{
      $("#optionsContent").slideUp();
      $("#optionsOpen").show();
      $("#optionsClose").hide();
      $.cookie('optionsCookie','close');
    }
  });
  $("#PageSourceEditing").change(function(){
      var checkValue = $(this).val();
      $.post("submission.php",{
          subType : "pageSourceEditing",
          isChecked : checkValue
      },function(){
      location.reload();
    });
  });
  // Plugins Panel END ====================================================

  // Users Panel START ====================================================
  var usersRanOnce = false;

  if ($.cookie('usersCookie') === null){
      $.cookie('usersCookie','close');
  }

  if (($.cookie('usersCookie') == 'open') && (usersRanOnce === false)){
      $("usersContent").show();
      $("#usersOpen").hide();
      $("#usersClose").show();
      usersRanOnce = true;
  }
  if (($.cookie('usersCookie') == 'close') && (usersRanOnce === false)){
      $("#usersContent").hide();
      $("#usersOpen").show();
      $("#usersClose").hide();
      usersRanOnce = true;
  }
  $("#usersHeader").click(function(){
    if ($.cookie('usersCookie') == 'close'){
      $("#usersContent").slideDown();
      $("#usersOpen").hide();
      $("#usersClose").show();
      $.cookie('usersCookie','open');
    }else{
      $("#usersContent").slideUp();
      $("#usersOpen").show();
      $("#usersClose").hide();
      $.cookie('usersCookie','close');
    }
  });

  $("#NewUserBtn").click(function(){
    $(".dialog-overlay, #NewUser").fadeIn("slow");
  });

  $("#NewUserSubmit").click(function(){
    var Avatar = $("#avatar").val();
    var Username = $("#newusername").val();
    var FirstName= $("#firstname").val();
    var LastName = $("#lastname").val();
    var Email = $("#email").val();
    var newpassword = $("#password").val();
    var retypepassword = $("#retypepassword").val();
    var accType = $("#accounttype").val();
    var subType = "addUser";
    $.post('submission.php',{
      "avatar" : Avatar,
      "newusername" : Username,
      "firstname" : FirstName,
      "lastname" : LastName,
      "email" : Email,
      "password" : newpassword,
      "retypepassword" : retypepassword,
      "accounttype" : accType,
      "subType" : subType
    }, function(){
      location.reload();
    });
  });

  // users Panel END ====================================================


});

var inputs = document.querySelectorAll( '.inputFile' );
Array.prototype.forEach.call( inputs, function( input )
{
var label	 = input.nextElementSibling,
  labelVal = label.innerHTML;

input.addEventListener( 'change', function( e )
{
  var fileName = '';
  if( this.files && this.files.length > 1 )
    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
  else
    fileName = e.target.value.split( '\\' ).pop();

  if( fileName )
    label.querySelector( 'span' ).innerHTML = fileName;
  else
    label.innerHTML = labelVal;
});
});
