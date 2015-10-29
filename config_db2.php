
<?
require_once("../system/conx.php");
require_once("config_functions.php")

//OBTENER CONFIGURACION INTERIOR


?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>
	Suecia Car Mérida</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="static/jasny-bootstrap/jasny-bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="http://sueciacarmerida.com/css/style-black.css" rel="stylesheet" type="text/css">
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="http://sueciacarmerida.com/css/ie.css" media="screen" /><![endif]-->
<!-- Color Style -->
<!-- SCRIPTS
  ================================================== -->
<!-- <script src="http://sueciacarmerida.com/js/modernizr.js"></script> -->
<!-- Modernizr -->
<link rel="stylesheet" href="static/styles/main.css" />
<link rel="stylesheet" href="css/configurador_prueba.css" />

<script src="http://sueciacarmerida.com/js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
<script src='http://sueciacarmerida.com/system/360/jquery.reel.js' type='text/javascript'></script>

</head>
<body>

<script type="text/javascript">
    // Función General de Botones y cambio de modelo.
    
    var color_folder="<?=$init_color?>";
    var rin_folder="<?=$init_rin?>";
    var acc_folder="sinaccesorio";


    function switch_360(tipo,folder,texto){

      if(tipo=="color"){ 
        color_folder=folder;
        jQuery('.elige-color').html(texto);
      }

      if(tipo=="rin") rin_folder=folder;
      if(tipo=="acc") acc_folder=folder;

      //alert(rin_folder);
          jQuery('#image').show();
          jQuery('#image2').hide();
          var thisimg = 'http://sueciacarsanangel.com/system/img/360/MY16/<?=$modelo?>/<?=$version_folder?>/'+color_folder+'/'+rin_folder+'/'+acc_folder+'/'+'0#.png';
          var urlimg = 'http://sueciacarsanangel.com/system/img/360/MY16/<?=$modelo?>/<?=$version_folder?>/'+color_folder+'/'+rin_folder+'/'+acc_folder+'/'+'02.png';
          jQuery('#image').reel('images', thisimg);
          
    }

  $(function(){

   function checkWidth() {
          if ($(window).width() <= 1024) {
            $("#myNavMenuCanvas").remove();
            $(".changeResponsiveRow").removeClass("row-eq-height");
            $(".changeResponsiveVerticalAlign").removeClass("vertical-align");
          }else{
            $(".changeResponsiveRow").addClass("row-eq-height");
            $(".changeResponsiveVerticalAlign").addClass("vertical-align");
          }
      }

      $('#image').reel({
          images:      'http://sueciacarmerida.com/system/img/360/MY16/<?=$modelo?>/<?=$version_folder?>/<?=$init_color?>/<?=$init_rin?>/<?=$init_accesorio?>/0#.png',
          frames:      5,
          frame:       2, 
          loops:       true,
          speed:       0,
          responsive:   true, 
          revolution:  100,
          indicator:    0, 
          preloader:    2
        });      

    $(".glyphicon-ok").hide();

    checkWidth();

    $(window).resize(checkWidth);

    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

     $('.nav-tabs li').click(function (e) {
      aux = $(this).children("span").children("a");
      aux2 = $(this).children("a");
      aux.tab('show');

      if(!$(aux2).hasClass("navbar-toggle")){
        e.preventDefault();
        e.stopImmediatePropagation();

      }

      if($(aux).hasClass("noInteriorTab") || $(aux2).hasClass("noInteriorTab")){  
        // $(".spacer-100").show();
        $("#carrusel-interiores").hide();
        $("#backgroundInteriorBox").show();
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
/*        $(".tabColorSelectedImg").attr("src","http://sueciacarmerida.com/system/img/360/colores/C"+$(this).attr("id")+"00.png").load(function(){this.width});
        window.location.href = base+'model=<?= $model ?>&submodel=<?= $submodel ?>&color='+$(this).attr("id")+'&rines='+'<?= $rines ?>'+'&accesorios=<?= $accesorios?>&serie=<?= $serie ?>';*/
          
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
      mostrarInteriores(null,null,true);
    })

    $(".row-eq-height").each(function() {
        var heights = $(this).find(".col-eq-height").map(function() {
            return $(this).outerHeight();
        }).get(), maxHeight = Math.max.apply(null, heights);

        $(this).find(".col-eq-height").outerHeight(maxHeight);
    });

    $("#myNavMenuCanvas").offcanvas('hide');
   
  });

  function mostrarInteriores(image1,image2,isDefault){
    $("#backgroundInteriorBox").hide();

    if(isDefault){
      
      $("#interiorDefaul1t").val(image1);
      $("#interiorDefaul2t").val(image2);

      $("#interior1").attr("src", "static/images/interiores/"+image1);
      $("#interior2").attr("src", "static/images/interiores/"+image2);

    }else{
      image1 = $("#interiorDefault1").val();
      image2 = $("#interiorDefault2").val();
      console.log("is default");
      
      $("#interior1").attr("src", "static/images/interiores/"+image1+".jpg");
      $("#interior2").attr("src", "static/images/interiores/"+image2+".jpg");
    }

      $("#carrusel-interiores").show();

  }

</script>

  <div id="myNavMenuCanvas" class="navmenu navmenu-default navmenu-fixed-left offcanvas col-md-6" role="navigation">
    <div class="row">
      <div class="col-md-10 text-left"><label class="navmenu-brand" href="#">TODOS LOS MODELOS</label></div>
      <div class="col-md-2 text-right">
          <a  class="navbar-toggle btn-close" data-toggle="offcanvas" data-target="#myNavMenuCanvas" data-canvas="#myNavMenuCanvas"><span class="glyphicon glyphicon-remove"></span></a>
      </div>

    </div>
    <div class="row">
      <div id="sidebar_model" class="col-md-2 text-center">
        <label>V40</label>
      </div>
      <div id="sidebar_img" class="col-md-4 text-center">
        <img class="col-md-12" src="static/images/volvos_sidebar/volvo.png">
      </div>
      <div id="sidebar_descripcion" class="col-md-3 text-left">
        <p>Estabilidad en autopista de clase mundia</p>
        <p>Desde $369,900</p>
      </div>
      <div id="sidebar_boton" class="col-md-3 text-left">
        <button type="button" class="btn btn-default">SELECCIONAR</button>
      </div>      
    </div>
    <div class="row">
      <div id="sidebar_model" class="col-md-2 text-left">
        <label>V40</label>
      </div>
      <div id="sidebar_img" class="col-md-4 text-left">
        <img class="col-md-12" src="static/images/volvos_sidebar/volvo.png">
      </div>
      <div id="sidebar_descripcion" class="col-md-3 text-left">
        <p>Estabilidad en autopista de clase mundia</p>
        <p>Desde $369,900</p>
      </div>
      <div id="sidebar_boton" class="col-md-3 text-left">
        <button type="button" class="btn btn-default">SELECCIONAR</button>
      </div>      
    </div>
    <div class="row">
      <div id="sidebar_model" class="col-md-2 text-left">
        <label>V40</label>
      </div>
      <div id="sidebar_img" class="col-md-4 text-left">
        <img class="col-md-12" src="static/images/volvos_sidebar/volvo.png">
      </div>
      <div id="sidebar_descripcion" class="col-md-3 text-left">
        <p>Estabilidad en autopista de clase mundia</p>
        <p>Desde $369,900</p>
      </div>
      <div id="sidebar_boton" class="col-md-3 text-left">
        <button type="button" class="btn btn-default">SELECCIONAR</button>
      </div>      
    </div>
    <div class="row">
      <div id="sidebar_model" class="col-md-2 text-left">
        <label>V40</label>
      </div>
      <div id="sidebar_img" class="col-md-4 text-left">
        <img class="col-md-12" src="static/images/volvos_sidebar/volvo.png">
      </div>
      <div id="sidebar_descripcion" class="col-md-3 text-left">
        <p>Estabilidad en autopista de clase mundia</p>
        <p>Desde $369,900</p>
      </div>
      <div id="sidebar_boton" class="col-md-3 text-left">
        <button type="button" class="btn btn-default">SELECCIONAR</button>
      </div>      
    </div>
    <div class="row">
      <div id="sidebar_model" class="col-md-2 text-left">
        <label>V40</label>
      </div>
      <div id="sidebar_img" class="col-md-4 text-left">
        <img class="col-md-12" src="static/images/volvos_sidebar/volvo.png">
      </div>
      <div id="sidebar_descripcion" class="col-md-3 text-left">
        <p>Estabilidad en autopista de clase mundia</p>
        <p>Desde $369,900</p>
      </div>
      <div id="sidebar_boton" class="col-md-3 text-left">
        <button type="button" class="btn btn-default">SELECCIONAR</button>
      </div>      
    </div>
  </div>

  
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body">
  <div class="site-header-wrapper" style="position:absolute;">
        <header class="site-header">
          <div class="ocultar_desktop franjadireccion">
          </div>

          <div class="container sp-cont text-center">
               <div class="site-logo">
                  <h1><a href="http://sueciacarmerida.com/index.php"><img src="http://sueciacarmerida.com/images/logo.png" alt="Logo">
                      </a>
                  </h1>
                  <div id="logo_agencia"><a href="http://sueciacarmerida.com/index.php">
                      <span class="site-tagline"><span class="suecia">Suecia Car</span> <br>Mérida</span></a></div>
              </div>
          </div>
        </header>        
        
        <nav class="nav">
           <a class="nav-logo"><img src="http://sueciacarmerida.com/-/media/images/logo/vcc_logo_102x102.png" height="0px" width="0px" alt="" /></a>

        <div class="navigation_back"><div class="contacto_movil ocultar_desktop"><a href="http://sueciacarmerida.com/agencia.php" class="ocultar_desktop"><button type="button" class="btn btn-default btn-contacto boton_contacto_menu">Contacto</button></a></div>
            <div class="nav-list nav-list-prim"> 
                <a id="nav-menu-item" class="nav-list-item is-icon is-menu js-drop" data-nav-drop-id="#nav-drop-tree" href="#"><i class="icon icon-menu"></i></a>

                        <a class="nav-list-item js-drop" id="nav-list-item-0" data-nav-drop-id="#nav-drop-cars"  href="#">Modelos</a>
                        <a class="nav-list-item js-drop" id="nav-list-item-1" data-nav-drop-id="#nav-drop-services"  href="#">Servicio</a>
            </div>

            <div class="nav-list nav-list-sec">
              <a class="nav-list-item" href="http://sueciacarmerida.com/promociones.php">Promociones </a>             
              <a class="nav-list-item" href="http://sueciacarmerida.com/prueba_manejo.php">Prueba de Manejo</a>
            </div>
          </div>
        </nav>
</div>
</div>

    
    <div class="main" role="main">
      <div id="content" class="container" style="padding:0; background:#fff;">
           <!-- <div class="spacer-100"></div> -->
            <div class="container" style="background:#fff; max-width: 100%;  width: 100%;">
            
               <div class="row" >
               </div>
               <div class="row">
                  <div class="col-md-12">
                    


<div class="row row-eq-height changeResponsiveRow">
  
  <div id="selectAnotherVersionBoxDevice" class="hideInDesktop col-xs-12 col-md-12">
      <div class="col-xs-6 text-left col-md-6">
        <label class="blueLabelBoldNum">Volvo V40</label>
        <label class="blueLabelBold">Momentum RD </label>
      </div>
      <div class="col-xs-6 text-right col-md-6">
        <label class="blueLabelBold">Precio</label>
        <label class="blueLabelBoldNum">$543,000</label>        
      </div>
  </div>

  <div id="selectAnotherVersionBox" class="col-md-3 col-lg-3 col-xs-12 text-left hideInDevices">
      <div id="sideBarConfiguratorModel" class="col-md-12 text-left">
        <h2>Volvo  <?=$modelo?></h2>
      </div>
      <div id="versionDetails" class="col-md-12 col-xs-4">
        <div class="col-md-12">
          <label id="selectAnotherVersionClick" class="blueLabelSideBarConfigurator">Selecciona otra versión</label>
        </div>
        <?

          while($row=mysql_fetch_array($result3)){

        ?>
        <a href="config_db.php?modelo=<?=$modelo?>&dc=<?=$row["derivative_code"]?>">
        <div class="col-md-12">
          <label class="click-hover grayLabelSideBarConfigurator"><?=$row["version"]?><br> <span>desde </span> <? echo "$".number_format($row["precio"])?></label>
        </div>
        </a>
        <?
        }
        ?>


      </div>

      <div id="versionDetails2" class="col-md-12 col-xs-4">
        <div id="versionSelected" class="col-md-12">
        <label>Versión <br>
        <?

          while($row=mysql_fetch_array($result4)){

            $version_folder=$row["folder"];

        ?>
          <span><?=$row["version"]?></span></label>
        </div>
        <div id="firstPrice" class="col-md-12">
          <label>Precio desde<br>
          <? echo "$".number_format($row["precio"])?></label>
        </div>
        <?
        }
        ?>

      </div>

      <div id="versionDetailsButtons" class="col-md-12 col-xs-4">
        <button type="button" class="btn btn-default col-md-12" aria-label="Rigth Align">
          VER FINANCIAMIENTO
          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        </button>
        <button type="button" class="btn btn-white col-md-12" aria-label="Rigth Align">
          <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
          ENVIARMELO POR EMAIL
          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        </button>
      </div>
  </div>

  <div id="backgroundInteriorBox" class="col-md-12 col-xs-12 text-center col-lg-12 noPadding"  style="">
      <img class="img-responsive" id="image" src="http://sueciacarmerida.com/system/img/360/MY16/<?=$modelo?>/<?=$version_folder?>/<?=$init_color?>/<?=$init_rin?>/<?=$init_accesorio?>/02.png" height="370" />
  </div>

  <div id="carrusel-interiores" class="col-md-12 col-xs-12 text-center col-lg-12 carousel slide noPadding" data-ride="carousel" style="display:none">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="#iterior1" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="#iterior2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img id="interior1" class="image-responsive" src="img_chania.jpg">
      </div>

      <div class="item">
        <img id="interior2" class="image-responsive" src="img_chania2.jpg">
      </div>    
    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>  
</div>

<div class="col-xs-12 hideInDesktop">
  <div class="col-md-5 col-md-offset-1 col-xs-6">
    <button type="button" class="btn btn-white col-md-12 col-xs-12" aria-label="Rigth Align">
      ENVIÁMELO POR EMAIL
      <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
    </button>
  </div>
  <div class="col-md-5 col-xs-6">
    <button type="button" class="btn btn-default col-md-12 col-xs-12" aria-label="Rigth Align">
      VER FINANCIAMIENTO
      <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
    </button>
  </div>
</div>

<div class="col-xs-12 col-md-12 dropdown hideInDesktop noPadding">
  <button class="btn btn-white dropdown-toggle col-xs-12 col-md-12" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Versión
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu col-xs-12 col-md-12" aria-labelledby="dropdownMenu1">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>


<div class="col-md-12 col-xs-12 noPadding hideInDesktop">
      <ul id="configurator_nav" class="nav nav-tabs col-md-12 noPadding" data-tabs="tabs">
        <li class="col-md-3 col-xs-3 active" role="presentation" style="border-left:1px solid #1d1d1d">
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center ">
            <img class="tabColorSelectedImg" src="http://sueciacarmerida.com/system/img/360/colores/C01900.png" width="65px">
          </span>
          <a style="padding:0"  class="col-md-12 col-lg-6 col-xs-12 text-center noInteriorTab" href="#colores">Color</a>
        </li>

        <li class="col-md-3 col-xs-3" role="presentation" >
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img class="tabRinesSelectedImg" src="static/images/rines/rin.png" width="75px">
          </span>
          <a style="padding:0"  class="col-md-12 col-lg-6 col-xs-12 noInteriorTab text-center" href="#rines">Rines</a>
        </li>
        <li class="col-md-3 col-xs-3" role="presentation">          
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img id="tabAccesoriosSelectedImg" src="http://sueciacarmerida.com/system/img/360/colores/RDesign_on.jpg" width="65px">
          </span>
          <a style="padding:0"  class="col-md-12 col-lg-6 col-xs-12 noInteriorTab text-center" href="#accesorios">Accesorios</a>
        </li>
        <li id="" class="interioresTab col-md-3 col-xs-3" role="presentation">                      
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img class="tabInterioresSelectedImg" src="http://sueciacarmerida.com/system/img/360/interiores/P500.png" width="65px">
          </span>
          <a style="padding:0"  class="col-md-12 col-lg-6 col-xs-12 text-center" href="#interiores">Interiores</a>
        </li>
    
      </ul>
</div>


<div class="row hideInDevices">
      
      <ul id="configurator_nav" class="nav nav-tabs row row-eq-height changeResponsiveRow" data-tabs="tabs">
        
        <li id="changeModelBtn" class="col-lg-3 col-md-3 col-xs-2 text-center" role="presentation" class="active" style="border-left:1px solid #1d1d1d" >
          <a  class="col-lg-12 col-md-12 navbar-toggle noInteriorTab" data-toggle="offcanvas" data-target="#myNavMenuCanvas" data-canvas="#myNavMenuCanvas">
            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
            Cambiar modelo
          </a>
        </li>
        
        <li class="col-lg-2 col-md-2 col-md-offset-2 col-lg-offset-2 col-xs-2 active" role="presentation" style="border-left:1px solid #1d1d1d">
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center ">
            <img class="tabColorSelectedImg" src="http://sueciacarmerida.com/system/img/360/colores/C01900.png" width="65px">
          </span>
          <span class="color-description-configurator col-md-12 col-lg-6 col-xs-12 text-center noInteriorTab noPadding">
              <a class="noInteriorTab" style="padding:0"  href="#colores">
              702 Flamenco
              Rojo metalic
              </a>
          </span>
        </li>

        <li class="col-lg-2 col-md-2 col-xs-2" role="presentation" >
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img class="tabRinesSelectedImg" src="static/images/rines/rin.png" width="75px">
          </span>
          <span class="col-md-12 col-lg-6 col-xs-12 text-center noInteriorTab noPadding">
            <a class="noInteriorTab" style="padding:0"  href="#rines">Rines</a>
          </span>
        </li>

        <li class="col-lg-2 col-md-2 col-xs-2" role="presentation">          
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img id="tabAccesoriosSelectedImg" src="http://sueciacarmerida.com/system/img/360/colores/RDesign_on.jpg" width="65px">
          </span>
          <span class="accesories-description-configurator col-md-12 col-lg-6 col-xs-12 text-center noInteriorTab noPadding">
            <a class="noInteriorTab" style="padding:0" href="#accesorios">
              Accesorios
              <span>Ninguno</span>
            </a>
          </span>
        </li>

        <li id="" class="interioresTab col-lg-2 col-md-2 col-xs-2" role="presentation">                      
          <span  style="padding:0" class="col-md-12 col-lg-6 col-xs-12 text-center">
            <img class="tabInterioresSelectedImg" src="http://sueciacarmerida.com/system/img/360/interiores/P500.png" width="65px">
          </span>
          <span class="col-md-12 col-lg-6 col-xs-12 text-center noPadding">
            <a style="padding:0" href="#interiores">Interiores</a>
          </span>
        </li>    
      </ul>
</div>

<div class="row">
  <div id="my-tab-content" class="tab-content" class="col-md-12" style="">
        <div class="tab-pane active" id="colores">
            <div class="row row-eq-height changeResponsiveRow" style="padding-top:0px;">  
              <div class="col-lg-3 col-md-4 col-xs-4 dividerRight">
                <label class="labelTabConfigurator">Sólido</label>
                <ul class="col-md-12">
                  <?
                      foreach ($colores as $color) {

                        /*valido, colorpath,colornombre,colorfolder*/
                        $dcolor=explode("|", $color);
                        //echo $color[2];
                        if(strrpos($dcolor[2], "m.")===false){
                          //echo $dcolor[0];
                        ?>
                        <li class="item col-lg-4 col-md-6 col-xs-6 noPadding <?= ($dcolor[0]==0) ? 'disable_option_config_class':'' ?>"  style="float:left;">
                        <button class="col-md-12 boxcolor_config boxcolor_config_color <?= ($dcolor[0]==0) ? 'disable_option_config_class':'' ?>" id="C<?=$dcolor[3]?>00" >
                          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>           
                          <img width="65px" alt="<?=$dcolor[3]?>" src="http://sueciacarmerida.com/system/img/360<?=$dcolor[1]?>" >
                        </button> 
                        </li>

                       <?if($dcolor[0]==1):?>
                        <script>
                            $('#C<?=$dcolor[3]?>00').click(function() {
                                  var text = $(this).data('text');      
                                  switch_360("color","<?=$dcolor[3]?>",'<?=$dcolor[2]?>');
                            });
                        </script>
                        <?endif;?>
                        

                        <? } 
                      } ?>               
                </ul>              
              </div>
              <div class="col-lg-5 col-md-4 col-xs-4 dividerRight">
                <label class="labelTabConfigurator">Metálicos</label>
                <ul class="col-md-12">   
                  <!-- INSERTAR COLORES -->
                  <?
                      foreach ($colores as $color) {
                        /*valido, colorpath,colornombre,colorfolder*/
                        $dcolor=explode("|", $color);
                        //echo $color[2];
                        if(strrpos($dcolor[2], "m.")>0){

                          ?>

                        <li class="item col-lg-4 col-md-6 col-xs-6 noPadding"  style="float:left;">
                        <button class="col-md-12 boxcolor_config boxcolor_config_color <?= ($dcolor[0]==0) ? 'disable_option_config_class':'' ?>" id="C<?=$dcolor[3]?>00">
                          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>           
                          <img width="65px" alt="<?=$dcolor[3]?>" src="http://sueciacarmerida.com/system/img/360<?=$dcolor[1]?>" >
                        </button> 
                        </li>

                                                <?if($dcolor[0]==1):?>
                        <script>
                            $('#C<?=$dcolor[3]?>00').click(function() {
                                  var text = $(this).data('text');      
                                  switch_360("color","<?=$dcolor[3]?>","<?=$dcolor[2]?>");
                            });
                        </script>
                        <?endif;?>

                          <?


                        }

                      }

                  ?>
  

                </ul>              
              </div>

            </div>
        </div>

        <div class="tab-pane" id="rines">
            <div class="row row-eq-height changeResponsiveRow" style="padding-top:0px;">  
              <div class="col-lg-2 col-md-2 dividerRight noPadding">
                <label class="labelTabConfigurator">De Serie</label>             
                <ul class="col-md-12 noPadding">
                <!--RIN DE SERIE -->
                  <?
                      foreach ($rines as $rin) {
        /*array_push($rines,$valido."|".$row["rinpath"]."|".$row["rin_nombre"]."|".$row["rin_default"]."|".$row["rin_folder"]);
*/
                        $drin=explode("|", $rin);
                        //echo $drin[0];
                        if($drin[3]==1){

                        ?>
                        <li class="item col-lg-12 col-md-12 col-xs-12">
                        <button class="col-md-12 boxcolor_config boxcolor_config_rines text-left <?= ($dcolor[0]==0) ? 'disable_option_config_class':'' ?>" id="<?=$drin[4]?>" >
                          <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="right:30px;"></span>                          
                          <img width="110px" text="<?=$drin[2]?>" alt="<?=$drin[3]?>" src="http://sueciacarmerida.com/system/img/360<?=$drin[1]?>" style="float:left">
                        </button> 
                        </li> 

                        <?if($drin[0]==1):?>
                        <script>
                            $('#<?=$drin[4]?>').click(function() {
                                  var text = $(this).data('text');      
                                  switch_360("rin","<?=$drin[4]?>",'<?=$drin[2]?>');
                            });
                        </script>
                        <?endif;?>


                        <?


                        }

                      }

                  ?>                            
             
                </ul>              
              </div>
              <div class="col-lg-6 col-md-6 custom-responsive6 dividerRight">
                <label class="labelTabConfigurator">Opcionales</label>             
                <ul class="col-md-12 noPadding">

                  <?
                      foreach ($rines as $rin) {

                        $drin=explode("|", $rin);
                        //echo $color[2];
                        if($drin[3]==0){

                          ?>
                        <li class="item ccol-lg-3 col-md-3 col-xs-3 noPadding">
                        <button class="col-md-12 boxcolor_config boxcolor_config_rines text-left <?= ($dcolor[0]==0) ? 'disable_option_config_class':'' ?>" id="<?=$drin[4]?>" >
                          <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="right:30px;"></span>                          
                          <img width="110px" text="<?=$drin[2]?>" alt="<?=$drin[3]?>" src="http://sueciacarmerida.com/system/img/360<?=$drin[1]?>" style="float:left">
                        </button> 
                        </li> 

                        <?if($drin[0]==1):?>
                        <script>
                            $('#<?=$drin[4]?>').click(function() {
                                  var text = $(this).data('text');      
                                  switch_360("rin","<?=$drin[4]?>",'<?=$drin[2]?>');
                            });
                        </script>
                        <?endif;?>


                          <?


                        }

                      }

                  ?>                                  
                 
                </ul>              
              </div>              
            
            </div>    

        </div>

        <div class="tab-pane" id="accesorios">
         <div class="col-md-12">
            <div class="row row-eq-height changeResponsiveRow" style="padding-top:0px;">  
              <div class="col-lg-8 col-md-8 dividerRight">
                <label class="labelTabConfigurator">Styling Kit</label>
                <input type="hidden" value="uP10000" id="interiorDefault1">
                <input type="hidden" value="3701" id="interiorDefault2">

                <ul class="col-md-12 noPadding">

                  <?

                      foreach ($accesorios as $accesorio) {

                        $daccesorio=explode("|", $accesorio);
                                         
                            ?>
                        <li class="col-md-3">
                          <button class="boxcolor_config boxcolor_config_interiores sidepan pic" id="<?=$daccesorio[2]?>">
                            <span class="glyphicon glyphicon glyphicon-ok default_loaded" aria-hidden="true"></span>                          
                            <img width="110px" text="<?=$dacesorio[1]?>" alt="<?=$daccesorio[1]?>" src="http://sueciacarmerida.com/system/img/360/interiores/<?=$daccesorio[2]?>.png" >
                          </button> 
                        </li> 


                        <?if($daccesorio[0]==1):?>
                        <script>
                            $('#<?=$daccesorio[2]?>').click(function() {
                                  var text = $(this).data('text');      
                                  switch_360("acc","<?=$daccesorio[2]?>",'<?=$daccesorio[1]?>');
                            });
                        </script>
                        <?endif;?>




                            <?
                        }

                  ?> 
                </ul>
              </div>
            </div>
          </div>
        </div>

      <!-- </div>  -->
      <div class="tab-pane" id="interiores">
          <div class="col-md-12">
            <div class="row row-eq-height changeResponsiveRow" style="padding-top:0px;">  
              <div class="col-lg-2 col-md-2 dividerRight">
                <label class="labelTabConfigurator">Textiles/T-tec</label>
                <ul class="col-md-12 noPadding">
                  <?
                      foreach ($interiores as $interior) {

                        $dinterior=explode("|", $interior);
                        //echo tp td c $color[2];
                        if(strrpos($dinterior[2], "TEX")>0){

                          ?>
                      <li class="col-md-3">
                        <button class="boxcolor_config boxcolor_config_interiores" id="<?=$dinterior[3]?>">
                          <img width="110px" text="<?=$dinterior[3]?>" alt="<?=$dinterior[3]?>" src="http://sueciacarmerida.com/system/img/360/interiores/<?=$dinterior[3]?>.png" >
                        </button> 
                        </li> 
                          <?


                        }

                      }

                  ?>  

                </ul>
              </div>
              <div class="col-lg-6 col-md-6 dividerRight">
                <label class="labelTabConfigurator">PIEL</label>
                <ul class="col-md-12">
                  <!-- <? echo var_dump($interiores);?>-->
                <?
                      foreach ($interiores as $interior) {

                        $dinterior=explode("|", $interior);
                        //echo tp td c $color[2];
                        if(strrpos($dinterior[2], "LEATH")===0){

                          ?>
                         <li class="item col-md-4 noPadding">
                        <button class="col-md-12 boxcolor_config boxcolor_config_interiores" id="<?=$dinterior[3]?>">
                          <img width="110px" text="<?=$dinterior[3]?>" alt="<?=$dinterior[3]?>" src="http://sueciacarmerida.com/system/img/360/interiores/<?=$dinterior[3]?>.png" >
                        </button> 
                        </li> 
                          <?


                        }

                      }

                  ?>  
                      
                </ul>
              </div>  

              <div class="col-lg-5 col-md-5">
                <label class="labelTabConfigurator">SPORT/LEATHER</label>
                <ul class="col-md-12 noPadding">
                  <?
                      foreach ($interiores as $interior) {
                        $dinterior=explode("|", $interior);
                        //echo tp td c $color[2];
                        if(strrpos($dinterior[2], "SPO")===0){

                          ?>
                         <li class="item col-md-4 noPadding">
                        <button class="col-md-12 boxcolor_config boxcolor_config_interiores" id="<?=$dinterior[3]?>">
                          <img width="110px" text="<?=$dinterior[2]?>" alt="<?=$dinterior[3]?>" src="http://sueciacarmerida.com/system/img/360/interiores/<?=$dinterior[3]?>.png" >
                        </button> 
                        </li> 
                          <?
                        }
                      }
                  ?>  
                </ul>
              </div>
              <div class="col-lg-4 col-md-4"></div>
            </div>
          </div>
      </div> <!-- by-type-options2 -->
  </div> <!-- tab content-->
</div> <!--row-->

    <div class="spacer-40"></div>

            </div>
      </div>
    </div>
</div>
      <footer class="site-footer">
       	<div class="site-footer-top">
       		<div class="container">
                <div class="row">
                <div class="col-md-12 menu_footer ">
                
                <ul>
                <li><a href="http://sueciacarmerida.com/index-0.php">Inicio</a></li>
                <li><a href="http://sueciacarmerida.com/agencia-0.php">Contáctanos</a></li>
                <li><a href="http://sueciacarmerida.com/agencia-0.php">Ubicación</a></li>
                <li><a href="http://sueciacarmerida.com/mapadesitio-0.php">Mapa de sitio</a></li>
                <li><a href="http://sueciacarmerida.com/privacidad-0.php">Aviso de Privacidad</a></li>
                
                </ul>
            </div>
            
            <div class="col-md-12 menu_footer ">
                
                <p id="footer_direccion">
                    Calle 43 No. 325 x 52 y Prol. Paseo de Montejo,
Col. Benito Juárez Norte, Mérida,
Yucatán, CP 97119.</p>
<p id="footer_derechos">Suecia Car Mérida se reserva el derecho de modificar las especificaciones y los precios de sus productos, sin aviso previo al consumidor. <br>
Las imágenes publicadas son únicamente ilustrativas y pueden cambiar de acuerdo a la versión del vehículo.</p>
            </div>
            
            <div class="col-md-12" style="text-align: center;">
            
            <img src="http://sueciacarmerida.com/images/volvo_wordmark_white.png" style="max-height: 15px;top: 50%;
left:50%;" />
            
            </div>
            
            
                	
                </div>
            </div>
     	</div>
        <div class="site-footer-bottom">
        	<div class="container">
                <div class="row">
                	<div class="col-md-8 col-sm-8 copyrights-left">
                    	<p class="footer_small">&copy; 1998-2014 Volvo Car Corporation (o sus filiales y/o empresas licenciadoras, cuando así se indique).</p>
                    </div>
                    <div class="col-md-4 col-sm-4 copyrights-right">
                        <ul class="social-icons social-icons-colored pull-right">

                                                        <li class="facebook"><a href="https://www.facebook.com/volvo.merida"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="https://twitter.com/volvomexico"><i class="fa fa-twitter"></i></a></li>
                            <li class="linkedin"><a href="https://plus.google.com/100482073311367621938"><i class="fa fa-google-plus"></i></a></li>
                            <li class="youtube"><a href="https://www.youtube.com/channel/UCA5-eV_CPJNxaio9Uq4AR9g"><i class="fa fa-youtube"></i></a></li>
                                                     
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<script type="text/javascript">

    var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-60576826-17']);
        _gaq.push(['_trackPageview']);
    </script>
    <!-- Run Google Analytics --> 
    <script type='text/javascript'>
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script>
    <!-- End site footer -->
  	<a id="back-to-top"><img src="http://sueciacarmerida.com/images/assets/btn-top.png" /></a> 

 
</div>

<!-- <script src="static/scripts/vendor.js?v=0.1.5498.38175"></script> -->
<!-- <script src="static/scripts/app.js?v=0.1.5498.38175"></script> -->

 
<!-- <script src="http://sueciacarmerida.com/js/ui-plugins.js"></script> <!-- UI Plugins --> -->
<script src="http://sueciacarmerida.com/js/helper-plugins.js"></script> <!-- Helper Plugins -->
<script src="http://sueciacarmerida.com/vendor/password-checker.js"></script> <!-- Password Checker -->
<script src="http://sueciacarmerida.com/js/bootstrap.js"></script> <!-- UI -->
<script src="static/jasny-bootstrap/jasny-bootstrap.js"></script> <!-- UI -->
<!-- <script src="http://sueciacarmerida.com/js/init2.js"></script> <!-- All Scripts --> -->
<script src="http://sueciacarmerida.com/vendor/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

</body>
</html>