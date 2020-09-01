<?php
require_once("modelo/RN_Usuariosistema.php");
require_once("modelo/RN_Empleadousuario.php");
require_once("modelo/RN_Cargo.php");
$obj_UsuarioSistema=new Usuariosistema;
$obj_Empleadousuario=new Empleadousuario;
$obj_cargo=new Cargo;

$lista_UsuarioSistema=$obj_UsuarioSistema->TraerLista_Usuariosistema();
$lista_empl=$obj_Empleadousuario->TraerLista_Empleadousuario();
$lista_cargos=$obj_cargo->TraerLista_Cargo();

$select_items="";
$select_emp="";

$btn_status=($lista_UsuarioSistema==null)? "disabled":"";
$btn_status_emp=($lista_empl==null)? "disabled":"";

foreach ($lista_UsuarioSistema as $indice => $obj)
{
  $select_items.="<option value=".$obj->hash.">".$obj->alias."</option>";
}

foreach ($lista_empl as $indice => $obj)
{
  $select_emp.="<option value=".$obj->hash.">".$obj->idEmpleado->nombre." ".$obj->idEmpleado->apellidoPaterno." ".$obj->idEmpleado->apellidoMaterno."</option>";
}

$select_cargos="";
foreach ($lista_cargos as $indice => $obj)
{
  $select_cargos.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}

$lista_US_EU=$obj_UsuarioSistema->idUsuario->TraerPersonas_US_EU();//usamos idUsuario para hacer uso de los metodos de la clase Persona de manera generica
$table_US_EU='
<div class="table-responsive-md">
    <table class="table">
    <thead class="thead-light">
      <tr>               
        <th scope="col">#</th>
        <th scope="col">Foto</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido Paterno</th>
        <th scope="col">Apellido Materno</th>
        <th scope="col">Genero</th>
        <th scope="col">Fecha de Nacimiento</th>
        <th scope="col">Pais de Origen</th>
        <th scope="col">Direccion</th>
        <th scope="col">Correo</th>
        <th scope="col">Fecha y Hora de Creación</th>
      </tr>
    </thead>
    <tbody>
';
foreach ($lista_US_EU as $indice => $obj)
{
  $indice+=1;
  $table_US_EU.="<tr><td>$indice</td><td><img src='vista/img/perfil/".$obj->foto."' width='64px' height='64px' alt='imagen de perfil'></td><td>".$obj->nombre."</td><td>".$obj->apellidoPaterno."</td><td>".$obj->apellidoMaterno."</td><td>".$obj->genero."</td><td>".$obj->fecha_nac."</td><td>".$obj->pais_nac."</td><td>".$obj->direccion."</td><td>".$obj->correo."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
}
$table_US_EU.="</tbody></table></div>";

include_once("vista/v-usuario.php");
?>