<?php
require_once("modelo/RN_Producto.php");
require_once("modelo/RN_Subcategoria.php");
require_once("modelo/RN_Marca.php");
$obj_Prod=new Producto;
$obj_SubCat=new Subcategoria;
$obj_Marca=new Marca;
//logica para subcategoria
$lista_subcat=$obj_SubCat->TraerLista_Subcategoria();
$select_subcat="";
foreach ($lista_subcat as $indice => $obj)
{
  $select_subcat.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}
//

//logica para marca
$lista_marca=$obj_Marca->TraerLista_Marca();
$select_marca="";
foreach ($lista_marca as $indice => $obj)
{
  $select_marca.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}
//

$lista_prod=$obj_Prod->TraerLista_Producto();
$table_prod='
<div class="table-responsive-md">
    <table class="table">
    <thead class="thead-light">
      <tr>               
        <th width="5%" scope="col">#</th>
        <th width="10%" scope="col">Foto</th>
        <th width="20%" scope="col">Nombre</th>
        <th width="25%" scope="col">Descripción</th>
        <th width="10%" scope="col">Subcategoria</th>
        <th width="10%" scope="col">Marca</th>
        <th width="20%" scope="col">Fecha y Hora de Creación</th>
      </tr>
    </thead>
    <tbody>
';
$select_prod='';
$btn_status=($lista_prod==null)?"disabled":"";
foreach ($lista_prod as $indice => $obj)
{
  $indice+=1;
  $table_prod.="<tr><td>$indice</td><td><img src='vista/img/producto/".$obj->foto."' width='64px' height='64px' alt='producto'></td><td>".$obj->nombre."</td><td>".$obj->descripcion."</td><td>".$obj->idSubCategoriaFK->nombre."</td><td>".$obj->idMarcaFK->nombre."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
  $select_prod.="<option value=".$obj->hash.">".$obj->nombre."</option>";
}
$table_prod.="</tbody></table></div>";

include_once("vista/v-producto.php");
?>