<?php
if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["categoria"]) )
{
  require_once("modelo/RN_Subcategoria.php");
  $obj_Subcategoria=new Subcategoria;
  $obj_Subcategoria->nombre=$_POST["nombre"];
  $obj_Subcategoria->descripcion=$_POST["descripcion"];
  $obj_Subcategoria->idCategoriaFK->hash=$_POST["categoria"];
  $res=$obj_Subcategoria->Insertar_Subcategoria();
  if($res)//se verifica que se inserte correctamente la subcategoria.
  {
    header("location: ?ruta=subcategoria");
  }
  else
  {
    echo "error";
  }
}
?>