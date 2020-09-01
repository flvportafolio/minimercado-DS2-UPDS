<?php
if(isset($_POST["foto_default"]) && isset($_POST["hash_hidden"]) && isset($_POST["nombre"]) && isset($_POST["alias"]) && isset($_POST["app"]) && isset($_POST["apm"]) && isset($_POST["prof"]) && isset($_POST["dir"]) && isset($_FILES["img"]) && isset($_POST["fecha"]) && isset($_POST["telf"])&& isset($_POST["e_civil"]) && isset($_POST["n_edu"]) && isset($_POST["pais"]) && isset($_POST["gen"]) && isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["estado"]))
{//modificar usuariosistema  
  require_once("modelo/RN_Usuariosistema.php");
  $obj_UsuarioS=new Usuariosistema;
  $obj_UsuarioS->idUsuario->nombre=$_POST["nombre"];
  $obj_UsuarioS->alias=$_POST["alias"];
  $obj_UsuarioS->idUsuario->apellidoPaterno=$_POST["app"];
  $obj_UsuarioS->idUsuario->apellidoMaterno=$_POST["apm"];
  $obj_UsuarioS->idUsuario->profesion= $_POST["prof"];
  $obj_UsuarioS->idUsuario->direccion=$_POST["dir"];

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
  $obj_UsuarioS->idUsuario->foto=$nomb_img;//foto

  $obj_UsuarioS->idUsuario->fecha_nac=$_POST["fecha"];
  $obj_UsuarioS->idUsuario->telefono=$_POST["telf"];
  $obj_UsuarioS->idUsuario->estado_civil=$_POST["e_civil"];
  $obj_UsuarioS->idUsuario->nivel_educ=$_POST["n_edu"];
  $obj_UsuarioS->idUsuario->pais_nac=$_POST["pais"];
  $obj_UsuarioS->idUsuario->genero= $_POST["gen"];
  $obj_UsuarioS->idUsuario->correo=$_POST["email"];
  $obj_UsuarioS->user=str_replace("'","",(trim($_POST["user"])));
  $obj_UsuarioS->password=str_replace("'","",(trim($_POST["pass"])));
  $obj_UsuarioS->idUsuario->estado=$_POST["estado"];
  $obj_UsuarioS->estado=$_POST["estado"];
  $obj_UsuarioS->hash=$_POST["hash_hidden"];
  $obj_UsuarioS->idUsuario->hash=$_POST["hash_hidden"];
  $res=$obj_UsuarioS->Modificar_Usuariosistema();
  if($res)//devuelve true si se modifico algun registro
  {
    header('Location: index.php?ruta=usuario');
  }
  else
  {
    header('Location: index.php?ruta=usuario#error');    
  }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Usuariosistema.php");
  $obj_UsuarioS=new Usuariosistema;
  $obj_UsuarioS->hash=$_POST["hash"];
  $res=$obj_UsuarioS->Traer_UsuarioSistema();
  if($res)
  {
    echo json_encode($obj_UsuarioS);
  }
  else
  {
    echo "error";
  }
  
}
?>