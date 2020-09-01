<?php
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Categoria.php");
  $obj_Categoria=new Categoria;
  $obj_Categoria->hash=$_POST["hash"];
  $res=$obj_Categoria->Borrar_Categoria();
  if($res)
  {
    echo "ok";
  }
  else
  {
    echo "error al borrar";
  }
  
}
?>