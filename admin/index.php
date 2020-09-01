<?php
session_start();

if(isset($_GET["logout"]))// si hay alguien que quiere cerrar sesion, se la cierra.
{
  $_SESSION["UsuarioRegistrado"]=null;
}

if(isset($_SESSION["UsuarioRegistrado"]))//se verifica si esta logeado
{
  $ruta= isset($_GET["ruta"])  ? $_GET["ruta"]:"home";
  $accion= isset($_GET["accion"])? $_GET["accion"]:"default";

  switch($ruta)
  {       
    case "home":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-home.php");
        break;
      }
    break;    
    case "producto":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-producto.php");
        break;
        case "new":                  
          require_once("controlador/c-new-producto.php");
        break;
        case "update":                  
          require_once("controlador/c-update-producto.php");
        break;
      }
    break;   
    case "usuario":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-usuario.php");
        break;
        case "newadmin":                 
          require_once("controlador/c-new-usuario-sistema.php");
        break;
        case "newempleado";
          require_once("controlador/c-new-usuario-empleado.php");
        break;
        case "updateadmin":                 
          require_once("controlador/c-update-usuario-sistema.php");
        break;
        case "update_empleado":                 
          require_once("controlador/c-update-usuario-empleado.php");
        break;
      }
    break;   
    case "cargo":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-cargo.php");
        break;
        case "new":                  
          require_once("controlador/c-new-cargo.php");
        break;
        case "update":                  
          require_once("controlador/c-update-cargo.php");
        break;
      }
    break;   
    case "categoria":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-categoria.php");
        break;
        case "new":                  
          require_once("controlador/c-new-categoria.php");
        break;
        case "update":                  
          require_once("controlador/c-update-categoria.php");
        break;
      }
    break;   
    case "subcategoria":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-subcategoria.php");
        break;
        case "new":                  
          require_once("controlador/c-new-subcategoria.php");
        break;
        case "update":                  
          require_once("controlador/c-update-subcategoria.php");
        break;
      }
    break;  
    case "marca":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-marca.php");
        break;
        case "new":                  
          require_once("controlador/c-new-marca.php");
        break;
        case "update":                  
          require_once("controlador/c-update-marca.php");
        break;
      }
    break;    
    case "logeo":            
      switch($accion)
      {
        case "default":                 
          require_once("controlador/c-logeo.php");
        break;
      }
    break;     
    
    default:
    require_once("vista/v-error404.php");
    break;
  }
}
else // si no esta logeado se verifica si se quiere logear ó se le manda una pagina para que se logee
{   
    if(isset($_GET["check"])) //se verifican los credenciales de acceso - por el momento solo usuarios admin entran.
    {
        require_once("controlador/c-checkdata.php");
    }
    else //se muestra el formulario de logeo        
    {
        require_once("controlador/c-login.php");
    }
}

?>