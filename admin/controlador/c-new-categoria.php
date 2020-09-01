<?php

if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) )
{
  require_once("modelo/RN_Categoria.php");
  $obj_Categoria=new Categoria;
  $obj_Categoria->nombre=$_POST["nombre"];
  $obj_Categoria->descripcion=$_POST["descripcion"];
  $res=$obj_Categoria->Insertar_Categoria();
  if($res)//se verifica que se inserte correctamente el usuariosistema.
  {
    header("location: ?ruta=categoria");
  }
  else
  {
    echo "error";
  }
}

?>