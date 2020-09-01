<?php

if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["hash_hidden"]))
{
  require_once("modelo/RN_Categoria.php");
  $obj_Categoria=new Categoria;
  $obj_Categoria->nombre=$_POST["nombre"];
  $obj_Categoria->descripcion=$_POST["descripcion"];
  $obj_Categoria->hash=$_POST["hash_hidden"];
  $res=$obj_Categoria->Modificar_Categoria();
  if($res)//devuelve true si se modifico algun registro
  {
    header('Location: index.php?ruta=categoria');
  }
  else
  {
    header('Location: index.php?ruta=categoria');
  }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Categoria.php");
  $obj_Categoria=new Categoria;
  $obj_Categoria->hash=$_POST["hash"];
  $res=$obj_Categoria->Traer_Categoria();
  if($res)
  {
    echo json_encode($obj_Categoria);
  }
  else
  {
    echo "error";
  }
  
}

?>