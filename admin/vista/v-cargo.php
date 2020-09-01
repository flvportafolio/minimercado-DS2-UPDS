<?php
$page='
<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">            
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
    <title>Panel de Administración</title>
    <link href="vista/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <style>
    .dropdown-item:hover
    {
      background:gray;
    }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Tiendas SC • <span class="h5 text-info">'.$_SESSION["UsuarioRegistrado"]["alias"].'</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-2 d-md-block bg-light collapse">
          <div class="pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-dark" href="?ruta=home">Menu Principal</a>
              </li>                          
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=producto">Productos</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=categoria">Categorias</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=subcategoria">Subcategorias</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=marca">Marcas</a>
              </li> 
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=usuario">Usuarios</a>
              </li>
              <li class="nav-item btn-group dropright py-2">
                <a class="nav-link dropdown-toggle active font-weight-bold" href="#" data-toggle="dropdown"> Más </a>
                <div class="dropdown-menu bg-light">                                    
                  <a href="?ruta=cargo" class="dropdown-item text-dark">Cargos</a>                  
                  <a href="?ruta=logeo" class="dropdown-item text-dark">Logeos</a>
                </div>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-danger" href="?logout">Salir</a>
              </li>              
            </ul>          
          </div>
        </nav>

        <main role="main" class="col-md-10" style="overflow-y: auto; height:600px;">
          <h1 class="h2 text-center py-2">Menu Cargos</h1>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="listacargos-tab" data-toggle="tab" href="#listacargos" role="tab" aria-controls="listacargos" aria-selected="true">Lista de Cargos</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="nuevocargo-tab" data-toggle="tab" href="#nuevocargo" role="tab" aria-controls="nuevocargo" aria-selected="false">Crear Cargo</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="modificarcargo-tab" data-toggle="tab" href="#modificarcargo" role="tab" aria-controls="modificarcargo" aria-selected="false">Modificar Cargo</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link text-danger" id="eliminarcargo-tab" data-toggle="tab" href="#eliminarcargo" role="tab" aria-controls="eliminarcargo" aria-selected="false">Eliminar Cargo</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="listacargos" role="tabpanel" aria-labelledby="listacargos-tab">
              '.$tabla.'
            </div>
            <div class="tab-pane fade" id="nuevocargo" role="tabpanel" aria-labelledby="nuevocargo-tab">
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=cargo&accion=new">
                <div class="form-group">
                  <label for="nombre_cargo_new">Nombre:</label>
                  <input required type="text" class="form-control" id="nombre_cargo_new" name="nombre">
                </div>                          
                <div class="form-group">
                  <label for="descripcion_cargo_new">Descripcion</label>
                  <textarea class="form-control" id="descripcion_cargo_new" rows="3" name="descripcion"></textarea>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="modificarcargo" role="tabpanel" aria-labelledby="modificarcargo-tab">
              <div class="row">
                <div class="col-md-4 mt-2">
                  <select id="cargo_sel" class="custom-select">                   
                    '.$select_items.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" '.$btn_status.'>Buscar</button>
                </div>
              </div>
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=cargo&accion=update">
                <div class="form-group">
                  <label for="up_nombre_cargo">Nombre:</label>
                  <input required type="text" class="form-control" id="up_nombre_cargo" name="nombre">
                </div>                          
                <div class="form-group">
                  <label for="up_desc_cargo">Descripcion</label>
                  <textarea class="form-control" id="up_desc_cargo" rows="3" name="descripcion"></textarea>
                </div>
                <input type="text" id="hash_hidden" name="hash_hidden" hidden>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button id="btn_mod_cargo" type="submit" class="btn btn-primary" disabled>Actualizar</button>
                  </div>
                </div>
              </form>            
            </div>
            <div class="tab-pane fade" id="eliminarcargo" role="tabpanel" aria-labelledby="eliminarcargo-tab">
              <div class="row">
                <div class="col-md-2 mt-2"></div>
                <div class="col-md-4 mt-2">
                  <select id="delete_car_sel" class="custom-select">                   
                    '.$select_items.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-danger" onclick="borrar_cargo()" '.$btn_status.'>Eliminar</button>
                </div>
              </div>
            </div>
          </div>          
        </main>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
      function llenar_updateform()
      {
        h=$("#cargo_sel").val();
        if(h!=null)
        {
          $("#hash_hidden").val(h);
          $.ajax({
            type: "POST",
            url: "controlador/c-update-cargo.php",
            data: "hash="+ h,
            success : function(text)
            {   
                if(text!="error")
                {
                  var objcargo = JSON.parse(text);
                  $("#up_nombre_cargo").val(objcargo.nombre);
                  $("#up_desc_cargo").val(objcargo.descripcion);
                  $("#btn_mod_cargo").prop("disabled", false);
                }
                else
                {
                  alert(text);
                }
            }
          });
        }
      } 
      function borrar_cargo()
      {
        h=$("#delete_car_sel").val();
        if(h!=null)
        {
          $.ajax({
            type: "POST",
            url: "controlador/c-delete-cargo.php",
            data: "hash="+ h,
            success : function(text)
            {   
                if(text=="ok")
                {
                  location = "index.php?ruta=cargo";
                }
                else
                {
                  alert(text);
                }              
            }
          });
        }
      }      
    </script>
  </body>
</html>';
echo $page;
?>