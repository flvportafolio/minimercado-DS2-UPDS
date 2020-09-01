<?php
if( isset($_POST["nombre"]) && isset($_POST["subcategoria"]) && isset($_POST["marca"]) && isset($_FILES["img"]) && isset($_POST["descripcion"])  )
{
  require_once("modelo/RN_Producto.php");
  $obj_Producto=new Producto;
  $obj_Producto->nombre=$_POST["nombre"];
  $obj_Producto->descripcion=$_POST["descripcion"];

  $nomb_img="prod_default.png";
  $ruta_img_perfil="vista/img/producto/";
  //si no se selecciona una imagen en el formulario de registro, el valor de: pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION) es ""  
  if(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="jpg")
  {
      $nomb_img="img-".date("Y-m-d-H-i-s").".jpg";
      copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
  }
  else
  {
    if(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="png")
    {
        $nomb_img="img-".date("Y-m-d-H-i-s").".png";
        copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
    }
    else
    {
        $nuevo_fichero = "img-".date("Y-m-d-H-i-s").".png";
        if (!copy($ruta_img_perfil.$nomb_img, $ruta_img_perfil.$nuevo_fichero)) 
        {  
        }
        $nomb_img=$nuevo_fichero;
    }
  }
  $obj_Producto->foto=$nomb_img;//foto

  $obj_Producto->idSubCategoriaFK->hash=$_POST["subcategoria"];
  $obj_Producto->idMarcaFK->hash=$_POST["marca"];
  $res=$obj_Producto->Insertar_Producto();
  if($res)//se verifica que se inserte correctamente el producto.
  {
    header("location: ?ruta=producto");
  }
  else
  {
    echo "error";
  }
}
?>