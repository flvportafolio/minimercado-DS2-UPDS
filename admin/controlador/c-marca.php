<?php
require_once("modelo/RN_Marca.php");
$obj_Marca=new Marca;
$lista=$obj_Marca->TraerLista_Marca();
$table='
<div class="table-responsive-md">
  <table class="table">
  <thead class="thead-light">
    <tr>               
      <th width="10%"scope="col">#</th>
      <th width="30%" scope="col">Representante de la Marca</th>
      <th width="40%" scope="col">Nombre de la Marca</th>
      <th width="20%" scope="col">Fecha y Hora de Creación</th>
    </tr>
  </thead>
  <tbody>
';
$select_marcas='';
$btn_status=($lista==null)?"disabled":"";
foreach ($lista as $indice => $obj)
{
  $indice+=1;
  $table.="<tr><td>$indice</td><td>".$obj->idMarca->nombre." ".$obj->idMarca->apellidoPaterno." ".$obj->idMarca->apellidoMaterno."</td><td>".$obj->nombre."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
  $select_marcas.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}
$table.="</tbody></table></div>";
include_once("vista/v-marca.php");
?>