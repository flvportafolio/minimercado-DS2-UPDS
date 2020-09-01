<?php
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Marca.php");
  $obj_Marca=new Marca;
  $obj_Marca->hash=$_POST["hash"];
  $res=$obj_Marca->Borrar_Marca();
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