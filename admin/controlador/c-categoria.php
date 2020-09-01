<?php

require_once("modelo/RN_Categoria.php");
$obj_Categoria=new Categoria;
$lista_cat=$obj_Categoria->TraerLista_Categoria();

$table_cats='
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
$btn_status=($lista_cat==null)?"disabled":"";
foreach ($lista_cat as $indice => $obj_c)
{
  $indice+=1;
  $table_cats.="<tr><td>$indice</td><td>".$obj_c->nombre."</td><td>".$obj_c->descripcion."</td><td>".$obj_c->fecha_registro." ".$obj_c->hora_registro."</td></tr>";
  $select_items.="<option value=".$obj_c->hash.">".$obj_c->nombre."</option>";
}
$table_cats.="</tbody></table></div>";

include_once("vista/v-categoria.php");

?>