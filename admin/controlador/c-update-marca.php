<?php
if(isset($_POST["foto_default"])  && isset($_POST["hash_hidden"]) &&isset($_POST["nombre"]) && isset($_POST["app"]) && isset($_POST["apm"]) && isset($_POST["marca"]) && isset($_POST["prof"]) && isset($_POST["dir"]) && isset($_FILES["img"]) && isset($_POST["fecha"]) && isset($_POST["telf"])&& isset($_POST["e_civil"]) && isset($_POST["n_edu"]) && isset($_POST["pais"]) && isset($_POST["gen"]) && isset($_POST["email"]) && isset($_POST["estado"]))
{//modificar marca   
    require_once("modelo/RN_Marca.php");
    $obj_Marca=new Marca;
    $obj_Marca->idMarca->nombre=$_POST["nombre"];
    $obj_Marca->idMarca->apellidoPaterno=$_POST["app"];
    $obj_Marca->idMarca->apellidoMaterno=$_POST["apm"];
    $obj_Marca->nombre=$_POST["marca"];     
    $obj_Marca->idMarca->profesion= $_POST["prof"];
    $obj_Marca->idMarca->direccion=$_POST["dir"];

    $nomb_img=$_POST["foto_default"];
    $ruta_img_perfil="vista/img/perfil/";
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
    $obj_Marca->idMarca->foto=$nomb_img;//foto

    $obj_Marca->idMarca->fecha_nac=$_POST["fecha"];
    $obj_Marca->idMarca->telefono=$_POST["telf"];
    $obj_Marca->idMarca->estado_civil=$_POST["e_civil"];
    $obj_Marca->idMarca->nivel_educ=$_POST["n_edu"];
    $obj_Marca->idMarca->pais_nac=$_POST["pais"];
    $obj_Marca->idMarca->genero= $_POST["gen"];
    $obj_Marca->idMarca->correo=$_POST["email"];        
    $obj_Marca->idMarca->estado=$_POST["estado"];
    $obj_Marca->estado=$_POST["estado"];   
    $obj_Marca->hash=$_POST["hash_hidden"];  
    $obj_Marca->idMarca->hash=$_POST["hash_hidden"];
    $res=$obj_Marca->Modificar_Marca();
    if($res)//se verifica que se modifique correctamente el usuarioempleado.
    {
      header("location: ?ruta=marca");    
    }
    else
    {
      header("location: ?ruta=marca#error");
    }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Marca.php");
  $obj_Marca=new Marca;
  $obj_Marca->hash=$_POST["hash"];
  $res=$obj_Marca->Traer_Marca();
  if($res)
  {
    echo json_encode($obj_Marca);
  }
  else
  {
    echo "error";
  }
  
}
?>