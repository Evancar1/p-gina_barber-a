<?php
if ($_SESSION["perfil_usuario"] == "Ayudante" || $_SESSION["perfil_usuario"] == "Administrador") {
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Administrar Precio</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Empresa</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#newPrice">Nuevo precio</button>
                            <h5 class="mt-4">Tabla de Precio</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 tabla_precio">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Servicio</th>
                                        <th>Imagen</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $precio = ControladorPrecio::ctrMostrarPrecio($item, $valor);

                                    foreach ($precio as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                          echo '<td>' . $value["codigo"] . '</td>';
                                          echo '<td>' . $value["titulos"] . '</td>';

                                         if($value["imagen"] != "") {
                                          echo '<td><img src="' . $value["imagen"] . '" style="border-radius: 5px;" width="80" alt=""></td>';
                                        } else {
                                            echo '<td><img src="vistas/img/precio/default/default.jpg" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        }

                                          echo '<td>' . $value["titulop"] . '</td>';
                                          echo '<td>' . $value["descripcion"] . '</td>';
                                          echo '<td>' . $value["precio"] . '</td>';

                                          echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarPrecio" idPrecio="' . $value["id_precio"] . '" data-bs-toggle="modal" data-bs-target="#editar_precio">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarPrecio" idPrecio="' . $value["id_precio"] . '" imagen="' . $value["imagen"] . '" codigo="' . $value["codigo"] . '">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>';
                                        echo '</tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end cardaa -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Minia.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


<!-- ====================================
MODAL NUEVO PRECIO
==================================== -->

<div id="newPrice" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Precio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <?php
                            $item = null;
                            $valor = null;
                            $codigoP = ControladorPrecio::ctrMostrarPrecio($item, $valor);
                            $contador = count($codigoP);
                            $ultimoDato = end($codigoP);
                            if($contador == 0){
                                echo '<label for="codigo">Ingrese el código:</label><small>(A001)</small>';
                            }else{
                                foreach($codigoP as $key => $value){
                                    if($ultimoDato == $value) {
                                        echo '<label for="codigo">Ingrese el código que sigue a:  </label>  <small class="bg-success" style="border-radius:2px 2px; color: white;">   ('.$value["codigo"].')</small>';

                                    }
                                }    
                            }
                            ?>
                        <input class="form-control" type="text" name="nuevoCodigoP" placeholder="A001, A002, A003, ..." require>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Selecciona el servicio</label>
                        <select class="form-select" name="nuevoServicio" id="">
                            <option value="">Selecciona el servicio</option>
                            <?php 
                            $item = null;
                            $valor = null;
                            $servicioSelect = ControladorServicio::ctrMostrarServicio($item, $valor);
                            foreach($servicioSelect as $key => $value){
                                echo '<option value="'.$value["id_servicio"].'">'.$value["titulos"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Subir foto de Precio</label>
                        <input class="form-control nuevoFotoP" type="file" accept="image/*" capture="camera" name="nuevoFotoP" require>
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/servicio/default/default.jpg" class="previsualizarP" width="200px" style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Titulo del Precio</label>
                        <input class="form-control" type="text" name="nuevoTituloP" placeholder="Ingrese el título" require>
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion">Descripción del Precio</label>
                        <textarea name="nuevoDescripcionP" cols="30" rows="10" class="form-control" placeholder="Ingrese una descripción del precio" require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Precio</label>
                        <input class="form-control" type="text" name="nuevoPrecio" placeholder="Ingrese el precio" require>
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoPrecio = new ControladorPrecio();
                $nuevoPrecio->ctrCrearPrecio();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR PRECIO
==================================== -->

<div id="editar_precio" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarIdPrecio" id="editarIdPrecio" require>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarCodigoP" id="editarCodigoP" require>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1">Selecciona el servicio</label>
                        <select class="form-select" name="editarServicioP">
                            <option value="" id="editarServicioP"></option>
                            <?php 
                            $item = null;
                            $valor = null;
                            $servicioSelect = ControladorServicio::ctrMostrarServicio($item, $valor);
                            foreach($servicioSelect as $key => $value){
                                echo '<option value="'.$value["id_servicio"].'">'.$value["titulos"].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto de Precio</label>
                        <input type="file" accept="image/*" capture="camera" class="form-control EditarFotoP"  name="editarFotoP">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/precio/default/default.png" class="previsualizarEditarP" width="200px" style="border-radius: 5px;">
                        </div>
                        <input type="hidden" name="fotoActualP" id="fotoActualP">
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Título de Precio</label>
                        <input class="form-control" type="text" name="editarTituloP" id="editarTituloP" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Descripción del Precio</label>
                        <textarea class="form-control" name="editarDescripcionP" id="editarDescripcionP" cols="30" rows="10"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Precio</label>
                        <input class="form-control" type="text" name="editarPrecio" id="editarPrecio" require>
                    </div>
               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $editarPrecio = new ControladorPrecio();
                $editarPrecio->ctrEditarPrecio();

                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR SERVICIO
=========================================== -->
<?php


$borrarPrecio = new ControladorPrecio();
$borrarPrecio->ctrBorrarPrecio();

}else{
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>