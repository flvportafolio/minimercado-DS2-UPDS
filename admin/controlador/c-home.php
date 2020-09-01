<?php
  require_once("modelo/RN_UsuarioSistema.php");
  require_once("modelo/RN_Producto.php");
  require_once("modelo/RN_Logeo.php");
  $objsis=new UsuarioSistema;
  $obj_Prod=new Producto;
  $obj_logeo=new Logeo;


  $lista=$objsis->Traer_Datos_MenuPrincipal();
  $lista_prod=$obj_Prod->TraerLista_UltimosProductos();
  $lista_logs=$obj_logeo->TraerLista_UltimosLogeados();

// logica para los productos
  $tabla_prod='
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
  foreach ($lista_prod as $indice => $obj)
  {
    $indice+=1;
    $tabla_prod.="<tr><td>$indice</td><td><img src='vista/img/producto/".$obj->foto."' width='64px' height='64px' alt='producto'></td><td>".$obj->nombre."</td><td>".$obj->descripcion."</td><td>".$obj->idSubCategoriaFK->nombre."</td><td>".$obj->idMarcaFK->nombre."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";    
  }
  $tabla_prod.="</tbody></table></div>";
//

// logica para los logeos
$tabla_log='
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
  $tabla_log.="<tr><td>$indice</td><td>".$obj->idUsuarioFK->nombre." ".$obj->idUsuarioFK->apellidoPaterno." ".$obj->idUsuarioFK->apellidoMaterno."</td><td>".$obj->intentos."</td><td>".$obj->fechaLogeo."</td><td>".$obj->horaLogeo."</td></tr>";  
}
$tabla_log.="</tbody></table></div>";
//

  include_once("vista/v-home.php");
?>