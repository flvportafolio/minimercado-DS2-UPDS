<?php

if(isset($_POST["nombre"]) && isset($_POST["alias"]) && isset($_POST["app"]) && isset($_POST["apm"]) && isset($_POST["prof"]) && isset($_POST["dir"]) && isset($_FILES["img"]) && isset($_POST["fecha"]) && isset($_POST["telf"])&& isset($_POST["e_civil"]) && isset($_POST["n_edu"]) && isset($_POST["pais"]) && isset($_POST["gen"]) && isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["estado"]))
{//insertar usuario    
    require_once("modelo/RN_Usuariosistema.php");
    $obj_Usuario=new Usuariosistema;
    $obj_Usuario->idUsuario->nombre=$_POST["nombre"];
    $obj_Usuario->alias=$_POST["alias"];
    $obj_Usuario->idUsuario->apellidoPaterno=$_POST["app"];
    $obj_Usuario->idUsuario->apellidoMaterno=$_POST["apm"];
    $obj_Usuario->idUsuario->profesion= $_POST["prof"];
    $obj_Usuario->idUsuario->direccion=$_POST["dir"];

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
    $obj_Usuario->idUsuario->foto=$nomb_img;//foto

    $obj_Usuario->idUsuario->fecha_nac=$_POST["fecha"];
    $obj_Usuario->idUsuario->telefono=$_POST["telf"];
    $obj_Usuario->idUsuario->estado_civil=$_POST["e_civil"];
    $obj_Usuario->idUsuario->nivel_educ=$_POST["n_edu"];
    $obj_Usuario->idUsuario->pais_nac=$_POST["pais"];
    $obj_Usuario->idUsuario->genero= $_POST["gen"];
    $obj_Usuario->idUsuario->correo=$_POST["email"];
    $obj_Usuario->user=str_replace("'","",(trim($_POST["user"])));
    $obj_Usuario->password=str_replace("'","",(trim($_POST["pass"])));
    $obj_Usuario->idUsuario->estado=$_POST["estado"];        
    $obj_Usuario->estado=$_POST["estado"];     
    $res=$obj_Usuario->Insertar_Usuariosistema();
    if($res)//se verifica que se inserte correctamente el usuariosistema.
    {
        header("location: ?ruta=usuario");    
    }
    else
    {
        header("location: ?ruta=usuario#error");
    }
}

?>