<?php

$ruta= isset($_GET["ruta"])  ? $_GET["ruta"]:"home";
$accion= isset($_GET["accion"])? $_GET["accion"]:"default";
switch($ruta)
{
  case "home":    
    switch($accion)
    {
      case "default":                 
        require_once("web/controlador/InicioController.php");
      break;
    }    
  break; 
  case "producto":                 
    require_once("web/controlador/ProductoController.php");
  break;

  case "marca":                 
    require_once("web/controlador/MarcaController.php");
  break;

  case "contactanos":                 
    require_once("web/vista/v-contacto.php");
  break;

  case "acerca":                 
    require_once("web/vista/v-acerca.php");
  break;

  case "privacidad":                 
    require_once("web/vista/v-politicas.php");
  break;

  case "cookies":                 
    require_once("web/vista/v-cookies.php");
  break;

  case "terminos":                 
    require_once("web/vista/v-terminos.php");
  break;
  
  default:
    require_once("web/vista/v-error404.php");
  break;
}
?>