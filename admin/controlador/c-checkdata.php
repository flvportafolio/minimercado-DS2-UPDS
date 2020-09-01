<?php

if (!isset($_SESSION["intentos"])) // si no hay intentos de logeo anteriores, se crea uno.
{
    $_SESSION["intentos"]=1;
}

if (isset($_POST["user"])&&isset($_POST["pass"])) 
{
    require_once("modelo/RN_Usuariosistema.php");
    require_once("modelo/RN_Logeo.php");
    $user=str_replace("'","",$_POST["user"]);
    $pass=str_replace("'","",$_POST["pass"]);

    $obj_Usuario=new Usuariosistema;
    $obj_Log=new Logeo;
    $obj_Usuario->user=$user;
    $obj_Usuario->password=$pass;
    $res=$obj_Usuario->verificar();

    if($res)//si se verifica exitosamente al usuarioSistema se registra el logeo y se muestra el panel de administracion
    {
        $obj_Log->idUsuarioFK->idPersona=$obj_Usuario->idUsuario;
        $res=$obj_Log->registrar_logeo($_SESSION["intentos"]);
        $_SESSION["intentos"]=null;
        header("location: ?ruta=home");
    }
    else //se verifica al EmpleadoUsuario y si es correcto se registra el logeo y se muestra el panel de administracion
    {   
        require_once("modelo/RN_Empleadousuario.php");
        $obj_emp=new Empleadousuario;
        $obj_emp->user=$user;
        $obj_emp->password=$pass;
        $res=$obj_emp->verificar();
        if($res)
        {
            $obj_Log->idUsuarioFK->idPersona=$obj_emp->idEmpleado;
            $res=$obj_Log->registrar_logeo($_SESSION["intentos"]);
            $_SESSION["intentos"]=null;
            header("location: ?ruta=home"); //por el momento un usuarioEmpleado tiene accesso al panel administrador
        }
        else //si los credenciales son incorrectos mostramos en la pagina de login un mensaje de error.
        {
            $_SESSION["spam_message"]="Los datos de acceso son incorrectos, Intente Nuevamente.";
            $_SESSION["intentos"]=$_SESSION["intentos"]+1;
            header("location: ?error");
        }                
    }
}
?>