<?php
if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["categoria"]) && isset($_POST["hash_hidden"]))
{
  require_once("modelo/RN_Subcategoria.php");
  $obj_Subcategoria=new Subcategoria;
  $obj_Subcategoria->nombre=$_POST["nombre"];
  $obj_Subcategoria->descripcion=$_POST["descripcion"];
  $obj_Subcategoria->idCategoriaFK->hash=$_POST["categoria"];
  $obj_Subcategoria->hash=$_POST["hash_hidden"];
  $res=$obj_Subcategoria->Modificar_Subcategoria();
  if($res)//devuelve true si se modifico algun registro
  {
    header("location: ?ruta=subcategoria");
  }
  else
  {
    header("location: ?ruta=subcategoria#error");  
  }
}

if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Subcategoria.php");
  $obj_Subcategoria=new Subcategoria;
  $obj_Subcategoria->hash=$_POST["hash"];
  $res=$obj_Subcategoria->Traer_Subcategoria();
  if($res)
  {
    echo json_encode($obj_Subcategoria);
  }
  else
  {
    echo "error";
  }
  
}
?>