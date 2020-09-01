<?php
require_once("modelo/RN_Cargo.php");
$obj_cargo=new Cargo;
$lista_cargo=$obj_cargo->TraerLista_Cargo();
$tabla='
<div class="table-responsive-md">
    <table class="table">
    <thead class="thead-light">
      <tr>               
        <th width="10%"scope="col">#</th>
        <th width="30%" scope="col">Nombre</th>
        <th width="40%" scope="col">Descripción</th>
        <th width="20%" scope="col">Fecha y Hora de Creación</th>
      </tr>
    </thead>
    <tbody>
';
$select_items='';// <option selected>Selecciona un Valor</option>
$btn_status=($lista_cargo==null)?"disabled":"";
foreach ($lista_cargo as $indice => $obj)
{
  $indice+=1;
  $tabla.="<tr><td>$indice</td><td>".$obj->nombre."</td><td>".$obj->descripcion."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
  $select_items.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}
$tabla.="</tbody></table></div>";

include_once("vista/v-cargo.php");
?>