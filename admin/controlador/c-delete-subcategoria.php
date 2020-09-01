<?php
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Subcategoria.php");
  $obj_Subcategoria=new Subcategoria;
  $obj_Subcategoria->hash=$_POST["hash"];
  $res=$obj_Subcategoria->Borrar_Subcategoria();
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