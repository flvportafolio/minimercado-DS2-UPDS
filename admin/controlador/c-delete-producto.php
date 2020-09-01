<?php
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Producto.php");
  $obj_Producto=new Producto;
  $obj_Producto->hash=$_POST["hash"];
  $res=$obj_Producto->Borrar_Producto();
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