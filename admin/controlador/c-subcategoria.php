<?php
  require_once("modelo/RN_Categoria.php");
  require_once("modelo/RN_Subcategoria.php");

  $obj_Subcategoria=new Subcategoria;
  $lista_subcat=$obj_Subcategoria->TraerLista_Subcategoria();
  $table_subcat='
  <div class="table-responsive-md">
      <table class="table">
      <thead class="thead-light">
        <tr>               
          <th width="10%"scope="col">#</th>
          <th width="30%" scope="col">Nombre</th>
          <th width="20%" scope="col">Descripción</th>
          <th width="20%" scope="col">Categoria</th>
          <th width="20%" scope="col">Fecha y Hora de Creación</th>
        </tr>
      </thead>
      <tbody>
  ';
  $select_subcat='';
  $btn_status=($lista_subcat==null)?"disabled":"";
  foreach ($lista_subcat as $indice => $obj_subc)
  {
    $indice+=1;
    $table_subcat.="<tr><td>$indice</td><td>".$obj_subc->nombre."</td><td>".$obj_subc->descripcion."</td><td>".$obj_subc->idCategoriaFK->nombre."</td><td>".$obj_subc->fecha_registro." ".$obj_subc->hora_registro."</td></tr>";
    $select_subcat.="<option value=".$obj_subc->hash.">".$obj_subc->nombre."</option>";
  }
  $table_subcat.="</tbody></table></div>";
  
  //logica de categoria
  $obj_Categoria=new Categoria;
  $lista_cat=$obj_Categoria->TraerLista_Categoria();

  $select_cat='';
  foreach ($lista_cat as $indice => $obj)
  {
    $select_cat.="<option value=".$obj->hash.">".$obj->nombre."</option>";
  }

  include_once("vista/v-subcategoria.php");
?>