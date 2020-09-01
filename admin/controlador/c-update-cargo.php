<?php
if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["hash_hidden"]))
{
  require_once("modelo/RN_Cargo.php");
  $obj_Cargo=new Cargo;
  $obj_Cargo->nombre=$_POST["nombre"];
  $obj_Cargo->descripcion=$_POST["descripcion"];
  $obj_Cargo->hash=$_POST["hash_hidden"];
  $res=$obj_Cargo->Modificar_Cargo();
  if($res)//devuelve true si se modifico algun registro
  {
    header('Location: index.php?ruta=cargo');
  }
  else
  {
    header('Location: index.php?ruta=cargo');
  }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Cargo.php");
  $obj_Cargo=new Cargo;
  $obj_Cargo->hash=$_POST["hash"];
  $res=$obj_Cargo->Traer_Cargo();
  if($res)
  {
    echo json_encode($obj_Cargo);
  }
  else
  {
    echo "error";
  }
  
}
?>