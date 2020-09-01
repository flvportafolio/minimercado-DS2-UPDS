<?php
if(isset($_POST["foto_default"])  && isset($_POST["hash_hidden"]) && isset($_POST["nombre"]) && isset($_POST["app"]) && isset($_POST["apm"]) && isset($_POST["ci"]) && isset($_POST["prof"]) && isset($_POST["dir"]) && isset($_FILES["img"]) && isset($_POST["fecha"]) && isset($_POST["telf"])&& isset($_POST["e_civil"]) && isset($_POST["n_edu"]) && isset($_POST["pais"]) && isset($_POST["gen"]) && isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["cargo"]) && isset($_POST["estado"]))
{//modificar usuario empleado   
    require_once("modelo/RN_Empleadousuario.php");
    $obj_Usuario_empl=new Empleadousuario;
    $obj_Usuario_empl->idEmpleado->nombre=$_POST["nombre"];
    $obj_Usuario_empl->idEmpleado->apellidoPaterno=$_POST["app"];
    $obj_Usuario_empl->idEmpleado->apellidoMaterno=$_POST["apm"];
    $obj_Usuario_empl->ci=$_POST["ci"];     
    $obj_Usuario_empl->idEmpleado->profesion= $_POST["prof"];
    $obj_Usuario_empl->idEmpleado->direccion=$_POST["dir"];

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
    $obj_Usuario_empl->idEmpleado->foto=$nomb_img;//foto

    $obj_Usuario_empl->idEmpleado->fecha_nac=$_POST["fecha"];
    $obj_Usuario_empl->idEmpleado->telefono=$_POST["telf"];
    $obj_Usuario_empl->idEmpleado->estado_civil=$_POST["e_civil"];
    $obj_Usuario_empl->idEmpleado->nivel_educ=$_POST["n_edu"];
    $obj_Usuario_empl->idEmpleado->pais_nac=$_POST["pais"];
    $obj_Usuario_empl->idEmpleado->genero= $_POST["gen"];
    $obj_Usuario_empl->idEmpleado->correo=$_POST["email"];
    $obj_Usuario_empl->user=str_replace("'","",(trim($_POST["user"])));
    $obj_Usuario_empl->password=str_replace("'","",(trim($_POST["pass"])));
    $obj_Usuario_empl->idCargoFK->hash=$_POST["cargo"]; // a traves del hash del cargo se hara la consulta para obtener el id.
    $obj_Usuario_empl->idEmpleado->estado=$_POST["estado"];
    $obj_Usuario_empl->estado=$_POST["estado"];     
    $obj_Usuario_empl->hash=$_POST["hash_hidden"];
    $obj_Usuario_empl->idEmpleado->hash=$_POST["hash_hidden"];
    $res=$obj_Usuario_empl->Modificar_Empleadousuario();
    if($res)//devuelve true si se modifico algun registro
    {
        header("location: ?ruta=usuario");    
    }
    else
    {
        header("location: ?ruta=usuario#nmod");
    }
}
if (isset($_POST["hash"]))
{
  require_once("../modelo/RN_Empleadousuario.php");
  $obj_Emp=new Empleadousuario;
  $obj_Emp->hash=$_POST["hash"];
  $res=$obj_Emp->Traer_Empleadousuario();
  if($res)
  {
    echo json_encode($obj_Emp);
  }
  else
  {
    echo "error";
  }
  
}
?>