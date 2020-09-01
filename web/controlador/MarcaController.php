<?php
require_once("web/modelo/RN_Marca.php");
$obj_Marca=new Marca;
$lista_marcas=$obj_Marca->TraerLista_Marca();
//logica de las marcas
$alfabeto = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');
//$marcas = array('Motorola','Audi1','Audi2','Audi3','Audi4','Bell','Casio','Doreo','Electra','Galeon','Hamacas','Indana','Jaw','Klin','Luxe','Lg','Manaco','Nissan');
$seccion_marcas="";
foreach ($alfabeto as $char)
{  
  $ul1="";
  $ul2="";
  $ul3="";
  $flag=1;
  $letraok=false;
  foreach ($lista_marcas as $indice => $item)
  {
    $n=ucfirst($item->nombre);
    if (substr($n, 0, 1)==$char)
    { 
      switch ($flag)
      {
        case 1:
          $letraok=true; 
          $ul1.='<li>'.$n.'</li>';
          $flag=2;
        break;
        case 2:
          $ul2.='<li>'.$n.'</li>';      
          $flag=3;
        break;
        case 3:
          $ul3.='<li>'.$n.'</li>'; 
          $flag=1;
        break;
      }        
      unset($lista_marcas[$indice]);
    }   
  }
  if ($letraok)
  {
    $seccion_marcas.='<h5>'.$char.'</h5>';
    $seccion_marcas.='<div class="row">';
      $seccion_marcas.='<div class="col-md-4">  <ul>'. $ul1.'</ul> </div>';
      $seccion_marcas.='<div class="col-md-4"> <ul>'. $ul2.'</ul> </div>';
      $seccion_marcas.='<div class="col-md-4"> <ul>'. $ul3.'</ul> </div>';
    $seccion_marcas.='</div>';
  }
  

}
//

include_once("web/vista/v-marcas.php");
?>