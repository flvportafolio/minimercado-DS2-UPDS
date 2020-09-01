<?php
$date_now=date("Y-m-d");
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
                <a class="nav-link active font-weight-bold" href="?ruta=marca">Marcas</a>
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
          <h1 class="h2 text-center py-2">Menu Marcas</h1>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="listamarcas-tab" data-toggle="tab" href="#listamarcas" role="tab" aria-controls="listamarcas" aria-selected="true">Lista de Marcas</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="crearmarca-tab" data-toggle="tab" href="#crearmarca" role="tab" aria-controls="crearmarca" aria-selected="false">Crear Marca</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="modificarmarca-tab" data-toggle="tab" href="#modificarmarca" role="tab" aria-controls="modificarmarca" aria-selected="false">Modificar Marca</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link text-danger" id="eliminarmarca-tab" data-toggle="tab" href="#eliminarmarca" role="tab" aria-controls="eliminarmarca" aria-selected="false">Eliminar Marca</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="listamarcas" role="tabpanel" aria-labelledby="listamarcas-tab">
              '.$table.'
            </div>
            <div class="tab-pane fade" id="crearmarca" role="tabpanel" aria-labelledby="crearmarca-tab">
            
            <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=marca&accion=new" enctype="multipart/form-data">
              <div class="form-row justify-content-md-center">
                <div class="form-group col-md-3">
                  <label for="input_new_name">Nombre</label>
                  <input required type="text" name="nombre" class="form-control" id="input_new_name" placeholder="Nombre">
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_app">Apellido Paterno</label>
                  <input required type="text" name="app" class="form-control" id="input_new_app" placeholder="Apellido Paterno">
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_apm">Apellido Materno</label>
                  <input required type="text" name="apm" class="form-control" id="input_new_apm" placeholder="Apellido Materno">
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_marca"><b>Marca</b></label>
                  <input required type="text" name="marca" class="form-control" id="input_new_marca" placeholder="Nombre de la Marca">
                </div>
              </div>

              <div class="form-row justify-content-md-center">
                <div class="form-group col-md-3">
                  <label for="input_new_prof">Profesión</label>
                  <input type="text" name="prof" class="form-control" id="input_new_prof" placeholder="Profesión">
                </div>
                <div class="form-group col-md-4">
                  <label for="input_new_dir">Direccion</label>
                  <input type="text" name="dir" class="form-control" id="input_new_dir" placeholder="Direccion">
                </div>
                <div class="form-group col-md-5">
                  <label for="input_new_foto">Fotografia</label>
                  <input type="file" name="img" class="form-control-file" id="input_new_foto" accept="image/png, image/jpeg">
                </div>            
              </div>

              <div class="form-row justify-content-md-center">
                <div class="form-group col-md-3">
                  <label for="input_new_date">Fecha de Nacimiento</label>
                  <input required class="form-control" name="fecha" type="date" max="'.$date_now.'" id="input_new_date">
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_telf">Telefono</label>
                  <input type="text" name="telf" class="form-control" id="input_new_telf" placeholder="Telefono">
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_estadoc">Estado Civil</label>
                  <select name="e_civil" id="input_new_estadoc" class="form-control">
                    <option value="S" selected>Soltero</option>
                    <option value="C">Casado</option>
                    <option value="D">Divorciado</option>
                    <option value="V">Viudo</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_niveledu">Nivel Educativo</label>
                  <select name="n_edu" id="input_new_niveledu" class="form-control">
                    <option value="E" selected>Estudiante</option>
                    <option value="B">Bachiller</option>
                    <option value="U">Universitario</option>
                    <option value="G">Graduado</option>
                  </select>
                </div>
                
              </div>

              <div class="form-row justify-content-md-center">
                <div class="form-group col-md-4">
                  <label for="input_new_correo">Correo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="logoemail_new">@</span>
                    </div>
                    <input required type="email" name="email" class="form-control" id="input_new_correo" placeholder="Correo">
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label for="input_new_pais">Pais de Origen</label>
                  <input type="text" name="pais" class="form-control" id="input_new_pais" placeholder="Pais">
                </div>
                <div class="form-group col-md-2">
                  <label class="col-md-12">Genero</label>
                  <div class="form-check-inline">
                    <input required type="radio" name="gen" class="form-check-input" id="input_new_radiogen1" value="M">
                    <label class="form-check-label" for="input_new_radiogen1">Masculino</label>
                  </div>
                  <div class="form-check-inline">
                    <input type="radio" name="gen" class="form-check-input" id="input_new_radiogen2" value="F">
                    <label class="form-check-label" for="input_new_radiogen2">Femenino</label>
                  </div>
                </div>                
                <div class="form-group col-md-3">
                  <label class="col-md-12">Estado</label>
                  <div class="form-check-inline">
                    <input checked type="radio" name="estado" class="form-check-input" id="input_new_radioestado1" value="A">
                    <label class="form-check-label" for="input_new_radioestado1">Activo</label>
                  </div>
                  <div class="form-check-inline">
                    <input type="radio" name="estado" class="form-check-input" id="input_new_radioestado2" value="I">
                    <label class="form-check-label" for="input_new_radioestado2">Inactivo</label>
                  </div>
                </div>                                                      
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar</button>
            </form>
            
            </div>
            <div class="tab-pane fade" id="modificarmarca" role="tabpanel" aria-labelledby="modificarmarca-tab">
              <div class="row">
                <div class="col-md-4 mt-2">
                  <select id="marca_sel" class="custom-select">                   
                    '.$select_marcas.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" '.$btn_status.'>Buscar</button>
                </div>
              </div>
              <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=marca&accion=update" enctype="multipart/form-data">
                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-3">
                    <label for="input_up_name">Nombre</label>
                    <input required type="text" name="nombre" class="form-control" id="input_up_name" placeholder="Nombre">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_app">Apellido Paterno</label>
                    <input required type="text" name="app" class="form-control" id="input_up_app" placeholder="Apellido Paterno">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_apm">Apellido Materno</label>
                    <input required type="text" name="apm" class="form-control" id="input_up_apm" placeholder="Apellido Materno">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_marca"><b>Marca</b></label>
                    <input required type="text" name="marca" class="form-control" id="input_up_marca" placeholder="Nombre de la Marca">
                  </div>
                </div>

                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-3">
                    <label for="input_up_prof">Profesión</label>
                    <input type="text" name="prof" class="form-control" id="input_up_prof" placeholder="Profesión">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_up_dir">Direccion</label>
                    <input type="text" name="dir" class="form-control" id="input_up_dir" placeholder="Direccion">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="input_up_foto">Fotografia</label>
                    <input type="file" name="img" class="form-control-file" id="input_up_foto" accept="image/png, image/jpeg">
                    <input type="text" id="foto_marca_up" name="foto_default" hidden>
                  </div>            
                </div>

                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-3">
                    <label for="input_up_date">Fecha de Nacimiento</label>
                    <input required class="form-control" name="fecha" type="date" max="'.$date_now.'" id="input_up_date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_telf">Telefono</label>
                    <input type="text" name="telf" class="form-control" id="input_up_telf" placeholder="Telefono">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_estadoc">Estado Civil</label>
                    <select name="e_civil" id="input_up_estadoc" class="form-control">
                      <option value="S" selected>Soltero</option>
                      <option value="C">Casado</option>
                      <option value="D">Divorciado</option>
                      <option value="V">Viudo</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_niveledu">Nivel Educativo</label>
                    <select name="n_edu" id="input_up_niveledu" class="form-control">
                      <option value="E" selected>Estudiante</option>
                      <option value="B">Bachiller</option>
                      <option value="U">Universitario</option>
                      <option value="G">Graduado</option>
                    </select>
                  </div>
                  
                </div>

                <div class="form-row justify-content-md-center">
                  <div class="form-group col-md-4">
                    <label for="input_up_correo">Correo</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="logoemail_up">@</span>
                      </div>
                      <input required type="email" name="email" class="form-control" id="input_up_correo" placeholder="Correo">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_up_pais">Pais de Origen</label>
                    <input type="text" name="pais" class="form-control" id="input_up_pais" placeholder="Pais">
                  </div>
                  <div class="form-group col-md-2">
                    <label class="col-md-12">Genero</label>
                    <div class="form-check-inline">
                      <input required type="radio" name="gen" class="form-check-input" id="input_up_radiogen1" value="M">
                      <label class="form-check-label" for="input_up_radiogen1">Masculino</label>
                    </div>
                    <div class="form-check-inline">
                      <input type="radio" name="gen" class="form-check-input" id="input_up_radiogen2" value="F">
                      <label class="form-check-label" for="input_up_radiogen2">Femenino</label>
                    </div>
                  </div>                
                  <div class="form-group col-md-3">
                    <label class="col-md-12">Estado</label>
                    <div class="form-check-inline">
                      <input checked type="radio" name="estado" class="form-check-input" id="input_up_radioestado1" value="A">
                      <label class="form-check-label" for="input_up_radioestado1">Activo</label>
                    </div>
                    <div class="form-check-inline">
                      <input type="radio" name="estado" class="form-check-input" id="input_up_radioestado2" value="I">
                      <label class="form-check-label" for="input_up_radioestado2">Inactivo</label>
                    </div>
                  </div>                                                      
                </div>
                <input type="text" id="hash_hidden" name="hash_hidden" hidden>
                <button id="btn_mod_marca" type="submit" class="btn btn-primary btn-sm btn-block" disabled>Actualizar</button>
              </form>
            </div>
            <div class="tab-pane fade" id="eliminarmarca" role="tabpanel" aria-labelledby="eliminarmarca-tab">
              <div class="row">
                <div class="col-md-2 mt-2"></div>
                <div class="col-md-4 mt-2">
                  <select id="delete_cargo_sel" class="custom-select">                   
                    '.$select_marcas.'
                  </select>
                </div>
                <div class="col-md-4 mt-2">
                  <button type="button" class="btn btn-danger" onclick="borrar_marca()" '.$btn_status.'>Eliminar</button>
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
        h=$("#marca_sel").val();
        if(h!=null)
        {
          $("#hash_hidden").val(h);
          $.ajax({
            type: "POST",
            url: "controlador/c-update-marca.php",
            data: "hash="+ h,
            success : function(text)
            {   
                if(text!="error")
                {
                  var objmarca = JSON.parse(text);
                  $("#input_up_name").val(objmarca.idMarca.nombre);
                  $("#input_up_marca").val(objmarca.nombre);
                  $("#input_up_app").val(objmarca.idMarca.apellidoPaterno);
                  $("#input_up_apm").val(objmarca.idMarca.apellidoMaterno);
                  $("#input_up_prof").val(objmarca.idMarca.profesion);
                  $("#input_up_dir").val(objmarca.idMarca.direccion);
                  $("#foto_marca_up").val(objmarca.idMarca.foto);
                  $("#input_up_date").val(objmarca.idMarca.fecha_nac);
                  $("#input_up_telf").val(objmarca.idMarca.telefono);
                  $("#input_up_estadoc").val(objmarca.idMarca.estado_civil);
                  $("#input_up_niveledu").val(objmarca.idMarca.nivel_educ);
                  $("#input_up_pais").val(objmarca.idMarca.pais_nac);
                  //caso del radiobutton de genero
                  (objmarca.idMarca.genero=="M")? $("#input_up_radiogen1").prop("checked",true):$("#input_up_radiogen2").prop("checked",true);
                  $("#input_up_correo").val(objmarca.idMarca.correo); 
                  //caso del radiobutton de estado
                  (objmarca.estado=="A")? $("#input_up_radioestado1").prop("checked",true):$("#input_up_radioestado2").prop("checked",true);
                  $("#btn_mod_marca").prop("disabled", false);
                }
                else
                {
                  alert(text);
                }
            }
          });
        }
      }
      function borrar_marca()
      {
        h=$("#delete_cargo_sel").val();
        if(h!=null)
        {
          $.ajax({
            type: "POST",
            url: "controlador/c-delete-marca.php",
            data: "hash="+ h,
            success : function(text)
            {   
                if(text=="ok")
                {
                  location = "index.php?ruta=marca";
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