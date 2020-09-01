<?php

require_once("modelo/RN_Logeo.php");
$obj_logeo=new Logeo;
$lista_logs=$obj_logeo->TraerLista_Logeo();
$tabla='
<div class="table-responsive-md">
    <table class="table">
    <thead class="thead-light">
      <tr>               
        <th width="10%"scope="col">#</th>
        <th width="30%" scope="col">Nombre Completo</th>
        <th width="20%" scope="col">Intentos de Logeo</th>
        <th width="20%" scope="col">Fecha de Logeo</th>
        <th width="20%" scope="col">Hora de Logeo</th>
      </tr>
    </thead>
    <tbody>
';
foreach ($lista_logs as $indice => $obj)
{
  $indice+=1;
  $tabla.="<tr><td>$indice</td><td>".$obj->idUsuarioFK->nombre." ".$obj->idUsuarioFK->apellidoPaterno." ".$obj->idUsuarioFK->apellidoMaterno."</td><td>".$obj->intentos."</td><td>".$obj->fechaLogeo."</td><td>".$obj->horaLogeo."</td></tr>";  
}

/* para utilizar la paginacion
$lista_logs=$obj_logeo->TraerLista_Logeo_10en10(1);
foreach ($lista_logs as $indice => $obj)
{
  // $indice+=1;
  $tabla.="<tr><td>".$obj->idLogeo."</td><td>".$obj->idUsuarioFK->nombre." ".$obj->idUsuarioFK->apellidoPaterno." ".$obj->idUsuarioFK->apellidoMaterno."</td><td>".$obj->intentos."</td><td>".$obj->fechaLogeo."</td><td>".$obj->horaLogeo."</td></tr>";  
}*/
$tabla.="</tbody></table></div>";

include_once("vista/v-logeo.php");
?>