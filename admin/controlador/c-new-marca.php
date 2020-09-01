<?php
if(isset($_POST["nombre"]) && isset($_POST["app"]) && isset($_POST["apm"]) && isset($_POST["marca"]) && isset($_POST["prof"]) && isset($_POST["dir"]) && isset($_FILES["img"]) && isset($_POST["fecha"]) && isset($_POST["telf"])&& isset($_POST["e_civil"]) && isset($_POST["n_edu"]) && isset($_POST["pais"]) && isset($_POST["gen"]) && isset($_POST["email"]) && isset($_POST["estado"]))
{//insertar usuario empleado   
    require_once("modelo/RN_Marca.php");
    $obj_Marca=new Marca;
    $obj_Marca->idMarca->nombre=$_POST["nombre"];
    $obj_Marca->idMarca->apellidoPaterno=$_POST["app"];
    $obj_Marca->idMarca->apellidoMaterno=$_POST["apm"];
    $obj_Marca->nombre=$_POST["marca"];     
    $obj_Marca->idMarca->profesion= $_POST["prof"];
    $obj_Marca->idMarca->direccion=$_POST["dir"];

    $nomb_img="default.svg";
    $ruta_img_perfil="vista/img/perfil/";
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
        $nuevo_fichero = "img-".date("Y-m-d-H-i-s").".svg";
        if (!copy($ruta_img_perfil.$nomb_img, $ruta_img_perfil.$nuevo_fichero)) 
        {  
        }
        $nomb_img=$nuevo_fichero;
      }
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
    $res=$obj_Marca->Insertar_Marca();
    if($res)//se verifica que se inserte correctamente el usuarioempleado.
    {
      header("location: ?ruta=marca");    
    }
    else
    {
      header("location: ?ruta=marca#error");
    }
}
?>