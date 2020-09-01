<?php
require_once("web/modelo/RN_Producto.php");
$obj_Producto=new Producto;
$lista_prod=$obj_Producto->TraerLista_Producto();

//generacion de bloques de producto en fila y por columnas de 4
$seccion_prod='<div class="row pb-2">';
foreach ($lista_prod as $indice => $obj) 
{
  $indice+=1;
  if ($indice%4==0)
  {
    $seccion_prod.='
    <div class="pb-2 col-md-3">
      <div class="card pt-3">
        <img class="mx-auto" src="admin/vista/img/producto/'.$obj->foto.'"  height="70px" alt="producto"> 
        <div class="card-body">
          <h6 class="card-title">'.$obj->nombre.'</h6>
          <p class="card-text">'.$obj->descripcion.'</p>
        </div>
      </div>
    </div>';
    $seccion_prod.='</div>';
    $seccion_prod.='<div class="row pb-2">';  
  }
  else 
  {
    $seccion_prod.='
    <div class="pb-2 col-md-3">
      <div class="card pt-3">
        <img class="mx-auto" src="admin/vista/img/producto/'.$obj->foto.'"  height="70px" alt="producto"> 
        <div class="card-body">
          <h6 class="card-title">'.$obj->nombre.'</h6>
          <p class="card-text">'.$obj->descripcion.'</p>
        </div>
      </div>
    </div>';
  }    
}
$seccion_prod.='</div>';
include_once("web/vista/v-producto.php");
?>