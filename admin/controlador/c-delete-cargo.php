<?php
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Cargo.php");
  $obj_Cargo=new Cargo;
  $obj_Cargo->hash=$_POST["hash"];
  $res=$obj_Cargo->Borrar_Cargo();
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