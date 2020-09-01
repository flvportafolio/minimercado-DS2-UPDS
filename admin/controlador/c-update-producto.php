<?php
if( isset($_POST["foto_default"]) && isset($_POST["hash_hidden"]) && isset($_POST["nombre"]) && isset($_POST["subcategoria"]) && isset($_POST["marca"]) && isset($_FILES["img"]) && isset($_POST["descripcion"]) )
{
  require_once("modelo/RN_Producto.php");
  $obj_Producto=new Producto;
  $obj_Producto->nombre=$_POST["nombre"];
  $obj_Producto->descripcion=$_POST["descripcion"];

  $nomb_img=$_POST["foto_default"];
  $ruta_img_perfil="vista/img/producto/";
  //si no se selecciona una imagen en el formulario, el valor de: pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION) es ""  
  if(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="jpg")
  { 
    unlink($ruta_img_perfil.$nomb_img);
      $nomb_img="img-".date("Y-m-d-H-i-s").".jpg";
      copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
  }
  elseif(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="png")
  { 
    unlink($ruta_img_perfil.$nomb_img);
      $nomb_img="img-".date("Y-m-d-H-i-s").".png";
      copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
  }
  $obj_Producto->foto=$nomb_img;//foto

  $obj_Producto->idSubCategoriaFK->hash=$_POST["subcategoria"];
  $obj_Producto->idMarcaFK->hash=$_POST["marca"];

  $obj_Producto->hash=$_POST["hash_hidden"];  
  $res=$obj_Producto->Modificar_Producto();
  if($res)//se verifica que se modifique correctamente el producto.
  {
    header("location: ?ruta=producto");
  }
  else
  {
    echo "error";
  }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Producto.php");
  $obj_Producto=new Producto;
  $obj_Producto->hash=$_POST["hash"];
  $res=$obj_Producto->Traer_Producto();
  if($res)
  {
    echo json_encode($obj_Producto);
  }
  else
  {
    echo "error";
  }
  
}
?>