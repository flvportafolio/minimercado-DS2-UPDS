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
                <a class="nav-link active font-weight-bold" href="?ruta=subcategoria">Subcategorias</a>
              </li>
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=marca">Marcas</a>
              </li> 
              <li class="nav-item py-2">
                <a class="nav-link text-dark" href="?ruta=usuario">Usuarios</a>
              </li>
              <li class="nav-item btn-group dropright py-2">
                <a class="nav-link text-dark dropdown-toggle" href="#" data-toggle="dropdown"> Más </a>
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
          <h1 class="h2 text-center py-2">Menu Subcategorias</h1>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="listar_subcategoria-tab" data-toggle="tab" href="#listar_subcategoria" role="tab" aria-controls="listar_subcategoria" aria-selected="true">Listar SubCategorias</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="crear_subcategoria-tab" data-toggle="tab" href="#crear_subcategoria" role="tab" aria-controls="crear_subcategoria" aria-selected="false">Crear SubCategoria</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="modificar_subcategoria-tab" data-toggle="tab" href="#modificar_subcategoria" role="tab" aria-controls="modificar_subcategoria" aria-selected="false">Modificar SubCategoria</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link text-danger" id="eliminar_subcategoria-tab" data-toggle="tab" href="#eliminar_subcategoria" role="tab" aria-controls="eliminar_subcategoria" aria-selected="false">Eliminar SubCategoria</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="listar_subcategoria" role="tabpanel" aria-labelledby="listar_subcategoria-tab">
              '.$table_subcat.'
            </div>
            <div class="tab-pane fade" id="crear_subcategoria" role="tabpanel" aria-labelledby="crear_subcategoria-tab">
              
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=subcategoria&accion=new">
                <div class="form-group">
                  <label for="nombre_subcat">Nombre:</label>
                  <input required type="text" class="form-control" id="nombre_subcat" name="nombre">
                </div>                          
                <div class="form-group">
                  <label for="desc_subcat">Descripcion:</label>
                  <textarea class="form-control" id="desc_subcat" rows="3" name="descripcion"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputcat">Categoria:</label>
                  <select required name="categoria" id="inputcat" class="form-control">
                    '.$select_cat.'
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </form>

            </div>
            <div class="tab-pane fade" id="modificar_subcategoria" role="tabpanel" aria-labelledby="modificar_subcategoria-tab">

              <div class="row">
                <div class="col-md-4 mt-2">
                  <select id="subcat_sel" class="custom-select">                   
                    '.$select_subcat.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" '.$btn_status.'>Buscar</button>
                </div>
              </div>
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=subcategoria&accion=update">
                <div class="form-group">
                  <label for="up_nombre_subcat">Nombre:</label>
                  <input required type="text" class="form-control" id="up_nombre_subcat" name="nombre">
                </div>                          
                <div class="form-group">
                  <label for="up_desc_subcat">Descripcion:</label>
                  <textarea class="form-control" id="up_desc_subcat" rows="3" name="descripcion"></textarea>
                </div>
                <div class="form-group">
                  <label for="up_inputcat">Categoria:</label>
                  <select name="categoria" id="up_inputcat" class="form-control">
                    '.$select_cat.'
                  </select>
                </div>
                <input type="text" id="hash_hidden" name="hash_hidden" hidden>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button id="btn_mod_subcategoria" type="submit" class="btn btn-primary" disabled>Actualizar</button>
                  </div>
                </div>
              </form>

            </div>
            <div class="tab-pane fade" id="eliminar_subcategoria" role="tabpanel" aria-labelledby="eliminar_subcategoria-tab">
              
              <div class="row">
                <div class="col-md-2 mt-2"></div>
                <div class="col-md-4 mt-2">
                  <select id="delete_subcat_sel" class="custom-select">                   
                    '.$select_subcat.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                  <button type="button" class="btn btn-danger" onclick="borrar_subcategoria()" '.$btn_status.'>Eliminar</button>
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
      h=$("#subcat_sel").val();
      if(h!=null)
      {
        $("#hash_hidden").val(h);
        $.ajax({
          type: "POST",
          url: "controlador/c-update-subcategoria.php",
          data: "hash="+ h,
          success : function(text)
          {   
              if(text!="error")
              {
                var objsubcat = JSON.parse(text);
                $("#up_nombre_subcat").val(objsubcat.nombre);
                $("#up_desc_subcat").val(objsubcat.descripcion);                
                $("#up_inputcat").val(objsubcat.idCategoriaFK.hash);
                
                $("#btn_mod_subcategoria").prop("disabled", false);
              }
              else
              {
                alert(text);
              }
          }
        });
      }
    }
    function borrar_subcategoria()
    {
      h=$("#delete_subcat_sel").val();
      if(h!=null)
      {
        $.ajax({
          type: "POST",
          url: "controlador/c-delete-subcategoria.php",
          data: "hash="+ h,
          success : function(text)
          {   
              if(text=="ok")
              {
                location = "index.php?ruta=subcategoria";
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