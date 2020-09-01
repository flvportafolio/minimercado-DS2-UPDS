<?php

if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) )
{
  require_once("modelo/RN_Cargo.php");
  $obj_Cargo=new Cargo;
  $obj_Cargo->nombre=$_POST["nombre"];
  $obj_Cargo->descripcion=$_POST["descripcion"];
  $res=$obj_Cargo->Insertar_Cargo();
  if($res)//se verifica que se inserte correctamente el usuariosistema.
  {
    header("location: ?ruta=cargo");
  }
  else
  {
    echo "error";
  }
}
?>