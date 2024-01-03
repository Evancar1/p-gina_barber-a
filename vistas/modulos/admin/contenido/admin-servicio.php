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
                        <h4 class="mb-sm-0 font-size-18">Administrar Servicio</h4>
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
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#newServicess">Nuevo servicio</button>
                            <h5 class="mt-4">Tabla de Servicios</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 tabla_servicio">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Imagen</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    
                                    $servicio = ControladorServicio::ctrMostrarServicio($item, $valor);
                                    foreach ($servicio as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                          echo '<td>' . $value["codigo"] . '</td>';
                                        if ($value["imagen"] != "") {
                                            echo '<td><img src="' . $value["imagen"] . '" style="border-radius: 5px;" width="80" alt=""></td>';
                                        } else {
                                            echo '<td><img src="vistas/img/servicios/default/default.jpg" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        }
                                        echo '<td>' . $value["titulos"] . '</td>';
                                        echo '<td>' . $value["texto"] . '</td>';

                                        echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarServicio" idServicio="' . $value["id_servicio"] . '" data-bs-toggle="modal" data-bs-target="#editar_servicio">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarServicio" idServicio="' . $value["id_servicio"] . '" imagen="' . $value["imagen"] . '" codigo="' . $value["codigo"] . '">
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
MODAL NUEVO USUARIO
==================================== -->

<div id="newServicess" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <?php
                            $item = null;
                            $valor = null;
                            $codigo = ControladorServicio::ctrMostrarServicio($item, $valor);
                            $contador = count($codigo);
                            $ultimoDato = end($codigo);
                            if($contador == 0){
                                echo '<label for="codigo">Ingrese el código:</label><small>(A001)</small>';
                            }else{
                                foreach($codigo as $key => $value){
                                    if($ultimoDato == $value) {
                                        echo '<label for="codigo">Ingrese el código que sigue a:  </label>  <small class="bg-success" style="border-radius:2px 2px; color: white;">   ('.$value["codigo"].')</small>';

                                    }
                                }    
                            }
                            ?>
                        <input class="form-control" type="text" name="nuevoCodigoS" placeholder="A001, A002, A003, ..." require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Subir foto de servicio</label>
                        <input class="form-control nuevoFotoS" type="file" accept="image/*" capture="camera" name="nuevoFotoS" require>
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/servicio/default/default.jpg" class="previsualizarS" width="200px" style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Titulo del servicio</label>
                        <input class="form-control" type="text" name="nuevoTitulosS" placeholder="Título de servicio" require>
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion">Descripción del servicio</label>
                        <textarea name="nuevoDescripcionS" cols="30" rows="10" class="form-control" placeholder="Ingrese una descripción del servicio" require></textarea>
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoServicio = new ControladorServicio();
                $nuevoServicio->ctrCrearServicio();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_servicio" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarIdServicio" id="editarIdServicio" require>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarCodigoS" id="editarCodigoS" placeholder="A001, A002, A003, ..." require>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto de Servicios</label>
                        <input type="file" accept="image/*" capture="camera" class="form-control EditarFotoS" name="editarFotoS">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/servicio/default/default.png" class="previsualizarEditarS" width="200px" style="border-radius: 5px;">
                        </div>
                        <input type="hidden" name="fotoActualS" id="fotoActualS">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Título de servicio</label>
                        <input class="form-control" type="text" name="editarTituloS" id="editarTituloS" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Descripción del servicio</label>
                        <textarea class="form-control" name="editarTextoS" id="editarTextoS" cols="30" rows="10"></textarea>
                    </div>
               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $editarServicio = new ControladorServicio();
                $editarServicio->ctrEditarServicio();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR SERVICIO
=========================================== -->
<?php

$borrarServicio = new ControladorServicio();
$borrarServicio->ctrBorrarServicio();

}else{
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>