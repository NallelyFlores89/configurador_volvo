  $(function(){
    var base = 'config2.php?';
    var base_dir = 'ORDENFINAL/'
    var model = null;

    $('#image').reel({
      images:      base_dir+'/'+'<?= $model ?>'+'/'+'<?= $submodel ?>'+'/'+'<?= $color ?>/<?= $rines ?>/<?= $accesorios?>/<?= $serie ?>#.png',
      frames:      5,
      frame:       2, 
      loops:       true,
      speed:       0,
      responsive:   true, 
      revolution:  100,
      indicator:    0, 
      preloader:    2
    });

    canvasbox = $("#myNavMenuCanvas").html();
    function checkWidth() {
        if ($(window).width() <= 1024) {
          $("#myNavMenuCanvas").remove();
          $(".changeResponsiveRow").removeClass("row-eq-height");
          $(".changeResponsiveVerticalAlign").removeClass("vertical-align");
        }else{
          $("#myNavMenuCanvas").html(canvasbox);
          $(".changeResponsiveRow").addClass("row-eq-height");
          $(".changeResponsiveVerticalAlign").addClass("vertical-align");
        }
    }

    $(".glyphicon-ok").hide();

    checkWidth();

    $(window).resize(checkWidth);

    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

     $('.nav-tabs li').click(function (e) {
      aux = $(this).children("a");
      aux.tab('show');

      if(!$(aux).hasClass("navbar-toggle")){
        e.preventDefault();
        e.stopImmediatePropagation();

      }

      if($(aux).hasClass("noInteriorTab")){
        var imageUrl = "http://sueciacarmerida.com/images/back_config.jpg";
        $("#backgroundInteriorBox").removeAttr("style").css('background-image', 'url(' + imageUrl + ')').css("background-size","cover").css("padding-top","150px");
        $(".spacer-100").show();
        $("#backgroundInteriorBox>*").show();
      }else{
        mostrarInteriores(null,true);
      }
    });
    

    $(".default_loaded").show();
    

    $(".boxcolor_config").click(function(){
      console.log($(this).attr("id"));
      if($(this).hasClass("boxcolor_config_color") && !($(this).hasClass("disable_option_config_class"))){
        $(".boxcolor_config_color span").hide();
        $(this).children("span").show();
        $(".tabColorSelectedImg").attr("src","http://sueciacarmerida.com/system/img/360/colores/C"+$(this).attr("id")+"00.png").load(function(){this.width});

        window.location.href = base+'model=<?= $model ?>&submodel=<?= $submodel ?>&color='+$(this).attr("id")+'&rines='+'<?= $rines ?>'+'&accesorios=<?= $accesorios?>&serie=<?= $serie ?>';
          
      }
      if($(this).hasClass("boxcolor_config_rines")){
        $(".boxcolor_config_rines span").hide();
        $(this).children("span").show();
        $(".tabRinesSelectedImg").attr("src","static/images/rines/"+$(this).attr("id")+".png");
        window.location.href = base+'model=<?= $model ?>&submodel=<?= $submodel ?>&color=<?= $color?>'+'&rines='+$(this).attr("id")+'&accesorios=<?= $accesorios?>&serie=<?= $serie ?>';        
      }
      if($(this).hasClass("boxcolor_config_accesorios")){
        $(".boxcolor_config_accesorios img").hide();
        $(this).children("span").show();        
        $("#tabAccesoriosSelectedImg").attr("src","http://sueciacarmerida.com/system/img/360/colores/"+$(this).attr("id")+".png");
      }
      if($(this).hasClass("boxcolor_config_accesorios")){
        $(".boxcolor_config_accesorios img").hide();
        $(this).children("span").show();        
        $("#tabAccesoriosSelectedImg").attr("src","http://sueciacarmerida.com/system/img/360/colores/"+$(this).attr("id")+".png");
      } 

      if($(this).hasClass("boxcolor_config_interiores")){
        $(".boxcolor_config_interiores > span").hide();
        $(this).children("span").show();        
        var imageUrl = "static/images/interiores/"+$(this).attr("id")+".jpg";
        mostrarInteriores(imageUrl,false);
      }         
    })

    $(".interioresTab").click(function(){
      mostrarInteriores(null,true);
    })

    $(".row-eq-height").each(function() {
        var heights = $(this).find(".col-eq-height").map(function() {
            return $(this).outerHeight();
        }).get(), maxHeight = Math.max.apply(null, heights);

        $(this).find(".col-eq-height").outerHeight(maxHeight);
    });


    $("#myNavMenuCanvas").offcanvas({autohide:true});                      // initialized with defaults
   
  });

  function mostrarInteriores(image1,image2,isDefault){
    $(".spacer-100").hide();
    $("#backgroundInteriorBox").hide();

    if(!isDefault){
      image1 = image1;
      image2 = image2;
      $("#interiorDefault").attr("interiora",image1);
      $("#interiorDefault").attr("interiorb",image2);

      $("#interior1").attr("src", "static/images/interiores/"+image1);
      $("#interior2").attr("src", "static/images/interiores/"+image2);

      $("#carrusel-interiores").show();

    }else{
      image1 = $("#interiorDefault1").attr("interiora");
      image2 = $("#interiorDefault2").attr("interiorb");
      
      $("#interior1").attr("src", "static/images/interiores/"+image1);
      $("#interior2").attr("src", "static/images/interiores/"+image2);
    }
  }