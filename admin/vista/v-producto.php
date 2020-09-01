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
                <a class="nav-link active font-weight-bold" href="?ruta=producto">Productos</a>
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
          <h1 class="h2 text-center py-2">Menu Productos</h1>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="listar_prod-tab" data-toggle="tab" href="#listar_prod" role="tab" aria-controls="listar_prod" aria-selected="true">Listar Productos</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="crear_prod-tab" data-toggle="tab" href="#crear_prod" role="tab" aria-controls="crear_prod" aria-selected="false">Crear Producto</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="modificar_prod-tab" data-toggle="tab" href="#modificar_prod" role="tab" aria-controls="modificar_prod" aria-selected="false">Modificar Producto</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link text-danger" id="eliminar_prod-tab" data-toggle="tab" href="#eliminar_prod" role="tab" aria-controls="eliminar_prod" aria-selected="false">Eliminar Producto</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="listar_prod" role="tabpanel" aria-labelledby="listar_prod-tab">
              '.$table_prod.'
            </div>
            <div class="tab-pane fade" id="crear_prod" role="tabpanel" aria-labelledby="crear_prod-tab">

              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=producto&accion=new" enctype="multipart/form-data">
                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-3">
                    <label for="new_nombre">Nombre</label>
                    <input required type="text" name="nombre" class="form-control" id="new_nombre" placeholder="Nombre">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="new_subcategoria">Subcategoria</label>
                    <select required name="subcategoria" id="new_subcategoria" class="form-control">
                      '.$select_subcat.'
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="new_marca">Marca</label>
                    <select required name="marca" id="new_marca" class="form-control">
                      '.$select_marca.'
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="new_foto">Fotografia</label>
                    <input type="file" name="img" class="form-control-file" id="new_foto" accept="image/png, image/jpeg">
                  </div>                                    
                </div>

                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-12">
                    <label for="new_desc_prod">Descripcion</label>
                    <textarea class="form-control" id="new_desc_prod" rows="3" name="descripcion"></textarea>
                  </div>                              
                </div>                                                
                <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar Producto</button>
              </form>

            </div>
            <div class="tab-pane fade" id="modificar_prod" role="tabpanel" aria-labelledby="modificar_prod-tab">
              <div class="row">
                <div class="col-md-4 mt-2">
                  <select id="up_prod_sel" class="custom-select">                   
                    '.$select_prod.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" '.$btn_status.'>Buscar</button>
                </div>
              </div>
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=producto&accion=update" enctype="multipart/form-data">
                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-3">
                    <label for="up_nombre">Nombre</label>
                    <input required type="text" name="nombre" class="form-control" id="up_nombre" placeholder="Nombre">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="up_subcategoria">Subcategoria</label>
                    <select name="subcategoria" id="up_subcategoria" class="form-control">
                      '.$select_subcat.'
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="up_marca">Marca</label>
                    <select name="marca" id="up_marca" class="form-control">
                      '.$select_marca.'
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="up_foto">Fotografia</label>
                    <input type="file" name="img" class="form-control-file" id="up_foto" accept="image/png, image/jpeg">
                    <input type="text" id="foto_producto_up" name="foto_default" hidden>
                  </div>                                    
                </div>

                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-12">
                    <label for="up_desc_prod">Descripcion</label>
                    <textarea class="form-control" id="up_desc_prod" rows="3" name="descripcion"></textarea>
                  </div>                              
                </div>
                <input type="text" id="hash_hidden" name="hash_hidden" hidden>                                            
                <button id="btn_mod_producto" type="submit" class="btn btn-primary btn-sm btn-block" disabled>Modificar Producto</button>
              </form>
            </div>
            <div class="tab-pane fade" id="eliminar_prod" role="tabpanel" aria-labelledby="eliminar_prod-tab">

              <div class="row">
                <div class="col-md-2 mt-2"></div>
                <div class="col-md-4 mt-2">
                  <select id="delete_prod_sel" class="custom-select">                   
                    '.$select_prod.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                  <button type="button" class="btn btn-danger" onclick="borrar_producto()" '.$btn_status.'>Eliminar</button>
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
      h=$("#up_prod_sel").val();
      if(h!=null)
      {
        $("#hash_hidden").val(h);
        $.ajax({
          type: "POST",
          url: "controlador/c-update-producto.php",
          data: "hash="+ h,
          success : function(text)
          {   
              if(text!="error")
              {
                var objprod = JSON.parse(text);
                $("#up_nombre").val(objprod.nombre);
                $("#up_desc_prod").val(objprod.descripcion);
                $("#foto_producto_up").val(objprod.foto);
                $("#up_subcategoria").val(objprod.idSubCategoriaFK.hash);
                $("#up_marca").val(objprod.idMarcaFK.hash);

                $("#btn_mod_producto").prop("disabled", false);
              }
              else
              {
                alert(text);
              }
          }
        });
      }
    }
    function borrar_producto()
    {
      h=$("#delete_prod_sel").val();
      if(h!=null)
      {
        $.ajax({
          type: "POST",
          url: "controlador/c-delete-producto.php",
          data: "hash="+ h,
          success : function(text)
          {   
              if(text=="ok")
              {
                location = "index.php?ruta=producto";
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